<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'nurse')) {
    header('Location:login.php');
}
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
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".showit").load("stockprocess.php", {
                "load_cart": "1"
            });
            $(".form-item").submit(function(e) {
                var form_data = $(this).serialize();
                //			var button_content = $(this).find('button[type="submit"]');
                //			button_content.html('Adding...'); //Loading button text 

                $.ajax({ //make ajax request to cart_process.php
                    url: "stockprocess.php",
                    type: "POST",
                    dataType: "json", //expect json value from server
                    data: form_data
                }).done(function(data) { //on Ajax success
                    $("#label-info").html(data.items); //total items in cart-info element
                    //				button_content.html('Add to Order'); //reset button text to original text
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 10px;">'); //show loading image
                    $(".showit").load("stockprocess.php", {
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
                $.getJSON("stockprocess.php", {
                    "remove_code": pcode
                }, function(data) { //get Item count from Server
                    $("#label-info").html(data.items); //update Item count in cart-info
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 150px;">');
                    $(".showit").load("stockprocess.php", {
                        "load_cart": "1"
                    });
                });
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
                            <h4>Add Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="stock">View Stock</a></li>
                            <li class="breadcrumb-item active"><a href="addstock">Add stock</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card" style="max-height: 500px;overflow-y: scroll">
                            <div class="card-header">
                                <h4 class="card-title">Stock Items</h4>
                            </div>
                            <div class="card-body">
                                <table class="table" id="example5" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>In Stock</th>
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
                                            $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                            $row2 =  mysqli_fetch_array($getunit);
                                            $measurement = $row2['measurement'];
                                            $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id'") or die(mysqli_error($con));
                                            $row3 = mysqli_fetch_array($getstock);
                                            $totalstock = $row3['totalstock'];
                                            $exipry = $row3['expiry'];
                                            $totalordered = 0;
                                            $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id'") or die(mysqli_error($con));
                                            while ($row4 = mysqli_fetch_array($getordered)) {
                                                $stockorder_id = $row4['stockorder_id'];
                                                $quantity = $row4['quantity'];
                                                $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND section='pharmacy'");
                                                if (mysqli_num_rows($getorder) > 0) {
                                                    $totalordered = $totalordered + $quantity;
                                                }
                                            }
                                            $instock = $totalstock - $totalordered;
                                        ?>
                                                <tr>
                                                    <td><?php echo $itemname . '(' . $measurement . ')'; ?></td>
                                                    <td><?php echo $instock; ?></td>
                                                    
                                                    <td> <input name="product_qty" form="pform<?php echo $inventoryitem_id ?>" class="form-control" type="text" style="width:50px">
                                                </td>
                                                <td>
                                                        <form class="form-item" id="pform<?php echo $inventoryitem_id ?>">
                                                        <input type="hidden" name="item_id" value="<?php echo $inventoryitem_id; ?>">
                                                        <input type="hidden" name="measurement_id" value="<?php echo $measurement_id; ?>">
                                                        <button class="btn btn-xs btn-info listbtn" type="submit">Add to List</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
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
                            </div>
                        </div>
                        <a href="addnursestockrequest" class="btn btn-primary pull-right">PROCEED <i class="fas fa-hand-point-right"></i></a>
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
</body>

</html>