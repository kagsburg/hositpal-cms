<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'lab technician')&& ($_SESSION['elcthospitallevel']!='lab technologist')) {
    header('Location:login.php');
}
$mode = isset($_GET['mode']) ? $_GET['mode']: "";
if ($mode == '2'){
    $modestatus = 'emergency';
}else{
    $modestatus = 'normal';
}
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
                            <h4>Waiting Patients</h4>

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
                                <h4 class="card-title">All waiting Patients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>DATE</th>
                                                <th>PIN</th>
                                                
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Previous Room</th>
                                                <th>Attendant</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $modestr = ($mode == 1) ? "payment='1' and": "";
                                            //  if ($mode == '1'){
                                            //     $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE payment=1 and room='lab' AND status=0") or die(mysqli_error($con));
                                            // }
                                            // else if ($mode == '2'){
                                            //     $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE payment=0 and room='lab' AND status=0") or die(mysqli_error($con));
                                            // }
                                            $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE  room='lab' and payment=1  AND status=0");
                                            while ($row = mysqli_fetch_array($getque)) {
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $prev_id = $row['prev_id'];
                                                $timestamp= $row['timestamp'];

                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id' and status ='1'");
                                                if (mysqli_num_rows($getadmission) > 0){
                                                $row1 = mysqli_fetch_array($getadmission);
                                                $patient_id = $row1['patient_id'];
                                                $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                $row2 = mysqli_fetch_array($getpatient);
                                                $firstname = $row2['firstname'];
                                                $secondname = $row2['secondname'];
                                                $thirdname = $row2['thirdname'];
                                                $gender = $row2['gender'];
                                                $ext = $row2['ext'];
                                                $mode2=$row1['mode'];

                                                $filter = empty($prev_id) ? "ORDER BY patientsque_id DESC" : "AND patientsque_id = '$prev_id'";
                                                $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND patientsque_id < '$patientsque_id'  AND status=1 $filter LIMIT 1");
                                                if (mysqli_num_rows($getprevque) > 0    ){
                                                    $rowp = mysqli_fetch_array($getprevque);
                                                    $patientsque_id2 = $rowp['patientsque_id'];
                                                    $room = $rowp['room'];
                                                }
                                                $attendant = $_SESSION['elcthospitaladmin'];
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
                                                if ($mode2 == 'emergency' && $mode == 2) {
                                                    ?>
                                            <tr class="gradeA">
                                                <td><?php echo date('Y-m-d',$timestamp); ?></td>
                                                <td><?php echo $pin; ?></td>
                                                <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?>
                                                </td>
                                                <td><?php echo $gender; ?></td>
                                                <td><?php echo $room; ?></td>
                                                <td><?php echo $fullname; ?></td>
                                                <td>
                                                    <a href="labreportlist?id=<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-info">Details</a>

                                                    <!-- <button data-toggle="modal"
                                                        data-target="#modal<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-primary">Doctor Report</button> -->
                                                    <div class="modal fade" id="modal<?php echo $patientsque_id; ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Doctor Report</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label class="text-primary"><strong>Measurements</strong></label>
                                                                    <?php
                                                                        $doctorreports = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$patientsque_id2'") or die(mysqli_error($con));
                                                                       $details='';	
                                                                        while ($row = mysqli_fetch_array($doctorreports)) {                                                                               
                                                                            $drug = $row['labmeasure'];
                                                                            $prescription = $row['prescription'];
                                                                            if ($row['labmeasure'] != '') $details = $row['details'];
                                                                            $provisional_diagnosis = $row['provisional_diagnosis'];
                                                                            $final_diagnosis = $row['final_diagnosis'];

                                                                            if (!empty($drug)) {
                                                                                $getitem = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$drug'");
                                                                                $row1 = mysqli_fetch_array($getitem);
                                                                                $itemname = $row1['investigationtype'];
                                                                            ?>
                                                                            <div class="row mb-2">
                                                                                <div class="col-sm-7 col-7">
                                                                                    <h5 class="f-w-500">
                                                                                        <?php echo $itemname; ?>
                                                                                        <!-- <span class="pull-right">:</span> -->
                                                                                    </h5>
                                                                                </div>
                                                                                <!-- <div class="col-sm-7 col-7">
                                                                                                <span><?php //echo $prescription; ?></span>
                                                                                            </div> -->
                                                                            </div>
                                                                            <?php } 
                                                                        } 
                                                                        ?>

                                                                    
                                                                    <label class="text-primary mt-3"><strong>Details</strong></label>
                                                                    <?php echo $details; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>


                                            </tr>
                                                    <?php

                                                }else{
                                            ?>
                                            <tr class="gradeA">
                                            <td><?php echo date('Y-m-d',$timestamp); ?></td>
                                                <td><?php echo $patientsque_id; ?></td>
                                                <!-- <td>
                                                    <a href="images/patients/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                        target="_blank">
                                                        <img src="images/patients/thumbs/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                            width="60">
                                                    </a>
                                                </td> -->
                                                <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?>
                                                </td>
                                                <td><?php echo $gender; ?></td>
                                                <td><?php echo $room; ?></td>
                                                <td><?php echo $fullname; ?></td>
                                                <td>
                                                    <a href="labreportlist?id=<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-info">Details</a>

                                                    <!-- <button data-toggle="modal"
                                                        data-target="#modal<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-primary">Doctor Report</button> -->
                                                    <div class="modal fade" id="modal<?php echo $patientsque_id; ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Doctor Report</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label class="text-primary"><strong>Measurements</strong></label>
                                                                    <?php
                                                                        $doctorreports = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$patientsque_id2'") or die(mysqli_error($con));
                                                                       $details='';	
                                                                        while ($row = mysqli_fetch_array($doctorreports)) {                                                                               
                                                                            $drug = $row['labmeasure'];
                                                                            $prescription = $row['prescription'];
                                                                            if ($row['labmeasure'] != '') $details = $row['details'];
                                                                            $provisional_diagnosis = $row['provisional_diagnosis'];
                                                                            $final_diagnosis = $row['final_diagnosis'];

                                                                            if (!empty($drug)) {
                                                                                $getitem = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$drug'");
                                                                                $row1 = mysqli_fetch_array($getitem);
                                                                                $itemname = $row1['investigationtype'];
                                                                            ?>
                                                                            <div class="row mb-2">
                                                                                <div class="col-sm-7 col-7">
                                                                                    <h5 class="f-w-500">
                                                                                        <?php echo $itemname; ?>
                                                                                        <!-- <span class="pull-right">:</span> -->
                                                                                    </h5>
                                                                                </div>
                                                                                <!-- <div class="col-sm-7 col-7">
                                                                                                <span><?php //echo $prescription; ?></span>
                                                                                            </div> -->
                                                                            </div>
                                                                            <?php } 
                                                                        } 
                                                                        ?>

                                                                    
                                                                    <label class="text-primary mt-3"><strong>Details</strong></label>
                                                                    <?php echo $details; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>


                                            </tr>

                                            <?php }} }
                                            // check for emergcny patients
                                        $getadmissions = mysqli_query($con, "SELECT * FROM admissions WHERE mode='emergency' AND status='1'");
                                        if (mysqli_num_rows($getadmissions)>0){
                                        while ($row = mysqli_fetch_array($getadmissions)) {                              
                                            $patient_id = $row['patient_id'];
                                            $admission_id=$row['admission_id'];
                                            $getque2 = mysqli_query($con, "SELECT * FROM patientsque WHERE  room='lab' and admission_id='$admission_id'  AND status=0");
                                            if (mysqli_num_rows($getque2) > 0){
                                            $row3 = mysqli_fetch_array($getque2);
                                                $patientsque_id = $row3['patientsque_id'];
                                                $prev_id = $row3['prev_id'];
                                                $timestamp= $row3['timestamp'];

                                                $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                $row2 = mysqli_fetch_array($getpatient);
                                                $firstname = $row2['firstname'];
                                                $secondname = $row2['secondname'];
                                                $thirdname = $row2['thirdname'];
                                                $gender = $row2['gender'];
                                                $ext = $row2['ext'];
                                                $mode2=$row['mode'];

                                                $filter = empty($prev_id) ? "ORDER BY patientsque_id DESC" : "AND patientsque_id = '$prev_id'";
                                                $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND patientsque_id < '$patientsque_id'  AND status=1 $filter LIMIT 1");
                                                if (mysqli_num_rows($getprevque) > 0    ){
                                                    $rowp = mysqli_fetch_array($getprevque);
                                                    $patientsque_id2 = $rowp['patientsque_id'];
                                                    $room = $rowp['room'];
                                                }
                                                $attendant = $_SESSION['elcthospitaladmin'];
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
                                            <td><?php echo date('Y-m-d',$timestamp); ?></td>
                                                <td><?php echo $patientsque_id; ?></td>
                                                <!-- <td>
                                                    <a href="images/patients/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                        target="_blank">
                                                        <img src="images/patients/thumbs/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>"
                                                            width="60">
                                                    </a>
                                                </td> -->
                                                <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?>
                                                </td>
                                                <td><?php echo $gender; ?></td>
                                                <td><?php echo $room; ?></td>
                                                <td><?php echo $fullname; ?></td>
                                                <td>
                                                    <a href="labreportlist?id=<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-info">Details</a>

                                                    <!-- <button data-toggle="modal"
                                                        data-target="#modal<?php echo $patientsque_id; ?>"
                                                        class="btn btn-xs btn-primary">Doctor Report</button> -->
                                                    <div class="modal fade" id="modal<?php echo $patientsque_id; ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Doctor Report</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label class="text-primary"><strong>Measurements</strong></label>
                                                                    <?php
                                                                        $doctorreports = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$patientsque_id2'") or die(mysqli_error($con));
                                                                       $details='';	
                                                                        while ($row = mysqli_fetch_array($doctorreports)) {                                                                               
                                                                            $drug = $row['labmeasure'];
                                                                            $prescription = $row['prescription'];
                                                                            if ($row['labmeasure'] != '') $details = $row['details'];
                                                                            $provisional_diagnosis = $row['provisional_diagnosis'];
                                                                            $final_diagnosis = $row['final_diagnosis'];

                                                                            if (!empty($drug)) {
                                                                                $getitem = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$drug'");
                                                                                $row1 = mysqli_fetch_array($getitem);
                                                                                $itemname = $row1['investigationtype'];
                                                                            ?>
                                                                            <div class="row mb-2">
                                                                                <div class="col-sm-7 col-7">
                                                                                    <h5 class="f-w-500">
                                                                                        <?php echo $itemname; ?>
                                                                                        <!-- <span class="pull-right">:</span> -->
                                                                                    </h5>
                                                                                </div>
                                                                                <!-- <div class="col-sm-7 col-7">
                                                                                                <span><?php //echo $prescription; ?></span>
                                                                                            </div> -->
                                                                            </div>
                                                                            <?php } 
                                                                        } 
                                                                        ?>

                                                                    
                                                                    <label class="text-primary mt-3"><strong>Details</strong></label>
                                                                    <?php echo $details; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>


                                            </tr>

                                            <?php
                                        }}}
                                            
                                            ?>
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
    <script>$('#example6').DataTable({
            "order": [
                [0, "desc"]
            ]
        });</script>    

</body>

</html>
