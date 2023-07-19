<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'store manager'))) {
    header('Location:login.php');
}
$ty = $_GET['ty'];
$type = mysqli_real_escape_string($con, $ty);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $ty; ?> Items</title>
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
                            <h4><?php echo $ty; ?> Items</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#"><?php echo $ty; ?> Items</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if ($_SESSION['elcthospitallevel'] == 'admin') {
                        ?>
                            <a href="additem?ty=<?php echo $ty; ?>&sub=NULL" class="btn btn-success mb-2">Add Item</a>
                        <?php } ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Inventory <?php echo $ty; ?> Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Measurement Unit</th>
                                                <th>Minimum Unit</th>
                                                <th>Unit Price</th>
                                                <th>Credit Price</th>
                                                <th>Sub Category</th>
                                                <?php if ($ty == 'Medical') { ?>
                                                    <th>Strength</th>
                                                <?php }
                                                if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                    <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE type='$type' AND status=1 ");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $strength = $row['strength'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                $creditprice = $row['creditprice'];
                                                $subcategory_id = $row['subcategory_id'];
                                                $getsub = mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 AND subcategory_id='$subcategory_id'");
                                                if (mysqli_num_rows($getsub) > 0) {
                                                    $row3 =  mysqli_fetch_array($getsub);
                                                    $subcategory = $row3['subcategory'];
                                                    $category_id = $row3['category_id'];
                                                } else {
                                                    $subcategory = '';
                                                }
                                                //                                  $getcat=mysqli_query($con,"SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                //                           $row1=  mysqli_fetch_array($getcat);                               
                                                //                                  $category=$row1['category'];
                                                //                                  $type=$row1['type'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];
                                                //if($type==$ty.' items'){
                                            ?>
                                                <tr class="gradeA">

                                                    <td><?php echo $itemname; ?></td>
                                                    <td><?php echo $measurement; ?></td>
                                                    <td><?php echo $minimum; ?></td>
                                                    <td><?php echo $unitprice; ?></td>
                                                    <td><?php echo $creditprice; ?></td>
                                                    <td><?php echo $subcategory; ?></td>
                                                    <?php if ($ty == 'Medical') { ?>
                                                        <td><?php echo $strength; ?></td>
                                                    <?php }
                                                    if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                        <td>
                                                            <button data-toggle="modal" data-target="#basicModal<?php echo $inventoryitem_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                            <a href="hideitem?id=<?php echo $inventoryitem_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $inventoryitem_id; ?>()">Remove</a>
                                                            <script type="text/javascript">
                                                                function confirm_delete<?php echo $inventoryitem_id; ?>() {
                                                                    return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                                }
                                                            </script>
                                                            <a href="insuranceitemcharges?id=<?php echo $inventoryitem_id; ?>&ty=<?php echo $ty; ?>" class="btn btn-xs btn-primary">Insurance Prices</a>
                                                        </td>
                                                    <?php  } ?>


                                                </tr>
                                                <div class="modal fade" id="basicModal<?php echo $inventoryitem_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" name='form' class="form" action="edititem?id=<?php echo $inventoryitem_id; ?>" enctype="multipart/form-data">

                                                                    <div class="form-group"><label class="control-label">*Item Name</label>
                                                                        <input type="text" name='itemname' class="form-control" placeholder="Enter item name" required="required" value="<?php echo $itemname; ?>">
                                                                    </div>

                                                                    <div class="form-group"><label class="control-label">*Measurement unit</label>
                                                                        <select name="unitmeasurement" class="form-control">
                                                                            <option value="<?php echo $measurement_id; ?>" selected="selected"><?php echo $measurement; ?></option>
                                                                            <?php
                                                                            $getunits =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1");
                                                                            while ($row1 =  mysqli_fetch_array($getunits)) {
                                                                                $measurement_id = $row1['measurement_id'];
                                                                                $measurement = $row1['measurement'];

                                                                            ?>
                                                                                <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group"><label class="control-label">*Sub Category</label>
                                                                        <select name="subcategory" id="subcategory" class=" form-control">
                                                                            <option value="<?php echo $subcategory_id; ?>" selected="selected"><?php echo $subcategory; ?></option>
                                                                            <?php
                                                                            $getsubs =  mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 ORDER BY subcategory");
                                                                            while ($row1 =  mysqli_fetch_array($getsubs)) {
                                                                                $subcategory_id = $row1['subcategory_id'];
                                                                                $subcategory = $row1['subcategory'];
                                                                            ?>
                                                                                <option value="<?php echo $subcategory_id; ?>"><?php echo $subcategory; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group" <?php if ($ty != 'Medical') { ?>style="display:none" <?php } ?>>
                                                                        <label class="control-label">Strength</label>
                                                                        <input type="text" name="strength" class="form-control" placeholder="Enter Strength" value="<?php echo $strength; ?>">
                                                                    </div>
                                                                    <div class="form-group"><label class="control-label">*Price Per Unit</label>
                                                                        <input type="text" name='unitprice' class="form-control" placeholder="Enter Price per Unit" required="required" value="<?php echo $unitprice; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Credit Price</label>
                                                                        <input type="text" class="form-control" name="creditprice" placeholder="Enter price for credit clients" value="<?php echo $creditprice ?>">
                                                                    </div>

                                                                    <div class="form-group"><label class="control-label">*Minimum re-order point</label>
                                                                        <input type="number" name='minimum' class="form-control" placeholder="Enter Minimum re-order point" required="required" value="<?php echo $minimum; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button class="btn btn-primary" type="submit">Edit Item</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
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