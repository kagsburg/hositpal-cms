<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'lab technician')&& ($_SESSION['elcthospitallevel']!='lab technologist')) {
    header('Location:login.php');
}
$id = $_GET['id'];
$test = $_GET['test'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Lab Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

    <style>
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef;
        }
    </style>
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
                            <h4>Add Report</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="labwaiting">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Report</a></li>
                        </ol>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <?php
                    $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE patientsque_id='$id'");
                    $row = mysqli_fetch_array($getque);
                    $patientsque_id = $row['patientsque_id'];
                    $admission_id = $row['admission_id'];
                    $room = $row['room'];
                    $attendant = $row['attendant'];
                    $admin_id = $row['admin_id'];
                    $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
                    $row1 = mysqli_fetch_array($getadmission);
                    $patient_id = $row1['patient_id'];
                    $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                    $row2 = mysqli_fetch_array($getpatient);
                    $firstname = $row2['firstname'];
                    $secondname = $row2['secondname'];
                    $thirdname = $row2['thirdname'];
                    $gender = $row2['gender'];
                    $ext = $row2['ext'];
                    
                    $bloodgroup = $row2['bloodgroup'];
                    $dob = $row2['dob'];
                    $weight = $row2['weight'];
                    $height = ($row2['height'] != '') ? $row2['height'] : 'N/A';
                    $temp = ($row2['temp'] != '') ? $row2['temp'] : 'N/A';
                    $bp = ($row2['bp'] != '') ? $row2['bp'] : 'N/A';
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
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="col-lg-12">
                                            <h4>Tests</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class='subobj1'>
                                                <?php 
                                                $total = 0;
                                                    $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE  patientsque_id='$patientsque_id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        $serviceorder_id = $rowo['laborder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status in (3)") or die(mysqli_error($con));
                                                        $count = mysqli_num_rows($getordered);
                                                        $getorder2 = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status in (3) and investigationtype_id='$test'") or die(mysqli_error($con));
                                                            $row = mysqli_fetch_array($getorder2);
                                                            $medicalservice_id = $row['investigationtype_id'];
                                                            $patientlab_id = $row['patientlab_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];
                                                            $investigationtype_id=$row2['investigationtype_id'];
                                                            $unit_id = $row2['unit_id'];
                                                            $range = $row2['range_type'];
                                                            $has_answer = $row2['has_answers'];
                                                            $getreport= mysqli_query($con, "SELECT * FROM labreports WHERE status=1 and admission_id='$admission_id' and test='$test'") or die(mysqli_error($con));
                                                            $rowtitle = mysqli_fetch_array($getreport);
                                                            $medicalservice_id = $rowtitle['test'];
                                                            $labreport_id=$rowtitle['labreport_id'];
                                                            $result=$rowtitle['result'];
                                                            $title = $rowtitle['title'];
                                                            $unit_id=$rowtitle['siunit'];
                                                            $start= $rowtitle['start'];
                                                            $sample_id=$rowtitle['sample_id'];
                                                            $end= $rowtitle['end'];
                                                            $details=$rowtitle['details'];
                                                            $approve = $rowtitle['approved'];
                                                            $admin_id2 = $rowtitle['admin_id'];

                                                            $getunit =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit_id'");
                                                            if (mysqli_num_rows($getunit) == 0) {
                                                                $measurement = "N/A";
                                                            }else{
                
                                                                $row1 =  mysqli_fetch_array($getunit);
                                                                $measurement_id = $row1['measurement_id'];
                                                                $measurement = $row1['measurement'];
                                                            }
                                                            // check if investigation has subtype 
                                                            $getsubtype = mysqli_query($con, "SELECT * FROM investigationsubtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'"); 
                                                            if ((mysqli_num_rows($getsubtype) > 0) && ($range != 0)) {
                                                                ?>
                                                                <form method="post" action="savelabreport">
                                                                    <div class="row">
                                                                    <input type="hidden" name="has_answer" value="<?php echo $has_answer; ?>">
                                                                <input type="hidden" name="patientlab_id" value="<?php echo $patientlab_id; ?>">
                                                                <input type="hidden" name="investigationtype_id" value="<?php echo $investigationtype_id; ?>">
                                                                <input type="hidden" name="admission_id" value="<?php echo $admission_id; ?>">
                                                                <input type="hidden" name="patientque_id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="count" value="<?php echo $count; ?>">
                                                                <input type="hidden" name="labreport_id" value="<?php echo $labreport_id; ?>">

                                                                <div class="form-group col-lg-12">
                                                                    <label>Report Title </label>
                                                                    <input type="text" class="form-control " name="title[<?php echo $medicalservice_id; ?>]" placeholder="Enter Title" value="<?php echo $title; ?>" required/>
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <label>Sample ID </label>
                                                                    <input type="text" class="form-control " name="sample[<?php echo $medicalservice_id; ?>]" placeholder="Enter Sample Id" value="<?php echo $sample_id; ?>" >
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Start Time</label>
                                                                    <input type="time" name="start[<?php echo $medicalservice_id; ?>]" class="form-control " value="<?php echo $start; ?>" placeholder="Enter Start Time" required>
                                                                </div><div class="form-group col-lg-6">
                                                                    <label>End Time</label>
                                                                    <input type="time" name="end[<?php echo $medicalservice_id; ?>]" class="form-control "value="<?php echo $end; ?>" placeholder="Enter End Time" required>
                                                                </div>
                                                                    <?php
                                                                while ($row3 = mysqli_fetch_array($getsubtype)){
                                                                    $investigationsubtype_id = $row3['investigationsubtype_id'];
                                                                    $subtype = $row3['subtype'];
                                                                    $unit = $row3['unit_id'];
                                                                    $getlabreportsubtype = mysqli_query($con, "SELECT * FROM labreportsubtype WHERE labreport_id='$labreport_id' and subtype_id='$investigationsubtype_id'");
                                                                    $getunit2 =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit'");
                                                                        if (mysqli_num_rows($getunit2) == 0) {
                                                                            $measurement = "N/A";
                                                                        }else{                            
                                                                            $row21 =  mysqli_fetch_array($getunit2);
                                                                            $measurement_id = $row21['measurement_id'];
                                                                            $measurement = $row21['measurement'];
                                                                        }
                                                                        $row22 =  mysqli_fetch_array($getlabreportsubtype);
                                                                            $results = $row22['results'];
                                                                            $labrep = $row22['labsubtype_id'];
                                                                    ?>
                                                                    <input type="hidden" name="subtype[]" value="<?php echo $investigationsubtype_id; ?>">
                                                                    <input type="hidden" name="labrep[]" value="<?php echo $labrep; ?>">
                                                                    <div class="form-group col-lg-6">
                                                                    <label>Test </label>
                                                                    <input type="hidden" name="test[<?php echo $labrep; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $subtype; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>SI Unit </label>
                                                                    <input type="hidden" name="unit[<?php echo $labrep; ?>]" placeholder="Enter test" value="<?php echo $measurement_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $measurement; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-3">
                                                                    <label>Result</label>
                                                                    <input type="number" step="0.0001" value="<?php echo $results ?>"  name="result[<?php echo $labrep; ?>]" class="form-control " placeholder="Enter result" >
                                                                </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="form-group"><label class="control-label">* More Details if any</label>
                                                                        <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details">
                                                                        <?php echo $details; ?>
                                                                        </textarea>
                                                                    </div>
                                                                    </div>
                                                                    <div class="form-group pull-right">
                                                                <button class="btn btn-primary" type="submit" name="submitspecialupdate">Submit</button>
                                                            </div>
                                                                </form>

                                                                <?php
                                                            }
                                                            if ($range != 0 && (mysqli_num_rows($getsubtype) == 0)){
                                                            ?>
                                                            <form method="post" action="savelabreport">
                                                            <div class='row'>
                                                            <input type="hidden" name="has_answer" value="<?php echo $has_answer; ?>">
                                                                <input type="hidden" name="patientlab_id" value="<?php echo $patientlab_id; ?>">
                                                                <input type="hidden" name="investigationtype_id" value="<?php echo $investigationtype_id; ?>">
                                                                <input type="hidden" name="admission_id" value="<?php echo $admission_id; ?>">
                                                                <input type="hidden" name="patientque_id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="count" value="<?php echo $count; ?>">
                                                                <input type="hidden" name="labreport_id" value="<?php echo $labreport_id; ?>">
                                                                <div class="form-group col-lg-12">
                                                                    <label>Report Title </label>
                                                                    <input type="text" class="form-control " name="title[<?php echo $medicalservice_id; ?>]" placeholder="Enter Title" value="<?php echo $title; ?>" required/>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Sample ID </label>
                                                                    <input type="text" class="form-control " name="sample[<?php echo $medicalservice_id; ?>]" placeholder="Enter Sample Id" value="<?php echo $sample_id; ?>" >
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test </label>
                                                                    <input type="hidden" name="test[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>SI Unit </label>
                                                                    <input type="hidden" name="unit[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $measurement_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $measurement; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-5">
                                                                    <label>Start Time</label>
                                                                    <input type="time" value="<?php echo $start; ?>" name="start[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter Start Time" required>
                                                                </div><div class="form-group col-lg-5">
                                                                    <label>End Time</label>
                                                                    <input type="time" value="<?php echo $end; ?>" name="end[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter End Time" required>
                                                                </div>
                                                                <div class="form-group col-lg-5">
                                                                    <label>Result</label>
                                                                    <input type="number" value="<?php echo $result; ?>" name="result[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter result" required>
                                                                </div>
                                                                <div class="form-group"><label class="control-label">* More Details if any</label>
                                                                        <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details">
                                                                        <?php echo $details; ?>
                                                                        </textarea>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group pull-right">
                                                                <button class="btn btn-primary" type="submit" name="updatelabreport">Submit</button>
                                                            </div>
                                                            </form>
                                                        <?php 
                                                            }
                                                            else if ($range == 0 && $has_answer==0){
                                                                ?>
                                                                <hr/>
                                                                <form class="form mb-3" method="post" action="savelabreport">
                                                                <input type="hidden" name="has_answer" value="<?php echo $has_answer; ?>">
                                                                <input type="hidden" name="patientlab_id" value="<?php echo $patientlab_id; ?>">
                                                                <input type="hidden" name="investigationtype_id" value="<?php echo $investigationtype_id; ?>">
                                                                <input type="hidden" name="admission_id" value="<?php echo $admission_id; ?>">
                                                                <input type="hidden" name="patientque_id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="count" value="<?php echo $count; ?>">
                                                                <input type="hidden" name="labreport_id" value="<?php echo $labreport_id; ?>">


                                                                <div class="form-group col-lg-12">
                                                                    <label>Report Title </label>
                                                                    <input type="text" class="form-control " name="title[<?php echo $medicalservice_id; ?>]" placeholder="Enter Title" value="<?php echo $title; ?>" required />
                                                                </div>
                                                            <div class='row'>
                                                            <div class="form-group col-lg-6">
                                                                    <label>Sample ID </label>
                                                                    <input type="text" class="form-control " name="sample[<?php echo $medicalservice_id; ?>]" placeholder="Enter Sample Id" value="<?php echo $sample_id; ?>" >
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test </label>
                                                                    <input type="hidden" name="test[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>SI Unit </label>
                                                                    <input type="hidden" name="unit[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $measurement_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $measurement; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Start Time</label>
                                                                    <input type="time" value="<?php echo $start; ?>" name="start[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter Start Time" required>
                                                                </div><div class="form-group col-lg-5">
                                                                    <label>End Time</label>
                                                                    <input type="time" value="<?php echo $end; ?>" name="end[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter End Time" required>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Result</label>
                                                                    <input type="text" value="<?php echo $result; ?>" name="result[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter result" required>
                                                                </div>
                                                                <div class="form-group"><label class="control-label">* More Details if any</label>
                                                                        <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details">
                                                                        <?php echo $details; ?>
                                                                        </textarea>
                                                                    </div>

                                                            </div>
                                                            <div class="form-group pull-right">
                                                                <button class="btn btn-primary" type="submit" name="updatelabreport">Submit</button>
                                                            </div>
                                                            </form>
                                                                <?php
                                                            } else if ($range == 0 && $has_answer==1){
                                                                ?>
                                                                <hr/>
                                                                 <form class="form" method="post" action="savelabreport">
                                                            <div class='row'>
                                                                <input type="hidden" name="has_answer" value="<?php echo $has_answer; ?>">
                                                                <input type="hidden" name="patientlab_id" value="<?php echo $patientlab_id; ?>">
                                                                <input type="hidden" name="investigationtype_id" value="<?php echo $investigationtype_id; ?>">
                                                                <input type="hidden" name="admission_id" value="<?php echo $admission_id; ?>">
                                                                <input type="hidden" name="patientque_id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="labreport_id" value="<?php echo $labreport_id; ?>">
                                                                <input type="hidden" name="count" value="<?php echo $count; ?>">
                                                                <div class="form-group col-lg-12">
                                                                    <label>Report Title </label>
                                                                    <input type="text" class="form-control " name="title[<?php echo $medicalservice_id; ?>]" placeholder="Enter Title" value="<?php echo $title; ?>" required />
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Sample ID </label>
                                                                    <input type="text" class="form-control " name="sample[<?php echo $medicalservice_id; ?>]" placeholder="Enter Sample Id" value="<?php echo $sample_id; ?>" >
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test </label>
                                                                    <input type="hidden" name="test[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>  
                                                                <div class="form-group col-lg-6">
                                                                    <label>SI Unit </label>
                                                                    <input type="hidden" name="unit[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $measurement_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="NIL" value="<?php echo $measurement; ?>" disabled>
                                                                </div>                                                              
                                                                <div class="form-group col-lg-6">
                                                                    <label>Start Time</label>
                                                                    <input type="time" value="<?php echo $start; ?>" name="start[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter Start Time" required>
                                                                </div><div class="form-group col-lg-6">
                                                                    <label>End Time</label>
                                                                    <input type="time" value="<?php echo $end; ?>" name="end[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter End Time" required>
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <label>Result</label>
                                                                    <select name="result[<?php echo $medicalservice_id; ?>]" class="form-control">
                                                                        <option value="0" selected>Select Result</option>
                                                                    <?php 
                                                                      $getanwers = mysqli_query($con, "SELECT * FROM investigationselect where investigationtype_id = '$investigationtype_id'") or die(mysqli_error($con));
                                                                      while ($row22= mysqli_fetch_array($getanwers)){
                                                                        ?>
                                                                        <option value="<?php echo $row22['investigationselect_id']; ?>" <?php if ($result == $row22['investigationselect_id']){ ?> selected <?php }?>><?php echo $row22['answer']; ?></option>                                                                                        
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group"><label class="control-label">* More Details if any</label>
                                                                        <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details">
                                                                        <?php echo $details; ?>
                                                                        </textarea>
                                                                    </div>

                                                            </div>
                                                            <div class="form-group pull-right">
                                                                <button class="btn btn-primary" type="submit" name="updatelabreport">Submit</button>
                                                            </div>
                                                            <!-- </form> -->
                                                                    <?php
                                                            }
                                                        
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>

                                        
                                        <div class="form-group pull-left">
                                            <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                        </div>
                                       
                                    </form>
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
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Test Done</label>    <input type="text"  name="test[]" class="form-control " placeholder="Enter test"></div>  <div class="form-group col-lg-6"> <label>Result</label>   <input type="text"  name="result[]" class="form-control " placeholder="Enter Result"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    </script>
</body>

</html>
