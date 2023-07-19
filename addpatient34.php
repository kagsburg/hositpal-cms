<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
if (!isset($_SESSION['patientreg'])) {
    header("Location:addpatient.php");
} else {
    $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='" . $_SESSION['patientreg'] . "'");
    $row =  mysqli_fetch_array($getpatient);
    $level = $row['level'];
    if ($level == 1) {
        header("Location:addpatient1.php");
    }
    if ($level == 2) {
        header("Location:addpatient2.php");
    }
    if ($level == 4) {
        header("Location:addpatient4.php");
    }
    if ($level == 5) {
        header("Location:addpatient5.php");
    }
    if ($level == 6) {
        header("Location:addpatient.php");
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
                                <h4 class="card-title">PART FOUR</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                                    if (isset($_POST['smoke'], $_POST['drink'], $_POST['druguse'], $_POST['drugtypes'], $_POST['exercise'], $_POST['specialdiet'], $_POST['activities'])) {
                                        $smoke = $_POST['smoke'];
                                        $drink = $_POST['drink'];
                                        $druguse = $_POST['druguse'];
                                        $exercise = $_POST['exercise'];
                                        $specialdiet = $_POST['specialdiet'];
                                        $drugtypes = mysqli_real_escape_string($con, trim($_POST['drugtypes']));
                                        $activities = mysqli_real_escape_string($con, trim($_POST['activities']));
                                        if ((empty($smoke)) || (empty($drink)) || (empty($druguse)) || (empty($exercise)) || (empty($specialdiet))) {
                                            echo '<div class="alert alert-danger">Some Fields are empty</div>';
                                        } else {
                                            mysqli_query($con, "UPDATE patients SET smoke='$smoke',drink='$drink',druguse='$druguse',drugtypes='$drugtypes',exercise='$exercise',specialdiet='$specialdiet',activities='$activities',level='4' WHERE patient_id='" . $_SESSION['patientreg'] . "'") or die(mysqli_error($con));
                                    ?>
                                            <script type="text/javascript">
                                                window.location = "addpatient4.php";
                                            </script>
                                    <?php
                                            echo '<div class="alert alert-success">Patient Information Successfully Added.Click <a href="addpatient5.php">here</a> to proceed</div>';
                                        }
                                    }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label">Do u Smoke?</label>
                                                <select name="smoke" class="form-control subscriptiontype">
                                                    <option value="">select status...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div id='form_smoke_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Do u Drink Alcohol?</label>
                                                <select name="drink" class="form-control subscriptiontype">
                                                    <option value="">select status...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div id='form_drink_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="control-label">Any history of illegal drug use?</label>
                                                <select name="druguse" class="form-control drughistory">
                                                    <option value="">select status...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div id='form_druguse_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-4 drugtype" style="display: none"><label class="control-label">What Drug Types?</label>
                                                <input type="text" name="drugtypes" class="form-control " placeholder="Enter Drug Type">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="control-label">Do you exercise?</label>
                                                <select name="exercise" class="form-control  exercise">
                                                    <option value="">select status...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div id='form_exercise_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="control-label">Are you on any special diet?</label>
                                                <select name="specialdiet" class="form-control">
                                                    <option value="">select diet...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                                <div id='form_specialdiet_errorloc' class='text-danger'></div>
                                            </div>
                                            <div class="form-group col-lg-6 activities" style="display: none"><label class="control-label">what kind of activities do you do?</label>
                                                <textarea name="activities" class="form-control " placeholder="Enter Activities"></textarea>
                                            </div>
                                        </div>



                                        <div class="form-group pull-left">
                                            <!--<a class="btn btn-success" a href="addpatient4.php">Back</a>-->
                                        </div>
                                        <div class="form-group pull-right">
                                            <a href="canceladdpatient" class="btn btn-danger" onclick="return cancelpatient()">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Proceed</button>
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
    <script src="vendor/apexchart/apexchart.js"></script>
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('.drughistory').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'Yes')) {
                $('.drugtype').show();
            } else {
                $('.drugtype').hide();
            }
        });
        $('.exercise').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'Yes')) {
                $('.activities').show();
            } else {
                $('.activities').hide();
            }
        });
        var frmvalidator = new Validator("form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("smoke", "req", "*Select to proceed");
        frmvalidator.addValidation("drink", "req", "*Select to proceed");
        frmvalidator.addValidation("druguse", "req", "*Select to proceed");
        frmvalidator.addValidation("exercise", "req", "*Select to proceed");
        frmvalidator.addValidation("specialdiet", "req", "*Select to proceed");
    </script>
</body>

</html>