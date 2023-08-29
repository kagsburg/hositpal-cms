<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('lab technician', 'nurse', 'lab technologist','doctor','head physician','pharmacist','admin');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$id = $_GET['patient_id'];
$que= $_GET['que'];
// $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
// $row = mysqli_fetch_array($getque);
// $patientsque_id = $row['patientsque_id'];
// $admission_id = $row['admission_id'];
// $room = $row['room'];
// $prev_id= $row['prev_id'];
// $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
// $row1 = mysqli_fetch_array($getadmission);
// $patient_id = $row1['patient_id'];
// $paymenttype = get_payment_method($pdo, $patient_id, $admission_id);
$getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$id'");
$row2 = mysqli_fetch_array($getpatient);
$firstname = $row2['firstname'];
$secondname = $row2['secondname'];
$thirdname = $row2['thirdname'];
$patient_id = $row2['patient_id'];
$gender = $row2['gender'];
$dob = $row2['dob'];
$weight = $row2['weight'];
$height = ($row2['height'] != '') ? $row2['height'] : 'NIL';
$temp = ($row2['temp'] != '') ? $row2['temp'] : 'NIL';
$bp = ($row2['bp'] != '') ? $row2['bp'] : 'NIL';
$bloodgroup = $row2['bloodgroup'];
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
                            <li class="breadcrumb-item active"><a href="#">Patient History Report</a></li>
                        </ol>
                    </div>
                </div>
             
                <div class="row">
                <div class="col-lg-4 mb-3">
                        <!--  <a href="printpaidbills.php?id=<?php echo $paymethod ?>&type=<?php echo $payment ?>" class="btn btn-primary">Print</a> -->
                       <!-- <?php 
                        // SELECT * FROM `admitted` 
                        $checkadmitted = mysqli_query($con , "SELECT * FROM `admitted` WHERE `admission_id` = '$admission_id' AND `status` = 1");
                        $countadmitted = mysqli_num_rows($checkadmitted);
                        if ($countadmitted ==0){
                         
                       ?> 
                       
                       <div class="mb-3">

                       <a href="updatepatientreport?id=<?php echo $id ?>" class="btn btn-primary">Add Patient Report</a>
                       </div>
                        <?php } ?>  -->
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient History Report for <?php echo $fullname ?></h4>
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
                                <div class="accordion" id="accordionExample">
                                <?php 
                                        $getpatientHistory = mysqli_query($con, "SELECT * FROM `patienthistory` WHERE `patient_id` = '$id' and status=1 ORDER BY `patient_history_id` DESC")or die(mysqli_error($con));

                                        if (mysqli_num_rows($getpatientHistory) > 0){
                                            while($row3 = mysqli_fetch_array($getpatientHistory)){
                                                $admission_id=$row3['admission_id'];
                                                $patient_id=$row3['patient_id'];
                                                $patientque_id=$row3['patientque_id'];
                                                $timestamp=$row3['timestamp'];
                                                if (strlen($admission_id) == 1) {
                                                    $pin2 = '000' . $admission_id;
                                                }
                                                if (strlen($admission_id) == 2) {
                                                    $pin2 = '00' . $admission_id;
                                                }
                                                if (strlen($admission_id) == 3) {
                                                    $pin2 = '0' . $admission_id;
                                                }
                                                if (strlen($admission_id) >= 4) {
                                                    $pin2 = $admission_id;
                                                }
                                    ?>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $pin2 ?>" aria-expanded="true" aria-controls="collapse<?php echo $pin2 ?>">
                                            Patient Report (<?php echo $pin2 ?>)
                                            </button>
                                        </h2>
                                        </div>

                                        <div id="collapse<?php echo $pin2 ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                        <div class="card">
                                        
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#doctorsreport1">
                                                        <strong class="text-primary">
                                                            Doctor Diagnosis
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#nurse1">
                                                        <strong class="text-primary">
                                                            Nurse
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#lab1">
                                                        <strong class="text-primary">
                                                            Lab
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#pharm1">
                                                        <strong class="text-primary">
                                                            Pharmacy
                                                        </strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#radio1">
                                                        <strong class="text-primary">
                                                            Radiology
                                                        </strong>
                                                    </a>
                                                </li>

                                            </ul>
                                            <?php 
                                                $rooms = [];
                                                $patient_ids =[];
                                                $patient_reports= mysqli_query($con, "SELECT * FROM patientsque WHERE payment='1' AND room ='doctor'AND status='1'and admission_id='$admission_id'");
                                                if (mysqli_num_rows($patient_reports) > 0){
                                                while($row23 = mysqli_fetch_array($patient_reports)){
                                                    $previd = $row23['prev_id'];
                                                    $patientsque22_id = $row23['patientsque_id'];
                                                    $getprevid = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab','doctor','radiography') and status='1' and patientsque_id < '$patientsque22_id' ORDER BY patientsque_id DESC LIMIT 1");
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
                                                <div class="tab-pane fade show active" id="doctorsreport1" role="tabpanel">
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
                                                                $nursereports = mysqli_query($con, "SELECT * FROM doctorexam WHERE patientque_id='$patientque_id'order by `doctorexam_id` desc") or die(mysqli_error($con));
                                                                if (mysqli_num_rows($nursereports)>0){
                                                                while ($row = mysqli_fetch_array($nursereports)) {                                                                    
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
                                                <div class="tab-pane fade" id="nurse1" role="tabpanel">
                                                <?php
                                                $checknurse = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='nurse' and prev_id='$patientque_id' AND status='1'") or die(mysqli_error($con));
                                                if (mysqli_num_rows($checknurse) > 0) {
                                                    ?>
                                                    <div class="table-responsive pt-4">
                                                            <h4><strong>Nurse Report</strong></h4>
                                                            <table class="table  table-striped table-responsive-sm table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Vital test</th>
                                                                        <th>Results</th>
                                                                        <th>Details</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                        <?php  
                                                                       
                                                                            $getnurse = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='nurse' AND status='1' AND admintype='doctor' AND prev_id='$patientque_id'")or die(mysqli_error($con));
                                                                            if (mysqli_num_rows($getnurse) > 0){
                                                                                while($rowpharm3 = mysqli_fetch_array($getnurse)){
                                                                                    $npatientsque_id = $rowpharm3['patientsque_id'];
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
                                                                                <?php }}} }else{?>
                                                                                    <tr>
                                                                                        <td colspan="3">No Nurse Report</td>
                                                                                    </tr>
                                                                                <?php }?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                            <table class="table  table-striped table-responsive-sm table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Service</th>
                                                                        <th>Case Type</th>
                                                                        <th>Details</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                        <?php  
                                                                        
                                                                            $getnurse = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='nurse' AND status='1' AND admintype='doctor' AND prev_id='$patientque_id'")or die(mysqli_error($con));
                                                                            
                                                                            if (mysqli_num_rows($getnurse) > 0){
                                                                                while($rowpharm3 = mysqli_fetch_array($getnurse)){
                                                                                    $npatientsque_id = $rowpharm3['patientsque_id'];
                                                                            $getreports = mysqli_query($con, "SELECT * FROM minor WHERE patientsque_id='$npatientsque_id'");
                                                                        if (mysqli_num_rows($getreports) > 0) {
                                                                            while ($row12 = mysqli_fetch_array($getreports)) {
                                                                                $secrive = $row12['service_id'];
                                                                                $casetype = $row12['casetype'];
                                                                                $details =strip_tags($row12['details']);
                                                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice_id='$secrive' AND status=1");
                                                                                if (mysqli_num_rows($getservice) > 0) {
                                                                                    $rows = mysqli_fetch_array($getservice);
                                                                                    $service_name = $rows['medicalservice'];
                                                                                    $service_id = $rows['medicalservice_id'];
                                                                                } else {
                                                                                    $service_name = " ";
                                                                                }
                                                                        ?><tr>
                                                                                <td><?php echo $service_name; ?></td>
                                                                                <td><?php echo $casetype; ?></td>
                                                                                <td><?php echo $details; ?></td>
                                                                                </tr>
                                                                                <?php }}} }?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="tab-pane fade" id="lab1" role="tabpanel">
                                                <?php
                                                $checklab = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='lab technician' and prev_id='$patientque_id' AND status='1'") or die(mysqli_error($con));

                                                if (mysqli_num_rows($checklab) > 0) {
                                                    ?>
                                                    <div class="table-responsive pt-4">
                                                        <h4><strong>Lab Report</strong></h4>
                                                        
                                                        <table class="table  table-striped table-responsive-sm table-bordered">
                                                            <thead>
                                                                <tr>
                                                                <th>Test done</th>
                                                                    <!-- <th>Result</th> -->
                                                                    <th>Action</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                    <?php  
                                                                    // while($row2=mysqli_fetch_array($checklab)){
                                                                    $getlab = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='lab' AND status in (1,0) AND admintype='doctor' AND prev_id='$patientque_id'")or die(mysqli_error($con));
                                                                        
                                                                        // $getlab = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='lab technician' AND status='1' AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($getlab) > 0){
                                                                            while($rowpharm3 = mysqli_fetch_array($getlab)){
                                                                                $npatientsque_id = $rowpharm3['patientsque_id'];
                                                                        $doctorreports = mysqli_query($con, "SELECT * FROM laborders WHERE  patientsque_id='$npatientsque_id' ") or die(mysqli_error($con));

                                                                        // $getreports = mysqli_query($con, "SELECT * FROM labreports WHERE patientsque_id='$npatientsque_id'");
                                                                        if (mysqli_num_rows($doctorreports) > 0) {
                                                                            while ($rowo = mysqli_fetch_array($doctorreports)) {
                                                                                $timestamp = $rowo['timestamp'];
                                                                        $serviceorder_id = $rowo['laborder_id'];
                                                                        $getordered2 = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id ='$serviceorder_id' AND status in (3)") or die(mysqli_error($con));

                                                                        if (mysqli_num_rows($getordered2) > 0) {
                                                                            while ($row = mysqli_fetch_array($getordered2)) {
                                                                                $medicalservice_id = $row['investigationtype_id'];
                                                                                $status = $row['status'];
                                                                            $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                                        $row2 = mysqli_fetch_array($getservice);
                                                                                        $test = $row2['investigationtype'];
                                                                                        $unit_id = $row2['unit_id'];  
                                                                                ?>
                                                                    
                                                                    <tr>
                                                                            <td><?php echo $test; ?></td>
                                                                            <td>
                                                                                <?php if ($status == 1 || $status == 2) { ?>
                                                                                <!-- <a href="addradiologyreport.php?id=<?php echo $patientsque_id; ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-xs btn-info">Add Test</a> -->
                                                                                <?php } else { ?>
                                                                                <a href="labreport?que=<?php echo $npatientsque_id; ?>&patient_id=<?php echo $patient_id ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-primary btn-sm">View Report</a>
                                                                            
                                                                            <?php  }?>
                                                                            </td>
                                                                            
                                                                            </tr>
                                                                            <?php }}}}}}?>
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php } ?>  
                                                
                                                </div>
                                                <div class="tab-pane fade" id="pharm1" role="tabpanel">
                                                <?php 
                                                 $checkpharmacy = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='pharmacy' and prev_id='$patientque_id' AND status='1'") or die(mysqli_error($con));
                                                    if (mysqli_num_rows($checkpharmacy) > 0){
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
                                                                    while($row2=mysqli_fetch_array($checkpharmacy)){
                                                                        $getpharmacy = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='pharmacy' AND status='1' AND admintype='doctor' AND prev_id='$patientque_id'")or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($getpharmacy) > 0){
                                                                            while($rowpharm = mysqli_fetch_array($getpharmacy)){
                                                                                $npatientsque_id = $rowpharm['patientsque_id'];
                                                                           
                                                                            $pharmacyorder = mysqli_query($con, "SELECT * FROM `pharmacyorders` where patientsque_id='$npatientsque_id'")or die(mysqli_error($con));
                                                                            if (mysqli_num_rows($pharmacyorder) > 0){
                                                                            // get issued drugs 

                                                                            while($row22=mysqli_fetch_array($pharmacyorder)){
                                                                                $patientque = $row22['patientsque_id'];
                                                                                $pharmyorder =$row22['pharmacyorder_id'];
                                                                                $pharmacyordersitem= mysqli_query($con,"SELECT * FROM `pharmacyordereditems` where pharmacyorder_id='$pharmyorder'")or die(mysqli_error($con));
                                                                                if (mysqli_num_rows($pharmacyordersitem) >0){
                                                                                    while($row3=mysqli_fetch_array($pharmacyordersitem)){
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
                                                                                <?php }}}} }}}?>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane fade" id="radio1" role="tabpanel">
                                                <?php
                                                    $checkradio = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='radiographer' and prev_id='$patientque_id' AND status='1'") or die(mysqli_error($con));
                                                // if (mysqli_num_rows($checkradio) > 0) {
                                                    ?>
                                                    <div class="table-responsive pt-4">
                                                            <h4><strong>Radiolody Report</strong></h4>
                                                            <table class="table  table-striped table-responsive-sm table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                    <th>Test done</th>
                                                                        <!-- <th>Details</th> -->
                                                                        <th>Action</th>
                                                                        <!-- <th>Conclusion</th> -->
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                        <?php  
                                                                        
                                                                        $getradio = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='radiography' AND status='1' AND admintype='doctor' AND prev_id='$patientque_id'")or die(mysqli_error($con));
                                                                        if (mysqli_num_rows($getradio) > 0){
                                                                            while($rowpharm3 = mysqli_fetch_array($getradio)){
                                                                                $npatientsque_id = $rowpharm3['patientsque_id'];
                                                                            $doctorreports = mysqli_query($con, "SELECT * FROM radioorders WHERE  patientsque_id='$npatientsque_id' ") or die(mysqli_error($con));
                                                                            // $radioreports = mysqli_query($con, "SELECT * FROM radiologyreports WHERE patientsque_id='$npatientsque_id'") or die(mysqli_error($con));
                                                                                    
                                                                            if (mysqli_num_rows($doctorreports) > 0) {
                                                                            while ($rowo = mysqli_fetch_array($doctorreports)) {
                                                                                $timestamp = $rowo['timestamp'];
                                                                           $serviceorder_id = $rowo['radioorder_id'];
                                                                           $getordered2 = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND status in (3)") or die(mysqli_error($con));

                                                                           if (mysqli_num_rows($getordered2) > 0) {
                                                                              while ($row = mysqli_fetch_array($getordered2)) {
                                                                                 $medicalservice_id = $row['radioinvestigationtype_id'];
                                                                                 $status = $row['status'];
                                                                               $getitem = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                                               $row1 = mysqli_fetch_array($getitem);
                                                                               $itemname = $row1['investigationtype'];
                                                                                    ?>
                                                                        
                                                                        <tr>
                                                                        <td><?php echo $itemname; ?></td>
                                                                                 <!-- <td><?php echo $details; ?></td> -->
                                                                                 <td>
                                                                                    <?php if ($status == 1 || $status == 2) { ?>
                                                                                       <a href="addradiologyreport.php?id=<?php echo $patientsque_id; ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-xs btn-info">Add Test</a>
                                                                                    <?php } else { ?>
                                                                                       <a href="radiography?patientsque_id=<?php echo $npatientsque_id; ?>&id=<?php echo $patient_id ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-primary btn-sm">Radiology Report</a>
                                                                                   
                                                                                   <?php  }?>

                                                                                 </td>
                                                                                
                                                                                </tr>
                                                                                <?php }}
                                                                                else{
                                                                                    echo "<tr> <td colspan='3'>No Radiology Report</td></tr>";  
                                                                                }
                                                                                }}
                                                                            }}else{
                                                                                echo "<tr> <td colspan='3'>No Radiology Report</td></tr>";
                                                                            }?>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    <?php  ?>  
                                                
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <?php }} ?>
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