<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('lab technician', 'nurse', 'lab technologist','doctor','head physician','pharmacist','admin');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$id = $_GET['id'];
$getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
$row = mysqli_fetch_array($getque);
$patientsque_id = $row['patientsque_id'];
$admission_id = $row['admission_id'];
$room = $row['room'];
$prev_id= $row['prev_id'];
$getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
$row1 = mysqli_fetch_array($getadmission);
$patient_id = $row1['patient_id'];
$paymenttype = get_payment_method($pdo, $patient_id, $admission_id);
$getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
$row2 = mysqli_fetch_array($getpatient);
$firstname = $row2['firstname'];
$secondname = $row2['secondname'];
$thirdname = $row2['thirdname'];
$gender = $row2['gender'];
$dob = $row2['dob'];
$weight = $row2['weight'];
$height = $row2['height'];
$bloodgroup = $row2['bloodgroup'];
$temp = $row2['temp'];
$bp = $row2['bp'];
$allergies = $row2['allergies'];
$diseases = $row2['diseases'];
$pregnancies = $row2['pregnancies'];
$insurancecompany = $row2['insurancecompany'];
$fullname = $firstname . ' ' . $secondname . ' ' . $thirdname;
$ext = $row2['ext'];
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Outpatient Report</title>
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
                            <h4>OutPatient Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Outpatient Report</a></li>
                        </ol>
                    </div>
                </div>
                <?php 
                    if (isset($_POST['submitclient'])){
                        $clinic_id = $_POST['clinic_id'];
                        $name = mysqli_real_escape_string($con, trim($_POST['name']));
                        $location = mysqli_real_escape_string($con, trim($_POST['location']));
                        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                        $weight = mysqli_real_escape_string($con, trim($_POST['weight']));
                        $dob = mysqli_real_escape_string($con, trim($_POST['dob']));
                        $bloodgroup = mysqli_real_escape_string($con, trim($_POST['bloodgroup']));
                        $pregnancy_month = mysqli_real_escape_string($con, trim($_POST['pregnancy_month']));
                        $partner_name = mysqli_real_escape_string($con, trim($_POST['partner_name']));
                        $partner_mobile = mysqli_real_escape_string($con, trim($_POST['partner_mobile']));
                       
                        $update = update_clinic_patient($pdo, $clinic_id, $name, $weight, $bloodgroup, $pregnancy_month, $dob, $phone, $partner_name, $partner_mobile, $location);
                        if ($update) {
                            echo "<div class='alert alert-success'>Clinic Patient Updated Successfully</div>";
                        }else{
                            echo "<script>alert('Error Updating Clinic Patient')</script>";
                            echo "<script>location.href='viewnursereport?id=$clinic_id'</script>";
                        }       
                    }
                ?>
                <div class="row">
                <div class="col-lg-4 mb-3">
                        <!--  <a href="printpaidbills.php?id=<?php echo $paymethod ?>&type=<?php echo $payment ?>" class="btn btn-primary">Print</a> -->
                       <?php 
                        // SELECT * FROM `admitted` 
                        $checkadmitted = mysqli_query($con , "SELECT * FROM `admitted` WHERE `admission_id` = '$admission_id' AND `status` = 1");
                        $countadmitted = mysqli_num_rows($checkadmitted);
                        if ($countadmitted ==0){
                         
                       ?> 
                       
                       <div class="mb-3">

                       <a href="updatepatientreport?id=<?php echo $id ?>" class="btn btn-primary">Add Patient Report</a>
                       </div>
                        <?php } ?> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Outpatient Report for <?php echo $fullname ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="text-primary mt-4 mb-4">Patient Information</h4>
                                        <div class="profile-blog mb-5">
                                            <address>
                                                <p>Pin : <span><?php echo $pin; ?></span></p>
                                                <p>Full Name : <span><?php echo $fullname; ?></span></p>
                                                <!-- <p>Location : <span><?php echo $location; ?></span></p>
                                                <p>Partner Name : <span><?php echo $partner_name; ?></span></p>
                                                <p>Partner Number: <span><?php echo $partner_no; ?></span></p> -->
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <h4 class="text-primary mt-4 mb-4">Medical Information</h4>
                                    <div class="profile-blog mb-5">
                                        <address>
                                        <p>Age: <span><?php 
                                        $dob1 = date("Y-m-d", strtotime($dob));
                                        $dob2 = new DateTime($dob1);
                                        $now = new DateTime();
                                        $difference = $now->diff($dob2);
                                        echo $difference->y;
                                        ?></span></p>
                                        <p>Blood Group : <span><?php echo $bloodgroup; ?></span></p>
                                        <p>Weight (kgs)  : <span><?php echo $weight; ?></span></p>
                                        <p>Height : <span><?php echo $height; ?></span></p>
                                        <p>Temperature : <span><?php echo $temp; ?></span></p>
                                        <p>Blood Pressure : <span><?php echo $bp; ?></span></p>
                                            
                                        </address>
                                    </div>
                                    </div>


                                </div>

                            
                                
                                <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Outpatient Report</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#doctorsreport">
                                                <strong class="text-primary">
                                                    Doctor Diagnosis
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#nurse">
                                                <strong class="text-primary">
                                                    Nurse
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#lab">
                                                <strong class="text-primary">
                                                    Lab
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#pharm">
                                                <strong class="text-primary">
                                                    Pharmacy
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#radio">
                                                <strong class="text-primary">
                                                    Radiology
                                                </strong>
                                            </a>
                                        </li>

                                    </ul>
                                    <?php 
                                        $rooms = [];
                                        $patient_ids =[];
                                        $patient_reports= mysqli_query($con, "SELECT * FROM patientsque WHERE payment='1' AND room ='doctor'AND status='1'and admission_id='$admission_id' and attendant='" . $_SESSION['elcthospitaladmin'] . "'");
                                        if (mysqli_num_rows($patient_reports) > 0){
                                           while($row23 = mysqli_fetch_array($patient_reports)){
                                               $previd = $row23['prev_id'];
                                               $patientsque22_id = $row23['patientsque_id'];
                                               $getprevid = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab','doctor','radiography') and status='1' AND patientsque_id = '$previd'");
                                               while ($row = mysqli_fetch_array($getprevid)) {
                                                   $room = $row['room'];
                                                   $rooms[] = $room;
                                                   $patient_ids[] = $row['patientsque_id'];
                                               }
                                           }
                                        }
                                        ?>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane fade show active" id="doctorsreport" role="tabpanel">
                                            <div class="table-responsive pt-4">
                                            <h4><strong>Doctor Diagnosis</strong></h4>
                                            <table class="table  table-striped table-responsive-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Main complains</th>
                                                        <th>Physical Examination</th>
                                                        <th>Systematic Examination</th>
                                                        <th>Provisional Diagnosis</th>
                                                        <th>Final Diagnosis</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                        <?php  
                                                         $nursereports = mysqli_query($con, "SELECT * FROM doctorreports WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                         if (mysqli_num_rows($nursereports)>0){
                                                         while ($row = mysqli_fetch_array($nursereports)) {
                                                             $drug = $row['drug'];
                                                             $prescription = $row['prescription'];
                                                             $details = $row['details'];
                                                             $complaint = $row["complaint"];
                                                                 $physical_exam = $row["physical_exam"];
                                                                 $systematic_exam = $row["systematic_exam"];
                                                                 $provisional_diagnosis = $row["provisional_diagnosis"];
                                                                 $final_diagnosis = $row["final_diagnosis"];
                                                        ?><tr>
                                                                <td><?php echo $complaint; ?></td>
                                                                <td><?php echo $physical_exam; ?></td>
                                                                <td><?php echo $systematic_exam; ?></td>
                                                                <td>
                                                                    <?php 
                                                                    if ($provisional_diagnosis == "") {
                                                                        echo "No Diagnosis";
                                                                    } else {
                                                                        $getdiseases = mysqli_query($con, "SELECT * FROM diseases WHERE disease_id IN ($provisional_diagnosis) AND status=1") or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($getdiseases) > 0) {
                                                                            while ($row = mysqli_fetch_array($getdiseases)) {
                                                                                echo $row['codename'] . "<br>";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td> 
                                                                <td>
                                                                    <?php 
                                                                    if ($final_diagnosis == "") {
                                                                        echo "No Diagnosis";
                                                                    } else {
                                                                        $getdiseasesy = mysqli_query($con, "SELECT * FROM diseases WHERE disease_id in ($final_diagnosis) ") or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($getdiseasesy) > 0) {
                                                                            while ($row = mysqli_fetch_array($getdiseasesy)) {
                                                                                echo $row['codename'] . "<br>";
                                                                            }
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
                                        <div class="tab-pane fade" id="nurse" role="tabpanel">
                                        <?php
                                           if (in_array('nurse', $rooms)) {
                                            ?>
                                            <div class="table-responsive pt-4">
                                                    <h4><strong>Nurse Report</strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tests Done</th>
                                                                <th>Results</th>
                                                                <th>Details</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                                <?php  
                                                                 foreach($patient_ids as $npatientsque_id){
                                                                    $getreports = mysqli_query($con, "SELECT * FROM nursereports WHERE patientsque_id='$npatientsque_id'");
                                                                if (mysqli_num_rows($getreports) > 0) {
                                                                    while ($row = mysqli_fetch_array($getreports)) {
                                                                        $medicalservice_id = $row['nursereport_id'];
                                                                                    $test = $row['type'];
                                                                                    $presult = $row['measurement'];
                                                                                    $details =strip_tags($row['details']);
                                                                ?><tr>
                                                                        <td><?php echo $test; ?></td>
                                                                        <td><?php echo $presult; ?></td>
                                                                        <td><?php echo $details; ?></td>
                                                                        </tr>
                                                                        <?php }}} ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="tab-pane fade" id="lab" role="tabpanel">
                                        <?php
                                           if (in_array('lab', $rooms)) {
                                            ?>
                                            <div class="table-responsive pt-4">
                                                    <h4><strong>Lab Report</strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                            <th>Test done</th>
                                                                <th>Result</th>
                                                                <th>Details</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                                <?php  
                                                                   foreach($patient_ids as $npatientsque_id){
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
                                                                
                                                                <tr>
                                                                        <td><?php echo $test; ?></td>
                                                                        <td><?php echo $presult; ?></td>
                                                                        <td><?php echo $details; ?></td>
                                                                        
                                                                        </tr>
                                                                        <?php }}?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                            <?php } ?>  
                                           
                                        </div>
                                        <div class="tab-pane fade" id="pharm" role="tabpanel">
                                           <?php 
                                               if (in_array('pharmacy',$rooms)){
                                           ?>
                                           <div class="table-responsive pt-4">
                                                    <h4><strong>Pharmacy Report</strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                            <th>Drug</th>
                                                                <th>Purpose</th>
                                                                <th>Units</th>
                                                                <th>Dosage</th>
                                                                <th>Frequency</th>
                                                                <th>Details</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                                <?php  
                                                                  foreach($patient_ids as $npatientsque_id){
                                                                    // get pharmacy orders 
                                                                    $pharmacyorder = mysqli_query($con, "SELECT * FROM `pharmacyorders` where patientsque_id='$npatientsque_id'")or die(mysqli_error($con));
                                                                    if (mysqli_num_rows($pharmacyorder) > 0){
                                                                    // get issued drugs 
                                                                    while($row2=mysqli_fetch_row($pharmacyorder)){
                                                                        $patientque = $row2['patientsque_id'];
                                                                        $pharmyorder =$row2['pharmacyorder_id '];
                                                                        $pharmacyordersitem= mysqli_query($con,"SELECT * FROM `pharmacyordereditems` where pharmacyorder_id='$pharmyorder'")or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($pharmacyordersitem) >0){
                                                                            while($row3=mysqli_fetch_row($pharmacyordersitem)){
                                                                            $purose = $row3['prescription'];
                                                                            $item_id = $row3['item_id'];
                                                                            $unit = $row3['quantity'];
                                                                            $dosage = $row3['dosage'];
                                                                            $freq = $row3['freq'];
                                                                            $details = $row3['details'];

                                                                    
                                                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 and inventoryitem_id='$item_id' ");
                                                                            $row = mysqli_fetch_array($getitems);
                                                                            $itemname = $row['itemname'];
                                                                            $measurement_id = $row['measurement_id'];
                                                                            $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                                            $row2 =  mysqli_fetch_array($getunit);
                                                                            $measurement = $row2['measurement'];
                                                                            ?>
                                                            
                                                                <tr>
                                                                        <td><?php echo $itemname; ?></td>
                                                                        <td><?php echo $purose; ?></td>
                                                                        <td><?php echo $unit; ?></td>
                                                                        <td><?php echo $dosage; ?></td>
                                                                        <td><?php echo $freq; ?></td>
                                                                        <td><?php echo $details; ?></td>
                                                                        </tr>
                                                                        <?php }}}} }?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                           <?php } ?>
                                        </div>
                                        <div class="tab-pane fade" id="radio" role="tabpanel">
                                        <?php
                                           if (in_array('radiography', $rooms)) {
                                            ?>
                                            <div class="table-responsive pt-4">
                                                    <h4><strong>Lab Report</strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                            <th>Test done</th>
                                                                <th>Image</th>
                                                                <th>Description</th>
                                                                <th>Conclusion</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                                <?php  
                                                                   foreach($patient_ids as $npatientsque_id){
                                                                    $radioreports = mysqli_query($con, "SELECT * FROM radiologyreports WHERE patientsque_id='$npatientsque_id'") or die(mysqli_error($con));
                                                                            
                                                                    if (mysqli_num_rows($radioreports) > 0) {
                                                                    while ($row = mysqli_fetch_array($radioreports)) {
                                                                        // print_r($row);
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
                                                                
                                                                <tr>
                                                                        <td><?php echo $medicalservice; ?></td>
                                                                        <td>
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
                                                                        </td>
                                                                        <td><?php echo $description; ?></td>
                                                                        <td><?php echo $conclusion; ?></td>
                                                                        
                                                                        </tr>
                                                                        <?php }}}?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                            <?php } ?>  
                                           
                                        </div>
                                    </div>
                                </div>
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