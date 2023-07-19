<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'store manager')) && (($_SESSION['elcthospitallevel'] != 'pharmacist')) && (($_SESSION['elcthospitallevel'] != 'store manager')) && (($_SESSION['elcthospitallevel'] != 'accountant'))) {
    header('Location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pharmacy Stock</title>
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
                            <h4>Pharmacy Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Pharmacy Stock</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pharmacy Stock</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>Item Name</th>
                                                <th>In Stock</th>
                                                <th>Measurement Unit</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                // $category_id = $row['category_id'];
                                                $checkitem = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id' AND section='pharmacy'") or die(mysqli_error($con));
                                                if (mysqli_num_rows($checkitem) > 0) {
                                                    $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                    $row2 =  mysqli_fetch_array($getunit);
                                                    $measurement = $row2['measurement'];
                                                    $totalstock = 0;
                                                    $totalrequested = 0;
                                                    $getstock = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id' AND section='pharmacy'") or die(mysqli_error($con));
                                                    while ($row3 = mysqli_fetch_array($getstock)) {
                                                        $stockorder_id = $row3['stockorder_id'];
                                                        $quantity = $row3['quantity'];
                                                        $checkorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND status=1");
                                                        if (mysqli_num_rows($checkorder) > 0) {
                                                            $totalstock = $totalstock + $quantity;
                                                        }
                                                    }
                                                    $getotherstock = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id' AND section!='pharmacy'") or die(mysqli_error($con));
                                                    while ($row4 = mysqli_fetch_array($getotherstock)) {
                                                        $stockorder_id1 = $row4['stockorder_id'];
                                                        $quantity1 = $row4['quantity'];
                                                        $checkrequests = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id1' AND status=1");
                                                        if (mysqli_num_rows($checkrequests) > 0) {
                                                            $totalrequested = $totalrequested + $quantity1;
                                                        }
                                                    }
                                                    $instock = $totalstock - $totalrequested;
                                            ?>
                                                    <tr class="gradeA">
                                                        <td><?php echo 'ELVD-' . $inventoryitem_id; ?></td>
                                                        <td><?php echo $itemname; ?></td>
                                                        <td><?php echo $instock; ?></td>
                                                        <td><?php echo $measurement; ?></td>

                                                    </tr>

                                            <?php }
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