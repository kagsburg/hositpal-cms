<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/bills.php';
include 'utils/services.php';

$roles = array('admin', 'cashier', 'receptionist');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pending Registrations</title>
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
                            <h4>Pending Registrations</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Pending Registrations</a></li>
                        </ol>
                    </div>
                </div>
                <?php if (isset($_SESSION['flash_message'])) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['flash_message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php } ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Pending Registrations</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px" data-order="[]">
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
                                            $patients = get_all_patients($pdo, '3');
                                            foreach ($patients as $row) {
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
                                                $image = $row['image'];
                                                $pin = $row['pin'];
                                                $insurer = $row['insurancecompany'];
                                                $creditclient = $row['creditclient'];
                                                $paymenttype = get_payment_method($pdo, $patient_id);
                                                $paymenttypes = get_payment_methods($pdo, $patient_id);
                                                $hasbill = has_bill($pdo, $patient_id, "unselective", REGISTRATION_SERVICE_ID);

                                                if (!empty($insurer)) {
                                                    $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurer'");
                                                    $row1 =  mysqli_fetch_array($getcompanies);
                                                    $insurancecompany_id = $row1['insurancecompany_id'];
                                                    $companyname = $row1['company'];
                                                } else {
                                                    $companyname = "N/A";
                                                }

                                                if (!empty($creditclient)) {
                                                    $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE creditclient_id='$creditclient'");
                                                    $row = mysqli_fetch_array($getclients);
                                                    $clientname = $row['clientname'];
                                                } else {
                                                    $clientname = "N/A";
                                                }

                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $pin; ?></td>
                                                    <td>
                                                        <a href="images/patients/<?php echo $image; ?>" target="_blank">
                                                            <img src="images/patients/thumbs/<?php echo $image; ?>" width="60">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $phone; ?></td>
                                                    <td><?php echo $address; ?></td>
                                                    <td><?php echo $occupation; ?></td>

                                                    <td>
                                                        <!-- <a href="patient?id=<?php echo $patient_id; ?>" class="btn btn-success btn-xs"><i class="fa fa-user"></i>View</a> -->

                                                        <?php if ($_SESSION['elcthospitallevel'] == 'cashier') { ?>
                                                            <a href="addregistrationpayment?id=<?php echo $patient_id; ?>" class="btn btn-sm btn-primary">Add Payment</a>
                                                        <?php }
                                                        if ($_SESSION['elcthospitallevel'] == 'receptionist') { ?>
                                                            <a href="editpatient?id=<?php echo $patient_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                            <?php if (!$hasbill) { ?>
                                                                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#payRegistrationModal<?php echo $patient_id; ?>">
                                                                    Pay
                                                                </button>
                                                            <?php } ?>
                                                        <?php }
                                                        if ($_SESSION['elcthospitallevel'] == 'admin' || $_SESSION['elcthospitallevel'] == 'receptionist') { ?>
                                                            <a href="hidepatient?id=<?php echo $patient_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $patient_id; ?>()">Remove</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $patient_id; ?>() {
                                                                    return confirm('You are about To Remove this Member. Are you sure you want to proceed?');
                                                                }
                                                            </script>
                                                        <?php } ?>

                                                        <div class="modal fade" id="payRegistrationModal<?php echo $patient_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form method="post" name='form' class="form" action="payregistration?id=<?php echo $patient_id; ?>" enctype="multipart/form-data">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Registration Payment</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label>Select Payment Method</label>
                                                                                        <select class="form-control" name="paymentmethod">
                                                                                            <option value="">Select option..</option>
                                                                                            <option value="cash">Cash</option>
                                                                                                <?php  
                                                                                                    foreach ($paymenttypes as $paymenttype) {
                                                                                                        print_r($paymenttype);
                                                                                                        if ($paymenttype == "credit") {
                                                                                                            $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 and clientname='$clientname'");
                                                                                                            while ($row = mysqli_fetch_array($getclients)) {
                                                                                                                $client_name = $row['clientname'];
                                                                                                                $creditclient_id = $row['creditclient_id'];
                                                                                                ?>
                                                                                                                <option value="credit">Credit - <?php echo $client_name; ?></option>
                                                                                                            <?php }
                                                                                                        } 
                                                                                                        if ($paymenttype == "insurance") {
                                                                                                            $getcompanies = mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 and company='$companyname'");
                                                                                                            while ($row = mysqli_fetch_array($getcompanies)) {
                                                                                                                $company_name = $row['company'];
                                                                                                                $insurancecompany_id = $row['insurancecompany_id'];
                                                                                                            ?>
                                                                                                                <option value="insurance">Insurance - <?php echo $company_name; ?></option>
                                                                                                            <?php }
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                            
                                                                                            <!-- <?php if ($paymenttype == "credit") { ?>
                                                                                                <option value="credit" selected>Credit - <?php echo $clientname; ?></option>
                                                                                            <?php } else if ($paymenttype == "insurance") { ?>
                                                                                                <option value="insurance" selected>Insurance - <?php echo $companyname; ?></option>
                                                                                            <?php } ?> -->
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                        </div>
                                                                    </form>
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

</body>

</html>