<?php
include 'includes/conn.php';
include "utils/bills.php";
include "utils/patients.php";
include "utils/services.php";
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
if (!isset($_SESSION['patientreg'])) {
    header("Location:addpatient.php");
} else {
    $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='" . $_SESSION['patientreg'] . "'");
    $row =  mysqli_fetch_array($getpatient);
    $patient_id = $row['patient_id'];
    $level = $row['level'];
    $firstname = $row['firstname'];
    $secondname = $row['secondname'];
    $thirdname = $row['thirdname'];
    $paymenttype = $row['paymenttype'];
    if ($level != 1) {
        header("Location:addpatient.php");
    }
    // if ($level == 3) {
    //     header("Location:addpatient3.php");
    // }
    // if ($level == 4) {
    //     header("Location:addpatient4.php");
    // }
    // if ($level == 5) {
    //     header("Location:addpatient5.php");
    // }
    // if ($level == 6) {
    //     header("Location:addpatient.php");
    // }
}
if (isset($_POST['emergencyaddress'], $_POST['emergencyrelationship'], $_POST['emergencyphone'])) {
    $employmentstatus = '';//$_POST['employmentstatus'];
    $employername = mysqli_real_escape_string($con, trim($_POST['employername']));
    $employeraddress = mysqli_real_escape_string($con, trim($_POST['employeraddress']));
    $employernumber = mysqli_real_escape_string($con, trim($_POST['employernumber']));
    $emergencyname = mysqli_real_escape_string($con, trim($_POST['emergencyname']));
    $emergencyphone = mysqli_real_escape_string($con, trim($_POST['emergencyphone']));
    $emergencyrelationship = mysqli_real_escape_string($con, trim($_POST['emergencyrelationship']));
    $emergencyaddress = mysqli_real_escape_string($con, trim($_POST['emergencyaddress']));
    // if (empty($employmentstatus)) {
    //     $errors[] = 'Select Status to Proceed';
    // }
    if (($employmentstatus == 'Full Time') || ($employmentstatus == 'Part Time')) {
        if ((empty($employername)) || (empty($employeraddress)) || (empty($employernumber))) {
            $errors[] = 'Employer Details should be filled';
        }
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    } else {
        mysqli_query($con, "UPDATE patients SET employmentstatus='$employmentstatus',employername='$employername',employeraddress='$employeraddress',employernumber='$employernumber',emergencyname='$emergencyname',emergencyrelationship='$emergencyrelationship',emergencyphone='$emergencyphone',emergencyaddress='$emergencyaddress',level=4,status=3 WHERE patient_id='" . $_SESSION['patientreg'] . "'") or die(mysqli_error($con));
        
                                                    
        $_SESSION['flash_message'] = 'Patient Information Successfully Added.';
        unset($_SESSION["patientreg"]);    
        header("Location:registrationpending.php");                                
        // echo '<div class="alert alert-success">Patient Information Successfully Added.Click <a href="addpatient3.php">here</a> to proceed</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient</title>
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
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Patient</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patients">Patients</a></li>
                            <li class="breadcrumb-item active"><a href="addpatient.php">Add Patient</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Patient : PART TWO</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">                                
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                            <div class="row">


                                                <!-- <div class="form-group col-lg-4"><label class="control-label">* Employment Status</label>

                                                    <select name="employmentstatus" class="form-control employmentstatus">

                                                        <option value="">select status...</option>
                                                        <option value="Full time">Full time</option>
                                                        <option value="Part time">Part time</option>
                                                        <option value="Unemployed">Unemployed</option>
                                                        <option value="Retired">Retired</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <div id='form_employmentstatus_errorloc' class='text-danger'></div>
                                                </div> -->

                                            </div>
                                            <div class="row foremployed" style="display: none">
                                                <div class="form-group col-lg-4"><label class="control-label">*Employer Name</label>
                                                    <input type="text" name="employername" class="form-control " placeholder="Enter Employer Name">
                                                </div>
                                                <div class="form-group col-lg-4"><label class="control-label">*Employer Address</label>
                                                    <input type="text" name="employeraddress" class="form-control " placeholder="Enter Employer Address">
                                                </div>
                                                <div class="form-group col-lg-4"><label class="control-label">*Employer Number</label>
                                                    <input type="text" name="employernumber" class="form-control " placeholder="Enter Employer Number">
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4>Emergency Contact</h4>
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">FullName</label>
                                                <input type="text" name="emergencyname" class="form-control " placeholder="Enter Fullname">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">Relationship to Patient</label>
                                                <input type="text" name="emergencyrelationship" class="form-control " placeholder="Enter Relationship">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">Phone Number</label>
                                                <input type="text" name="emergencyphone" class="form-control " placeholder="Enter  Phone Number">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">Address</label>
                                                <input type="text" name="emergencyaddress" class="form-control " placeholder="Enter Emergency address">

                                            </div>

                                        </div>
                                        <div class="form-group pull-left">
                                            <!--<a class="btn btn-success" a href="addpatient.php">Back</a>-->
                                        </div>
                                        <div class="form-group pull-right">
                                            <a href="canceladdpatient" class="btn btn-danger" onclick="return cancelpatient()">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <script type="text/javascript">
                                                function cancelpatient() {
                                                    return confirm('You are about To Cancel this process. Are you sure you want to proceed?');
                                                }
                                            </script>
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
    <!-- <script src="vendor/apexchart/apexchart.js"></script> -->
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('.employmentstatus').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'Full time') || (getselect == 'Part time')) {
                $('.foremployed').show();
            } else {
                $('.foremployed').hide();

            }
        });
        var frmvalidator = new Validator("form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        // frmvalidator.addValidation("email", "email", "*Enter a valid  email address");
        // frmvalidator.addValidation("gender", "req", "*Gender is required");
        // frmvalidator.addValidation("department", "req", "*Department is required");
        // frmvalidator.addValidation("employementstatus", "req", "*Employment Status is required");
        //             frmvalidator.addValidation("password","minlength=6","*password  should atleast be 6 characters");
        // frmvalidator.addValidation("repeat", "eqelmnt=password", "*The passwords dont match");

    </script>
</body>

</html>