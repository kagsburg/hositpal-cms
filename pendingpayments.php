<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';

$roles = array('cashier', 'admin');
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
    <title>Pending Payments</title>
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
                            <h4>Pending Payments</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Pending Payments</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Pending Payments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px" data-order="[]">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Full Names</th>
                                                <th>Payment Method</th>
                                                <!-- <th>Services</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $bills = get_all_bills_group_patient($pdo);

                                            foreach ($bills as $bill) {
                                                $bill_id = $bill['bill_id'];
                                                $patient_id = $bill['patient_id'];
                                                $admission_id = $bill['admission_id'];
                                                $type = $bill['type'];
                                                $type_id = $bill['type_id'];
                                                $paymenttype = $bill['payment_method'];
                                                
                                                if (!empty($admission_id)) {
                                                    $row1 = get_admission($pdo, $admission_id);
                                                    $mode = $row1['mode'];
                                                } else {
                                                    $mode = "normal";
                                                    // $paymenttype = get_payment_method($pdo, $patient_id);
                                                }
                                                if ($mode == 'normal') {
                                                    $patient = get_active_patient($pdo, $patient_id);
                                                    $pin = $patient['pin'];
                                                    $fullname = $patient['fullname'];
                                                    $insurance_id = $patient['insurancecompany'];


                                                    $total = 0;

                                                    if ($type == "lab") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE  laborder_id='$type_id'");
                                                        $key = "laborder_id";
                                                    } else if ($type == "radiography") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE  radioorder_id='$type_id'");
                                                        $key = "radioorder_id";
                                                    } else if ($type == "medical_service") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$type_id'");
                                                        $key = "serviceorder_id";
                                                    } else if ($type == "unselective") {
                                                        $getorder = mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice_id='$type_id'");
                                                        $key = "medicalservice_id";
                                                    }

                                                    if (isset($getorder) && mysqli_num_rows($getorder) > 0) {
                                                        while ($rowo = mysqli_fetch_array($getorder)) {

                                                            $serviceorder_id = $rowo[$key];
                                                            $room = $type;
                                                            $service_html = "";

                                                            if ($type == "lab") {
                                                                $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                    $medicalservice_id = $row['investigationtype_id'];
                                                                    $unitcharge = $row['charge'];
                                                                    $total = $total + $unitcharge;
                                                                    $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                    $medicalservice = $row2['investigationtype'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "radiography") {
                                                                $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                    $medicalservice_id = $row['radioinvestigationtype_id'];
                                                                    $unitcharge = $row['charge'];
                                                                    $total = $total + $unitcharge;
                                                                    $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                                    $row2 = mysqli_fetch_array($getservice);
                                                                    $medicalservice = $row2['investigationtype'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "medical_service") {
                                                                $getservices = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1");
                                                                while ($rows = mysqli_fetch_array($getservices)) {
                                                                    $medicalservice_id = $rows['medicalservice_id'];
                                                                    $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                                    $rowm =  mysqli_fetch_array($getmedicalservice);
                                                                    $medicalservice = $rowm['medicalservice'];
                                                                    $service_html .= '<li>' . $medicalservice . '</li>';
                                                                }
                                                            } else if ($type == "unselective") {
                                                                $medicalservice = $rowo['medicalservice'];
                                                                $service_charge = get_service_charge($pdo, $serviceorder_id, $paymenttype, $insurance_id, 2);
                                                                $paymenttype = $service_charge['payment_type'];
                                                                $service_html .= '<li>' . $medicalservice . '</li>';
                                                            }


                                            ?>
                                                            <tr class="gradeA">
                                                                <td><?php echo $pin; ?></td>
                                                                <td><?php echo $fullname; ?></td>
                                                                <td><?php echo ucfirst($paymenttype); ?></td>
                                                                <!-- <td>
                                                                    <ol type="1">
                                                                        <?php echo $service_html; ?>
                                                                    </ol>
                                                                </td> -->
                                                                <td>
                                                                    <?php
                                                                    if ($_SESSION['elcthospitallevel'] == 'cashier') {
                                                                    ?>
                                                                        <a href="addpayment?q=<?php echo $patient_id; ?>" class="btn btn-sm btn-primary">Add Payment</a>
                                                                        <a href="deletebill?q=<?php echo $patient_id; ?>" class="btn btn-sm btn-danger">Clear</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <?php /*
                                                                <div class="modal fade" id="basicModal<?php echo $patientsque_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="addpayment?id=<?php echo $patientsque_id; ?>" method="POST">
                                                                                    <div class="form-group">
                                                                                        <label>Amount</label>
                                                                                        <input type="number" class="form-control" name="amount" required="required">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Medical Service</label>
                                                                                        <select name="service" class="form-control">
                                                                                            <option value="">Select Service...</option>
                                                                                            <?php
                                                                                            $getnoninsured =  mysqli_query($con, "SELECT * FROM noninsuredservices WHERE status=1");
                                                                                            while ($row1 =  mysqli_fetch_array($getnoninsured)) {
                                                                                                $noninsuredservice_id = $row1['noninsuredservice_id'];
                                                                                                $medicalservice_id = $row1['medicalservice_id'];
                                                                                                $charge = $row1['charge'];
                                                                                                $getmedicalservice =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                                                                $row3 =  mysqli_fetch_array($getmedicalservice);
                                                                                                $medicalservice = $row3['medicalservice'];
                                                                                            ?>
                                                                                                <option value="<?php echo $medicalservice_id . '_' . $charge; ?>"><?php echo $medicalservice . ' (' . $charge . ')'; ?></option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Payment Mode</label>
                                                                                        <select name="mode" class="form-control">
                                                                                            <option value="" selected="selected">Select Service...</option>
                                                                                            <option value="full">Full Payment</option>
                                                                                            <option value="installment">Installment Payment</option>
                                                                                            <option value="credit">Credit Payment</option>
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
                                                                */ ?>

                                                            </tr>

                                            <?php
                                                        }
                                                    }
                                                }
                                            } ?>
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