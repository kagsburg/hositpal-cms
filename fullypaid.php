<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('admin', 'accountant', 'cashier');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$paymethod = isset($_GET['paymethod']) ? $_GET['paymethod']: null;
$payments = get_all_payments($pdo, $paymethod);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Paid Services</title>
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
                            <h4>Patient Payments</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Patient Payments</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-4 mb-3">
                        
                        <select name="paymethod" id="paymethod" class="form-control">
                            <option value="">Filter by payment method</option>
                            <option value="insurance" <?php if ($paymethod == "insurance") echo "selected"; ?>>Insurance</option>
                            <option value="cash" <?php if ($paymethod == "cash") echo "selected"; ?>>Cash</option>
                        </select>
                        
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Payments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>PIN</th>
                                                <th>Image</th>
                                                <th>Full Names</th>
                                                <th>Gender</th>
                                                <th>Room to Visit</th>
                                                <th>Amount</th>
                                                <th>Payment Mode</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                        

                                            foreach ($payments as $payment) {
                                                $payment_method = $payment['payment_method'];
                                                $amount = $payment['amount'];
                                                
                                                $bill = get_bill_by_id($pdo, $payment['bill_id'], 2);
                                                
                                                $type = $bill['type'];
                                                $type_id = $bill['type_id'];
                                                $patient = get_patient($pdo, $bill['patient_id']);
                                                $fullname = $patient['fullname'];
                                                $gender = $patient["gender"];
                                                $image = $patient["image"]; 
                                                
                                                if ($type != "unselective") {
                                                    $room = ucfirst($type);
                                                } else {
                                                    $service = get_service($pdo, $type_id, 2);
                                                    $room = isset($service['name']) ? $service['name'] : "N/A";
                                                }
                                                
                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $pin; ?></td>
                                                    <td>
                                                        <a href="images/patients/<?php echo md5($patient_id) . '.' . $ext . '?' .  time(); ?>" target="_blank">
                                                            <img src="images/patients/thumbs/<?php echo $image; ?>" width="60">
                                                        </a>
                                                    </td>
                                                    <td><?php echo $fullname; ?></td>
                                                    <td><?php echo $gender; ?></td>
                                                    <td><?php echo $room; ?></td>
                                                    <td><?php echo $amount; ?></td>
                                                    <td><?php echo ucfirst($payment_method); ?></td>

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
        $(function() {
            $('#paymethod').change(function() {
                var chosenPaymethod = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('paymethod', chosenPaymethod);
                window.location.href = url.href;
            });
        })
    </script>
</body>

</html>