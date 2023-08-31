<?php
include 'includes/conn.php';
include 'utils/bills.php';

if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attend Patient</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <!-- <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet"> -->

</head>

<body>

    <!--*******************
    Preloader start
********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
    Preloader end
********************-->

    <!--**********************************
    Main wrapper start
***********************************-->
    <div id="main-wrapper">
        <?php
        include 'includes/header.php';
        $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$id'");
        $row = mysqli_fetch_array($getpatient);
        $patient_id = $row['patient_id'];
        $firstname = $row['firstname'];
        $secondname = $row['secondname'];
        $thirdname = $row['thirdname'];
        $insurancecompany = $row['insurancecompany'];
        $creditclient = $row['creditclient'];
        
        if (!empty($insurancecompany)) {
            $getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurancecompany'");
            $row1 =  mysqli_fetch_array($getcompany);
            $companyname = $row1['company'];
        }
        if (!empty($creditclient)) {
            $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE creditclient_id='$creditclient'");
            $row = mysqli_fetch_array($getclients);
            $clientname = $row['clientname'];
        } else {
            $clientname = "N/A";
        }
        $ext = $row2['ext'];
        $getpay = mysqli_query($con, "SELECT * FROM paymethod WHERE status='1' AND patient_id='$patient_id'");
        if (mysqli_num_rows($getpay) > 0) {
            $payrow = mysqli_fetch_array($getpay);
            $paymenttype = $payrow['method'];
        } else {
            $paymenttype = "cash";
        }
        if (strlen($patient_id) == 1) {
            $pin = '000' . $patient_id;
        }
        if (strlen($patient_id) == 2) {
            $pin = '00' . $patient_id;
        }
        if (strlen($patient_id) == 3) {
            $pin = '0' . $patient_id;
        }
        if (strlen($patient_id) >= 4) {
            $pin = $patient_id;
        }
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Attend <?php echo $firstname . ' ' . $secondname . ' ' . $thirdname . ' (' . $pin . ')'; ?></h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patient">Attend Patient</a></li>
                            <li class="breadcrumb-item active"><a href="#">Attend Patient</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attend Patient</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['mode'])) {
                                        $mode = $_POST['mode'];
                                        $room = $_POST['room'];
                                        $doctor = "";
                                        $nurse = "";
                                        $paymentmethod = $_POST['paymentmethod'];
                                        $errors = array();
                                        if (empty($mode)) {
                                            $errors[] = 'Mode Type Required';
                                        }
                                        if ($room == 'nurse') {
                                            $attendant = $nurse;
                                        }
                                        if ($room == 'doctor') {
                                            $attendant = $doctor;
                                        }
                                        
                                        $getadmissions = mysqli_query($con, "SELECT * FROM admissions WHERE patient_id='$id' AND status='1'");
                                        if (mysqli_num_rows($getadmissions) > 0) {
                                            $errors[] = 'Patient Already Admitted';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO admissions(patient_id,mode,timestamp,dischargedate,admin_id,paymethod,status) VALUES('$id','$mode',UNIX_TIMESTAMP(),0,'" . $_SESSION['elcthospitaladmin'] . "','$paymentmethod',1)") or die(mysqli_error($con));
                                            
                                            if ($mode == 'normal') {
                                                $last_id = mysqli_insert_id($con);
                                                $admission_id = $last_id;
                                                if ($room == 'clinic'){
                                                    $getpatient= mysqli_query($con, "SELECT * FROM patients WHERE patient_id='$id'");
                                                    $row = mysqli_fetch_array($getpatient);
                                                    $clinic = $row['clinic'];
                                                    mysqli_query($con, "UPDATE clinic_clients SET status='1' WHERE clinic_cl_id ='$clinic'") or die(mysqli_error($con));
                                                    mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status) VALUES('$last_id','$room','','1','" . $_SESSION['elcthospitaladmin'] . "','receptionist',UNIX_TIMESTAMP(),0)") or die(mysqli_error($con));
                                                    $patientsque_id = mysqli_insert_id($con);
                                                    echo '<div class="alert alert-success">Patient Successfully Attended.</div>';
                                                    
                                                }else{
                                                    mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status) VALUES('$last_id','$room','$attendant','0','" . $_SESSION['elcthospitaladmin'] . "','receptionist',UNIX_TIMESTAMP(),0)") or die(mysqli_error($con));
                                                    $patientsque_id = mysqli_insert_id($con);

                                                if (isset($_POST['medicalservices'])) {
                                                    $cashfallbacks = [];
                                                    $mservices = [];
                                                    $medicalservices = $_POST['medicalservices'];
                                                    foreach ($medicalservices as $service) {
                                                        $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
                                                        $row1 =  mysqli_fetch_array($getmedicalservice);
                                                        if ($paymentmethod == 'cash') {
                                                            $charge = $row1['charge'];
                                                        } else if ($paymentmethod == 'credit') {
                                                            $charge = $row1['creditprice'];
                                                        } else if ($paymentmethod == 'insurance') {
                                                            $getinsured =  mysqli_query($con, "SELECT * FROM insuredservices WHERE status=1 AND medicalservice_id='$service' AND insurancecompany_id='$insurancecompany'");
                                                            if (mysqli_num_rows($getinsured) > 0) {
                                                                $insurance =  mysqli_fetch_array($getinsured);
                                                                $insuredservice_id = $insurance['insuredservice_id'];
                                                                $charge = $insurance['charge'];
                                                            }
                                                        }
                                                        if (empty($charge)) {
                                                            $cashfallbacks[$service] = $row1['charge'];
                                                        } else {
                                                            $mservices[$service] = $charge;
                                                        }
                                                    }
                                                    if (!empty($cashfallbacks)) {
                                                        mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'cash',0,'reception',0,0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        $total_amount = array_sum($cashfallbacks);
                                                        create_bill($pdo, $patient_id, $admission_id, $patientsque_id, 'medical_service', $last_id, $total_amount, 'cash');
                                                        foreach ($cashfallbacks as $service => $charge)
                                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                    }
                                                    if (!empty($mservices)) {
                                                        mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymentmethod',0,'reception',0,0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        $total_amount = array_sum($mservices);
                                                        create_bill($pdo, $patient_id, $admission_id, $patientsque_id, 'medical_service', $last_id, $total_amount, $paymentmethod);
                                                        foreach ($mservices as $service => $charge)
                                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                    }
                                                }
                                                echo '<div class="alert alert-success">Patient Successfully Attended.</div>';
                                                }
                                            }else{
                                                $last_id = mysqli_insert_id($con);
                                                $admission_id = $last_id;
                                                $attendant='';
                                                mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status) VALUES('$last_id','doctor','$attendant','0','" . $_SESSION['elcthospitaladmin'] . "','receptionist',UNIX_TIMESTAMP(),0)") or die(mysqli_error($con));
                                                $patientsque_id = mysqli_insert_id($con);
                                                if (isset($_POST['medicalservices'])) {
                                                    $cashfallbacks = [];
                                                    $mservices = [];
                                                    $medicalservices = $_POST['medicalservices'];
                                                    foreach ($medicalservices as $service) {
                                                        $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
                                                        $row1 =  mysqli_fetch_array($getmedicalservice);
                                                        if ($paymentmethod == 'cash') {
                                                            $charge = $row1['charge'];
                                                        } else if ($paymentmethod == 'credit') {
                                                            $charge = $row1['creditprice'];
                                                        } else if ($paymentmethod == 'insurance') {
                                                            $getinsured =  mysqli_query($con, "SELECT * FROM insuredservices WHERE status=1 AND medicalservice_id='$service' AND insurancecompany_id='$insurancecompany'");
                                                            if (mysqli_num_rows($getinsured) > 0) {
                                                                $insurance =  mysqli_fetch_array($getinsured);
                                                                $insuredservice_id = $insurance['insuredservice_id'];
                                                                $charge = $insurance['charge'];
                                                            }
                                                        }
                                                        if (empty($charge)) {
                                                            $cashfallbacks[$service] = $row1['charge'];
                                                        } else {
                                                            $mservices[$service] = $charge;
                                                        }
                                                    }
                                                    if (!empty($cashfallbacks)) {
                                                        mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'cash',0,'reception',0,0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        $total_amount = array_sum($cashfallbacks);
                                                        create_bill($pdo, $patient_id, $admission_id, $patientsque_id, 'medical_service', $last_id, $total_amount, 'cash');
                                                        foreach ($cashfallbacks as $service => $charge)
                                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                    }
                                                    if (!empty($mservices)) {
                                                        mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymentmethod',0,'reception',0,0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        $total_amount = array_sum($mservices);
                                                        create_bill($pdo, $patient_id, $admission_id, $patientsque_id, 'medical_service', $last_id, $total_amount, $paymentmethod);
                                                        foreach ($mservices as $service => $charge)
                                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                    }
                                                }
                                                echo '<div class="alert alert-success">Patient Successfully Attended.</div>';
                                            }
                                        }
                                    }

                                    ?>
                                    <form action="" method="POST">

                                        <div class="form-group">
                                            <label>Select Mode</label>
                                            <select class="form-control mode" name="mode">
                                                <option selected="selected" value="">Select option..</option>
                                                <option value="emergency">Emergency Mode</option>
                                                <option value="normal">Normal Mode</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Payment Method</label>
                                            <select class="form-control" name="paymentmethod">
                                                <option value="">Select option..</option>
                                                <option value="cash">Cash</option>
                                                <!-- <option value="cash postpaid">Cash Postpaid</option> -->
                                                <?php if ($paymenttype == "credit") { ?>
                                                    <option value="credit" selected>Credit - <?php echo $clientname; ?></option>
                                                <?php } else if ($paymenttype == "insurance") { ?>
                                                    <option value="insurance" selected>Insurance - <?php echo isset($companyname) ? $companyname : "N/A" ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group fornormal" style="display: none">
                                            <label>Select Destination</label>
                                            <select class="form-control room" name="room">
                                                <option selected="selected" value="">Select option..</option>
                                                <option value="nurse">Nurse Room</option>
                                                <option value="doctor">Doctor Room</option>
                                                <option value="clinic">Clinic</option>
                                            </select>
                                        </div>
                                        <!-- <div class="form-group doctors" style="display: none">
                                            <label>Select Doctor</label>
                                            <select class="form-control room" name="doctor">
                                                <option selected="selected" value="">Select option..</option>
                                                <?php
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='doctor'");
                                                while ($row = mysqli_fetch_array($getstaff)) {
                                                    $staff_id = $row['staff_id'];
                                                    $fullname = $row['fullname'];
                                                ?>
                                                    <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group nurses" style="display: none">
                                            <label>Select Nurse</label>
                                            <select class="form-control room" name="nurse">
                                                <option selected="selected" value="">Select option..</option>
                                                <?php
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='nurse'");
                                                while ($row = mysqli_fetch_array($getstaff)) {
                                                    $staff_id = $row['staff_id'];
                                                    $fullname = $row['fullname'];
                                                ?>
                                                    <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div> -->
                                        <?php /*
                                        <div class="form-group">
                                            <label class="control-label">Department</label>
                                            <select class="form-control" id="category" name="department" data-parsley-id="1560" class="form-control parsley-error" data-parsley-required="true">
                                                <option value="" selected="selected">Choose Department...</option>
                                                <?php
                                                $getdepartment =  mysqli_query($con, "SELECT * FROM departments WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getdepartment)) {
                                                    $department_id = $row1['department_id'];
                                                    $department = $row1['department'];
                                                    $getsections = mysqli_query($con, "SELECT * FROM sections WHERE department_id='$department_id'");
                                                ?>
                                                    <option value="<?php echo $department_id; ?>"><?php echo $department; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php */ ?>
                                        <div class="form-group ward">
                                            <label class="control-label">Section</label>
                                            <select name="section" class="sections form-control">
                                                <option value="">Select Section</option>
                                                <?php
                                                $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getsections)) {
                                                    $section_id = $row1['section_id'];
                                                    $section = $row1['section'];
                                                ?>
                                                    <option value="<?php echo $section_id; ?>"><?php echo $section; ?></option>
                                                <?php } ?>
                                            </select>                                            
                                        </div>
                                        <div class="form-group ward">
                                            <label class="control-label">Medical Services</label>
                                            <select name="servicename" id="servicename" class="form-control">
                                                <option value="">Select Medical Service</option>
                                            </select>
                                            <?php
                                            $getsection =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                            while ($row =  mysqli_fetch_array($getsection)) {
                                                $section_id = $row['section_id'];
                                            ?>
                                                <div id="service<?php echo $section_id; ?>" style="display:none;width:100%;" class="row services form-group">

                                                    <?php
                                                    $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND section_id='$section_id' ORDER BY medicalservice");
                                                    while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                                        $medicalservice_id = $row1['medicalservice_id'];
                                                        $medicalservice = $row1['medicalservice'];
                                                        $charge = $row1['charge'];
                                                    ?>
                                                        <div class="col-lg-6">
                                                            <div class="form-check form-check-inline">
                                                                <label class="form-check-label" style="font-size:14px">
                                                                    <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="medicalservices[]"><?php echo $medicalservice; ?>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Footer start
    ***********************************-->
    <?php
    include 'includes/footer.php';
    ?>
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
        Support ticket button start
    ***********************************-->

    <!--**********************************
        Support ticket button end
    ***********************************-->


    </div>
    <!--**********************************
    Main wrapper end
***********************************-->

    <!--**********************************
    Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>


    <!-- Dashboard 1 -->
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('.mode').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'normal')) {
                $('.fornormal').show();
                $('.room').on('change', function() {
                    var getroom = $(this).val();
                    if ((getroom == '')) {
                        $('.nurses').hide();
                        $('.doctors').hide();
                    }
                    if ((getroom == 'nurse')) {
                        $('.nurses').show();
                        $('.doctors').hide();
                    }
                    if ((getroom == 'doctor')) {
                        $('.nurses').hide();
                        $('.doctors').show();
                    }
                });
            } else {
                $('.fornormal').hide();

            }
        });
        $('.room').on('change',function(){
            var getroom= $(this).val();
            if (getroom == 'clinic') {
                $('.clinic').show();
                $('.ward').hide();
            }else{
                $('.clinic').hide();
                $('.ward').show();
            }
        })
        
        $('.sections').on('change', function() {
            var getselect = $(this).val();
            if ((getselect != '')) {
                $('#servicename').hide();
                $('.services').hide();
                $('#service' + getselect).show();
            } else {
                $('#servicename').show();
                $('.services').hide();
            }
        });
    </script>
</body>

</html>