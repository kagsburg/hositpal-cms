<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/bills.php';
if (($_SESSION['elcthospitallevel'] != 'doctor')) {
    header('Location:login.php');
}
$anareport_id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Waiting Patients</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
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
                            <h4> Patient Anaesthesia Report</h4>

                        </div>
                        
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="operationswaiting">Waiting Patients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <?php 
                            // get anaesthesia report
                            $anareport = mysqli_query($con, "SELECT * FROM anaesthesiareport WHERE anareport_id  = '$anareport_id' and status = 1");
                            $anareport = mysqli_fetch_array($anareport);
                            $patient_id = $anareport['patient_id'];
                            $procedure = $anareport['proce_dure'];
                            $surgeon = $anareport['surgeon'];
                            $npo = $anareport['npo'];
                            $weight = $anareport['weight'];
                            $allergy = $anareport['allergy'];
                            $mallampati = $anareport['mallampati'];
                            $prevhx = $anareport['prevhx'];
                            $comment = $anareport['comment'];
                            $date = $anareport['date'];
                            $time = $anareport['time'];
                            $anaesthetist = $anareport['admin_id'];
                            // get patient details
                            $patient = mysqli_query($con, "SELECT * FROM patients WHERE patient_id  = '$patient_id' and status = 1");
                            $patient = mysqli_fetch_array($patient);
                            $patientname = $patient['firstname'] . ' ' . $patient['secondname'];
                            $gender = $patient['gender'];
                            $dob = $patient['dob'];
                            $patient_id = $patient['patient_id'];
                            // get admission id 
                            $admission = mysqli_query($con, "SELECT * FROM admissions WHERE patient_id  = '$patient_id' and status = 1");
                            $admission1 = mysqli_fetch_array($admission);
                            $admission_id = $admission1['admission_id'];
                            $paymenttype = get_payment_method($pdo, $patient_id, $admission_id);
                            ?>
                            <?php
                            if (isset($_POST['submit'])) {
                                $opdate = $_POST['opdate'];
                                $optime = $_POST['optime'];
                                mysqli_query($con, "INSERT INTO operations (patient_id, date,time,anareport_id,anesthesiologist, admin_id, timestamp, status) VALUES ('$patient_id', '$opdate', '$optime', '$anareport_id', '$anaesthetist','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(), 1)") or die(mysqli_error($con));
                                
                                mysqli_query($con, "UPDATE anaesthesiareport SET status = 2 WHERE anareport_id = '$anareport_id'") or die(mysqli_error($con));
                                echo "<script>alert('Patient approved successfully!'); window.location='operationswaiting';</script>";
                            }
                        ?>
                            <div class="card-header">
                                <h4 class="card-title"> <?php echo $patientname ; ?> Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6>Procedure</h6>
                                        <p><?php echo $procedure ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>Surgeon</h6>
                                        <p><?php echo $surgeon ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>NPO</h6>
                                        <p><?php echo $npo ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>Weight</h6>
                                        <p><?php echo $weight ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>Allergy</h6>
                                        <p><?php echo $allergy ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>Mallampati</h6>
                                        <p><?php echo $mallampati ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6>Previous Hx</h6>
                                        <p><?php echo $prevhx ; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6> Anaesthetist Comment</h6>
                                        <p><?php echo $comment ; ?></p>
                                    </div>
                                </div>
                                <h3> LABS </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportlabs WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> VITALS </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportvitals WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> CNS </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportcns WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> HEM </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareporthem WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> RENAL </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportrenal WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> PULM </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportpul WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> PE </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportpe WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> ONC </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportonc WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> Planned anaesthesia </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportpla WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <h3> Others </h3>
                                <div class="row">
                                    <?php
                                    // get patient labs
                                    $labs = mysqli_query($con, "SELECT * FROM anaesthesiareportoth WHERE anaesthesiareport_id  = '$anareport_id'");
                                    if (mysqli_num_rows($labs) > 0) {
                                        while ($lab = mysqli_fetch_array($labs)) {
                                            $labname = $lab['type'];
                                            $labvalue = $lab['result'];
                                            ?>
                                            <div class="col-sm-2">
                                                <p><?php echo $labname ; ?> : 
                                                <?php echo $labvalue ; ?></p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="form-group pull-right">
                                            <a href="cancelanareport?id=<?php echo $anareport_id; ?>" class="btn btn-danger" onclick="return cancelpatient()">Cancel</a>
                                            <script>
                                                function cancelpatient() {
                                                    return confirm('Are you sure you want to cancel?');
                                                }
                                            </script>
                                           
                                            <button data-toggle="modal" data-target="#modal<?php echo $anareport_id; ?>" class="btn btn-primary" type="submit" name="submit">Approve</button>
                                           
                                        </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal<?php echo $anareport_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Approve Patient </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" name='form' class="form" action="" enctype="multipart/form-data" >
                                                                        <div class="form-group nref" >
                                                                            <label class="control-label">Schedule Operation Date</label>
                                                                            <input type="date" name="opdate" class="form-control" required>
                                                                        </div>

                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Schedule Operation Time </label>
                                                                                <input type="time" name="optime" class="form-control" required>
                                                                            </div>
                                            <div class="form-group pull-right"><button class="btn btn-primary" type="submit" name="submit">Save</button>
                                                </div>
                                                                            </form>
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
    <script>
                $(document).on('change', '.sections', function() {
            // var $nref = $(this).closest(".nref");
            var section = $(this).val();
            console.log("dddd", section)
            $(`.service${section}`).show();
           
        });
    </script>

</body>

</html>
