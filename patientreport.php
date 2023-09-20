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
$getque = mysqli_query($con, "SELECT * FROM patientsque WHERE prev_id='$id' and admintype='clinic' AND status='1'");
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
    <title>Recent Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet">

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
                            <h4> Recent Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Recent Report</a></li>
                        </ol>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Report for <?php echo $fullname ?></h4>
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
                                        $dob1 = date("Y-m-d", $dob);
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
                                            <h4 class="card-title">Recent Report</h4>
                                        </div>
                                        <div class="card-body">
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
                                                                $nursereports = mysqli_query($con, "SELECT * FROM doctorexam WHERE patientque_id='$id'order by `doctorexam_id` desc") or die(mysqli_error($con));
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
                                                $checknurse = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='nurse' and prev_id='$id' AND status='1'") or die(mysqli_error($con));
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
                                                                       
                                                                            $getnurse = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='nurse' AND status='1' AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
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
                                                                                <?php }}else{?>
                                                                                    <tr>
                                                                                        <td colspan="3">No Nurse Report</td>
                                                                                    </tr>
                                                                                    <?php }
                                                                            } }else{?>
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
                                                                        
                                                                            $getnurse = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='nurse' AND status='1' AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
                                                                            
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
                                                 $checklab = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='lab technician' and prev_id='$id' AND status='1'") or die(mysqli_error($con));
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
                                                                        $getlab = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='lab' AND status in (1,0) AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
                                                                            
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
                                                 $checkpharmacy = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='pharmacy' and prev_id='$id' AND status='1'") or die(mysqli_error($con));
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
                                                                        $getpharmacy = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='pharmacy' AND status='1' AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
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
                                                    $checkradio = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admintype='radiographer' and prev_id='$id' AND status in (1,8)") or die(mysqli_error($con));
                                                if (mysqli_num_rows($checkradio) > 0) {
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
                                                                        
                                                                        $getradio = mysqli_query($con, "SELECT * FROM patientsque where admission_id ='$admission_id' and room='radiography' AND status in (1,0) AND admintype='doctor' AND prev_id='$id'")or die(mysqli_error($con));
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
                                                                                       <a href="radiography?patientsque_id=<?php echo $npatientsque_id; ?>&id=<?php echo $patient_id ?>&test=<?php echo $medicalservice_id;?>" target="_blank" class="btn btn-primary btn-sm">View Report</a>
                                                                                   
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

    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->

    <!-- Datatable -->
    <script src="vendor/select2/js/select2.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>

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



    <script>
        $(document).on('click','.cause', function(){
            var cause = $(this).val();
            if(cause == 'immediate'){
                $('.fortype1').show();
                $('.fortype2').hide();
                $('.fortype3').hide();
            }
            if (cause == 'other'){
                $('.fortype1').hide();
                $('.fortype2').show();
                $('.fortype3').hide();
            }
            if (cause == 'underlying'){
                $('.fortype1').hide();
                $('.fortype2').hide();
                $('.fortype3').show();
            }
        });
        $(document).on('click','.medicalop',function(){
            var medicalop= $(this).val();
            if(medicalop == 'yes'){
                $('.formedicalop').show();
            }
            else{
                $('.formedicalop').hide();
            }
        })
        $(document).on('click','.deadinves',function(){
            var deadinves = $(this).val();
            if (deadinves == 'yes'){
                $('.fordeadinves').show();
            }
            else{
                $('.fordeadinves').hide();
            }
        })
        $(document).on('click','.deadborndead24',function(){
            var deadborndead = $(this).val();
            if (deadborndead=='yes'){
                $('.fordeadborndead24').show();
            }
            else{
                $('.fordeadborndead24').hide();
            }
        })
        $('#nextref').on('click', '.subcategoryname', function() {
            var $nref = $(this).closest(".nref");
            if ($nref.find('.category').val() === '') {
                alert("Please Select a Category First");
            }
        });


        $('#nextref').on('change', '.sections', function() {
            var $nref = $(this).closest(".nref");
            var section = $(this).val();
            console.log("dddd", section)
            if (section !== '') {                
                $nref.find(".servicename").hide();
                $nref.find(".services").hide();
                $nref.find(".service" + section).show();
            } else {
                $nref.find(".servicename").show();
                $nref.find(".services").hide();
            }
        });
        
        $(document).on('change','.drug',function(){
            var drug = $(this).val();
            var $count = $(this).attr('data-count')
            $.ajax({
                url: "getprod.php",
                type: "POST",
                data: {
                    drug: drug
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                   if (data.status == 'success'){
                        $(`#stock${$count}`).val(data.instock)
                        $(`#date${$count}`).val(data.expiry)
                        $(`#unit${$count}`).html(`( ${data.measurement}  )`)

                   }
                }
            });
        })

        var refsc = 1;
        $(`.multi-select_${refsc}`).select2();

        $('#addnref').on("click", function() {
            refsc += 1;
            // $('.msnr').select2('destroy');
            $(`#nref_${refsc - 1}`).after(`
            <div id="nref_${refsc}" class="nref bt">
                <div class="form-group">
                    <label>Next Reference</label>
                    <select class="form-control reference" name="ref[${refsc}][reference]">
                        <option selected="selected" value="">Select Reference..</option>
                        <option value="nurse">nurse</option>
                        <option value="pharmacy">pharmacy</option>
                        <option value="lab">Lab</option>
                        <option value="radiography">Radiography</option>
                        <option value="anesthesiology">Anesthesiology</option>
                        <option value="patron">Patron</option>
                    </select>
                </div>
                
                <div class="form-group notmedic" style="display: none;">
                    <label class="control-label">Section</label>
                    <select name="ref[${refsc}][section][]" class="sections form-control">
                        <option value="">Select Section</option>
                        <?php
                        $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                        while ($row1 =  mysqli_fetch_array($getsections)) {
                            $section_id = $row1['section_id'];
                            $section = $row1['section'];
                        ?>
                            <option value="<?php echo $section_id; ?>"><?php echo $section; ?></option>
                        <?php } ?>
                    </select>                                            
                </div>

                <div class="form-group notmedic" style="display: none;">
                    <label class="control-label">Medical Services</label>
                    <select name="ref[${refsc}][servicename]" class="form-control servicename multi-select_${refsc}">
                        <option value="">Select Medical Service</option>
                    </select>
                    <?php
                    $getsection =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                    while ($row =  mysqli_fetch_array($getsection)) {
                        $section_id = $row['section_id'];
                    ?>
                        <div id="" style="display:none;width:100%;" class="row services service<?php echo $section_id; ?> form-group">

                            <?php
                            $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND section_id='$section_id' ORDER BY medicalservice");
                            while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                $medicalservice_id = $row1['medicalservice_id'];
                                $medicalservice = $row1['medicalservice'];
                                // $charge = $row1['charge'];
                            ?>
                                <div class="col-lg-6">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" style="font-size:14px">
                                            <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="ref[${refsc}][medicalservices][]"><?php echo $medicalservice; ?>
                                        </label>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="pharmacy" style="display: none">
                    <div class="col-lg-12">
                        <h4>Recommended Drugs</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class='subobj1'>
                            <div class='row'>
                                <div class="form-group col-lg-6">
                                    <label>Drug Name</label>
                                    <select class="form-control room  msnr multi-select_${refsc}" name="ref[${refsc}][drug][]">
                                        <option selected="selected" value="">Select option..</option>
                                        <?php
                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ");
                                        while ($row = mysqli_fetch_array($getitems)) {
                                            $inventoryitem_id = $row['inventoryitem_id'];
                                            $itemname = $row['itemname'];
                                            // $category_id = $row['category_id'];
                                            // $measurement_id = $row['measurement_id'];
                                            // $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                            // $row1 =  mysqli_fetch_array($getcat);
                                            // $category = $row1['category'];
                                            $type = $row['type'];
                                            $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                            $row2 =  mysqli_fetch_array($getunit);
                                            $measurement = $row2['measurement'];
                                            if ($type == 'Medical') {
                                        ?>
                                                <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label>Prescription</label>
                                    <input type="text" name="ref[${refsc}][prescription][]" class="form-control " placeholder="Enter prescription">
                                </div>
                                <div class="form-group col-lg-1">
                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group forlab" style="display: none;">
                    <label class="control-label">Measurement</label>
                    <select name="ref[${refsc}][labmeasure][]" id="mname" class="form-control  msnr multi-select_${refsc}" multiple>
                        <option value="">Select Measurement</option>


                        <?php
                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1");
                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                            $medicalservice_id = $row1['investigationtype_id'];
                            $medicalservice = $row1['investigationtype'];
                            // $charge = $row1['charge'];
                        ?>
                            <option value="<?php echo $medicalservice_id; ?>"><?php echo $medicalservice; ?></option>

                        <?php } ?>
                    </select>

                </div>
                <div class="form-group forlab" style="display: none">
                    <label>Select Technician</label>
                    <select class="form-control room" name="ref[${refsc}][technician]">
                        <option selected="selected" value="">Select option..</option>
                        <?php
                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='lab technician'");
                        while ($row = mysqli_fetch_array($getstaff)) {
                            $staff_id = $row['staff_id'];
                            $fullname = $row['fullname'];
                        ?>
                            <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group fornurse" style="display: none">
                    <label>Select Nurse</label>
                    <select class="form-control room" name="ref[${refsc}][nurse]">
                        <option selected="selected" value="">Select option..</option>
                        <?php
                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='nurse'");
                        while ($row = mysqli_fetch_array($getstaff)) {
                            $staff_id = $row['staff_id'];
                            $fullname = $row['fullname'];
                        ?>
                            <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group forradiography" style="display: none;">
                    <label class="control-label">Measurement</label>
                    <select name="ref[${refsc}][radiomeasure][]" id="rmname" class="form-control  msnr multi-select_${refsc}" multiple>
                        <option value="">Select Measurement</option>


                        <?php
                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1");
                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                            $medicalservice_id = $row1['radioinvestigationtype_id'];
                            $medicalservice = $row1['investigationtype'];
                            // $charge = $row1['charge'];
                        ?>
                            <option value="<?php echo $medicalservice_id; ?>"><?php echo $medicalservice; ?></option>

                        <?php } ?>
                    </select>

                </div>
                <div class="form-group forradiography" style="display: none">
                    <label>Select Radiographer</label>
                    <select class="form-control room" name="ref[${refsc}][radiographer]">
                        <option selected="selected" value="">Select option..</option>
                        <?php
                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='radiographer'");
                        while ($row = mysqli_fetch_array($getstaff)) {
                            $staff_id = $row['staff_id'];
                            $fullname = $row['fullname'];
                        ?>
                            <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group foranesthesiology" style="display: none">
                    <label>Select Anesthesiologist</label>
                    <select class="form-control room" name="ref[${refsc}][anesthesiologist]">
                        <option selected="selected" value="">Select option..</option>
                        <?php
                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='anesthesiologist'");
                        while ($row = mysqli_fetch_array($getstaff)) {
                            $staff_id = $row['staff_id'];
                            $fullname = $row['fullname'];
                        ?>
                            <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group forpatron" style="display: none">
                    <label>Select Patron / Matron</label>
                    <select class="form-control room" name="ref[${refsc}][patron]">
                        <option selected="selected" value="">Select option..</option>
                        <?php
                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 AND role='patron'");
                        while ($row = mysqli_fetch_array($getstaff)) {
                            $staff_id = $row['staff_id'];
                            $fullname = $row['fullname'];
                        ?>
                            <option value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            `)

            $(`.multi-select_${refsc}`).select2();
            // $(`.msnr`).select2();
        })
        $(document).on('click','.subobj1_button2',function(e){
            e.preventDefault();
        //    count the number of add rows 
            var count = $('.subobj2').children().length;
            // count++;
            $('.subobj2').append(`
                        <div class="row">
                           
                            <div class="col-lg-11">
                                <div class="row">  
                                    <div class="form-group col-lg-12">
                                        <label>Drug Name</label>     
                                        <select class="form-control room select2 msnr multi-select_1 drug" name="ref[pharmacy][drug][]" data-count="${count}">  
                                            <option selected="selected" value="">Select option..</option>        
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $type = $row['type'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];
                                                if ($type == 'Medicine') {
                                                    
                                                    $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id' and store =2 and status=1") or die(mysqli_error($con));
                                                    
                                                    $row3 = mysqli_fetch_array($getstock);
                                                    $totalstock = $row3['totalstock'];
                                                    $exipry = $row3['expiry'];
                                                    $totalordered = 0;
                                                    $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id'") or die(mysqli_error($con));
                                                    while ($row4 = mysqli_fetch_array($getordered)) {
                                                        $stockorder_id = $row4['stockorder_id'];
                                                        $quantity = $row4['quantity'];
                                                        $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND status=1");
                                                        if (mysqli_num_rows($getorder) > 0) {
                                                            $totalordered = $totalordered + $quantity;
                                                        }
                                                    }
                                                    $instock = $totalstock - $totalordered;
                                                    if ($instock > 0){
                                            ?>     
                                                    <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname . '(' . $measurement . ')'; ?></option>  
                                                <?php }}
                                            } ?>      
                                        </select>
                                    </div>  
                                    <div class="form-group col-lg-6">
                                                                <label>In stock</label>
                                                                <input type="text" id="stock${count}" name="ref[pharmacy][stock][]" class="form-control " readonly>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Expiry Date</label>
                                                                <input type="date" id="date${count}" name="ref[pharmacy][expiry][]" class="form-control " readonly>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Purpose</label>
                                                                <input type="text" name="ref[pharmacy][prescription][]" class="form-control " placeholder="Enter Purpose">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Units <span id="unit${count}"></span></label>
                                                                <input type="number"  name="ref[pharmacy][unit][]" class="form-control " placeholder="Enter Unit">
                                                            </div>
                                                            <div class="form-group col-lg-12">
                                                                <label>Dosage</label>
                                                                <input type="text" name="ref[pharmacy][dosage][]" class="form-control " placeholder="Enter dosage">
                                                            </div>
                                                            <div class="form-group col-lg-12">
                                                                <label>Frequency</label>
                                                                <input type="text" name="ref[pharmacy][Frequency][]" class="form-control " placeholder="Enter Frequency ">
                                                            </div>
                                                            <div class="form-group pharmacy" >
                                                                <label class="control-label">* Details & Instructions</label>
                                                                <textarea class="form-control" cols="40" id="editor1" rows="8" name="ref[pharmacy][details][]"></textarea>
                                                            </div>
                            </div> 
                            <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    `); //add input box
        
                    $(`.multi-select_${refsc}`).select2(); 
                        // re initilize for ckeditor
                        if (typeof CKEDITOR !== 'undefined') {
                            CKEDITOR.replace('editor1');
                        }
        });
        $('#nextref').on('click', '.subobj1_button', function(e) { //on add input button click
            e.preventDefault();
            $(this).closest('.subobj1').append(`
                        <div class="row">
                            <div class="col-lg-12">
                                <hr style="border-top: dashed 1px #b7b9cc;">
                            </div>
                            <div class="col-lg-11">
                                <div class="row">  
                                    <div class="form-group col-lg-5">
                                        <label>Drug Name</label>     
                                        <select class="form-control room select2 msnr multi-select_1" name="ref[pharmacy][drug][]">  
                                            <option selected="selected" value="">Select option..</option>        
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                // $category_id = $row['category_id'];
                                                $measurement_id = $row['measurement_id'];
                                                // $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                // $row1 =  mysqli_fetch_array($getcat);
                                                // $category = $row1['category'];
                                                $type = $row['type'];
                                                if ($type == 'Medical') {
                                            ?>     
                                                    <option  value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>       
                                                <?php }
                                            } ?>      
                                        </select>
                                    </div>  
                                    <div class="form-group col-lg-3"> 
                                        <label>Prescription</label>   
                                        <input type="text"  name="ref[pharmacy][prescription][]" class="form-control " placeholder="Enter Prescription">
                                    </div>
                                    <div class="form-group col-lg-3"> 
                                        <label>Dosage</label>   
                                        <input type="text"  name="ref[pharmacy][dosage][]" class="form-control " placeholder="Enter Dosage">
                                    </div>
                                </div> 
                            </div> 
                            <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    `); //add input box
        });
        $('#nextref').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        $('#nextref').on('change', '.reference', function() {
            var isChecked = $(this).prop('checked');
            var nref = $(this).closest(".nref");
            var getselect = $(this).data('ref');

            console.log("changed", $(this), nref)

            if (!isChecked) {
                nref.find('.pharmacy').hide();
                nref.find('.notmedic').hide();
                nref.find('.forlab').hide();
                nref.find('.fornurse').hide();
                nref.find('.forpatron').hide();
                nref.find('.forradiography').hide();
                nref.find('.foradmission').hide();
                nref.find('.foranesthesiology').hide();
            } else {
                if ((getselect == 'pharmacy')) {
                    nref.find('.pharmacy').show();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                }
                if ((getselect == 'lab')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').hide();
                    nref.find('.forlab').show();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                }
                if ((getselect == 'nurse')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').show();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                }
                if ((getselect == 'patron')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').show();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                }
                if ((getselect == 'radiography')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').hide();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').show();
                    nref.find('.foranesthesiology').hide();
                }
                if ((getselect == 'anesthesiology')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').show();
                }
                if((getselect == 'admission')){
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                    nref.find('.foradmission').show()
                }
                if((getselect == 'referral')){
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                    nref.find('.foradmission').hide();
                    nref.find('.forreferral').show()
                }
                if ((getselect == 'acts')) {
                    nref.find('.pharmacy').hide();
                    nref.find('.notmedic').show();
                    nref.find('.forlab').hide();
                    nref.find('.fornurse').hide();
                    nref.find('.forpatron').hide();
                    nref.find('.forradiography').hide();
                    nref.find('.foranesthesiology').hide();
                    nref.find('.foradmission').hide();
                    nref.find('.forreferral').hide()
                    nref.find('.foracts').show()

                }
            }

        });
    </script>
</body>

</html>