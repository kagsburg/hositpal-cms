<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'pharmacist')) && (($_SESSION['elcthospitallevel'] != 'doctor'))&&(($_SESSION['elcthospitallevel'] != 'head physician'))) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Doctor Stock Orders</title>
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
                            <h4>Pharmacy Stock Orders</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Stock Orders</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Doctor Stock Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Date</th>
                                                <th>Ordered by</th>
                                                <th>Reason</th>
                                                <th>Items</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getordered = mysqli_query($con, "SELECT * FROM stockorders WHERE status IN(1,0) AND section='doctor'") or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($getordered)) {
                                                $stockorder_id = $row['stockorder_id'];
                                                $timestamp = $row['timestamp'];
                                                $admin_id = $row['admin_id'];
                                                $status = $row['status'];
                                                $reason = $row['reason'];
                                                $type = $row['type'];
                                                $section = $row['section'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1  AND staff_id='$admin_id'");
                                                $row1 = mysqli_fetch_array($getstaff);
                                                $fullname = $row1['fullname'];
                                                if (strlen($stockorder_id) == 1) {
                                                    $pin = '000' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) == 2) {
                                                    $pin = '00' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) == 3) {
                                                    $pin = '0' . $stockorder_id;
                                                }
                                                if (strlen($stockorder_id) >= 4) {
                                                    $pin = $stockorder_id;
                                                }
                                                $getitems = mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$stockorder_id'");

                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $pin; ?></td>
                                                    <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td>
                                                        <?php if ($reason == 0) {
                                                            echo 'For Use';
                                                        } else {
                                                            $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$reason'");
                                                            $row3 = mysqli_fetch_array($getadmission);
                                                            $patient_id = $row3['patient_id'];
                                                            $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                            $row2 = mysqli_fetch_array($getpatient);
                                                            $firstname = $row2['firstname'];
                                                            $secondname = $row2['secondname'];
                                                            $thirdname = $row2['thirdname'];
                                                            $gender = $row2['gender'];
                                                            $ext = $row2['ext'];
                                                            echo 'Patient (' . $firstname . ' ' . $secondname . ' ' . $thirdname . ' )';
                                                        }
                                                        ?></td>
                                                    <td><?php echo mysqli_num_rows($getitems); ?></td>
                                                    <td><?php if ($status == 1) {
                                                            echo '<strong class="text-success">Approved</strong>';
                                                        } else {
                                                            echo '<strong class="text-warning">PENDING</strong>';
                                                        } ?></td>


                                                    <td>

                                                        <a href="ordereditems?id=<?php echo $stockorder_id; ?>&st=<?php echo $status; ?>&ty=<?php echo $type; ?>&section=<?php echo $section ?>" class="btn btn-primary btn-xs">Details</a>
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