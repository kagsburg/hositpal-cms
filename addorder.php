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
    <link href="css/chosen/chosen.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".showit").load("purchaseprocess.php", {
                "load_cart": "1"
            });
            $(document).on('click', '#add_item',function(){
                var type = $('#type').val();
                var item = $('#item').val();
                var unit1 = $('#unit1').val();
                var quantity = $('#quantity').val();
                var store = $('#store').val();
                var supplier = $('#supplier').val();
                var delivery = $('#deliverydate').val();
                $.ajax({
                    url: "purchaseprocess.php",
                    type: "POST",
                    dataType: "json", //expect json value from server
                    data:{
                        type:type,
                        item:item,
                        unitprice:unit1,
                        quantity:quantity,
                        store:store,
                        supplier,
                        delivery
                    }
                }).done(function(data){
                    $('#type').val("")
                    $('#item').val("")
                    $('#unit1').val("")
                    $('#quantity').val("")
                    $("#label-info").html(data.items);
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 10px;">'); //show loading image
                    $(".showit").load("purchaseprocess.php", {
                        "load_cart": "1"
                    }); //Make ajax request using jQuery Load() & update results
                })
            })
            $(".form-item").submit(function(e) {
                var f = $(this);
                var form_data = $(this).serialize();
                $.ajax({ //make ajax request to cart_process.php
                    url: "purchaseprocess.php",
                    type: "POST",
                    dataType: "json", //expect json value from server
                    data: form_data
                }).done(function(data) { //on Ajax success
                    f.trigger("reset");
                    $('#selectprod').val("").trigger("change")
                    $("#label-info").html(data.items); //total items in cart-info element
                    //				button_content.html('Add to Order'); //reset button text to original text
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 10px;">'); //show loading image
                    $(".showit").load("purchaseprocess.php", {
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
                $.getJSON("purchaseprocess.php", {
                    "remove_code": pcode
                }, function(data) { //get Item count from Server
                    $("#label-info").html(data.items); //update Item count in cart-info
                    $(".showit").html('<img src="images/loading2.gif" alt="loading.." style="position: relative;left: 150px;">');
                    $(".showit").load("purchaseprocess.php", {
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
                            <h4>Add Purchase Order</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="stockorders">Orders</a></li>
                            <li class="breadcrumb-item active"><a href="addorder">Add Purchase Order</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form name="form" class="form form-item" method="GET">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="control-label">* Select Store</label>
                                            <select name="store" id="store" class="form-control">
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
                                        <div class="form-group col-md-4">
                                            <label class="control-label">* Select Supplier</label>
                                            <select name="supplier" id="supplier" class="form-control">
                                                <option value="0" selected="selected">Select Supplier</option>
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
                                        <div class="form-group col-md-4" id="date" style="display: none;">
                                            <label class="control-label"> Delivery Date</label>
                                            <input type="date" name="deliverydate" id="deliverydate" class="form-control">
                                        </div>
                                        <div class="col-md-12 subobj3">
                                            <div id="oproducts" class="row">
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Item Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="" selected="selected">Select Item Type</option>
                                                        <option value="Medicine">Medicine</option>
                                                        <option value="Medical">Medical Items</option>
                                                        <option value="Non Medical">Non Medical Items </option>
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group col-md-6">
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
                                                    <select name="subcategory" class="form-control" id="emptycat">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                    <select name="subcategory" id="subcategory" class="form-control" style="display: none;">
                                                        <option value="" selected="selected">Select Item Category</option>
                                                    </select>
                                                </div> -->


                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Item</label>                                                   
                                                    <select data-placeholder="Choose item..." name="item" class="form-control" id="item" style="display:none;">
                                                        <option value="" selected="selected">Select Item</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4" id="unitprice">
                                                    <label class="control-label">Unit Price</label>
                                                    <input type="number" class="form-control" id="unit1" name="unitprice" />

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity" name="quantity" min="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="add_item" type="button" >+</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Purchase Items</h4>
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
                        <a href="saveorder" class="btn btn-primary pull-right">SUBMIT <i class="fas fa-hand-point-right"></i></a>
                    </div>
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
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <script>
        $('.subobj3_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj3').append(`
            <div id="oproducts" class="row outer">
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Item Type</label>
                                                    <select name="type[]" id="type" class="form-control">
                                                        <option value="" selected="selected">Select Item Type</option>
                                                        <option value="Medicine">Medicine</option>
                                                        <option value="Medical">Medical Items</option>
                                                        <option value="Non Medical">Non Medical Items </option>
                                                    </select>
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Item</label>                                                   
                                                    <select data-placeholder="Choose item..." name="item[]" class="form-control" id="item" >
                                                        <option value="" selected="selected">Select Item</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4" id="unitprice">
                                                    <label class="control-label">Unit Price</label>
                                                    <input type="number" class="form-control"  name="unitprice[]" />

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Quantity</label>
                                                    <input type="number" class="form-control" name="quantity[]" min="1">
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="remove_subobj3 btn btn-danger" type="button" style="height:40px;margin-top:22px;padding-top:5px;">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
            
               
            `); 

        });       
    </script>
    <script>
        var items = [
            <?php
            $items = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status = 1");
            while ($row = mysqli_fetch_assoc($items))
                echo json_encode($row) . ",";
            ?>
        ];
        var productItem=[
            <?php
            $products = mysqli_query($con, "SELECT * FROM supplierproducts where status=1");
            while ($row = mysqli_fetch_assoc($products)){

                echo json_encode($row).",";
            }

            ?>
        ]

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
            function getsupplierproducts(sup){
                $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item</option>');
                // console.log(productItem)
                var prdt = productItem.filter(i => i.supplier_id == sup)
                // get products 
                var filtered = 
                prdt.forEach(function(row){
                    items.forEach(function(item){
                        if (row.product_id == item.inventoryitem_id){
                            $('#item').append($("<option>").text(item.itemname).val(item.inventoryitem_id));
                        }
                    })
                })
                $('#emptysubcat').hide();
                $('#item').show();
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
            function fillItemss(type,supplier){
                $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item</option>');
                var filtered = items.filter(i => i.type == type)
                if (supplier !== '0'){
                    var prdt = productItem.filter(i => i.supplier_id == supplier)
                    prdt.forEach(function(row){
                        filtered.forEach(function(item){
                        if (row.product_id == item.inventoryitem_id){
                            $('#item').append($("<option>").text(item.itemname).val(item.inventoryitem_id));
                        }
                    })
                })
                }else{
                    filtered.forEach(function(row) {
                    $('#item').append($("<option>").text(row.itemname).val(row.inventoryitem_id));
                });
                }
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
            $('#supplier').on('change',function(){
                var supplier = $(this).val()
                if (supplier == '0'){
                    // show unit price 
                    $('#unitprice').show();
                    $('#date').hide();
                    $('#item').val("")
                $('#item').html('<option value="" selected="selected">Select Item</option>');
                items.forEach(function(row) {
                    $('#item').append($("<option>").text(row.itemname).val(row.inventoryitem_id));
                });
                $('#emptysubcat').hide();
                $('#item').show();

                }else{
                    getsupplierproducts(supplier);
                    $('#unitprice').hide();
                    $('#date').show();
                }

            })
            $('#type').on('change', function() {
                var type = $(this).val();
                var supplier = $('#supplier').val();
                if (!!type) {
                    fillItemss(type,supplier);
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