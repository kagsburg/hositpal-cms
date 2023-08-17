<?php
include 'includes/conn.php';
include 'utils/patients.php';
// if (($_SESSION['elcthospitallevel'] != 'doctor')) {
//     header('Location:login.php');
// }
$paymethod = isset($_GET['paymethod']) ? $_GET['paymethod']: "";
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
                            <h4>Patient Management</h4>

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
                    <!-- <div class="col-lg-4 mb-3">
                        
                        <select name="paymethod" id="paymethod" class="form-control">
                            <option value="">Filter by payment method</option>
                            <option value="insurance" <?php if ($paymethod == "insurance") echo "selected"; ?>>Insurance</option>
                            <option value="cash" <?php if ($paymethod == "cash") echo "selected"; ?>>Cash</option>
                        </select>
                        
                    </div> -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All waiting Patients</h4>
                            </div>
                            <div class="card-body">
                                <!-- check for session success -->
                                <?php
                                if (isset($_SESSION['success'])) {
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);   
                                } 
                                 ?>
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Image</th>
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Previous Room</th>
                                                <th>Payment Method</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // $pmstr = empty($paymethod) ? "" : "AND paymethod='$paymethod'";
                                            $modestr = ($mode == 1) ? "payment='1' and": "";

                                            $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE $modestr  room ='doctor' AND status=0");
                                            if (mysqli_num_rows($getque) >0){
                                            while ($row = mysqli_fetch_array($getque)) {
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $prev_id = $row['prev_id'];
                                                $admintype = $row['admintype'];

                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'and mode ='$modestatus' and status='1'");
                                                if (mysqli_num_rows($getadmission) > 0){
                                                $row1 = mysqli_fetch_array($getadmission);
                                                $patient_id = $row1['patient_id'];
                                                $paymenttype = get_payment_method($pdo, $patient_id, $admission_id);

                                                $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                $row2 = mysqli_fetch_array($getpatient);
                                                $firstname = $row2['firstname'];
                                                $secondname = $row2['secondname'];
                                                $thirdname = $row2['thirdname'];
                                                $gender = $row2['gender'];
                                                $ext = $row2['ext'];
                                                $attendant=$row['admin_id'];

                                                if (!empty($ext))
                                                    $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                                                else
                                                    $pimage = "noimage.png";

                                                $filter = empty($prev_id) ? "AND patientsque_id < '$patientsque_id' ORDER BY patientsque_id DESC" : "AND patientsque_id = '$prev_id'";
                                                $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab','doctor') AND status=1 $filter");
                                                $rowp = mysqli_fetch_array($getprevque);
                                                // $attendant = isset($rowp) ? $rowp['admin_id'] : "";
                                                $patientsque_id2 = isset($rowp) ? $rowp['patientsque_id'] : null;
                                                $room = isset($rowp) ? $rowp['room'] : "";

                                                if (isset($rowp)) {
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];
                                                } else{
                                                    if ($admintype == 'receptionist'){
                                                        $attendant = isset($rowp) ? $rowp['admin_id'] : "";
                                                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                        $rows = mysqli_fetch_array($getstaff);
                                                        // $fullname = $rows['fullname'];
                                                        $room = 'reception';
                                                    } else {
                                                        $fullname = "";
                                                    }
                                                }
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
                                                    <td>
                                                        <a href="images/patients/<?php echo $pimage; ?>" target="_blank">
                                                            <img src="images/patients/thumbs/<?php echo $pimage; ?>" width="60">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $room; ?></td>
                                                    <td><?php echo $paymenttype; ?></td>


                                                    <td>
                                                        <?php
                                                        if ($_SESSION['elcthospitallevel'] == 'doctor') {
                                                            if ($mode == 2){
                                                                ?>
                                                                <a href="attendemergency?patientid=<?php echo $patient_id ?>&que=<?php echo $patientsque_id;?>" class="btn btn-primary btn-sm">Attend</a>
                                                                <?php
                                                            }else{
                                                        ?>
                                                            <a href="adddoctorreport?id=<?php echo $patientsque_id; ?>" class="btn btn-xs btn-info">Add Patient Report</a>
                                                            <?php } if ($room == 'nurse') { ?>
                                                                <button data-toggle="modal" data-target="#nurse<?php echo $patientsque_id; ?>" class="btn btn-xs btn-primary">Nurse Report</button>
                                                                <div class="modal fade" id="nurse<?php echo $patientsque_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Nurse Report</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php

                                                                                $nursereports = mysqli_query($con, "SELECT * FROM nursereports WHERE patientsque_id='$patientsque_id2'") or die(mysqli_error($con));
                                                                                while ($row = mysqli_fetch_array($nursereports)) {
                                                                                    $type = $row['type'];
                                                                                    $measurement = $row['measurement'];
                                                                                    $details = $row['details'];
                                                                                ?>
                                                                                    <div class="row mb-2">
                                                                                        <div class="col-sm-5 col-5">
                                                                                            <h5 class="f-w-500"><?php echo $type; ?><span class="pull-right">:</span>
                                                                                            </h5>
                                                                                        </div>
                                                                                        <div class="col-sm-7 col-7"><span><?php echo $measurement; ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php }
                                                                                if (!empty($details)) {
                                                                                ?>
                                                                                    <label class="text-primary"><strong>More Details</strong></label>
                                                                                <?php echo $details;
                                                                                } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                            if ($room == 'lab') {
                                                            ?>
								                                <button data-toggle="modal" data-target="#lab<?php echo $patientsque_id; ?>" class="btn btn-xs btn-primary">Lab Report</button>
                                                                <div class="modal fade" id="lab<?php echo $patientsque_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Lab Report</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                $labreports = mysqli_query($con, "SELECT * FROM labreports WHERE patientsque_id='$patientsque_id2'") or die(mysqli_error($con));
                                                                                while ($row = mysqli_fetch_array($labreports)) {
                                                                                    $medicalservice_id = $row['test'];
                                                                                    $result = $row['result'];
                                                                                    $details = $row['details'];
                                                                                    $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                                    $test = $row2['investigationtype'];
                                                                                    $unit_id = $row2['unit_id'];
                                                                                    $getunit =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit_id'");
                                                                                    $row1 =  mysqli_fetch_array($getunit);
                                                                                    $measurement_id = $row1['measurement_id'];
                                                                                    $measurement = $row1['measurement'];
                                                                                ?>
                                                                                    <div class="row mb-2">
                                                                                        <div class="col-sm-5 col-5">
                                                                                            <h5 class="f-w-500"><?php echo $test; ?><span class="pull-right">:</span>
                                                                                            </h5>
                                                                                        </div>
                                                                                        <div class="col-sm-7 col-7"><span><?php echo $result." ".$measurement; ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <label class="text-primary"><strong>Details</strong></label>
                                                                                <?php echo $details; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        if ($room == 'radiography') {
                                                            ?>
                                                            <button data-toggle="modal" data-target="#radio<?php echo $patientsque_id; ?>" class="btn btn-xs btn-primary">Radiology Report</button>
                                                                <div class="modal fade" id="radio<?php echo $patientsque_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Radiology Report</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php
                                                                                $radioreports = mysqli_query($con, "SELECT * FROM radiologyreports WHERE patientsque_id='$patientsque_id'") or die(mysqli_error($con));
                                                                                while ($row9 = mysqli_fetch_array($radioreports)) {
                                                                                    $radiologyreport_id = $row9['radiologyreport_id'];
                                                                                    $reason = $row9['reason'];
                                                                                    $description = $row9['description'];
                                                                                    $results = $row9['results'];
                                                                                    $conclusion = $row9['conclusion'];
                                                                                    $responsible = $row9['responsible'];
                                                                                    // $getservice = mysqli_query($con, "SELECT * FROM radiologyimages WHERE status=1 AND radiology_report_id='$radiologyreport_id'");
                                                                                    // $row2 = mysqli_fetch_array($getservice);
                                                                                ?>
                                                                                 <div class="row form-group">
                                                                                    <div class="col col-md-2"><label for="website"
                                                                                            class=" form-control-label">Reason:</label>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-9"><?php echo $reason; ?></div>
                                                                                </div>
                                                                                <div class="row form-group">
                                                                                    <div class="col col-md-2"><label for="website"
                                                                                            class=" form-control-label">Results:</label>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-9"><?php echo $results; ?></div>
                                                                                </div>
                                                                                    
                                                                                <?php } ?>
                                                                                <label class="text-primary"><strong>Images</strong></label>
                                                                                <div class="row">
                                                                                    <?php
                                                                                    $getservice = mysqli_query($con, "SELECT * FROM radiologyimages WHERE status=1 AND radiology_report_id='$radiologyreport_id'");
                                                                                    while ($row2 = mysqli_fetch_array($getservice)) {
                                                                                        // $image = $row2['image'];
                                                                                        $ext = $row2['image'];
                                                                                        $image_id = $row2['radioimage_id'];
                                                                                        if (!empty($ext))
                                                                                            $pimage = md5($image_id) . '.' . $ext;
                                                                                        else 
                                                                                            $pimage = "noimage.png";
                                                                                    ?>
                                                                                        <div class="col-md-6">
                                                                                            <a href="#" target="_blank">
                                                                                                <img src="./images/radiology/<?php echo $pimage; ?>" width="100%">
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                            </div>
                                                                            <label class="text-primary"><strong>Description</strong></label>
                                                                            <?php echo $description; ?>
                                                                            <div class="row form-group">
                                                                                    <div class="col col-md-3"><label for="website"
                                                                                            class=" form-control-label">Conclusion:</label>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-9"><?php echo $conclusion; ?></div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
    
    
                                                            <?php
                                                        }
                                                       
                                                        } ?>
                                                    </td>


                                                </tr>

                                            <?php }}  }?>
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
    <script>
        $(function() {
            $('#paymethod').change(function() {
                var chosenPaymethod = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('paymethod', chosenPaymethod);
                window.location.href = url.href;
            });
        })
    </script>
</body>

</html>
