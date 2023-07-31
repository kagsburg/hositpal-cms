<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];
$pque=$_GET['que'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Patient Admission</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        .profile-tab .nav-item .nav-link {
            margin-right: 10px;
            font-size: 15px;
            padding: 0.5rem 0.8rem;
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
        if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
            include 'fr/admission.php';
        } else {
        ?>

            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Patient Admission</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="admitted">Admitted Patients</a></li>
                                <li class="breadcrumb-item active"><a href="#">View Details</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                              if (isset($_SESSION['success'])){
                                echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                                unset($_SESSION['success']);

                              }
                              ?>
                            <!-- <a href="admissionprint?id=<?php echo $id; ?>" class="btn btn-success mb-2 btn-xs">Print</a> -->
                            <?php
                            // status 2 is for discharged from ward
                            $getadmitted = mysqli_query($con, "SELECT * FROM admitted WHERE status IN (1,2) AND admitted_id='$id'");
                            $row = mysqli_fetch_array($getadmitted);
                            $admission_id = $row['admission_id'];
                            $admitted_id = $row['admitted_id'];
                            $bed_id = $row['bed_id'];
                            $price = $row['price'];
                            $status = $row['status'];
                            $admissiondate = $row['admissiondate'];
                            $dischargedate = $row['dischargedate'];
                            $admin_id = $row['admin_id'];
                            if (($_SESSION['elcthospitallevel'] == 'nurse') && ($status == 1)) {
                            ?>
                                <a href="addnursingsheet?id=<?php echo $id; ?>" class="btn btn-info mb-2 btn-xs">Add Medication</a>
                                <button data-toggle="modal" data-target="#medical<?php echo $id; ?>" class="btn btn-primary mb-2 btn-xs">Add Medical Case </button>
                                <!-- <button data-toggle="modal" data-target="#major<?php echo $id; ?>" class="btn btn-primary mb-2 btn-xs">Add Major Theater </button> -->
                                <!-- <a href="requestmedication?id=<?php echo $id; ?>" class="btn btn-warning mb-2 btn-xs">Request Medication</a> -->
                                <a href="addobservation?id=<?php echo $id; ?>" class="btn btn-warning mb-2 btn-xs">General Observation</a>
                            <?php } ?>
                            <?php 
                            if (($_SESSION['elcthospitallevel'] == 'doctor') && ($status == 1)) {
                            ?>
                            <a href="updatepatientreport?id=<?php echo $pque; ?>" class="btn btn-xs btn-info"> Patient Report </a>
                            <?php } ?>
                            <?php 
                            if ($status != 2){
                                ?>
                            <button data-toggle="modal" data-target="#discharge<?php echo $id; ?>" class="btn btn-success mb-2 btn-xs">Discharge Patient</button>
                            <?php }?>
                        </div>
                        <?php
                            if (isset($_POST['submitprogress'])){
                                $opdate = mysqli_real_escape_string($con,strtotime($_POST['opdate']));
                                $progress = mysqli_real_escape_string($con,trim($_POST['progress']));
                                $treatment =  mysqli_real_escape_string($con,trim($_POST['treatment']));
                                $diet =  mysqli_real_escape_string($con,trim($_POST['diet']));
                                $insert = mysqli_query($con, "INSERT INTO medicalcase (admitted_id, date, progress, treatment, diet,admin_id,status) VALUES ('$id', '$opdate', '$progress', '$treatment', '$diet','".$_SESSION['elcthospitaladmin']."',1)") or die(mysqli_error($con));
                                if ($insert) {
                                    $_SESSION['success'] = 'Patient Medical Case Report added successfully';
                                    echo '<script>window.location.href = "admission?id=' . $id . '";</script>';
                                }
                            }
                            $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id'");
                            $row1 = mysqli_fetch_array($getadmission);
                            $patient_id = $row1['patient_id'];
                            $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                            $row2 = mysqli_fetch_array($getpatient);
                            $firstname = $row2['firstname'];
                            // $headfirstname = $row2['headfirstname'];
                            $lastname = $row2['secondname'];
                            // $headlastname = $row2['headlastname'];
                            $age = $row2['dob'];
                            // $agecategory = $row2['agecategory'];
                            $gender = $row2['gender'];
                            // $referred = $row2['referred'];
                            // $province = $row2['province'];
                            $town = $row2['address'];
                            // $zone = $row2['zone'];
                            // $quarter = $row2['quarter'];
                            // $agegroup = $row2['agegroup'];
                            $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                            $rows = mysqli_fetch_array($getstaff);
                            $fullname = $rows['fullname'];
                            $getbed = mysqli_query($con, "SELECT * FROM beds WHERE bed_id='$bed_id' AND status=1") or die(mysqli_error($con));
                            $rowb = mysqli_fetch_array($getbed);
                            $ward_id = $rowb['ward_id'];
                            $bednumber = $rowb['bedname'];
                            $getward =  mysqli_query($con, "SELECT * FROM wards WHERE status=1 AND ward_id='$ward_id'");
                            $roww = mysqli_fetch_array($getward);
                            $wardname = $roww['wardname'];
                            if (strlen($patient_id) == 1) {
                                $pin = '0000' . $patient_id;
                            }
                            if (strlen($patient_id) == 2) {
                                $pin = '000' . $patient_id;
                            }
                            if (strlen($patient_id) == 3) {
                                $pin = '00' . $patient_id;
                            }
                            if (strlen($patient_id) == 4) {
                                $pin = '0' . $patient_id;
                            }
                            if (strlen($patient_id) >= 5) {
                                $pin = $patient_id;
                            }
                            // $getgroups = mysqli_query($con, "SELECT * FROM agegroups WHERE status=1 AND agegroup_id='$agegroup'") or die(mysqli_error($con));
                            // $row1 = mysqli_fetch_array($getgroups);
                            // $agegroup_id = $row1['agegroup_id'];
                            // $agegroup1 = $row1['agegroup'];
                            // $code1 = $row1['code'];
                        ?>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table  table-striped table-responsive-sm">
                                            <tbody>
                                                <tr>
                                                    <th>PIN</th>
                                                    <td>#<?php echo $pin; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Fullnames</th>
                                                    <td><?php echo $firstname . ' ' . $lastname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Age </th>
                                                    <td><?php 
                                                    if ($age == '') {
                                                        $age = '';
                                                    }else{
                                                    $dob = date('Y', $age);
                                                    $today = date('Y');
                                                    $age = $today - $dob;
                                                }
                                                    echo $age; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td><?php echo $gender; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Town</th>
                                                    <td><?php echo $town; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <th>Province</th>
                                                    <td><?php echo $province; ?></td>
                                                </tr> -->
                                                <!-- <tr>
                                                    <th>Age Group</th>
                                                    <td><?php echo $agegroup1 . ' (' . $code1 . ')'; ?></td>
                                                </tr> -->
                                                <tr>
                                                    <th>Admission Date</th>
                                                    <td><?php echo date('d/M/Y', $admissiondate); ?></td>
                                                </tr>
                                                <?php
                                                if ($status == 2) {
                                                ?>
                                                    <tr>
                                                        <th>Discharge Date</th>
                                                        <td><?php echo date('d/M/Y', $dischargedate); ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Ward</th>
                                                    <td><?php echo $wardname; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Bed Number</th>
                                                    <td><?php echo $bednumber; ?></td>
                                                </tr>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Progress Report</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#doctorsreport">
                                                <strong class="text-primary">
                                                    Doctor Reports
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#nursingsheets">
                                                <strong class="text-primary">
                                                    Nursing Sheets
                                                </strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#consumeditems">
                                                <strong class="text-primary">
                                                    Observation Sheets
                                                </strong>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane fade show active" id="doctorsreport" role="tabpanel">
                                            <!-- check if patient is scheduled for operation -->
                                            <?php
                                            if (isset($_POST['submitupdate'])) {
                                                $operation_id = $_POST['operation_id'];
                                                $status = $_POST['status'];
                                                $update = mysqli_query($con, "UPDATE operations SET status='$status' WHERE operation_id='$operation_id'") or die(mysqli_error($con));
                                                if ($update) {
                                                    $_SESSION['success'] = 'Operation status updated successfully';
                                                    echo '<script>window.location.href = "admission?id=' . $id . '";</script>';
                                                }
                                            }
                                            $getoperation = mysqli_query($con, "SELECT * FROM operations WHERE  patient_id='$patient_id'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($getoperation) > 0) {
                                                $row = mysqli_fetch_array($getoperation);
                                                $operation_id = $row['operation_id'];
                                                $operationdate = $row['date'];
                                                $operationtime = $row['time'];
                                                $operationname = $row['anesthesiologist'];
                                                $operationadmin_id = $row['admin_id'];
                                                $status = $row['status'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$operationadmin_id'") or die(mysqli_error($con));
                                                $rows = mysqli_fetch_array($getstaff);
                                                $fullname = $rows['fullname'];
                                                $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$operationname'") or die(mysqli_error($con));
                                                $rows = mysqli_fetch_array($getstaff);
                                                $fullnam2e = $rows['fullname'];
                                            ?>
                                                <div class="table-responsive pt-4">
                                                    <h4><strong>OPERATION REPORT ON <?php echo  $operationdate; ?></strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>OPERATION TYPE</th> -->
                                                                <th>OPERATION NAME</th>
                                                                <!-- <th>OPERATION NOTES</th> -->
                                                                <th>OPERATION STATUS</th>
                                                                <th>OPERATION TIME</th>
                                                                <th>OPERATION DATE</th>
                                                                <th>OPERATION NURSE</th>
                                                                <th>OPERATION DOCTOR</th>
                                                                <?php 
                                                                 if($_SESSION['elcthospitaladmin']==$operationadmin_id){
                                                                ?>
                                                                <th>ACTION</th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <!-- <td><?php echo $operationtype; ?></td> -->
                                                                <td><?php echo $operationname; ?></td>
                                                                <!-- <td><?php echo $operationnotes; ?></td> -->
                                                                <td>
                                                                    <?php
                                                                    if ($status == 1) {
                                                                        echo '<span class="badge badge-primary">Booked</span>';
                                                                    }
                                                                    if ($status == 2) {
                                                                        echo '<span class="badge badge-success">Done</span>';
                                                                    }
                                                                    if ($status == 3) {
                                                                        echo '<span class="badge badge-danger">Cancelled</span>';
                                                                    }
                                                                    if ($status == 4) {
                                                                        echo '<span class="badge badge-warning">Review</span>';
                                                                    }
                                                                    
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $operationtime; ?></td>
                                                                <td><?php echo  $operationdate ?></td>
                                                                <td><?php echo $fullnam2e; ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                                <?php 
                                                                 if($_SESSION['elcthospitaladmin']==$operationadmin_id){
                                                                ?>
                                                                <td>
                                                                    <button data-toggle="modal" data-target="#modal<?php echo $operation_id; ?>" class="btn btn-success ">Update</button>
                                                                </td>
                                                                <div class="modal fade" id="modal<?php echo $operation_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Update Patient Operation status </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" name='form' class="form" action="" enctype="multipart/form-data" >
                                                                        <div class="form-group " >
                                                                            <input type="hidden" name="operation_id" value="<?php echo $operation_id; ?>" required>
                                                                            <label class="control-label">Operation Status</label>
                                                                            <select class="form-control" name="status" required>
                                                                                <option value="">Select Operation Status</option>
                                                                                <option value="1">Booked</option>
                                                                                <option value="2">Done</option>
                                                                                <option value="3">Cancelled</option>
                                                                            </select>
                                                                        </div>
                                                                    <div class="form-group pull-right"><button class="btn btn-primary" type="submit" name="submitupdate">Save</button>
                                                                        </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <?php } ?>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr>
                                            <?php } ?>

                                            <div class="table-responsive pt-4">
                                                <?php
                                                $getprogress = mysqli_query($con, "SELECT * FROM medicalcase WHERE admitted_id='$id'") or die(mysqli_error($con));
                                                if (mysqli_num_rows($getprogress) == 0) {
                                                    echo '<div class="alert alert-danger">No Progress Report Found</div>';
                                                }
                                                while ($row = mysqli_fetch_array($getprogress)) {
                                                    $date = $row['date'];
                                                    $progress_id = $row['progress'];
                                                    $treatment = $row['treatment'];
                                                    $diet = $row['diet'];
                                                    $admin_id = $row['admin_id'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                                                    $row= mysqli_fetch_array($getstaff);
                                                    $fullname = $row['fullname'];
                                                ?>
                                                    <h4><strong> REPORT ON <?php echo date('d/M/Y', $date); ?></strong></h4>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>DAY</th>
                                                                <th>PROGRESS</th>
                                                                <th>TREATMENT</th>
                                                                <th>DIET</th>
                                                                <th>ATTENDANT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo date('d/M/Y', $date); ?></td>
                                                                <td><?php echo $progress_id; ?></td>
                                                                <td><?php echo $treatment; ?></td>
                                                                <td><?php echo $diet; ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                            </tr>
                                                            
                                                            <!-- <?php
                                                            $getmedication = mysqli_query($con, "SELECT * FROM progressmedications WHERE progress_id='$progress_id'");
                                                            while ($row2 = mysqli_fetch_array($getmedication)) {
                                                                $drug = $row2['drug'];
                                                                $prescription = $row2['prescription'];
                                                                $getitem = mysqli_query($con, "SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$drug'");
                                                                $row = mysqli_fetch_array($getitem);
                                                                $pharmacyitem_id = $row['pharmacyitem_id'];
                                                                $genericname = $row['genericname'];
                                                                $commercialname = $row['commercialname'];
                                                                $pharmaceuticalform_id = $row['pharmaceuticalform_id'];
                                                                $getcats =  mysqli_query($con, "SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                                                                $row1 =  mysqli_fetch_array($getcats);
                                                                $pharmaceuticalform = $row1['pharmaceuticalform'];
                                                            ?>
                                                                <tr>
                                                                    <td colspan="3"><?php echo $commercialname . ' (' . $pharmaceuticalform . ')' ?></td>
                                                                    <td colspan="3"><?php echo $prescription; ?></td>
                                                                </tr>
                                                            <?php } ?> -->
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nursingsheets" role="tabpanel">
                                            <div class="table-responsive pt-4">
                                                <?php
                                                $getnursingsheets = mysqli_query($con, "SELECT * FROM nursingsheets WHERE admitted_id='$id' AND status=1 ORDER BY date") or die(mysqli_error($con));
                                                if (mysqli_num_rows($getnursingsheets) == 0) {
                                                    echo '<div class="alert alert-danger">No Nursing Sheet Found</div>';
                                                }
                                                while ($row = mysqli_fetch_array($getnursingsheets)) {
                                                    $date = $row['date'];
                                                    $time = $row['time'];
                                                    $nursingsheet_id = $row['nursingsheet_id'];
                                                    $admin_id = $row['admin_id'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];
                                                ?>

                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>NURSE</th>
                                                                <th>TIME</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo date('d/M/Y', $date); ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                                <td><?php echo $time; ?></td>
                                                            <tr>
                                                                <th colspan="3">MEDICATIONS</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Medication</th>
                                                                <th>Consumption</th>
                                                                <th>Root</th>
                                                            </tr>
                                                            <?php
                                                            $getnursingsheetmedications = mysqli_query($con, "SELECT * FROM nursingsheetmedications WHERE nursingsheet_id='$nursingsheet_id'");
                                                            while ($row2 = mysqli_fetch_array($getnursingsheetmedications)) {
                                                                $medication = $row2['medication'];
                                                                $consumption = $row2['consumption'];
                                                                $admissionroot = $row2['admissionroot'];
                                                                $getitem = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$medication' ");
                                                                $rowt = mysqli_fetch_array($getitem);
                                                                $inventoryitem_id = $rowt['inventoryitem_id'];
                                                                $itemname = $rowt['itemname'];
                                                                $measurement_id = $rowt['measurement_id'];
                                                                $type = $rowt['type'];
                                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                                $row2 =  mysqli_fetch_array($getunit);
                                                                $measurement = $row2['measurement'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $itemname . ' (' . $measurement . ')'; ?></td>
                                                                    <td><?php echo $consumption; ?></td>
                                                                    <td><?php echo $admissionroot; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="consumeditems" role="tabpanel">
                                            <div class="table-responsive pt-4">
                                                <?php 
                                                 $getobservationsheets = mysqli_query($con, "SELECT * FROM observationsheets WHERE admitted_id='$id' AND status=1 ORDER BY date") or die(mysqli_error($con));
                                                if (mysqli_num_rows($getobservationsheets) == 0) {
                                                    echo '<div class="alert alert-danger">No Observation Sheet Found</div>';
                                                }
                                                while ($row = mysqli_fetch_array($getobservationsheets)) {
                                                    $date = $row['date'];
                                                    $time = $row['time'];
                                                    $observationsheet_id = $row['observation_id'];
                                                    $bp = $row['bp'];
                                                    $t = $row['t'];
                                                    $p = $row['p'];
                                                    $r = $row['r'];
                                                    $nature = $row['fluid'];
                                                    $oral= $row['oral'];
                                                    $iv = $row['iv'];
                                                    $total = $row['tot'];
                                                    $urine = $row['urine'];
                                                    $vomit = $row['vomit'];
                                                    $aspirate =$row['aspirate'];
                                                    $tot= $row['total2'];
                                                    $bal= $row['balance'];
                                                    $admin_id = $row['admin_id'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];
                                                
                                                ?>
                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>BP</th>
                                                                <th>T</th>
                                                                <th>P</th>
                                                                <th>R</th>
                                                                <th>NATURE</th>
                                                                <th>NURSE</th>
                                                                <th>TIME</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo  $date; ?></td>
                                                                <td><?php echo  $bp; ?></td>
                                                                <td><?php echo  $t; ?></td>
                                                                <td><?php echo  $p; ?></td>
                                                                <td><?php echo  $r; ?></td>
                                                                <td><?php echo  $nature; ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                                <td><?php echo $time; ?></td>
                                                            <tr>
                                                                <th colspan="3">IN Take & Body Loss</th>
                                                            </tr>
                                                            <tr >
                                                                <th>Oral</th>
                                                                <th>IV</th>
                                                                <th>URINE</th>
                                                                <th>VOMIT</th>
                                                                <th>ASPIRATE</th>
                                                                <th>TOTAL</th>
                                                                <th>BALANCE</th>

                                                            </tr>
                                                            <tr>
                                                                <td><?php echo $oral; ?></td>
                                                                <td><?php echo $iv; ?></td>
                                                                <td><?php echo $urine; ?></td>
                                                                <td><?php echo $vomit; ?></td>
                                                                <td><?php echo $aspirate; ?></td>
                                                                <td><?php echo $tot; ?></td>
                                                                <td><?php echo $bal; ?></td>
                                                            </tr>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>

                                            </div>
                                            <hr>
                                            <div class="table-responsive pt-4">
                                                <?php
                                                $getconsumed = mysqli_query($con, "SELECT * FROM consumed WHERE admitted_id='$id' AND status=1") or die(mysqli_error($con));
                                                if (mysqli_num_rows($getconsumed) == 0) {
                                                    echo '<div class="alert alert-danger">No Consumed Items Found</div>';
                                                }
                                                while ($row = mysqli_fetch_array($getconsumed)) {
                                                    $date = $row['date'];
                                                    $consumed_id = $row['consumed_id'];
                                                    $admin_id = $row['admin_id'];
                                                    $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                                                    $rows = mysqli_fetch_array($getstaff);
                                                    $fullname = $rows['fullname'];

                                                ?>

                                                    <table class="table  table-striped table-responsive-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>DATE</th>
                                                                <th>NURSE</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo date('d/M/Y', $date); ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                            <tr>
                                                                <th colspan="2">ITEMS CONSUMED</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                            <?php
                                                            $getitems = mysqli_query($con, "SELECT * FROM consumeditems WHERE consumed_id='$consumed_id'");
                                                            while ($row2 = mysqli_fetch_array($getitems)) {
                                                                $item = $row2['item'];
                                                                $quantity = $row2['quantity'];
                                                                $getitem = mysqli_query($con, "SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item' ");
                                                                $rowt = mysqli_fetch_array($getitem);
                                                                $commercialname = $rowt['commercialname'];
                                                                $pharmaceuticalform_id = $rowt['pharmaceuticalform_id'];
                                                                $getcats =  mysqli_query($con, "SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                                                                $rowf =  mysqli_fetch_array($getcats);
                                                                $pharmaceuticalform = $rowf['pharmaceuticalform'];

                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $commercialname . ' (' . $pharmaceuticalform . ')'; ?></td>
                                                                    <td><?php echo $quantity; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php 
                if (isset($_POST['submitdischarge'])){
                    $date =  mysqli_real_escape_string($con,strtotime($_POST['disdate']));  
                    $remarks = mysqli_real_escape_string($con,trim($_POST['remarks']));

                    $insert = mysqli_query($con, "INSERT INTO discharged (admitted_id, dischargedate, remarks,admin_id,timestamp,status) VALUES ('$id', '$date', '$remarks','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
                    if ($insert){
                        $update = mysqli_query($con, "UPDATE admitted SET status=2,dischargedate='$date' WHERE admission_id='$admission_id'") or die(mysqli_error($con));
                        $update2= mysqli_query($con, "UPDATE admissions set status=2,dischargedate'$date' where admission_id='$admission'") or die(mysqli_error($con));
                        // echo '<script>alert("Patient Discharged from ward successfully")</script>';
                        $_SESSION['success'] = "Patient Discharged from ward successfully";
                                    echo '<script>window.location.href = "admission?id=' . $id . '";</script>';
                    }

                }
            ?>
                                                           <div class="modal fade" id="medical<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Add Patient Medical Case  Report </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" name='form' class="form" action="" enctype="multipart/form-data" >
                                                                        <div class="form-group nref" >
                                                                            <label class="control-label"> Date</label>
                                                                            <input type="date" name="opdate" class="form-control" value="<?php echo date('Y-m-d',$timenow); ?>" required>
                                                                        </div>

                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Progress </label>
                                                                                <textarea name="progress" class="form-control" rows="5" required></textarea>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Treatment </label>
                                                                                <textarea name="treatment" class="form-control" rows="5" required></textarea>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Diet </label>
                                                                                <textarea name="diet" class="form-control" rows="5" required></textarea>
                                                                            </div>

                                                                            <div class="form-group pull-right"><button class="btn btn-primary" type="submit" name="submitprogress">Save</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
            
                                                            <div class="modal fade" id="discharge<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Discharge Patient  </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" name='form' class="form" action="" enctype="multipart/form-data" >
                                                                        <div class="form-group nref" >
                                                                            <label class="control-label"> Discharge Date</label>
                                                                            <input type="date" name="disdate" class="form-control" required value="<?php echo date('Y-m-d',$timenow);?>">
                                                                        </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Remarks </label>
                                                                                <textarea name="remarks" class="form-control" rows="5" required ></textarea>
                                                                            </div>
                                                                            <div class="form-group pull-right"><button class="btn btn-primary" type="submit" name="submitdischarge">Save</button>
                                                                                </div>
                                                                            </form>
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