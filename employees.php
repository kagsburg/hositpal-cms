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
    <title>Employees </title>
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
                            <h4>Staff Members</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="employees">Staff</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Members</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Full Names</th>
                                                <th>Designation</th>
                                                <th>Department</th>
                                                <th>Gender</th>
                                                <th>Salary</th>
                                                <th>Contract Duration</th>
                                                <th>Phone</th>
                                                <?php
                                                if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                    <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 ");
                                            while ($row = mysqli_fetch_array($getstaff)) {
                                                $staff_id = $row['staff_id'];
                                                $fullname = $row['fullname'];
                                                $phone = $row['phone'];
                                                $email = $row['email'];
                                                $gender = $row['gender'];
                                                $designation_id = $row['designation_id'];
                                                $department_id = $row['department_id'];
                                                $salary_id = $row['salary'];
                                                $status = $row['status'];
                                                $ext = $row['ext'];
                                                $contractstart = $row['contractstart'];
                                                $contractend = $row['contractend'];
                                                if (isset($department_id)) {
                                                    $getdepartment = mysqli_query($con, "SELECT * FROM departments WHERE status=1 AND department_id='$department_id'");
                                                    $row1 =  mysqli_fetch_array($getdepartment);
                                                    $department_id = isset($row1) ? $row1['department_id'] : null;
                                                    $department = isset($row1) ? $row1['department'] : "";
                                                } else {
                                                    $department = "";
                                                }
                                                $getdesignation =  mysqli_query($con, "SELECT * FROM designations WHERE status=1 AND designation_id='$designation_id'");
                                                $row2 =  mysqli_fetch_array($getdesignation);
                                                $designation = $row2['designation'];
                                                $getsalaries =  mysqli_query($con, "SELECT * FROM salaries WHERE status=1 AND  salary_id='$salary_id'");
                                                $num = mysqli_num_rows($getsalaries);
                                                if ($num == 0) {
                                                    $salary = "";
                                                }else{
                                                    $row3 =  mysqli_fetch_array($getsalaries);
                                                    $salary = $row3['salary'];
                                                }
                                            ?>
                                                <tr class="gradeA">
                                                    <td>
                                                        <?php
                                                        if (empty($ext)) {
                                                        ?>
                                                            <img src="images/avatar.png" width="60">
                                                        <?php } else { ?>
                                                            <a href="images/employees/<?php echo md5($staff_id) . '.' . $ext . '?' .  time(); ?>" target="_blank">
                                                                <img src="images/employees/thumbs/<?php echo md5($staff_id) . '.' . $ext . '?' .  time(); ?>" width="60">
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $designation; ?></td>
                                                    <td><?php echo $department; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $salary; ?></td>
                                                    <td><?php echo date('d/M/Y', $contractstart) . ' to ' . date('d/M/Y', $contractend); ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <?php
                                                    if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                        <td>
                                                            <a href="editstaff?id=<?php echo $staff_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                            <a href="hidestaff?id=<?php echo $staff_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $staff_id; ?>()">Remove</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $staff_id; ?>() {
                                                                    return confirm('You are about To Remove this Member. Are you sure you want to proceed?');
                                                                }
                                                            </script>
                                                        </td>
                                                    <?php  } ?>


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