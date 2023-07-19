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
    <title>Patients</title>
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
                            <h4>Out Patients</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="outpatients">Out Patients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Out Patients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Image</th>
                                                <!-- <th>Date</th> -->
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE status in (0,1)");
                                            while ($row1 = mysqli_fetch_array($getadmission)) {
                                                $admission_id = $row1['admission_id'];
                                                $getadmitted = mysqli_query($con, "SELECT * FROM admitted WHERE status=1 and admission_id='$admission_id'");
                                                // $row2 = mysqli_fetch_array($getadmitted);
                                                if (mysqli_num_rows($getadmitted) == 0) {                                                
                                                
                                                $patient_id = $row1['patient_id'];
                                                $dischargedate = $row1['dischargedate'];
                                                #check if patient has pending bills 
                                                $pending_bills = mysqli_query($con, "SELECT * FROM bills WHERE status IN (1) AND patient_id='$patient_id'");
                                               
                                                
                                                $getpatients = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                                $row = mysqli_fetch_array($getpatients);
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

                                                if (!empty($ext))
                                                    $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                                                else 
                                                    $pimage = "noimage.png";

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
                                                    <!-- <td><?php echo date('d/M/Y', $dischargedate); ?></td> -->
                                                    <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $phone; ?></td>

                                                    <td>

                                                        <?php
                                                        if ($_SESSION['elcthospitallevel'] == 'receptionist') {
                                                            if (mysqli_num_rows($pending_bills) > 0) {
                                                              
                                                            }
                                                        ?>
                                                            <a href="dischargepatient?id=<?php echo $admission_id; ?>"
                                                            <?php if (mysqli_num_rows($pending_bills) > 0) { ?>
                                                                class="btn btn-xs btn-danger disabled"
                                                            <?php } else { ?>
                                                             class="btn btn-xs btn-success" 
                                                            <?php } ?>
                                                             onclick="return confirm_delete<?php echo $admission_id; ?>()">Discharge</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $admission_id; ?>() {
                                                                    return confirm('You are about To Discharge Patient. Are you sure you want to proceed?');
                                                                }
                                                            </script>
                                                        <?php }

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