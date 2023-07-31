<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/bills.php';

if (($_SESSION['elcthospitallevel'] != 'doctor')) {
    header('Location:login.php');
}
$id = $_GET['id'];
// print_r($_POST); die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        #nextref {
            /*border: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 4px;*/
            margin-top: -10px;

        }

        .nref {
            padding: 12px;
        }

        .bt {
            border-top: 1px solid #ddd;
            padding-top: 16px;
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            color: #2c2f32;
            font-weight: 400;
            background-color: #f3f3f3;
            border-color: #dee2e6 #dee2e6 #fbfbfb;
        }
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> -->
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
                            <h4>Add Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Report</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
                    $row = mysqli_fetch_array($getque);
                    $patientsque_id = $row['patientsque_id'];
                    $admission_id = $row['admission_id'];
                    $room = $row['room'];
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
                    $insurancecompany = $row2['insurancecompany'];
                    $ext = $row2['ext'];
                    
                    $getprevque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab') AND status=1 ORDER BY patientsque_id DESC");
                    $rowp = mysqli_fetch_array($getprevque);
                    $attendant = isset($rowp['attendant']) ? $rowp['attendant'] : "";
                    $patientsque_id2 = isset($rowp['patientsque_id']) ? $rowp['patientsque_id'] : "";
                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                    $rows = mysqli_fetch_array($getstaff);
                    $fullname = isset($rows['fullname']) ? $rows['fullname'] : "";
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
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">

                                <div class="profile-blog mb-5">
                                    <img src="images/patients/thumbs/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header" style="padding-bottom: 0.75rem;">
                                <ul class="nav nav-tabs card-header-tabs" id="form-list" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#diagnosis" data-toggle="tab" data-target="#diagnosis" role="tab" aria-controls="diagnosis" aria-selected="true">Diagnosis</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#nurse" data-toggle="tab" data-target="#nurse" role="tab" aria-controls="nurse" aria-selected="false">Nurse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pharmacy" data-toggle="tab" data-target="#pharmacy" role="tab" aria-controls="pharmacy" aria-selected="false">Pharmacy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#lab" data-toggle="tab" data-target="#lab" role="tab" aria-controls="lab" aria-selected="false">Lab</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#radiography" data-toggle="tab" data-target="#radiography" role="tab" aria-controls="radiography" aria-selected="false">Radiology </a>
                                    </li>
                                    <?php 
                                    // get admitted details
                                    $getadmitted = mysqli_query($con, "SELECT * FROM admitted WHERE admission_id='$admission_id' AND status=1");
                                    if (mysqli_num_rows($getadmitted)>0){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#anesthesiology" data-toggle="tab" data-target="#anesthesiology" role="tab" aria-controls="anesthesiology" aria-selected="false">Anesthesiology</a>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#patron" data-toggle="tab" data-target="#patron" role="tab" aria-controls="patron" aria-selected="false">Patron</a>
                                    </li>
                                    <?php
                                    if (mysqli_num_rows($getadmitted)==0){
                                        ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#admission" data-toggle="tab" data-target="#admission" role="tab" aria-controls="admission" aria-selected="false">Admission</a>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#referral" data-toggle="tab" data-target="#referral" role="tab" aria-controls="referral" aria-selected="false">Referral</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="#acts" data-toggle="tab" data-target="#acts" role="tab" aria-controls="acts" aria-selected="false">Acts</a>
                                    </li> -->



                                </ul>
                            </div>
                            <div class="card-body">
                                <?php 
                                    if (isset($_POST['submit'])) {
                                        $complaint = $_POST["complaint"];
                                        $physical_exam = $_POST["physical_exam"];
                                        $systematic_exam = $_POST["systematic_exam"];
                                        $provisional_diagnosis = $_POST["provisional_diagnosis"];
                                        $final_diagnosis = $_POST["final_diagnosis"];
                                        
                                        $final_diagnosis = is_array($final_diagnosis) ? implode(",", $final_diagnosis) : $final_diagnosis;
                                        $provisional_diagnosis = is_array($provisional_diagnosis) ? implode(",", $provisional_diagnosis) : $provisional_diagnosis;
    
    
                                        $references = isset($_POST['reference']) ? $_POST['reference'] : [''];
                                            foreach ($references as $reference_key) {
                                                $reference_obj = isset($_POST['ref'][$reference_key]) ? $_POST['ref'][$reference_key] : [];
                                                $reference = $reference_key; //$reference_obj['reference'];
        
                                                $patron =  0;
                                                $technician =  0;
                                                $nurse = 0;
                                                $radiographer =  0;
                                                $anesthesiologist = 0;
                                                $details = !empty($reference_obj['details']) ? $reference_obj['details'] : "";
        
                                                if (!empty($reference)) {
                                                    if ($reference == 'lab') {
                                                        $attendant = $technician;
                                                    }
                                                    if ($reference == 'pharmacy') {
                                                        $attendant = 0;
                                                    }
                                                    if ($reference == 'nurse') {
                                                        $attendant = $nurse;
                                                    }
                                                    if ($reference == 'radiography') {
                                                        $attendant = $radiographer;
                                                    }
                                                    if ($reference == 'anesthesiology') {
                                                        $attendant = $anesthesiologist;
                                                    }
                                                    if ($reference == 'patron') {
                                                        $attendant = $patron;
                                                    }
                                                    if ($reference == 'admission'){
                                                        $attendant=$nurse;
                                                    }
                                                    if ($reference == 'referral'){
                                                        $attendant=$nurse;
                                                    }
                                                    if ($reference == 'referral'){
                                                        $ros = $reference_obj['ros'];
                                                        $pmh = $reference_obj['pmh'];
                                                        $dia = $reference_obj['dia'];
                                                        $treat = $reference_obj['treat'];
                                                        $details = $reference_obj['ros'];
                                                        $hpi = $reference_obj['hpi'];
                                                        mysqli_query($con, "INSERT INTO referral(patient_id,date,HPI,ROS,PMH,diagnosis,treatment,reason,admin_id,status) VALUES('$patient_id',UNIX_TIMESTAMP(),'$hpi','$ros','$pmh','$dia','$treat','$reason','" . $_SESSION['elcthospitaladmin'] . "',1)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                        // create_bill($pdo,$patient_id,$admission_id,$id,'referral',$last_id,$referralfee,$paymenttype);
                                                        $_SESSION['success'] = '<div class="alert alert-success">Patient Successfully Referred.</div>';
                                                            // redirect to doctorwaiting
                                                            echo '<script>window.location.href = "doctorwaiting.php";</script>';
                                                    }
                                                    
                                                    if ($reference == 'anesthesiology'){
                                                        mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','$reference','$attendant','1','" . $_SESSION['elcthospitaladmin'] . "','doctor',UNIX_TIMESTAMP(),0,'$id')") or die(mysqli_error($con));
                                                        $new_patientsque_id = mysqli_insert_id($con);
                                                        mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                        $_SESSION['success'] = '<div class="alert alert-success">Patient Successfully sent to Anesthesiology.</div>';
                                                            // redirect to doctorwaiting
                                                        echo '<script>window.location.href = "doctorcleared.php";</script>';

                                                    }
                                                    if ($reference == 'admission'){
                                                        mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','$reference','$attendant','0','" . $_SESSION['elcthospitaladmin'] . "','doctor',UNIX_TIMESTAMP(),5,'$id')") or die(mysqli_error($con));
                                                    }else{
                                                        mysqli_query($con, "INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','$reference','$attendant','0','" . $_SESSION['elcthospitaladmin'] . "','doctor',UNIX_TIMESTAMP(),0,'$id')") or die(mysqli_error($con));
                                                    }  
                                                    $new_patientsque_id = mysqli_insert_id($con);
                                                    if (isset($reference_obj['medicalservices'])) {
                                                        // format: [{id: charge}]
                                                        $cashfallbacks = [];
                                                        $mservices = [];
                                                        $medicalservices = $reference_obj['medicalservices'];
                                                        foreach ($medicalservices as $service) {
                                                            $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
                                                            $row1 =  mysqli_fetch_array($getmedicalservice);
                                                            if ($paymenttype == 'cash') {
                                                                $charge = $row1['charge'];
                                                            } else if ($paymenttype == 'credit') {
                                                                $charge = $row1['creditprice'];
                                                            } else if ($paymenttype == 'insurance') {
                                                                $getinsured =  mysqli_query($con, "SELECT * FROM insuredservices WHERE status=1 AND medicalservice_id='$service' AND insurancecompany_id='$insurancecompany'");
                                                                if (mysqli_num_rows($getinsured) > 0) {
                                                                    $insurance =  mysqli_fetch_array($getinsured);
                                                                    $insuredservice_id = $insurance['insuredservice_id'];
                                                                    $charge = $insurance['charge'];
                                                                }
                                                            }
                                                            if (empty($charge)) {
                                                                $cashfallbacks[$service] = $row1['charge'];
                                                            } else {
                                                                $mservices[$service] = $charge;
                                                            }
                                                        }
                                                        if (!empty($cashfallbacks)) {
                                                            mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'cash',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($cashfallbacks);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'medical_service', $last_id, $total_amount, 'cash');
                                                            foreach ($cashfallbacks as $service => $charge)
                                                                mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                        }
                                                        if (!empty($mservices)) {
                                                            mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymenttype',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($mservices);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'medical_service', $last_id, $total_amount, $paymenttype);
                                                            foreach ($mservices as $service => $charge)
                                                                mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                        }
                                                    }
                                                    if (!empty($reference_obj['labmeasure'])) {
                                                        $labmeasures = $reference_obj['labmeasure'];
                                                        // format: [{id: charge}]
                                                        $cashfallbacks = [];
                                                        $lbmeasures = [];
                                                        foreach ($labmeasures as $service) {
                                                            $getmedicalservices =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$service'");
                                                            $row1 =  mysqli_fetch_array($getmedicalservices);
                                                            if ($paymenttype == 'cash') {
                                                                $charge = $row1['unitprice'];
                                                            } else if ($paymenttype == 'credit') {
                                                                $charge = $row1['creditprice'];
                                                            } else if ($paymenttype == 'insurance') {
                                                                $getinsured =  mysqli_query($con, "SELECT * FROM insuredinvestigationtypes WHERE status=1 AND investigationtype_id='$service' AND insurancecompany_id='$insurancecompany'");
                                                                if (mysqli_num_rows($getinsured) > 0) {
                                                                    $insurance =  mysqli_fetch_array($getinsured);
                                                                    $charge = $insurance['charge'];
                                                                }
                                                            }
                                                            if (empty($charge)) {
                                                                $cashfallbacks[$service] = $row1['unitprice'];
                                                            } else {
                                                                $lbmeasures[$service] = $charge;
                                                            }
                                                        }
                                                        if (!empty($cashfallbacks)) {
                                                            mysqli_query($con, "INSERT INTO laborders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'cash',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($cashfallbacks);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'lab', $last_id, $total_amount, 'cash');
                                                            foreach ($cashfallbacks as $service => $charge) {
                                                                mysqli_query($con, "INSERT INTO patientlabs(laborder_id,investigationtype_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                            }
                                                        }
                                                        if (!empty($lbmeasures)) {
                                                            mysqli_query($con, "INSERT INTO laborders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymenttype',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($lbmeasures);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'lab', $last_id, $total_amount, $paymenttype);
                                                            foreach ($lbmeasures as $key =>$charge){
                                                                $charge = intval($charge);
                                                                $service = intval($key);
                                                                mysqli_query($con, "INSERT INTO patientlabs(laborder_id,investigationtype_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));                                                            } 
                                                        }
                                                    }
        
                                                    if (!empty($reference_obj['radiomeasure'])) {
                                                        $radiomeasures = $reference_obj['radiomeasure'];
                                                        $cashfallbacks = [];
                                                        $lbmeasures = [];
        
                                                        foreach ($radiomeasures as $service) {
                                                            $getmedicalservices =  mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$service'");
                                                            $row1 =  mysqli_fetch_array($getmedicalservices);
                                                            if ($paymenttype == 'cash') {
                                                                $charge = $row1['unitprice'];
                                                            } else if ($paymenttype == 'credit') {
                                                                $charge = $row1['creditprice'];
                                                            } else if ($paymenttype == 'insurance') {
                                                                $getinsured =  mysqli_query($con, "SELECT * FROM insuredradiotypes WHERE status=1 AND investigationtype_id='$service' AND insurancecompany_id='$insurancecompany'");
                                                                if (mysqli_num_rows($getinsured) > 0) {
                                                                    $insurance =  mysqli_fetch_array($getinsured);
                                                                    $charge = $insurance['charge'];
                                                                }
                                                            }
                                                            if (empty($charge)) {
                                                                $cashfallbacks[$service] = $row1['unitprice'];
                                                            } else {
                                                                $lbmeasures[$service] = $charge;
                                                            }
                                                        }
        
                                                        if (!empty($cashfallbacks)) {
                                                            mysqli_query($con, "INSERT INTO radioorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'cash',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($cashfallbacks);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'radiography', $last_id, $total_amount, 'cash');
                                                            foreach ($cashfallbacks as $service => $charge) {
                                                                $charge = intval($charge);
                                                                mysqli_query($con, "INSERT INTO patientradios(radioorder_id,radioinvestigationtype_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                            }
                                                        }
                                                        if (!empty($lbmeasures)) {
                                                            mysqli_query($con, "INSERT INTO radioorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymenttype',0,'reception',0,0)") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            $total_amount = array_sum($lbmeasures);
                                                            create_bill($pdo, $patient_id, $admission_id, $new_patientsque_id, 'radiography', $last_id, $total_amount, $paymenttype);
                                                            foreach ($lbmeasures as $service => $charge) {
                                                                mysqli_query($con, "INSERT INTO patientradios(radioorder_id,radioinvestigationtype_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con));
                                                            }
                                                        }
                                                    }
                                                    if(!empty($reference_obj['drug'])){
                                                        $drug = $reference_obj['drug'];
                                                        $totalbill=0;
                                                        $prescription = $reference_obj['prescription'];
                                                        $dosage= $reference_obj['dosage']; 
                                                        $allprescriptions = sizeof($drug);
                                                        mysqli_query($con, "INSERT INTO pharmacyorders(patientsque_id,admin_id,timestamp,payment,insurer,percentage,source,status) VALUES('$new_patientsque_id','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymenttype',0,'doctor',0)") or die(mysqli_error($con));
                                                        $last_id = mysqli_insert_id($con);
                                                        for ($i = 0; $i < $allprescriptions; $i++) {
                                                            // create pharmacy order
                                                            $getmedicalcharge = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$drug[$i]'");
                                                            $row1 = mysqli_fetch_array($getmedicalcharge);
                                                            $charge = $row1['unitprice'];
                                                            $totalbill += intval($charge)* intval($dosage[$i]);  
                                                            mysqli_query($con, "INSERT INTO pharmacyordereditems(item_id,pharmacyorder_id,prescription,quantity,status) VALUES('$drug[$i]','$last_id','$prescription[$i]','$dosage[$i]',1)") or die(mysqli_error($con));                                                          
                                                            
                                                        }
                                                        create_bill($pdo,$patient_id,$admission_id,$new_patientsque_id,'pharmacy',$last_id,$totalbill,$paymenttype);
                                                    }
                                                    
                                                    
        
                                                    mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                    if ($reference == 'admission'){                                                       
                                                        $ward= $reference_obj['ward'];
                                                        $days= $reference_obj['days'];
                                                        $bed_id = explode("_", $ward)[1];
                                                        $ward_id = explode("_", $ward)[0]; 
                                                        $check = mysqli_query($con, "SELECT * FROM admitted WHERE admission_id='$admission_id' AND status=1");
                                                        if (mysqli_num_rows($check) > 0) {
                                                            $errors[] = 'Patient Already Admitted';
                                                        }
                                                        if (!empty($errors)) {
                                                            foreach ($errors as $error) {
                                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                                            }
                                                            exit();
                                                        } else {
                                                            $getward =  mysqli_query($con, "SELECT * FROM wards WHERE status=1 AND ward_id='$ward_id'");
                                                            $row12 = mysqli_fetch_array($getward);
                                                            $bedfee = $row12['bedfee'];
                                                            if ($days != ""){
                                                                $price = $bedfee * $days;
                                                            }else{
                                                                $price = $bedfee;
                                                            }
                                                            mysqli_query($con, "INSERT INTO admitted(admission_id,bed_id,price,admissiondate,dischargedate,admin_id,status) VALUES('$admission_id','$bed_id','$price','$timenow',0,'" . $_SESSION['elcthospitaladmin'] . "','1')") or die(mysqli_error($con));
                                                            $last_id = mysqli_insert_id($con);
                                                            mysqli_query($con, "UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                                            create_bill($pdo,$patient_id,$admission_id,$id,'admission',$last_id,$price,$paymenttype);
                                                            $_SESSION['success'] = '<div class="alert alert-success">Patient Successfully Admitted.Click Here to <a href="admitted">View</a> Admissions</div>';
                                                                // redirect to doctorwaiting
                                                                echo '<script>window.location.href = "doctorwaiting";</script>';
                                                        }                                                      
                                                    }
                                                    elseif ($reference == 'pharmacy') {
                                                        if (isset($reference_obj['drug'], $reference_obj['prescription'])) {
                                                            $drug = $reference_obj['drug'];
                                                            $dosage= $reference_obj['dosage'];
                                                            $prescription = $reference_obj['prescription'];
                                                            $allprescriptions = sizeof($prescription);
                                                            for ($i = 0; $i < $allprescriptions; $i++) {
                                                                mysqli_query($con, "INSERT INTO doctorreports(drug,dosage,prescription,labmeasure,radiomeasure,patientsque_id,details,complaint, physical_exam, systematic_exam, provisional_diagnosis, final_diagnosis, status) VALUES('$drug[$i]','$dosage[$i]','$prescription[$i]','','','$id','$details','$complaint','$physical_exam','$systematic_exam','$provisional_diagnosis','$final_diagnosis','1')") or die(mysqli_error($con));
                                                            }
                                                        }
                                                    } else if ($reference == 'lab') {
                                                        if (isset($labmeasures)) {
                                                            $measure = $labmeasures;
                                                            $allprescriptions = sizeof($measure);
                                                            for ($i = 0; $i < $allprescriptions; $i++) {
                                                                mysqli_query($con, "INSERT INTO doctorreports(drug,dosage,prescription,labmeasure,radiomeasure,patientsque_id,details,complaint, physical_exam, systematic_exam, provisional_diagnosis, final_diagnosis, status) VALUES('','','','$measure[$i]','','$id','$details','$complaint','$physical_exam','$systematic_exam','$provisional_diagnosis','$final_diagnosis','1')") or die(mysqli_error($con));
                                                            }
                                                        }
                                                    } elseif ($reference == 'radiography') {
                                                        if (isset($radiomeasures)) {
                                                            $measure = $radiomeasures;
                                                            $allprescriptions = sizeof($measure);
                                                            for ($i = 0; $i < $allprescriptions; $i++) {
                                                                mysqli_query($con, "INSERT INTO doctorreports(drug,dosage,prescription,labmeasure,radiomeasure,patientsque_id,details,complaint, physical_exam, systematic_exam, provisional_diagnosis, final_diagnosis, status) VALUES('','','','','$measure[$i]','$id','$details','$complaint','$physical_exam','$systematic_exam','$provisional_diagnosis','$final_diagnosis','1')") or die(mysqli_error($con));
                                                            }
                                                        }
                                                    } else {
                                                        mysqli_query($con, "INSERT INTO doctorreports(drug,dosage,prescription,labmeasure,radiomeasure,patientsque_id,details,complaint, physical_exam, systematic_exam, provisional_diagnosis, final_diagnosis, status) VALUES('','','','','','$id','$details','$complaint','$physical_exam','$systematic_exam','$provisional_diagnosis','$final_diagnosis','1')") or die(mysqli_error($con));
                                                    }
                                                }
                                            }
                                            // redirect to doctorwaiting 
                                                // set alert message to session message 
                                                $_SESSION['success'] = '<div class="alert alert-success">Patient Report Successfully Added</div>';
                                                // redirect to doctorwaiting
                                                echo '<script>window.location.href = "doctorwaiting.php";</script>';
                                                
                                    }
                                ?>
                                
                                <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                    <div class="tab-content mt-3" id="nextref">
                                        <div class="tab-pane active" id="diagnosis" role="tabpanel">
                                            <div class="form-group"><label class="control-label">Main complains</label>
                                                <textarea class="ckeditor" cols="70" id="complaint" rows="8" name="complaint"></textarea>
                                            </div>
                                            <div class="form-group"><label class="control-label">Physical Examination</label>
                                                <textarea class="ckeditor" cols="70" id="physical_exam" rows="8" name="physical_exam"></textarea>
                                            </div>
                                            <div class="form-group"><label class="control-label">Systematic Examination</label>
                                                <textarea class="ckeditor" cols="70" id="systematic_exam" rows="8" name="systematic_exam"></textarea>
                                            </div>
                                            <div class="form-group"><label class="control-label">Provisional Diagnosis</label>
                                                <select name="provisional_diagnosis[]" id="provisional_diagnosis" class="form-control select2 multi-select" multiple>
                                                    <option value="">Select Disease</option>

                                                    <?php
                                                    $getmedicalservices =  mysqli_query($con, "SELECT * FROM diseases WHERE status=1");
                                                    while ($row11 =  mysqli_fetch_array($getmedicalservices)) {
                                                        $disease_id = $row11['disease_id'];
                                                        $codename = $row11['codename'];
                                                        $codenumber = $row11['codenumber'];
                                                    ?>
                                                        <option value="<?php echo $disease_id; ?>"><?php echo $codename . ' (' . $codenumber . ')'; ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group"><label class="control-label">Final Diagnosis</label>
                                                <select name="final_diagnosis[]" id="final_diagnosis" class="form-control select2 multi-select" multiple>
                                                    <option value="">Select Disease</option>


                                                    <?php
                                                    $getmedicalservices =  mysqli_query($con, "SELECT * FROM diseases WHERE status=1");
                                                    while ($row11 =  mysqli_fetch_array($getmedicalservices)) {
                                                        $disease_id = $row11['disease_id'];
                                                        $codename = $row11['codename'];
                                                        $codenumber = $row11['codenumber'];
                                                    ?>
                                                        <option value="<?php echo $disease_id; ?>"><?php echo $codename . ' (' . $codenumber . ')'; ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="tab-pane nref" id="nurse" role="tabpanel" aria-labelledby="nurse-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="nurse" data-ref="nurse" id="send-nurse">
                                                <label class="form-check-label" for="send-nurse">
                                                    Send to nurse
                                                </label>
                                            </div>

                                            <div class="form-group notmedic" style="display: none;">
                                                <label class="control-label">Section</label>
                                                <select name="ref[nurse][section][]" class="sections form-control">
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
                                                <select name="ref[nurse][servicename]" class="form-control servicename msnr multi-select_1">
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
                                                            $charge = $row1['charge'];
                                                        ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label" style="font-size:14px">
                                                                        <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="ref[nurse][medicalservices][]"><?php echo $medicalservice; ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- <div class="form-group fornurse" style="display: none">
                                                <label>Select Nurse</label>
                                                <select class="form-control room" name="ref[nurse][nurse]">
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
                                            </div> -->
                                            <div class="form-group fornurse" style="display: none;">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[nurse][details]"></textarea>
                                            </div>
                                        </div>

                                        <div class="tab-pane nref" id="pharmacy" role="tabpanel" aria-labelledby="pharmacy-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="pharmacy" data-ref="pharmacy" id="send-pharmacy">
                                                <label class="form-check-label" for="send-pharmacy">
                                                    Send to pharmacy
                                                </label>
                                            </div>


                                            <div class="pharmacy" style="display: none;">
                                                <div class="col-lg-12">
                                                    <h4>Recommended Drugs</h4>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class='subobj1'>
                                                        <div class='row'>
                                                            <div class="form-group col-lg-6">
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
                                                            <div class="form-group col-lg-3">
                                                                <label>Prescription</label>
                                                                <input type="text" name="ref[pharmacy][prescription][]" class="form-control " placeholder="Enter prescription">
                                                            </div>
                                                            <div class="form-group col-lg-3">
                                                                <label>Dosage</label>
                                                                <input type="text" name="ref[pharmacy][dosage][]" class="form-control " placeholder="Enter dosage">
                                                            </div>
                                                            <div class="form-group col-lg-1">
                                                                <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group pharmacy" style="display: none;">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[pharmacy][details]"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane nref" id="patron" role="tabpanel" aria-labelledby="patron-tab">

                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="patron" data-ref="patron" id="send-patron">
                                                <label class="form-check-label" for="send-patron">
                                                    Send to patron/matron
                                                </label>
                                            </div>

                                            <div class="form-group notmedic" style="display: none;">
                                                <label class="control-label">Section</label>
                                                <select name="ref[patron][section][]" class="sections form-control">
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
                                                <select name="ref[patron][servicename]" class="form-control servicename msnr multi-select_1">
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
                                                            $charge = $row1['charge'];
                                                        ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label" style="font-size:14px">
                                                                        <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="ref[patron][medicalservices][]"><?php echo $medicalservice; ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- <div class="form-group forpatron" style="display: none">
                                                <label>Select Patron / Matron</label>
                                                <select class="form-control room" name="ref[patron][patron]">
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
                                            </div> -->
                                            <div class="form-group forpatron" style="display: none;">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[patron][details]"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane nref" id="lab" role="tabpanel" aria-labelledby="lab-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="lab" data-ref="lab" id="send-lab">
                                                <label class="form-check-label" for="send-lab">
                                                    Send to lab
                                                </label>
                                            </div>
                                            <div class="form-group forlab" style="display: none;">
                                                <label class="control-label">Measurement</label>
                                                <select name="ref[lab][labmeasure][]" id="mname" class="form-control select2 msnr multi-select_1" multiple>
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
                                            <!-- <div class="form-group forlab" style="display: none">
                                                <label>Select Technician</label>
                                                <select class="form-control room" name="ref[lab][technician]">
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
                                            </div> -->
                                            <div class="form-group forlab" style="display: none">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[lab][details]"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane nref" id="anesthesiology" role="tabpanel" aria-labelledby="anesthesiology-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="anesthesiology" data-ref="anesthesiology" id="send-anesthesiology">
                                                <label class="form-check-label" for="send-anesthesiology">
                                                    Send to anesthesiology
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane nref" id="admission" role="tabpanel" aria-labelledby="admission-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="admission" data-ref="admission" id="send-admission">
                                                <label class="form-check-label" for="send-admission">
                                                    Admit Patient 
                                                </label>
                                            </div>
                                            <div class="foradmission" style="display:none">                                            
                                                <div class="form-group">
                                                    <label class="control-label">Select Ward and Bed Number</label>
                                                    <select name="ref[admission][ward]" id="bedname" class="form-control">
                                                        <option value="" selected="">Select ward and Bed Number</option>
                                                   
                                                    <?php
                                                    $getwards =  mysqli_query($con, "SELECT * FROM wards WHERE status=1");
                                                    while ($row = mysqli_fetch_array($getwards)) {
                                                        $ward_id = $row['ward_id'];
                                                        $ward_name = $row['wardname'];
                                                    ?>
                                                            <?php
                                                            $getbeds =  mysqli_query($con, "SELECT * FROM beds WHERE status=1 AND ward_id='$ward_id'");
                                                            while ($row1 =  mysqli_fetch_array($getbeds)) {
                                                                $bed_id = $row1['bed_id'];
                                                                $bednumber = $row1['bedname'];
                                                                $checkbed = mysqli_query($con, "SELECT * FROM admitted WHERE bed_id='$bed_id' AND status=1");
                                                                if (mysqli_num_rows($checkbed) == 0) {
                                                            ?>
                                                                    <option value="<?php echo $ward_id ?>_<?php echo $bed_id ?>">Ward <?php echo $ward_name; ?> (<?php echo $bednumber; ?>)</option>
                                                            <?php }
                                                            } ?>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Number of Days </label>
                                                    <input type="text" class="form-control" name="ref[admission][days]" value=""/>

                                                </div>
                                            </div>
                                            
                                        </div> 
                                        <div class="tab-pane nref" id="radiography" role="tabpanel" aria-labelledby="radiography-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="radiography" data-ref="radiography" id="send-radiography">
                                                <label class="form-check-label" for="send-radiography">
                                                    Send to Radiology
                                                </label>
                                            </div>
                                            <!-- <div class="form-group forradiography" style="display: none">
                                                <label>Select Radiologist</label>
                                                <select class="form-control room" name="ref[radiography][radiographer]">
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
                                            </div> -->
                                            <div class="form-group forradiography" style="display: none;">
                                                <label class="control-label">Measurement</label>
                                                <select name="ref[radiography][radiomeasure][]" id="rmname" class="form-control select2 msnr multi-select_1" multiple>
                                                    <option value="">Select Measurement</option>


                                                    <?php
                                                    $getmedicalservices =  mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                                        $medicalservice_id = $row1['radioinvestigationtype_id'];
                                                        $medicalservice = $row1['investigationtype'];
                                                        $charge = $row1['charge'];
                                                    ?>
                                                        <option value="<?php echo $medicalservice_id; ?>"><?php echo $medicalservice; ?></option>

                                                    <?php } ?>
                                                </select>

                                            </div>
                                            <div class="form-group forradiography" style="display: none;">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[radiography][details]"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane nref" id="referral" role="tabpanel" aria-labelledby="referral-tab">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input reference" name="reference[]" type="checkbox" value="referral" data-ref="referral" id="send-referral">
                                                <label class="form-check-label" for="send-referral">
                                                    Send to Referral
                                                </label>
                                            </div>
                                            <div class="forreferral" style="display:none">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label">Date </label>
                                                        <input type="date" class="form-control" name="ref[referral][date]" value=""/>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label">Time </label>
                                                        <input type="time" class="form-control" name="ref[referral][time]" value=""/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label">HPI </label>
                                                        <input type="text" class="form-control" name="ref[referral][hpi]" value=""/>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label">ROS </label>
                                                        <input type="text" class="form-control" name="ref[referral][ros]" value=""/>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label">PMH </label>
                                                        <input type="text" class="form-control" name="ref[referral][pmh]" value=""/>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label">Diagnosis investigation </label>
                                                        <textarea type="text" class="form-control" name="ref[referral][dia]" value=""></textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label">Treatments </label>
                                                        <textarea type="text" class="form-control" name="ref[referral][treat]" value=""></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">* Reason for referral</label>
                                                    <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[referral][reason]"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group forradiography" style="display: none;">
                                                <label class="control-label">Measurement</label>
                                                <select name="ref[radiography][radiomeasure][]" id="rmname" class="form-control select2 msnr multi-select_1" multiple>
                                                    <option value="">Select Measurement</option>


                                                    <?php
                                                    $getmedicalservices =  mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                                        $medicalservice_id = $row1['radioinvestigationtype_id'];
                                                        $medicalservice = $row1['investigationtype'];
                                                        $charge = $row1['charge'];
                                                    ?>
                                                        <option value="<?php echo $medicalservice_id; ?>"><?php echo $medicalservice; ?></option>

                                                    <?php } ?>
                                                </select>

                                            </div>
                                            <div class="form-group forradiography" style="display: none;">
                                                <label class="control-label">* Details & Instructions</label>
                                                <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="ref[radiography][details]"></textarea>
                                            </div>
                                        </div>
                                       
                                        
                                         

                                    </div>

                                    <div class="form-group pull-left">
                                        <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                    </div>
                                    <div class="form-group pull-right">
                                        <button class="btn btn-primary" name="submit" type="submit">Proceed</button>
                                    </div>
                                </form>
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
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <!-- <script src="vendor/apexchart/apexchart.js"></script> -->
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->

    <!-- Datatable -->
    <script src="vendor/select2/js/select2.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>

    <script>
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

        $('#nextref').on('click', '.subobj1_button', function(e) { //on add input button click
            e.preventDefault();
            $(this).closest('.subobj1').append(`
                        <div class="row">
                            <div class="col-lg-12">
                                <hr style="border-top: dashed 1px #b7b9cc;">
                            </div>
                            <div class="col-lg-11">
                                <div class="row">  
                                    <div class="form-group col-lg-6">
                                        <label>Drug Name</label>     
                                        <select class="form-control room" name="ref[pharmacy][drug][]">  
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
            }

        });
    </script>
</body>

</html>