<?php
include 'includes/conn.php';
include 'utils/patients.php';
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
                                 <!-- check for session success -->
                                 <?php
                                if (isset($_SESSION['success'])) {
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);   
                                } 
                                 ?>
                                <div class="table-responsive">
                                    <table id="example6" class="display" style="min-width: 845px">
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
                                            $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE payment in (1,0) AND room ='doctor'AND status in (1,8) and attendant='" . $_SESSION['elcthospitaladmin'] . "' GROUP BY admission_id");
                                            while ($row = mysqli_fetch_array($getque)) {
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $admintype = $row['admintype'];
                                                
                                                // check if patient is admitted 
                                                $getadmitted = mysqli_query($con, "SELECT * FROM admitted WHERE status=1 and admission_id='$admission_id'");
                                                // if (mysqli_num_rows($getadmitted) > 0){
                                                // }else{
                                                    // continue;                                               
                                                $prev_id= $row['prev_id'];
                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id' and status='1'");
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
                                                $insurance_id = $row2['insurancecompany'];  
                                                if ($paymenttype == "insurance") {
                                                    $getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE insurancecompany_id='$insurance_id'");
                                                    $row1 =  mysqli_fetch_array($getcompany);
                                                    $company = $row1['company'];
                                                } else {
                                                    $company = "";
                                                }
                                                if (!empty($ext))
                                                    $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                                                else 
                                                    $pimage = "noimage.png";
                                                    // print_r($prev_id);
                                                $getnextque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('nurse','lab','doctor','radiographer') and status='1' AND patientsque_id = '$prev_id'");
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
                                                    if ($prev22_id == '') {
                                                        $prev22_id = $npatientsque_id;
                                                    }
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
                                                // check if admin type is lab technician
                                                if ($admintype == "lab technician") {
                                                    $prev= mysqli_query($con,"SELECT * FROM patientsque WHERE admission_id='$admission_id'  AND room IN('lab') and status='1' ") or die(mysqli_error($con));
                                                    $prevrow = mysqli_fetch_array($prev);
                                                    $patientqu= $prevrow['patientsque_id'];
                                                    $getpendinglab = mysqli_query($con, "SELECT * FROM labreports where patientsque_id='$patientqu' AND admission_id='$admission_id' and approved=0  and status='1'") or die(mysqli_error($con));  
                                                    if (mysqli_num_rows($getpendinglab) <= 0 ){
                                                        
                                                    }else{
                                                        continue;
                                                    }
                                                }
                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $patientsque_id; ?></td>
                                                    <td>
                                                        <a href="images/patients/<?php echo $pimage; ?>" target="_blank">
                                                            <img src="images/patients/thumbs/<?php echo $pimage; ?>" width="60">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $room; ?></td>
                                                    <td><?php if ($paymenttype == "insurance") {
                                                        echo  $paymenttype.' - '. $company;
                                                    } else {
                                                    echo $paymenttype; } ?></td>


                                                    <td>
                                                        <a href="outpatientreport?id=<?php echo $prev22_id; ?>" class="btn btn-xs btn-info"> Patient Report </a>
                                                    
                                                       
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
    <script>
        $(document).ready(function() {
            $('#example6').DataTable({
                "order": [
                [0, "desc"]
            ],
        });
        });
    </script>

</body>

</html>
