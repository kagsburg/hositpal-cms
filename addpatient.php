<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
if (isset($_SESSION['patientreg'])) {
    $getpatient =  mysqli_query($con, "SELECT * FROM patients WHERE patient_id='" . $_SESSION['patientreg'] . "'");
    $row =  mysqli_fetch_array($getpatient);
    $level = $row['level'];
    if ($level == 1) {
        header("Location:addpatient1.php");
    }
    // if ($level == 2) {
    //     header("Location:addpatient2.php");
    // }
    // if ($level == 3) {
    //     header("Location:addpatient3.php");
    // }
    // if ($level == 4) {
    //     header("Location:addpatient4.php");
    // }
    // if ($level == 5) {
    //     header("Location:addpatient5.php");
    // }
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
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

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
                            <h4>Add Patient </h4>

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
                                <h4 class="card-title">Add Patient : PART ONE</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <?php
                                    if (isset($_POST['firstname'], $_POST['secondname'], $_POST['thirdname'], $_POST['gender'], $_POST['dob'], $_POST['spousename'], $_POST['spouseaddress'], $_POST['spousephone'], $_POST['phone'], $_POST['occupation'], $_POST['address'])) {
                                        $firstname = mysqli_real_escape_string($con, trim($_POST['firstname']));
                                        $secondname = mysqli_real_escape_string($con, trim($_POST['secondname']));
                                        $thirdname = mysqli_real_escape_string($con, trim($_POST['thirdname']));
                                        $gender = mysqli_real_escape_string($con, trim($_POST['gender']));
                                        $dob = mysqli_real_escape_string($con, strtotime($_POST['dob']));
                                        $maritalstatus = '';//mysqli_real_escape_string($con, trim($_POST['maritalstatus']));
                                        $spousename = mysqli_real_escape_string($con, trim($_POST['spousename']));
                                        $spouseaddress = mysqli_real_escape_string($con, trim($_POST['spouseaddress']));
                                        $spousephone = mysqli_real_escape_string($con, trim($_POST['spousephone']));
                                        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                                        $address = mysqli_real_escape_string($con, trim($_POST['address']));
                                        $occupation = mysqli_real_escape_string($con, trim($_POST['occupation']));
                                        if ((empty($firstname)) || (empty($secondname)) || (empty($gender)) || (empty($occupation)) || (empty($phone)) || (empty($address)|| empty($dob))) {
                                            echo '<div class="alert alert-danger">All Fields marked * Should be Filled</div>';
                                        } else {
                                            mysqli_query($con, "INSERT INTO patients(firstname,secondname,thirdname,gender,dob,maritalstatus,spousename,spousephone,spouseaddress,religion,occupation,phone,address,email,employmentstatus,employername,employeraddress,employernumber,emergencyname,emergencyrelationship,emergencyphone,emergencyaddress,paymenttype,creditclient,insurancecompany,subscribername,socialsecuritynumber,policyidnumber,insuranceemployer,insurancedob,insurancecardext,secondarysubscribername,patientrelation,workphone,bloodgroup,weight,height,allergies,diseases,pregnancies,smoke,drink,druguse,drugtypes,exercise,specialdiet,activities,ext,docext,admin_id,timestamp,level,status) VALUES('$firstname','$secondname','$thirdname','$gender','$dob','$maritalstatus','$spousename','$spousephone','$spouseaddress','','$occupation','$phone','$address','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),1,'2')") or die(mysqli_error($con));
                                            // mysqli_query($con, "UPDATE patients SET firstname='$firstname',secondname='$secondname',thirdname='$thirdname',gender='$gender',dob='$dob',maritalstatus='$maritalstatus',spousename='$spousename',spousephone='$spousephone',spouseaddress='$spouseaddress',religion='$religion',occupation='$occupation',phone='$phone',address='$address',email='$email',level='2' WHERE patient_id='" . $_SESSION['patientreg'] . "'") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);
                                            $_SESSION['patientreg'] = $last_id;
                                    ?>
                                            <script type="text/javascript">
                                                window.location = "addpatient1.php";
                                            </script>
                                    <?php
                                            echo '<div class="alert alert-success">Patient Information Successfully Added.Click <a href="addpatient2.php">here</a> to proceed</div>';
                                        }
                                    }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="form-group col-lg-4"><label class="control-label">* First Name</label>
                                                <input type="text" name='firstname' class="form-control" placeholder="Enter firstname" required="required">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">* Second Name</label>
                                                <input type="text" name='secondname' class="form-control" placeholder="Enter second name" required="required">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Third Name</label>
                                                <input type="text" name='thirdname' class="form-control" placeholder="Enter Third name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-6"><label class="control-label">* Gender</label>

                                                <select name="gender" class="form-control">
                                                    <option value="">select gender...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div id='form_gender_errorloc' class='text-danger'></div>
                                            </div>

                                            <div class="form-group col-lg-6"><label class="control-label">Date of Birth</label>

                                                <input type="date" name="dob" class="form-control" placeholder="Enter  date of birth">
                                            </div>
                                            <!-- <div class="form-group col-lg-4"><label class="control-label">* Marital Status</label>
                                                <select name="maritalstatus" class="form-control maritalstatus">
                                                    <option value="">select status...</option>
                                                    <option value="married">Married</option>
                                                    <option value="single">Single</option>
                                                    <option value="divorced">Divorced</option>
                                                    <option value="widowed">Widowed</option>
                                                </select>
                                                <div id='form_maritalstatus_errorloc' class='text-danger'></div>
                                            </div> -->
                                        </div>
                                        <div class="row forspouse" style="display: none">
                                            <div class="form-group col-lg-4"><label class="control-label">Spouse Name</label>
                                                <input type="text" name="spousename" class="form-control " placeholder="Enter Spouse Name">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Spouse Address</label>
                                                <input type="text" name="spouseaddress" class="form-control ">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Spouse Phone Number</label>
                                                <input type="text" name="spousephone" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6"><label class="control-label">* Occupation</label>
                                                <input type="text" name="occupation" class="form-control " placeholder="Enter your Occupation">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">* Address</label>
                                                <input type="text" name="address" class="form-control " placeholder="Enter your Adress">
                                            </div>
                                            <div class="form-group col-lg-6"><label class="control-label">* Phone Number</label>
                                                <input type="text" name="phone" class="form-control " placeholder="Enter your Phone Number">
                                            </div>

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
        $('.maritalstatus').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'married')) {
                $('.forspouse').show();
            } else {
                $('.forspouse').hide();

            }
        });
        var frmvalidator = new Validator("form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("gender", "req", "*Gender is required");
        frmvalidator.addValidation("maritalstatus", "req", "*Marital Status is required");
    </script>

</body>

</html>
