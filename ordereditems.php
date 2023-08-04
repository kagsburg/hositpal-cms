<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];
$st = $_GET['st'];
$ty = $_GET['ty'];
if (strlen($id) == 1) {
    $pin = '000' . $id;
}
if (strlen($id) == 2) {
    $pin = '00' . $id;
}
if (strlen($id) == 3) {
    $pin = '0' . $id;
}
if (strlen($id) >= 4) {
    $pin = $id;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Stock Order <?php echo $pin; ?></title>
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
                            <h4>Stock Order #<?php echo $pin; ?></h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Order details</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if (($_SESSION['elcthospitallevel'] == 'store manager') && ($st == 0) && ($ty == "Non Medical")) {
                        ?>
                            <a href="approverequest?id=<?php echo $id; ?>" class="btn btn-success" onclick="return approve()"> <i class="fa fa-thumbs-up"></i> Approve Request</a>
                            <script type="text/javascript">
                                function approve() {
                                    return confirm('You are about To Approve request. Are you sure you want to proceed?');
                                }
                            </script>
                        <?php } ?>
                        <?php
                        if (($_SESSION['elcthospitallevel'] == 'pharmacist') && ($st == 0) && ( ($ty == "Medical") || ($ty == "Medicine"))) {
                            ?>
                            <a href="approverequest?id=<?php echo $id; ?>" class="btn btn-success" onclick= "return approve()"><i class="fa fa-thumbs-up"></i> Approve Request
                        </a>
                        <a href="cancelrequest?id=<?php echo $id; ?>" class="btn btn-success" onclick="return cancel()">
                            <i class="fa fa-thumbs-down"></i> Cancel Request
                            </a>

                        <script type="text/javascript">
                                function approve() {
                                    return confirm('You are about To Approve request. Are you sure you want to proceed?');
                                }
                                function cancel() {
                                    return confirm('You are about To Cancel request. Are you sure you want to proceed?');
                                }
                            </script>
                            <?php } ?>

                            <?php 
                             if (isset($_SESSION['success'])){
                                echo $_SESSION['success'];
                                unset($_SESSION['success']); 
                             }
                            ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> #<?php echo $pin; ?> Order Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>Measurement Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ordereditems = mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$id'") or die(mysqli_error($con));
                                            while ($row1 = mysqli_fetch_array($ordereditems)) {
                                                $quantity = $row1['quantity'];
                                                $item_id = $row1['item_id'];
                                                $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$item_id'");
                                                $row = mysqli_fetch_array($getitems);
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                $subcategory_id = $row['subcategory_id'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];

                                            ?>
                                                <tr class="gradeA">
                                                    <td><?php echo $itemname; ?></td>
                                                    <td><?php echo $quantity; ?></td>
                                                    <td><?php echo $measurement; ?></td>

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


    </div>

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