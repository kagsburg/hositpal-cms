<?php
include 'includes/conn.php';
include 'utils/patients.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Patient Information</title>
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
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Patient Information</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patients">Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">View Patient</a></li>
                        </ol>
                    </div>
                    <?php 
                        if (isset($_POST['submittriage'])){
                            $blood2 = mysqli_real_escape_string($con, trim($_POST['blood']));
                            $weight2 = mysqli_real_escape_string($con, trim($_POST['weight']));
                            $height2 = mysqli_real_escape_string($con, trim($_POST['height']));
                            $allergies2 = mysqli_real_escape_string($con, trim($_POST['alleg']));
                            $diseases2 = mysqli_real_escape_string($con, trim($_POST['disease']));
                            $pregnancies2 = mysqli_real_escape_string($con, trim($_POST['pregan']));
                            $temp = mysqli_real_escape_string($con,trim($_POST['temp']));
                            $bp = mysqli_real_escape_string($con,trim($_POST['bp']));
                            $id = mysqli_real_escape_string($con, trim($_POST['id']));
                            mysqli_query($con, "UPDATE patients SET bloodgroup='$blood2',weight='$weight2',temp='$temp',bp='$bp',height='$height2',allergies='$allergies2',diseases='$diseases2',pregnancies='$pregnancies2'WHERE patient_id='" . $id . "'") or die(mysqli_error($con));
                            echo '<div class="alert alert-success"> Patient Triage Deatails Updated Successfully</div>';

                        }
                    ?>
                </div>
                <div class="row">
                    <?php
                    $getpatients = mysqli_query($con, "SELECT * FROM patients WHERE status IN ('1', '3') AND patient_id='$id'");
                    $row = mysqli_fetch_array($getpatients);
                    $status = $row['status'];
                    $patient_id = $row['patient_id'];
                    $firstname = $row['firstname'];
                    $secondname = $row['secondname'];
                    $thirdname = $row['thirdname'];
                    $gender = $row['gender'];
                    $dob = $row['dob'];
                    $maritalstatus = $row['maritalstatus'];
                    $spousename = $row['spousename'];
                    $spouseaddress = $row['spouseaddress'];
                    $spousephone = $row['spousephone'];
                    $religion = $row['religion'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $occupation = $row['occupation'];
                    $email = $row['email'];
                    $ext = $row['ext'];
                    $employmentstatus = $row['employmentstatus'];
                    $employername = $row['employername'];
                    $employeraddress = $row['employeraddress'];
                    $employernumber = $row['employernumber'];
                    $emergencyname = $row['emergencyname'];
                    $emergencyphone = $row['emergencyphone'];
                    $emergencyrelationship = $row['emergencyrelationship'];
                    $emergencyaddress = $row['emergencyaddress'];
                    $insurancecompany = $row['insurancecompany'];
                    $subscribername = $row['subscribername'];
                    $socialsecuritynumber = $row['socialsecuritynumber'];
                    $policyidnumber = $row['policyidnumber'];
                    $insurancedob = $row['insurancedob'];
                    $insuranceemployer = $row['insuranceemployer'];
                    $bloodgroup = $row['bloodgroup'];
                    $weight = $row['weight'];
                    $height = $row['height'];
                    $allergies = $row['allergies'];
                    $diseases = $row['diseases'];
                    $pregnancies = $row['pregnancies'];
                    $temp = $row['temp'];
                    $bp = $row['bp'];
                    $smoke = $row['smoke'];
                    $drink = $row['drink'];
                    $exercise = $row['exercise'];
                    $specialdiet = $row['specialdiet'];
                    $druguse = $row['druguse'];
                    $drugtypes = $row['drugtypes'];
                    $activities = $row['activities'];
                    $subscribername = $row['subscribername'];
                    $socialsecuritynumber = $row['socialsecuritynumber'];
                    $policyidnumber = $row['policyidnumber'];
                    $insurancedob = $row['insurancedob'];
                    $insuranceemployer = $row['insuranceemployer'];
                    $insurancecardext = $row['insurancecardext'];
                    $secondarysubscribername = $row['secondarysubscribername'];
                    $patientrelation = $row['patientrelation'];
                    $workphone = $row['workphone'];
                    $level = $row['level'];
                    $docext = $row['docext'];
                    $paymenttype = get_payment_method($pdo, $patient_id);
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

                    if (!empty($ext))
                        $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                    else
                        $pimage = "noimage.png";

                    if (!empty($insurancecompany)) {
                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurancecompany'");
                        $row1 =  mysqli_fetch_array($getcompanies);
                        $insurancecompany_id = $row1['insurancecompany_id'];
                        $company = $row1['company'];
                        $companyname = $company;
                    } else {
                        $companyname = 'None';
                    }
                    ?>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">

                                <div class="profile-blog mb-5">
                                    <img src="images/patients/thumbs/<?php echo $pimage; ?>" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></h4>
                                    <p>#<?php echo $pin; ?></p>
                                    <?php if ($status == '1') { ?>
                                        <?php if ($level == 4 && $_SESSION['elcthospitallevel'] == 'receptionist') { ?>
                                            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#completeRegistrationModal">
                                                Send to Nurse for Triage
                                            </button>
                                        <?php } else if ($level == 2) { ?>
                                            <?php if (is_admitted($pdo, $patient_id)) { ?>
                                                <p><span class="badge badge-secondary">Admitted</span></p>
                                            <?php } else if ($_SESSION['elcthospitallevel'] == 'receptionist') { ?>
                                                <p><a href="admitpatient?id=<?php echo $patient_id; ?>" class="btn btn-xs btn-info btn-block">Attend</a></p>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else if ($status == '3') { ?>
                                        <p><span class="badge badge-danger">Pending Registration</span></p>
                                    <?php } ?>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#basic" data-toggle="tab" class="nav-link show active">Basic Info</a>
                                            </li>
                                            <li class="nav-item"><a href="#emergency" data-toggle="tab" class="nav-link">Emergency Contact</a>
                                            </li>
                                            <li class="nav-item"><a href="#medical" data-toggle="tab" class="nav-link">Medical Info</a>
                                            </li>
                                            <!-- <li class="nav-item"><a href="#social" data-toggle="tab" class="nav-link">Social Info</a>
                                            </li> -->
                                            <?php if (($_SESSION['elcthospitallevel'] == 'insurance officer')) { ?>
                                                <li class="nav-item"><a href="#insurance" data-toggle="tab" class="nav-link">Insurance info</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="basic" class="tab-pane fade active show">
                                                <div class="my-post-content pt-3">
                                                    <h4 class="text-primary mb-4 mt-4">Personal Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Fullnames<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Gender<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $gender; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">DOB<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if (!empty($dob)) {
                                                                                                    echo date('d M Y', strtotime($dob));
                                                                                                } else {
                                                                                                    echo 'N/A';
                                                                                                } ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Phone<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $phone; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Address<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $address; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Occupation<span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $occupation; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="emergency" class="tab-pane fade">

                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4 mt-4">Emergency Contact</h4>
                                                    <?php /*
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Status <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $employmentstatus; ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (($employmentstatus == 'Full time') || ($employmentstatus == 'Part time')) {
                                                    ?>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Employer Name <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $employername; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Employer Address <span class="pull-right">:</span></h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $employeraddress; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Employer Number <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $employernumber; ?></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php */ ?>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Fullname <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $emergencyname; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Relationship<span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $emergencyrelationship; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Contact<span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $emergencyphone; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php echo $emergencyaddress; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="medical" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary mt-4 mb-4">Medical Information</h4>
                                                        <?php
                                                        if (!empty($docext)) {
                                                        ?>
                                                            <a href="images/docs/<?php echo md5($patient_id) . '.' . $docext; ?>" class="btn btn-xs btn-success" target="_blank"><i class="fa fa-clipboard"></i> View Attachment</a>
                                                        <?php } ?>
                                                        <div class="row mb-2 mt-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Blood Group <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $bloodgroup; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Weight (kgs) <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $weight; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Height <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $height; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Temperature <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $temp; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Blood Pressure <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $bp; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Allergies <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $allergies; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Diseases <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $diseases; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-sm-3 col-5">
                                                                <h5 class="f-w-500">Pregnancies <span class="pull-right">:</span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-sm-9 col-7"><span><?php echo $pregnancies; ?></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $getsurgeries = mysqli_query($con, "SELECT * FROM surgeryhistory WHERE patient_id='$id'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($getsurgeries) > 0) {
                                                        ?>
                                                            <h4 class="text-primary mt-4">Surgery History</h4>
                                                            <?php
                                                            while ($row2 = mysqli_fetch_array($getsurgeries)) {
                                                                $year = $row2['year'];
                                                                $month = $row2['month'];
                                                            ?>
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-3 col-5">
                                                                        <h5 class="f-w-500"> <?php echo $month; ?><span class="pull-right">:</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-sm-9 col-7"><span><?php echo $year; ?></span>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                        <div class="">
                                                            <button  class="btn btn-xs btn-info" data-toggle="modal" data-target="#addEditModal"><i class="fa fa-plus"></i> Edit Triage</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (($_SESSION['elcthospitallevel'] == 'insurance officer')) { ?>
                                                <div id="insurance" class="tab-pane fade">
                                                    <div class="pt-3">
                                                        <div class="settings-form">
                                                            <h4 class="text-primary mt-4">Insurance Information</h4>
                                                            <?php if (!empty($insurancecompany)) { ?>
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-3 col-5">
                                                                        <h5 class="f-w-500"> Company<span class="pull-right">:</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-sm-9 col-7">
                                                                        <span><?php echo $company; ?></span>
                                                                        <a href="insurancereport?id=<?php echo $patient_id; ?>" class="btn btn-primary">View Report</a>
                                                                    </div>
                                                                </div>


                                                                <div class="row mb-2">
                                                                    <div class="col-sm-3 col-5">
                                                                        <h5 class="f-w-500">Membership No<span class="pull-right">:</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-sm-9 col-7"><span><?php echo $policyidnumber; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-3 col-5">
                                                                        <h5 class="f-w-500">Employer<span class="pull-right">:</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-sm-9 col-7"><span><?php echo $insuranceemployer; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-sm-3 col-5">
                                                                        <h5 class="f-w-500">Date of Birth<span class="pull-right">:</span>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-sm-9 col-7"><span><?php echo date('Y-m-d', $dob); ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php if ($insurancecompany == 'Secondary') { ?>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-3 col-5">
                                                                            <h5 class="f-w-500">Secondary Subscriber Name<span class="pull-right">:</span>
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-sm-9 col-7"><span><?php echo $secondarysubscribername; ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-3 col-5">
                                                                            <h5 class="f-w-500">Relationship to Patient<span class="pull-right">:</span>
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-sm-9 col-7"><span><?php echo $patientrelation; ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-3 col-5">
                                                                            <h5 class="f-w-500">Work Phone Number<span class="pull-right">:</span>
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-sm-9 col-7"><span><?php echo $workphone; ?></span>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
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
        <div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel"> Edit Patient Triage  </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="post" name='form' class="form" action="" enctype="multipart/form-data" >
                                                                        <input type="hidden" name="id" value="<?php echo $patient_id; ?>">
                                                                        <div class="form-group nref" >
                                                                            <label class="control-label"> Blood Group</label>
                                                                            <input type="text" name="blood" class="form-control" value="<?php echo $bloodgroup; ?>" required>
                                                                        </div>

                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Weight (kgs) </label>
                                                                                <input name="weight" class="form-control" value="<?php echo $weight; ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Height </label>
                                                                                <input name="height" class="form-control" value="<?php echo $height; ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Temperature </label>
                                                                                <input name="temp" class="form-control" value="<?php echo $temp; ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Blood Pressure (BP) </label>
                                                                                <input name="bp" class="form-control" value="<?php echo $bp ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Allergies </label>
                                                                                <input name="alleg" class="form-control" value="<?php echo $allergies; ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Diseases </label>
                                                                                <input name="disease" class="form-control" value="<?php echo $diseases; ?>" required/>
                                                                            </div>
                                                                            <div class="form-group notmedic">
                                                                                <label class="control-label">Pregnancies </label>
                                                                                <input name="pregan" class="form-control" value="<?php echo $pregnancies; ?>" required/>
                                                                            </div>
                                                                            

                                                                            <div class="form-group pull-right"><button class="btn btn-primary" type="submit" name="submittriage">Save</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
        <!-- completeRegistrationModal - bootstrap modal -->
        <div class="modal fade" id="completeRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send to nurse</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="sendforregistration?id=<?php echo $patient_id; ?>" method="POST">
                            <div class="form-group">
                                <label>Select Nurse</label>
                                <select class="form-control room" name="nurse">
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

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
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


    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>