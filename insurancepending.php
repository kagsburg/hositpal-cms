<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Patients</title>
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
                            <h4>Pending Insured Patients</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="patients">Patients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Pending Insured Patients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <!-- <th>Company</th>
                                                <th>Membership Number</th> -->
                                                <th>Added on</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getpatients = mysqli_query($con, "SELECT patients.*, paymethod_id, paymethod.user_id as added_by FROM paymethod LEFT JOIN patients ON patients.patient_id=paymethod.patient_id WHERE paymethod.status='2' AND paymethod.method='insurance'") OR die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($getpatients)) {
                                                $patient_id = $row['patient_id'];
                                                $paymethod_id = $row['paymethod_id'];
                                                $policyidnumber = $row['policyidnumber'];
                                                $insurancecompany = $row['insurancecompany'];
                                                $admin_id = $row['added_by'];
                                                $firstname = $row['firstname'];
                                                $secondname = $row['secondname'];
                                                $thirdname = $row['thirdname'];
                                                $timestamp = $row['timestamp'];
                                                //////////$getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurancecompany'");
                                                //$row1 =  mysqli_fetch_array($getcompany);
                                                //$company = $row1['company'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'");
                                                $row2 = mysqli_fetch_array($getstaff);
                                                $fullname = $row2['fullname'];
                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                                    <!-- <td><?php //echo $company; ?></td>
                                                    <td><?php //echo $policyidnumber; ?></td> -->
                                                    <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td>
                                                        <?php
                                                        /**if (($_SESSION['elcthospitallevel'] == 'receptionist')) {
                                                        ?>
                                                            <a href="approveinsurance?id=<?php echo $patient_id; ?>" class="btn btn-info btn-xs" onclick="return confirm_approve<?php echo $patient_id; ?>()">Approve</a>
                                                            <a href="cancelinsurance?id=<?php echo $patient_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $patient_id; ?>()">Decline</a>
                                                        <?php } else
                                                        **/
                                                        
                                                        if ($_SESSION['elcthospitallevel'] == "insurance officer") { ?>
                                                            <a href="verifyinsurance?id=<?php echo $paymethod_id; ?>" class="btn btn-info btn-xs">Complete Registration</a>
                                                        <?php } ?>
                                                        <script type="text/javascript">
                                                            function confirm_delete<?php echo $patient_id; ?>() {
                                                                return confirm('You are about To Cancel this Patient. Are you sure you want to proceed?');
                                                            }
                                                        </script>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
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

</body>

</html>