<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'store manager')) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add New Order</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $(".showit").load("stockprocess.php", {
        //         "load_cart": "1"
        //     });
        //     $(".form-item").submit(function(e) {
        //         var form_data = $(this).serialize();
        //         //			var button_content = $(this).find('button[type="submit"]');
        //         //			button_content.html('Adding...'); //Loading button text 

        //         $.ajax({ //make ajax request to cart_process.php
        //             url: "stockprocess.php",
        //             type: "POST",
        //             dataType: "json", //expect json value from server
        //             data: form_data
        //         }).done(function(data) { //on Ajax success
        //             $("#label-info").html(data.items); //total items in cart-info element
        //             //				button_content.html('Add to Order'); //reset button text to original text
        //             $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 10px;">'); //show loading image
        //             $(".showit").load("stockprocess.php", {
        //                 "load_cart": "1"
        //             }); //Make ajax request using jQuery Load() & update results

        //         })
        //         e.preventDefault();
        //     });

            //Show Items in Cart

            //Remove items from cart
            // $(".showit").on('click', 'a.remove-item', function(e) {
            //     e.preventDefault();
            //     var pcode = $(this).attr("data-code"); //get product code
            //     $(this).parent().fadeOut(); //remove item element from box
            //     $.getJSON("stockprocess.php", {
            //         "remove_code": pcode
            //     }, function(data) { //get Item count from Server
            //         $("#label-info").html(data.items); //update Item count in cart-info
            //         $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 150px;">');
            //         $(".showit").load("stockprocess.php", {
            //             "load_cart": "1"
            //         });
            //     });
            // });


        // });
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
                            <h4>Add Order</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="orders">Orders</a></li>
                            <li class="breadcrumb-item active"><a href="addorder">Add Order</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="addorderdetails" name="form" class="form" method="GET">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label">*Select Store</label>
                                            <select name="store" class="form-control">
                                                <option value="" selected="selected">Select Store</option>
                                                <?php
                                                $getstores =  mysqli_query($con, "SELECT * FROM stores WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getstores)) {
                                                    $store_id = $row1['store_id'];
                                                    $store = $row1['store'];

                                                ?>
                                                    <option value="<?php echo $store_id; ?>"><?php echo $store;  ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">*Select Supplier</label>
                                            <select name="supplier" class="form-control">
                                                <option value="" selected="selected">Select Supplier</option>
                                                <?php
                                                $suppliers =  mysqli_query($con, "SELECT * FROM suppliers WHERE status=1") or die(mysqli_error($con));
                                                while ($row =  mysqli_fetch_array($suppliers)) {
                                                    $supplier_id = $row['supplier_id'];
                                                    $suppliername = $row['suppliername'];
                                                ?>
                                                    <option value="<?php echo $supplier_id; ?>"><?php echo $suppliername;  ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="oproducts" class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Item Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="" selected="selected">Select Item Type</option>
                                                        <option value="medical">Medical</option>
                                                        <option value="non-medical">Non Medical</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Item Category</label>
                                                    <select name="category" class="form-control" id="emptytype">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                    <select name="category" id="category" class="form-control" style="display: none;">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Item Sub Category</label>
                                                    <select class="form-control" id="emptycat">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                    <select name="subcategory" id="subcategory" class="form-control" style="display: none;">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Item</label>
                                                    <select name="item" class="form-control" id="emptysubcat">
                                                        <option value="" selected="selected">Select Item</option>
                                                    </select>
                                                    <select name="item" class="form-control" id="item" style="display:none;">
                                                        <option value="" selected="selected">Select Item</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="control-label">Quantity</label>
                                                    <input type="number" class="form-control" name="quantity" min="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Proceed</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <?php /*<div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Select Items</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 ");
                                        while ($row = mysqli_fetch_array($getitems)) {
                                            $inventoryitem_id = $row['inventoryitem_id'];
                                            $itemname = $row['itemname'];
                                            $strength = $row['strength'];
                                            $measurement_id = $row['measurement_id'];
                                            $minimum = $row['minimum'];
                                            $unitprice = $row['unitprice'];
                                            $subcategory_id = $row['subcategory_id'];
                                            $getsub = mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 AND subcategory_id='$subcategory_id'");
                                            $row3 =  mysqli_fetch_array($getsub);
                                            $subcategory = $row3['subcategory'] ?? "";
                                            $category_id = $row3['category_id'] ?? "";

                                            $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                            $row2 =  mysqli_fetch_array($getunit);
                                            $measurement = $row2['measurement'];
                                        ?>

                                            <tr>
                                                <td><?php echo $itemname . '(' . $measurement . ')'; ?></td>

                                                <td>
                                                    <form class="form-item">

                                                        <input type="text" class="form-control" name="product_qty" style="width:40px;float: left" required="required">
                                                        <input type="hidden" name="item_id" value="<?php echo $inventoryitem_id; ?>">
                                                        <input type="hidden" name="measurement_id" value="<?php echo $measurement_id; ?>">
                                                        <button class="btn btn-xs btn-info listbtn" type="submit" style="float:right">Add to List</button>
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
                        </div>
*/ ?>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        var items = [
            <?php
            $items = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status = 1");
            while ($row = mysqli_fetch_assoc($items))
                echo json_encode($row) . ",";
            ?>
        ];

        var categories = [
            <?php
            $cats = mysqli_query($con, "SELECT * FROM itemcategories WHERE status = 1");
            while ($row1 = mysqli_fetch_assoc($cats))
                echo json_encode($row1) . ",";
            ?>
        ];

        var subcategories = [
            <?php
            $cats = mysqli_query($con, "SELECT * FROM subcategories WHERE status = 1");
            while ($row1 = mysqli_fetch_assoc($cats))
                echo json_encode($row1) . ",";
            ?>
        ];

        $(function() {
            $('#emptytype').click(function() {
                if ($('#type').val() === '') {
                    alert("Please Select Item Type First");
                }
            });
            $('#emptycat').click(function() {
                if ($('#category').val() === '') {
                    alert("Please Select Item Category First");
                }
            });
            $('#emptysubcat').click(function() {
                if ($('#subcategory').val() === '') {
                    alert("Please Select Item Sub Category First");
                }
            });

            function fillSubCats(type) {
                $('#subcategory').val("")
                $('#subcategory').html('<option value="" selected="selected">Select Item Category</option>');
                var filtered = subcategories.filter(c => c.category_id == type)
                filtered.forEach(function(row) {
                    $('#subcategory').append($("<option>").text(row.subcategory).val(row.subcategory_id));
                });
                $('#emptycat').hide();
                $('#subcategory').show();
                emptyItems();
            }

            function emptySubCats() {
                $('#subcategory').val("")
                $('#subcategory').html('<option value="" selected="selected">Select Item Category</option>');
                $('#subcategory').hide();
                $('#emptycat').show();
                emptyItems();
            }

            function fillCats(type) {
                $('#category').val("")
                $('#category').html('<option value="" selected="selected">Select Item Category</option>');
                var filtered = categories.filter(c => c.type == type)
                filtered.forEach(function(row) {
                    $('#category').append($("<option>").text(row.category).val(row.itemcategory_id));
                });
                $('#emptytype').hide();
                $('#category').show();

                emptySubCats();
            }

            function emptyCats() {
                $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item Category</option>');
                $('#item').hide();
                $('#emptytype').show();
                emptySubCats();
            }


            function fillItems(category) {
                $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item</option>');
                console.log(category, subcategories)
                var filtered = items.filter(i => i.subcategory_id == category)
                filtered.forEach(function(row) {
                    $('#item').append($("<option>").text(row.itemname).val(row.inventoryitem_id));
                });
                $('#emptysubcat').hide();
                $('#item').show();
            }

            function emptyItems() {
                $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item</option>');
                $('#item').hide();
                $('#emptysubcat').show();
            }

            $('#category').on('change', function() {
                var cat = $(this).val();
                if (!!cat)
                    fillSubCats(cat)
                else
                    emptySubCats();
            })

            $('#type').on('change', function() {
                var type = $(this).val();
                if (!!type) {
                    ty = (type == "medical") ? "Medical items": "Non Medical items";
                    fillCats(ty);
                } else
                    emptyCats();
            })

            $('#subcategory').on('change', function() {
                var subcat = $(this).val();
                if (!!subcat) {                    
                    fillItems(subcat);
                } else
                    emptyItems();
            })
        });
    </script>
</body>

</html>