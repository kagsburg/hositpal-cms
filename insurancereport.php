<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/bills.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
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
    <title>Insurance Services</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        .profile-tab .nav-item .nav-link {
            margin-right: 10px;
            font-size: 15px;
            padding: 0.5rem 0.8rem;
        }
    </style>
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
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Insurance Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patient?id<?php echo $id; ?>">Patient</a></li>
                            <li class="breadcrumb-item active"><a href="#">View Insurance Report</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $getpatients = mysqli_query($con, "SELECT * FROM patients WHERE patient_id='$id'");
                    $row = mysqli_fetch_array($getpatients);
                    $status = $row['status'];
                    $patient_id = $row['patient_id'];
                    $firstname = $row['firstname'];
                    $secondname = $row['secondname'];
                    $thirdname = $row['thirdname'];
                    $gender = $row['gender'];
                    $dob = $row['dob'];
                    $maritalstatus = $row['maritalstatus'];
                    $spousename = $row['spousename'];
                    $spouseaddress = $row['spouseaddress'];
                    $spousephone = $row['spousephone'];
                    $religion = $row['religion'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $occupation = $row['occupation'];
                    $email = $row['email'];
                    $ext = $row['ext'];
                    $employmentstatus = $row['employmentstatus'];
                    $employername = $row['employername'];
                    $employeraddress = $row['employeraddress'];
                    $employernumber = $row['employernumber'];
                    $emergencyname = $row['emergencyname'];
                    $emergencyphone = $row['emergencyphone'];
                    $emergencyrelationship = $row['emergencyrelationship'];
                    $emergencyaddress = $row['emergencyaddress'];
                    $insurancecompany = $row['insurancecompany'];
                    $subscribername = $row['subscribername'];
                    $socialsecuritynumber = $row['socialsecuritynumber'];
                    $policyidnumber = $row['policyidnumber'];
                    $insurancedob = $row['insurancedob'];
                    $insuranceemployer = $row['insuranceemployer'];
                    $bloodgroup = $row['bloodgroup'];
                    $weight = $row['weight'];
                    $height = $row['height'];
                    $allergies = $row['allergies'];
                    $diseases = $row['diseases'];
                    $pregnancies = $row['pregnancies'];
                    $smoke = $row['smoke'];
                    $drink = $row['drink'];
                    $exercise = $row['exercise'];
                    $specialdiet = $row['specialdiet'];
                    $druguse = $row['druguse'];
                    $drugtypes = $row['drugtypes'];
                    $activities = $row['activities'];
                    $subscribername = $row['subscribername'];
                    $socialsecuritynumber = $row['socialsecuritynumber'];
                    $policyidnumber = $row['policyidnumber'];
                    $insurancedob = $row['insurancedob'];
                    $insuranceemployer = $row['insuranceemployer'];
                    $insurancecardext = $row['insurancecardext'];
                    $secondarysubscribername = $row['secondarysubscribername'];
                    $patientrelation = $row['patientrelation'];
                    $workphone = $row['workphone'];
                    $level = $row['level'];
                    $docext = $row['docext'];
                    $paymenttype = get_payment_method($pdo, $patient_id);
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

                    if (!empty($ext))
                        $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                    else
                        $pimage = "noimage.png";

                    if (!empty($insurancecompany)) {
                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurancecompany'");
                        $row1 =  mysqli_fetch_array($getcompanies);
                        $insurancecompany_id = $row1['insurancecompany_id'];
                        $company = $row1['company'];
                        $companyname = $company;
                    } else {
                        $companyname = 'None';
                    }
                    ?>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table  table-striped table-responsive-sm">
                                        <tbody>
                                            <tr>
                                                <th>PIN</th>
                                                <td>#<?php echo $pin; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Fullnames</th>
                                                <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Insurance Company</th>
                                                <td><?php echo $companyname; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Insurance Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px" data-order="[]">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Services</th>                                                
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $lastadmission = get_last_admission($pdo, $patient_id);
                                                $lastadmission_id = $lastadmission['admission_id'];
                                                $bills = get_admission_bills_for_paymethod($pdo, $lastadmission_id, 'insurance');

                                                foreach ($bills as $bill) {
                                                    $type = $bill['type'];
                                                    $type_id = $bill['type_id'];
                                                    $troom = ucwords(str_replace('_', ' ', $type));
                                                    if ($type == "lab") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE  laborder_id='$type_id'");
                                                        $key = "laborder_id";
                                                    } else if ($type == "radiography") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE  radioorder_id='$type_id'");
                                                        $key = "radioorder_id";
                                                    } else if ($type == "medical_service") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$type_id'");
                                                        $key = "serviceorder_id";
                                                    } else if ($type == "unselective") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice_id='$type_id'");
                                                        $key = "medicalservice_id";
                                                    }

                                                    if (isset($getorder) && mysqli_num_rows($getorder) > 0) {
                                                        while ($rowo = mysqli_fetch_array($getorder)) {

                                                            $serviceorder_id = $rowo[$key];
                                                            $room = $type;
                                                            $service_html = "";

                                                            if ($type == "lab") {
                                                                $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                    $medicalservice_id = $row['investigationtype_id'];
                                                                    $unitcharge = $row['charge'];
                                                                    $total = $total + $unitcharge;
                                                                    $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                    $medicalservice = $row2['investigationtype'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "radiography") {
                                                                $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                    $medicalservice_id = $row['radioinvestigationtype_id'];
                                                                    $unitcharge = $row['charge'];
                                                                    $total = $total + $unitcharge;
                                                                    $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                    $medicalservice = $row2['investigationtype'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "medical_service") {
                                                                $getservices = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1");
                                                                while ($rows = mysqli_fetch_array($getservices)) {
                                                                    $medicalservice_id = $rows['medicalservice_id'];
                                                                    $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                                    $rowm =  mysqli_fetch_array($getmedicalservice);
                                                                    $medicalservice = $rowm['medicalservice'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "unselective") {
                                                                $medicalservice = $rowo['medicalservice'];
                                                                $service_charge = get_service_charge($pdo, $serviceorder_id, $paymenttype, $insurance_id, 2);
                                                                $paymenttype = $service_charge['payment_type'];
                                                                $service_html .= '<li>' . $medicalservice . '</li>';
                                                            }
                                                        }
                                                    }

                                            ?>
                                                <tr>
                                                    <td><?php echo $troom; ?></td>
                                                    <td><?php echo $service_html; ?></td>
                                                    <td><?php echo $bill['amount']; ?></td>
                                                    <td>
                                                        <!-- <a href="print_invoice.php?invoice=<?php echo $bill['invoice']; ?>" target="_blank" class="btn btn-primary btn-sm">Print</a> -->
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>


    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>