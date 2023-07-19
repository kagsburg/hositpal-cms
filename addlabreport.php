<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'lab technician')) {
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
    <title>Add Patient Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

    <style>
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef;
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
                            <h4>Add Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="labwaiting">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Report</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
                    $row = mysqli_fetch_array($getque);
                    $patientsque_id = $row['patientsque_id'];
                    $admission_id = $row['admission_id'];
                    $room = $row['room'];
                    $attendant = $row['attendant'];
                    $admin_id = $row['admin_id'];
                    $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
                    $row1 = mysqli_fetch_array($getadmission);
                    $patient_id = $row1['patient_id'];
                    $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                    $row2 = mysqli_fetch_array($getpatient);
                    $firstname = $row2['firstname'];
                    $secondname = $row2['secondname'];
                    $thirdname = $row2['thirdname'];
                    $gender = $row2['gender'];
                    $ext = $row2['ext'];
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
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">

                                <div class="profile-blog mb-5">
                                    <img src="images/patients/thumbs/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['details'])) {
                                        $details =mysqli_real_escape_string($con,trim($_POST['details']));

                                        mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$admin_id','1','" . $_SESSION['elcthospitaladmin'] . "','lab technician',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
                                        //                      $last_id= mysqli_insert_id($con);
                                        mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                        if (isset($_POST['test'], $_POST['result'])) {
                                            $test = $_POST['test'];
                                            $result = $_POST['result'];
                                            $alltests = sizeof($test);
                                            foreach($test as $key => $value){
                                                $test_id = $value;
                                                $result_id = $result[$key];
                                                mysqli_query($con, "INSERT INTO labreports(test,result,patientsque_id,details,status) VALUES('$test_id','$result_id','$id','$details','1')") or die(mysqli_error($con));
                                            }
                                           
                                        }
                                    ?>

                                    <?php
                                     $_SESSION['success'] = '<div class="alert alert-success">Patient Report Successfully Added</div>';
                                     // redirect to labwaiting
                                     echo '<script>window.location.href = "labwaiting.php";</script>';
                                                
                                     exit();
                                        // echo '<div class="alert alert-success">Patient Report Successfully Added</div>';
                                    }

                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">


                                        <div class="col-lg-12">
                                            <h4>Measurements</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class='subobj1'>
                                                <?php 
                                                $total = 0;
                                                    $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE  patientsque_id='$patientsque_id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        $serviceorder_id = $rowo['laborder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $medicalservice_id = $row['investigationtype_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];
                                                            ?>

                                                            <div class='row'>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test done</label>
                                                                    <input type="hidden" name="test[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-5">
                                                                    <label>Result</label>
                                                                    <input type="text" name="result[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter result">
                                                                </div>

                                                                <!-- <div class="form-group col-lg-1">
                                                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                                </div> -->
                                                            </div>
                                                        <?php 
                                                        } 
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="control-label">* More Details if any</label>
                                            <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details"></textarea>
                                        </div>
                                        <div class="form-group pull-left">
                                            <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                        </div>
                                        <div class="form-group pull-right">
                                            <button class="btn btn-primary" type="submit">Proceed</button>
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
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Test Done</label>    <input type="text"  name="test[]" class="form-control " placeholder="Enter test"></div>  <div class="form-group col-lg-6"> <label>Result</label>   <input type="text"  name="result[]" class="form-control " placeholder="Enter Result"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    </script>
</body>

</html>
