<?php
include 'includes/conn.php';
$roles = array('lab technician', 'accountant', 'lab technologist','nurse','pharmacist','radiographer');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}
$type = $_GET['ty'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Clinic Patients</title>
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
                            <h4>Clinic Patients</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Waiting Patients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Registered Patients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                
                                                <th>Full Names</th>
                                                <th>Location</th>
                                                <th>Attendant</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $getque = mysqli_query($con, "SELECT * FROM bills WHERE clinic='1' AND type='$type' AND status=2");
                                            // $patient_id = $row['patient_id'];
                                            
                                            $getadmission = mysqli_query($con, "SELECT * FROM clinic_clients WHERE status ='2'");
                                            if (mysqli_num_rows($getadmission) > 0){
                                                    while ($row1 = mysqli_fetch_array($getadmission)) {
                                                // $row1 = mysqli_fetch_array($getadmission);
                                                $patient_id = $row1['clinic_cl_id'];
                                                $fullname1 = $row1['name'];
                                                $location = $row1['location'];
                                                $attendant= $row1['user_id'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                $rows = mysqli_fetch_array($getstaff);
                                                $fullname = $rows['fullname'];
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
                                            <tr class="gradeA">
                                                <td><?php echo $pin; ?></td>
                                                <!-- <td>
                                                    <a href="images/patients/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                        target="_blank">
                                                        <img src="images/patients/thumbs/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                            width="60">
                                                    </a>
                                                </td> -->
                                                <td><?php echo $fullname1; ?>
                                                </td>
                                                <td><?php echo $location; ?></td>
                                                <td><?php echo $fullname; ?></td>
                                                <td>
                                                    <?php 
                                                    if ($type == 'lab'){
                                                        $getlabreport = mysqli_query($con,"SELECT * from labreports where clinic=1 and patientsque_id='$patient_id'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($getlabreport) > 0){
                                                            echo '<a href="viewlabreport?id='.$patient_id.'" class="btn btn-xs btn-success">View Report</a>';
                                                        }else{
                                                            echo '<a href="addlabclinic?id='.$patient_id.'" class="btn btn-xs btn-info">Add Report</a>';
                                                        }
                                                    }
                                                    else if ($type == 'radiography'){
                                                        $getlabreport = mysqli_query($con,"SELECT * from radiologyreports where clinic=1 and patientsque_id='$patient_id'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($getlabreport) > 0){
                                                            echo '<a href="viewradreport?id='.$patient_id.'" class="btn btn-xs btn-success">View Report</a>';
                                                        }else{
                                                            echo '<a href="addradclinic?id='.$patient_id.'" class="btn btn-xs btn-info">Add Report</a>';
                                                        }
                                                    }
                                                    else if ($type == 'medical_service'){
                                                        $getlabreport = mysqli_query($con,"SELECT * from clinicreport where status=1 and clinic_client_id='$patient_id'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($getlabreport) > 0){
                                                            echo '<a href="viewnursereport?id='.$patient_id.'" class="btn btn-xs btn-success">View Report</a>';
                                                            echo '<a href="dischargenurseclinic?id='.$patient_id.'" class="btn btn-xs btn-info">Discharge</a>';
                                                        }else{
                                                            echo '<a href="addnurseclinic?id='.$patient_id.'" class="btn btn-xs btn-info">Add Report</a>';
                                                        }

                                                    }
                                                    else if ($type == 'pharmacy'){
                                                        $getlabreport = mysqli_query($con,"SELECT * from labreports where clinic=1 and patientsque_id='$patient_id'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($getlabreport) > 0){
                                                            echo '<a href="viewlabreport?id='.$patient_id.'" class="btn btn-xs btn-success">View Report</a>';
                                                        }else{
                                                            echo '<a href="addpharclinic?id='.$patient_id.'" class="btn btn-xs btn-info">Add Report</a>';
                                                        }
                                                    }
                                                    
                                                    ?>

                                                </td>


                                            </tr>

                                            <?php } }?>
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
