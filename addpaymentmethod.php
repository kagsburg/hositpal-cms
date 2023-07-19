<?php
include 'includes/conn.php';
include 'utils/services.php';
include 'utils/bills.php';
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Method Of Payment</title>
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
                            <h4>Add Method Of Payment</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="methodofpayment">Patients</a></li>
                            <li class="breadcrumb-item active"><a href="addpaymentmethod.php">Add Method Of Payment</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Payment Method</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $paymenttype = $_POST['paymenttype'];
                                        $patient = $_POST['patient'];
                                        //$insurancecompany = mysqli_real_escape_string($con, trim($_POST['insurancecompany']));
                                        //$membernumber = mysqli_real_escape_string($con, trim($_POST['membernumber']));
                                        // $method = mysqli_real_escape_string($con, trim($_POST['firstname']));
                                        $creditclient = mysqli_real_escape_string($con, trim($_POST['creditclient']));
                                        //$secondname = mysqli_real_escape_string($con, trim($_POST['secondname']));
                                        //$thirdname = mysqli_real_escape_string($con, trim($_POST['thirdname']));
                                        if (empty($patient)) {
                                            $errors[] = 'Patient should be selected';
                                        }
                                        if (empty($paymenttype)) {
                                            $errors[] = 'Payment Method should be selected';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO paymethod(patient_id,method,user_id,status) VALUES('$patient','$paymenttype','" . $_SESSION['elcthospitaladmin'] . "',2)") or die(mysqli_error($con));
                                            mysqli_query($con, "UPDATE patients SET paymenttype='$paymenttype',creditclient='$creditclient' WHERE patient_id='" . $patient . "'") or die(mysqli_error($con));
                                            // $last_id = mysqli_insert_id($con);
                                            // if ($paymenttype != 'insurance') {
                                            //     $_SESSION['patientreg'] = $last_id;
                                    ?>
                                            <!-- <script type="text/javascript">
                                                    window.location = "addpatient5.php";
                                                </script> -->
                                    <?php
                                            echo '<div class="alert alert-success">Patient Information Successfully Added.</div>';
                                            // } else {
                                            //     echo '<div class="alert alert-success">Payment information Submitted for verification.</div>';
                                            //     unset($_SESSION["patientreg"]);
                                            // }
                                        }
                                    }
                                    ?>
                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label class="control-label">* Patient</label>
                                                <select name="patient" class="form-control" required>
                                                    <option value="">select patient...</option>
                                                    <?php
                                                    $getclients = mysqli_query($con, "SELECT * FROM patients WHERE status IN (1,3) ");
                                                    while ($row = mysqli_fetch_array($getclients)) {
                                                        $patient_id = $row['patient_id'];
                                                        $firstname = $row['firstname'];
                                                        $secondname = $row['secondname'];
                                                        $thirdname = $row['thirdname'];
                                                        $clientname = $firstname . " " . $secondname . " " . $thirdname;
                                                    ?>
                                                        <option value="<?php echo  $patient_id; ?>"><?php echo $clientname; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12"><label class="control-label">* Payment Type</label>
                                                <select name="paymenttype" class="form-control paymenttype">
                                                    <option value="">select status...</option>
                                                    <!-- <option value="cash">Cash</option> -->
                                                    <option value="credit">Credit</option>
                                                    <option value="insurance">Insurance</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row forcredit" style="display: none">
                                            <div class="form-group col-lg-12">
                                                <label class="control-label">* Credit Client</label>
                                                <select name="creditclient" class="form-control">
                                                    <option value="">select client...</option>
                                                    <?php
                                                    $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 ");
                                                    while ($row = mysqli_fetch_array($getclients)) {
                                                        $creditclient_id = $row['creditclient_id'];
                                                        $clientname = $row['clientname'];
                                                    ?>
                                                        <option value="<?php echo  $creditclient_id; ?>"><?php echo $clientname; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row forinsurance" style="display: none">
                                            <!-- <div class="form-group col-lg-4"><label class="control-label">* First Name</label>
                                                <input type="text" name='firstname' class="form-control" placeholder="Enter firstname">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">* Second Name</label>
                                                <input type="text" name='secondname' class="form-control" placeholder="Enter second name">
                                            </div>
                                            <div class="form-group col-lg-4"><label class="control-label">Third Name</label>
                                                <input type="text" name='thirdname' class="form-control" placeholder="Enter Third name">
                                            </div> -->

                                        </div>

                                        <div class="form-group pull-right">
                                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
        $('.paymenttype').on('change', function() {
            var getselect = $(this).val();
            if ((getselect === 'insurance')) {
                $('.forinsurance').show();
                $('.forcredit').hide();
            }
            if ((getselect === 'credit')) {
                $('.forinsurance').hide();
                $('.forcredit').show();
            }
            if ((getselect != 'credit') && (getselect != 'insurance')) {
                $('.forinsurance').hide();
                $('.forcredit').hide();
            }
        });
    </script>
</body>

</html>