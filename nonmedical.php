<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin') && (($_SESSION['elcthospitallevel'] != 'store manager'))) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Non Medical Items</title>
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
                            <h4>Non Medical Items</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="nonmedical">Non Medical Items</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="addnonmedical" class="btn btn-success mb-2">Add Item</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Inventory Non Medical Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>Id Number</th>
                                                <th>Item Name</th>
                                                <th>Measurement Unit</th>
                                                <th>Minimum Unit</th>
                                                <th>Unit Price</th>
                                                <th>Category</th>

                                                <?php
                                                if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                    <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $tradename = $row['tradename'];
                                                $genericname = $row['genericname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                $subcategory_id = $row['subcategory_id'];
                                                $getsub = mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 AND subcategory_id='$subcategory_id'");
                                                $row3 =  mysqli_fetch_array($getsub);
                                                $subcategory = $row3['subcategory'];
                                                $category_id = $row3['category_id'];
                                                $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                $row1 =  mysqli_fetch_array($getcat);
                                                $category = $row1['category'];
                                                $type = $row1['type'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];
                                                if ($type == 'Non Medical items') {
                                            ?>
                                                    <tr class="gradeA">
                                                        <td><?php echo 'ELVD-' . $inventoryitem_id; ?></td>
                                                        <td><?php echo $tradename; ?></td>
                                                        <td><?php echo $measurement; ?></td>
                                                        <td><?php echo $minimum; ?></td>
                                                        <td><?php echo $unitprice; ?></td>
                                                        <td><?php echo $subcategory; ?></td>
                                                        <?php
                                                        if ($_SESSION['elcthospitallevel'] == 'admin') { ?>
                                                            <td>
                                                                <button data-toggle="modal" data-target="#basicModal<?php echo $inventoryitem_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                                <a href="hideitem?id=<?php echo $inventoryitem_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $inventoryitem_id; ?>()"><i class="fa fa-times"></i> Remove</a>
                                                                <script type="text/javascript">
                                                                    function confirm_delete<?php echo $inventoryitem_id; ?>() {
                                                                        return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                                    }
                                                                </script>
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
                                                                    <form method="post" name='form' class="form" action="editnonmedical?id=<?php echo $inventoryitem_id; ?>" enctype="multipart/form-data">

                                                                        <div class="form-group"><label class="control-label">*Item Name</label>
                                                                            <input type="text" name='itemname' class="form-control" placeholder="Enter item name" required="required" value="<?php echo $tradename; ?>">
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
                                                                                $getsubs =  mysqli_query($con, "SELECT * FROM subcategories WHERE status=1");
                                                                                while ($row3 =  mysqli_fetch_array($getsubs)) {
                                                                                    $subcategory_id = $row3['subcategory_id'];
                                                                                    $subcategory = $row3['subcategory'];
                                                                                    $category_id = $row3['category_id'];
                                                                                    $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                                                    $row1 =  mysqli_fetch_array($getcat);
                                                                                    $category = $row1['category'];
                                                                                    $type = $row1['type'];
                                                                                    if ($type == 'Non Medical items') {
                                                                                ?>
                                                                                        <option value="<?php echo $subcategory_id; ?>"><?php echo $subcategory; ?></option>
                                                                                <?php }
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group"><label class="control-label">*Price Per Unit</label>
                                                                            <input type="text" name='unitprice' class="form-control" placeholder="Enter Price per Unit" required="required" value="<?php echo $unitprice; ?>">
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
</body>

</html>