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
    <title>Cleared Patients</title>
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
                            <h4>Patients With Results</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#"> Patients With Results</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Patients with Results </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Image</th>
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Next Room</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE payment='1' AND room ='doctor'AND status='1' and attendant='" . $_SESSION['elcthospitaladmin'] . "' GROUP BY admission_id");
                                            while ($row = mysqli_fetch_array($getque)) {
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $prev_id= $row['prev_id'];
                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id' and status='1'");
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
                                                // $room = $row['room'];

                                                if (!empty($ext))
                                                    $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                                                else 
                                                    $pimage = "noimage.png";
                                                    // print_r($prev_id);
                                                $getnextque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab','doctor','radiography') and status='1' AND patientsque_id = '$prev_id'");
                                                if (mysqli_num_rows($getnextque) > 0) {
                                                    $rown = mysqli_fetch_array($getnextque);
                                                    $npatientsque_id = $rown['patientsque_id'];                                                
                                                    $attendant = $_SESSION['elcthospitaladmin'];
                                                    $room = isset($rown) ? $rown['room'] : "";
                                                    // $room = $rown['room'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];
                                                    $prev22_id= $rown['prev_id'];
                                                    // $getnextque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND room IN('nurse','lab') AND status=1 ORDER BY patientsque_id DESC");
                                                }else{
                                                    $npatientsque_id = $patientsque_id;
                                                    $attendant = $_SESSION['elcthospitaladmin'];
                                                    $room = isset($row) ? $row['room'] : "";
                                                    // $room = $rown['room'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];
                                                    $prev22_id=$row['prev_id'];
                                                }
                                               

                                                // $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab') AND status=1 ORDER BY patientsque_id DESC");
                                                // $rowp = mysqli_fetch_array($getprevque);
                                                // $pattendant = isset($rowp) ? $rowp['attendant'] : "";
                                                // $patientsque_id2 = isset($rowp) ? $rowp['patientsque_id'] : null;
                                                // $proom = isset($rowp) ? $rowp['room'] : "";

                                                

                                                // if (isset($rowp)) {
                                                //     $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$pattendant'") or die(mysqli_error($con));
                                                //     $prows = mysqli_fetch_array($getstaff);
                                                //     $pfullname = $prows['fullname'];
                                                // } else $fullname = "";

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


                                                    <td>
                                                        <a href="updatepatientreport?id=<?php echo $prev22_id; ?>" class="btn btn-xs btn-info"> Patient Report </a>
                                                    <!-- <button data-toggle="modal" data-target="#basicModal<?php echo $prev22_id; ?>" class="btn btn-xs btn-info">Patient Report</button> -->
                                                    <div class="modal fade" id="basicModal<?php echo $prev22_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Doctor Report</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $nursereports = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$prev22_id'") or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($nursereports)) {
                                                                    $drug = $row['drug'];
                                                                    $prescription = $row['prescription'];
                                                                    $details = $row['details'];
                                                                    $complaint = $row["complaint"];
                                                                        $physical_exam = $row["physical_exam"];
                                                                        $systematic_exam = $row["systematic_exam"];
                                                                        $provisional_diagnosis = $row["provisional_diagnosis"];
                                                                        $final_diagnosis = $row["final_diagnosis"];

                                                                    if ($room == 'pharmacy') {
                                                                ?>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-5 col-5">
                                                                                <h5 class="f-w-500"><?php echo $drug; ?><span class="pull-right">:</span>
                                                                                </h5>
                                                                            </div>
                                                                            <div class="col-sm-7 col-7"><span><?php echo $prescription; ?></span>
                                                                            </div>
                                                                        </div>
                                                                <?php }
                                                                } ?>
                                                                <label class="text-primary"><strong>Main complains</strong></label>
                                                                <p><?php echo $complaint; ?></p>
                                                                <hr>
                                                                <label class="text-primary"><strong>Physical Exam</strong></label>
                                                                <p><?php echo $physical_exam; ?></p>
                                                                <hr>
                                                                <label class="text-primary"><strong>Systematic Exam</strong></label>
                                                                <p><?php echo $systematic_exam; ?></p>
                                                                <hr>
                                                                <label class="text-primary"><strong>Provisional Diagnosis</strong></label>
                                                               
                                                                <?php 
                                                                    if (!empty($provisional_diagnosis)) {
                                                                        $getdiseases = mysqli_query($con, "SELECT * FROM diseases WHERE disease_id IN ($provisional_diagnosis) AND status=1") or die(mysqli_error($con));
                                                                       
                                                                        while ($row11 = mysqli_fetch_array($getdiseases)) {
                                                                            $disease_id = $row11['disease_id'];
                                                                            $codename = $row11['codename'];
                                                                            $codenumber = $row11['codenumber'];
                                                                       
                                                                            echo '<p class="mb-0">'.$codename . ' (' . $codenumber . ')</p>';
                                                                        }
                                                                    }
                                                                       ?>
                                                               
                                                                <hr>
                                                                <label class="text-primary"><strong>Final Diagnosis</strong></label>
                                                               
                                                                <?php 
                                                                    if (!empty($final_diagnosis)) {
                                                                        $getdiseases = mysqli_query($con, "SELECT * FROM diseases WHERE disease_id IN ($final_diagnosis) AND status=1") or die(mysqli_error($con));
                                                                       
                                                                        while ($row11 = mysqli_fetch_array($getdiseases)) {
                                                                            $disease_id = $row11['disease_id'];
                                                                            $codename = $row11['codename'];
                                                                            $codenumber = $row11['codenumber'];
                                                                       
                                                                            echo '<p class="mb-0">'.$codename . ' (' . $codenumber . ')</p>';
                                                                        }
                                                                    }
                                                                       ?>
                                                                
                                                                <hr>
                                                                <label class="text-primary"><strong>Details</strong></label>
                                                                <p><?php echo $details; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <?php   
                                                        $patient_reports= mysqli_query($con, "SELECT * FROM patientsque WHERE payment='1' AND room ='doctor'AND status='1'and admission_id='$admission_id' and attendant='" . $_SESSION['elcthospitaladmin'] . "'");
                                                        if (mysqli_num_rows($patient_reports) > 0){
                                                            while($row23 = mysqli_fetch_array($patient_reports)){
                                                                $patientsque22_id = $row23['patientsque_id'];
                                                                $admm=$row23['admission_id'];
                                                                $previd2= $row23['prev_id'];
                                                                $getprevisque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admm'  AND room IN('nurse','lab','doctor','radiography') and status='1' AND patientsque_id = '$previd2'");
                                                                if (mysqli_num_rows($getprevisque) > 0){
                                                                $row24 = mysqli_fetch_array($getprevisque);
                                                                $roomp = $row24['room'];
                                                                ?>
                                                               
                                                                <?php if($roomp == 'lab') { ?>
                                                                    <button data-toggle="modal" data-target="#labModal<?php echo $patientsque22_id; ?>" class="btn btn-xs btn-info">Lab Report</button>
                                                                    <?php } 
                                                                    if ($roomp == 'radiography') {
                                                                        ?>
                                                                        <button data-toggle="modal" data-target="#radio<?php echo $patientsque22_id; ?>" class="btn btn-xs btn-primary">Radiology Report</button>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    
                                                
                                                <?php 

                                                    if($roomp == 'lab') {                                                        
                                                    ?>
                                                    <div class="modal fade" id="labModal<?php echo $patientsque22_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    $getreports = mysqli_query($con, "SELECT * FROM labreports WHERE patientsque_id='$npatientsque_id'");
                                                                
                                                                    while ($row = mysqli_fetch_array($getreports)) {
                                                                        $medicalservice_id = $row['test'];
                                                                                    $presult = $row['result'];
                                                                                    $details = $row['details']; 
                                                                        $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                                    $test = $row2['investigationtype'];
                                                                                    $unit_id = $row2['unit_id'];                                                                      
                                                                        
                                                                    ?>
                                                                            <div class="row mb-2">
                                                                                <div class="col-sm-5 col-5">
                                                                                    <h5 class="f-w-500"><?php echo $test; ?><span class="pull-right">:</span>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-sm-7 col-7"><span><?php echo $presult; ?></span>
                                                                                </div>
                                                                            </div>
                                                                    <?php }
                                                                     ?>
                                                                    <label class="text-primary"><strong>Details</strong></label>
                                                                    <?php echo $details; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }
                                                     if ($roomp == 'radiography') {
                                                        ?>
                                                            <div class="modal fade" id="radio<?php echo $patientsque22_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl " role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Radiology Report</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                            $radioreports = mysqli_query($con, "SELECT * FROM radiologyreports WHERE patientsque_id='$npatientsque_id'") or die(mysqli_error($con));
                                                                            while ($row = mysqli_fetch_array($radioreports)) {
                                                                                $radiologyreport_id = $row['radiologyreport_id'];
                                                                                $reason = $row['reason'];
                                                                                $description = $row['description'];
                                                                                $results = $row['results'];
                                                                                $conclusion = $row['conclusion'];
                                                                                $responsible = $row['responsible'];
                                                                                $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$results'");
                                                                                $row2 = mysqli_fetch_array($getservice);
                                                                                $medicalservice = $row2['investigationtype'];
                                                                                // $getservice = mysqli_query($con, "SELECT * FROM radiologyimages WHERE status=1 AND radiology_report_id='$radiologyreport_id'");
                                                                                // $row2 = mysqli_fetch_array($getservice);
                                                                            ?>
                                                                             <!-- <div class="row form-group">
                                                                                <div class="col col-md-2"><label for="website"
                                                                                        class=" form-control-label">Reason:</label>
                                                                                </div>
                                                                                <div class="col-12 col-md-9"><?php echo $reason; ?></div>
                                                                            </div> -->
                                                                            <div class="row form-group">
                                                                                <div class="col col-md-2"><label for="website"
                                                                                        class=" form-control-label">Tests:</label>
                                                                                </div>
                                                                                <div class="col-12 col-md-9"><?php echo $medicalservice; ?></div>
                                                                            </div>
                                                                                
                                                                           
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
                                                                                            <img src="<?php echo BASE_URL ?>/images/radiology/<?php echo $pimage; ?>" width="100%">
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } ?>
                                                                        </div>
                                                                        <label class="text-primary mt-3"><strong>Description</strong></label>
                                                                        <p><?php echo $description; ?></p>
                                                                        <?php } ?>
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
                                                }
                                            }

                                                        }
                                                        ?>
                                                       
                                                    </td>


                                                </tr>
                                                
                                            <?php }} ?>
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
