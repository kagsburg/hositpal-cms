<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'store manager'))&&($_SESSION['elcthospitallevel'] != 'head physician') && ($_SESSION['elcthospitallevel'] != 'pharmacist')) {
    header('Location:login.php');
}
$ty = isset($_GET['ty']) ? $_GET['ty'] : "";
$type = mysqli_real_escape_string($con, $ty);
$store = isset($_GET['store']) ? $_GET['store'] : "";
$store = mysqli_real_escape_string($con, $store);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Stock</title>
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
                            <h4>Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="items">Items</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-3">

                        
                        <!-- add print button -->
                        <!-- <a href="" class="btn btn-primary" >Print</a> -->


                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Items in Stock</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>Id Number</th>
                                                <th>Item Name</th>
                                                <th>Category</th>
                                                <th>In Stock</th>
                                                <th>Expiry</th>
                                                <th>Measurement Unit</th>
                                                <th>Stock Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //$pmstr = empty($ty) ? "" : "AND `type`='$paymethod'";
                                            if ($type== ""){
                                                $pmstr = '';
                                            }else{
                                                $pmstr = "AND `type`='$type'";
                                            }
                                            $query = "SELECT * FROM inventoryitems WHERE status=1 $pmstr";
                                            $getitems = mysqli_query($con, $query) or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                $subcategory_id = $row['subcategory_id'];
                                                $getsub = mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 AND subcategory_id='$subcategory_id'");
                                                $row32 =  mysqli_fetch_array($getsub);
                                                $subcategory = isset($row32['subcategory']) ? $row32['subcategory'] : "";
                                                $category_id = isset($row32['category_id']) ? $row32['category_id'] : "";
                                                $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                $row13 =  mysqli_fetch_array($getcat);
                                                $category = isset($row13['category']) ? $row13['category'] : "";
                                                $type2 = isset($row13['type']) ? $row13['type'] : "";

                                                $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                $row1 =  mysqli_fetch_array($getcat);
                                                $category = isset($row1) ? $row1['category'] : "";
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];
                                                $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id' and store=2 and status=2 order by expiry desc") or die(mysqli_error($con));
                                                if (mysqli_num_rows($getstock) == 0) {
                                                    continue;
                                                }
                                                $row3 = mysqli_fetch_array($getstock);
                                                $totalstock = $row3['totalstock'];
                                                $totalordered = 0;
                                                $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id'") or die(mysqli_error($con));
                                                while ($row4 = mysqli_fetch_array($getordered)) {
                                                    $stockorder_id = $row4['stockorder_id'];
                                                    $quantity = $row4['quantity'];
                                                    $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND status=1");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $totalordered = $totalordered + $quantity;
                                                    }
                                                }
                                                $instock = $totalstock - $totalordered;
                                                $today = date('Y-m-d');
                                                $expiry = $row3['expiry'];
                                                if ($expiry < $today){
                                                    $instock = 0;
                                                }
                                                if ($instock <= 0) {
                                                } else {
                                            ?>
                                                    <tr class="gradeA">
                                                        <td><?php echo 'ELVD-' . $inventoryitem_id; ?></td>
                                                        <td><?php echo $itemname; ?></td>
                                                        <td><?php echo $category; ?></td>
                                                        <td><?php echo $instock; ?></td>
                                                        <td><?php echo $row3['expiry']; ?></td>
                                                        <td><?php echo $measurement; ?></td>
                                                        <th><?php
                                                            if ($instock <= 100) {
                                                                echo '<div class="text-danger">LOW</div>';
                                                            } else if ($instock>=101 && $instock<=500) {
                                                                echo '<div class="text-primary">MED</div>';
                                                            } 
                                                            else {
                                                                echo '<div class="text-success">HIGH</div>';
                                                            }
                                                            ?></th>

                                                        <td>
                                                            <a href="itemstock?id=<?php echo $inventoryitem_id; ?>&ty=<?php echo $type; ?>" class="btn btn-primary btn-xs">Details</a>

                                                        </td>
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
    <script>
        $(function() {
            $('#ty').change(function() {
                var chosenPaymethod = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('store', chosenPaymethod);
                window.location.href = url.href;
            });
        })
    </script>
</body>

</html>