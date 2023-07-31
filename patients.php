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
                            <h4>Patients</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="patients">Patients</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Patients</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Image</th>
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Occupation</th>

                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getpatients = mysqli_query($con, "SELECT * FROM patients WHERE status='1' order by patient_id desc");
                                            while ($row = mysqli_fetch_array($getpatients)) {
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
                                                $level = $row['level'];

                                                if (!empty($ext))
                                                    $pimage = md5($patient_id) . '.' . $ext . '?' .  time();
                                                else
                                                    $pimage = "noimage.png";

                                                $getadmissions = mysqli_query($con, "SELECT * FROM admissions WHERE patient_id='$patient_id' AND status='1'");
                                                if (mysqli_num_rows($getadmissions) > 0)
                                                    $is_admitted = true;
                                                else
                                                    $is_admitted = false;


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
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                    <td><?php echo $occupation; ?></td>

                                                    <td>
                                                        <a href="patient?id=<?php echo $patient_id; ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i>View</a>
                                                        <?php
                                                        if ($_SESSION['elcthospitallevel'] == 'receptionist') {
                                                        ?>
                                                            <?php if ($level == 4) { ?>
                                                                <a href="sendforregistration?id=<?php echo $patient_id; ?>" class="btn btn-warning btn-xs" >
                                                                    Triage
                                                                </a>
                                                            <?php } else if ($level == 2) { ?>

                                                                <a href="admitpatient?id=<?php echo $patient_id; ?>" class="btn btn-xs btn-primary <?php if ($is_admitted) echo "disabled" ?>">Attend</a>
                                                            <?php } ?>
                                                            <a href="editpatient?id=<?php echo $patient_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                        <?php }
                                                        if ($_SESSION['elcthospitallevel'] == 'admin') {
                                                        ?>
                                                            <a href="hidepatient?id=<?php echo $patient_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $patient_id; ?>()">Remove</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $patient_id; ?>() {
                                                                    return confirm('You are about To Remove this Member. Are you sure you want to proceed?');
                                                                }
                                                            </script>

                                                        <?php } ?>

                                                        <div class="modal fade" id="completeRegistrationModal<?php echo $patient_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Send to nurse</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" method="POST">
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
                                                    </td>


                                                </tr>

                                            <?php } ?>
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
                ]
            });
        });
    </script>

</body>

</html>