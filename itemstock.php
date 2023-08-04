<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && ($_SESSION['elcthospitallevel'] != 'store manager') && ($_SESSION['elcthospitallevel'] != 'accountant')) {
    header('Location:login.php');
}
$id = $_GET['id'];
$ty= $_GET['ty'];
$type = mysqli_escape_string($con,$ty);
$getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$id' ");
$row = mysqli_fetch_array($getitems);
$itemname = $row['itemname'];
$measurement_id = $row['measurement_id'];
$getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
$row2 =  mysqli_fetch_array($getunit);
$measurement = $row2['measurement'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $itemname; ?> Stock</title>
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
                            <h4><?php echo $itemname; ?> Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="stock?ty=<?php echo $type ?>">stock</a></li>
                            <li class="breadcrumb-item active"><a href="#"><?php echo $itemname; ?></a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-success">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="fa fa-medkit"></i>
                                    </span>
                                    <div class="media-body text-white text-right">
                                        <p class="mb-1">In Stock</p>
                                        <?php
                                        $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock FROM stockitems WHERE product_id='$id'") or die(mysqli_error($con));
                                        $row3 = mysqli_fetch_array($getstock);
                                        $totalstock = $row3['totalstock'];
                                        $totalordered = 0;
                                        $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$id'") or die(mysqli_error($con));
                                        while ($row4 = mysqli_fetch_array($getordered)) {
                                            $stockorder_id = $row4['stockorder_id'];
                                            $quantity = $row4['quantity'];
                                            $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND section='pharmacy' AND status=1");
                                            if (mysqli_num_rows($getorder) > 0) {
                                                $totalordered = $totalordered + $quantity;
                                            }
                                        }
                                        $instock = $totalstock - $totalordered;

                                        ?>
                                        <h3 class="text-white"> <?php echo number_format($instock) . ' ' . $measurement; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Items in Stock</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date Added</th>
                                                <th scope="col">Quantity Added</th>
                                                <?php if ($type == 'Medicine'){ ?>
                                                <th scope="col">Expiry Date</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getstock = mysqli_query($con, "SELECT * FROM stockitems WHERE product_id='$id'") or die(mysqli_error($con));
                                            while ($row3 = mysqli_fetch_array($getstock)) {
                                                $quantity = $row3['quantity'];
                                                $timestamp = $row3['timestamp'];
                                                $expiry = $row3['expiry'];

                                            ?>
                                                <tr>
                                                    <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                    <td><?php echo $quantity . ' (' . $measurement . ')'; ?></td>
                                                    <?php if ($type == 'Medicine'){?>
                                                    <td><?php if(isset($expiry)) echo date('d/M/Y', strtotime($expiry));  ?></td>
                                                    <?php } ?>

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


    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>