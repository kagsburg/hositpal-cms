<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'pharmacist')) {
    header('Location:login.php');
}
$ty=$_GET['ty'];
$type = mysqli_real_escape_string($con, $ty);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add New Stock</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".showit").load("pharprocess.php", {
                "load_cart": "1"
            });
            $(".form-item").submit(function(e) {
                var f = $(this);
                var form_data = $(this).serialize();
                $.ajax({ //make ajax request to cart_process.php
                    url: "pharprocess.php",
                    type: "POST",
                    dataType: "json", //expect json value from server
                    data: form_data
                }).done(function(data) { //on Ajax success
                    f.trigger("reset");
                    $('#selectprod').val("").trigger("change")
                    $("#label-info").html(data.items); //total items in cart-info element
                    //				button_content.html('Add to Order'); //reset button text to original text
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 10px;">'); //show loading image
                    $(".showit").load("pharprocess.php", {
                        "load_cart": "1"
                    }); //Make ajax request using jQuery Load() & update results

                })
                e.preventDefault();
            });

            //Show Items in Cart

            //Remove items from cart
            $(".showit").on('click', 'a.remove-item', function(e) {
                e.preventDefault();
                var pcode = $(this).attr("data-code"); //get product code
                $(this).parent().fadeOut(); //remove item element from box
                $.getJSON("pharprocess.php", {
                    "remove_code": pcode
                }, function(data) { //get Item count from Server
                    $("#label-info").html(data.items); //update Item count in cart-info
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 150px;">');
                    $(".showit").load("pharprocess.php", {
                        "load_cart": "1"
                    });
                });
            });
            $('#selectprod').on('change', function(e) {
                var val = $(this).val()
                if (!!val) {
                    const [item, measure] = val.split("_");
                    $('#item_id').val(item)
                    $('#measurement_id').val(measure)
                } else {
                    $('#item_id').val("")
                    $('#measure_id').val("")
                }
            });

        });
    </script>
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
                            <h4>Add <?php 
                            if ($type != 'Medicine'){
                                echo $type .' Items';
                            }else {
                                echo $type;
                            }
                             ?> Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="viewpharstock">View Stock</a></li>
                            <li class="breadcrumb-item active"><a href="addpharstock">Add stock</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="row form-item" method="post">
                                    <div class="col-md-4 form-group">
                                        <label class="mb-2" for="">Item</label>
                                        <input type="hidden" id="measurement_id" name="measurement_id" value="">
                                        <input type="hidden" id="type" name="type" value="<?php echo $type;?>">
                                        <input type="hidden" id="item_id" name="item_id" value="<?php echo $type;?>">
                                        <select name="item" id="selectprod" class="form-control multi-select">
                                            <option value="">Select a product</option>
                                            <?php
                                            $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 and type='$type' ORDER BY itemname");
                                            while ($row = mysqli_fetch_array($getitems)) {
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                // $category_id = $row['category_id'];
                                                // $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                                // $row1 =  mysqli_fetch_array($getcat);
                                                // $category = $row1['category'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];

                                            ?>
                                                <option value="<?php echo $inventoryitem_id . '_' . $measurement_id; ?>"><?php echo $itemname . '(' . $measurement . ')'; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php 
                                    $getstore = mysqli_query($con,"SELECT * FROM stores where store_id =2");
                                    $row = mysqli_fetch_array($getstore);
                                    $store_id = $row['store_id'];
                                    ?>
                                    <input type="hidden" name="store" value="<?php echo $store_id; ?>">
                                    <!-- <div class="col-md-2 form-group">
                                        <label class="mb-2" for="">Store</label>
                                        <select name="store" id="" class="form-control">
                                            <option value="">Select a store</option>
                                            <?php
                                            $getstores = mysqli_query($con, "SELECT * FROM stores WHERE status=1");
                                            while ($row = mysqli_fetch_array($getstores)) {
                                                $store_id = $row['store_id'];
                                                $storename = $row['store'];
                                            ?>
                                                <option value="<?php echo $store_id; ?>"><?php echo $storename; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> -->
                                    <div class="col-md-3 form-group">
                                        <label class="mb-2" for="">Quantity</label>
                                        <input type="number" name="product_qty" class="form-control" placeholder="Quantity">
                                    </div>
                                    <?php  
                                       if($type == "Medicine"){
                                    ?>
                                    <div class="col-md-3 form-group">
                                        <label class="mb-2" for="expiry">Expiry Date</label>
                                        <input type="date" name="expiry" id="expiry" class="form-control" placeholder="Expiry date">
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-2 form-group">
                                        <label for="" class="mb-2">&nbsp;</label>
                                        <button class="btn btn-block btn-info listbtn" type="submit">Add to List</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stock Items</h4>
                                <label class="badge badge-flat-primary badge-shadow pull-right label-success" id="label-info">
                                    <?php
                                    if (isset($_SESSION["bproducts"])) {
                                        echo count($_SESSION["bproducts"]);
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="card-body">
                                <div class="showit"></div>
                                <div class="table-responsive" style="display: none;">
                                    <table id="example5" class="display">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Measurement Unit</th>
                                                <th>Quantity</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_SESSION["bproducts"]) && count($_SESSION["bproducts"]) > 0) {
                                                foreach ($_SESSION["bproducts"] as $product) { //loop though items and prepare html content

                                                    //set variables to use them in HTML content below
                                                    $menuitem = $product["menuitem"];
                                                    $item_id = $product["item_id"];
                                                    $product_qty = $product["product_qty"];
                                                    $measurement_id = $product["measurement_id"];
                                                    $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                    $row2 =  mysqli_fetch_array($getunit);
                                                    $measurement = $row2['measurement'];
                                            ?>
                                                    <tr class="gradeA">
                                                        <td><?php echo $menuitem; ?></td>
                                                        <td><?php echo $measurement; ?></td>
                                                        <td><?php echo $product_qty; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a href="savepharstock" class="btn btn-primary pull-right">SAVE <i class="fas fa-hand-point-right"></i></a>
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

    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

    <script src="vendor/select2/js/select2.min.js"></script>
    <script src="js/plugins-init/select2-init.js"></script>
</body>

</html>
<?php /*
<div class="card" style="max-height: 500px;overflow-y: scroll; display: none;">
                            <div class="card-header">
                                <h4 class="card-title">Stock Items</h4>
                            </div>
                            <div class="card-body">                                
                                <table class="table " style="width:100%; display: none;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ORDER BY itemname");
                                        while ($row = mysqli_fetch_array($getitems)) {
                                            $inventoryitem_id = $row['inventoryitem_id'];
                                            $itemname = $row['itemname'];
                                            $measurement_id = $row['measurement_id'];
                                            $minimum = $row['minimum'];
                                            $unitprice = $row['unitprice'];
                                            // $category_id = $row['category_id'];
                                            // $getcat = mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND itemcategory_id='$category_id'");
                                            // $row1 =  mysqli_fetch_array($getcat);
                                            // $category = $row1['category'];
                                            $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                            $row2 =  mysqli_fetch_array($getunit);
                                            $measurement = $row2['measurement'];
                                        ?>
                                            <form class="form-item">
                                                <tr>
                                                    <td><?php echo $itemname . '(' . $measurement . ')'; ?></td>

                                                    <td> <input name="product_qty" class="form-control" type="text" style="width:50px">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="item_id" value="<?php echo $inventoryitem_id; ?>">
                                                        <input type="hidden" name="measurement_id" value="<?php echo $measurement_id; ?>">
                                                        <button class="btn btn-xs btn-info listbtn" type="submit">Add to List</button>
                                                    </td>
                                                </tr>
                                            </form>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        */ ?>