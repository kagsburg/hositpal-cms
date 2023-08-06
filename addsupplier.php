<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Supplier</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/chosen/chosen.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <style>
        .chosen-container-single .chosen-single {
            height: 35px;
            padding: 6px;
        }
    </style>
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
                            <h4>Add Supplier</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="suppliers">Suppliers</a></li>
                            <li class="breadcrumb-item active"><a href="addsupplier">Add Supplier</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Supplier</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['suppliername'], $_POST['address'], $_POST['phone'], $_POST['email'])) {
                                        $suppliername = mysqli_real_escape_string($con, trim($_POST['suppliername']));
                                        $address = mysqli_real_escape_string($con, trim($_POST['address']));
                                        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
                                        $email =  mysqli_real_escape_string($con, trim($_POST['email']));
                                        $products = $_POST['products'];
                                        $price = $_POST['price'];
                                        if ((empty($suppliername)) || (empty($address)) || (empty($phone))) {
                                            $errors[] = 'Some Fields marked * are Empty';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO suppliers(suppliername,address,phone,email,admin_id,timestamp,status) VALUES('$suppliername','$address','$phone','$email','" . $_SESSION['elcthospitaladmin'] . "','$timenow',1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);
                                            $allproducts = sizeof($products);
                                            if ($allproducts != 0){
                                                for ($i = 0; $i < $allproducts; $i++) {
                                                    if ($products[$i] != ''){
                                                    mysqli_query($con, "INSERT INTO supplierproducts(product_id,price,supplier_id,status) VALUES('$products[$i]','$price[$i]','$last_id',1)");
                                                }
                                            }
                                            }
                                            echo '<div class="alert alert-success">Supplier Successfully Added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Supplier Name *</label>
                                            <input type="text" class="form-control" name="suppliername" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Address *</label>
                                            <input type="text" class="form-control" name="address" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="text" class="form-control" name="phone" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>

                                        <h4>Products Supplied</h4>
                                        <hr>
                                        <h5> Medicine </h5>
                                        <div class='subobj3'>

                                            <div class='row'>
                                                <div class="form-group col-lg-6">
                                                    <label>Item</label>
                                                    <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;">
                                                        <option value="" selected="">Select item...</option>
                                                        <?php
                                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Medicine' ");
                                                        while ($row = mysqli_fetch_array($getitems)) {
                                                            $inventoryitem_id = $row['inventoryitem_id'];
                                                            $itemname = $row['itemname'];
                                                            $genericname = $row['genericname'];
                                                        ?>
                                                            <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Cost Price</label>
                                                    <input type="text" class="form-control" name="price[]" >
                                                </div>
                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj3_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h5>Medical Items</h5>
                                        <div class='subobj1'>

                                            <div class='row'>
                                                <div class="form-group col-lg-6">
                                                    <label>Item</label>
                                                    <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;">
                                                        <option value="" selected="">Select item...</option>
                                                        <?php
                                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Medical'");
                                                        while ($row = mysqli_fetch_array($getitems)) {
                                                            $inventoryitem_id = $row['inventoryitem_id'];
                                                            $itemname = $row['itemname'];
                                                            $genericname = $row['genericname'];
                                                        ?>
                                                            <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Cost Price</label>
                                                    <input type="text" class="form-control" name="price[]" >
                                                </div>
                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>
                                            </div>
                                        </div>

                                        <h5>Non Medical Items</h5>
                                        <div class='subobj2'>

                                            <div class='row'>
                                                <div class="form-group col-lg-6">
                                                    <label>Item</label>
                                                    <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;">
                                                        <option value="" selected="">Select item...</option>
                                                        <?php
                                                        $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Non Medical' ");
                                                        while ($row = mysqli_fetch_array($getitems)) {
                                                            $inventoryitem_id = $row['inventoryitem_id'];
                                                            $itemname = $row['itemname'];
                                                            $genericname = $row['genericname'];
                                                        ?>
                                                            <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label>Cost Price</label>
                                                    <input type="text" class="form-control" name="price[]" >
                                                </div>
                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj2_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
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

    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {
                allow_single_deselect: true
            },
            '.chosen-select-no-single': {
                disable_search_threshold: 10
            },
            '.chosen-select-no-results': {
                no_results_text: 'Oops, nothing found!'
            },
            '.chosen-select-width': {
                width: "100%"
            }
        }
       
            $('.chosen-select').chosen({
                width: "100%"
            });
       
    </script>
    <script>
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append(`
            <div class="row outer">
                <div class="col-lg-12">
                    <hr style="border-top: dashed 1px #b7b9cc;">
                </div>
                <div class="col-lg-11">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Item</label>  
                            <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;"> 
                                <option value="" selected="">Select item...</option>       
                                <?php $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Medical' ");
                                while ($row = mysqli_fetch_array($getitems)) {
                                    $inventoryitem_id = $row['inventoryitem_id'];
                                    $itemname = $row['itemname'];        
                                ?>     
                                <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="form-group col-lg-6"> 
                            <label>Cost Price</label>   
                            <input type="text" class="form-control" name="price[]" required="required">
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1">
                    <button class="remove_subobj1 btn btn-danger" type="button" style="height:40px;margin-top:22px;padding-top:5px;">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            `); //add input box
            $('.chosen-select').chosen({
                width: "100%"
            });

        });
        $('.subobj3_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj3').append(`
            <div class="row outer">
                <div class="col-lg-12">
                    <hr style="border-top: dashed 1px #b7b9cc;">
                </div>
                <div class="col-lg-11">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Item</label>  
                            <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;"> 
                                <option value="" selected="">Select item...</option>       
                                <?php $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Medicine' ");
                                while ($row = mysqli_fetch_array($getitems)) {
                                    $inventoryitem_id = $row['inventoryitem_id'];
                                    $itemname = $row['itemname'];        
                                ?>     
                                <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="form-group col-lg-6"> 
                            <label>Cost Price</label>   
                            <input type="text" class="form-control" name="price[]" required="required">
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1">
                    <button class="remove_subobj3 btn btn-danger" type="button" style="height:40px;margin-top:22px;padding-top:5px;">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            `); //add input box
            $('.chosen-select').chosen({
                width: "100%"
            });

        });
        $('.subobj3').on("click", ".remove_subobj3", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.outer').remove();
            x--;
        });

        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.outer').remove();
            x--;
        });

        $('.subobj2_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj2').append(`
            <div class="row outer">
                <div class="col-lg-12">
                    <hr style="border-top: dashed 1px #b7b9cc;">
                </div>
                <div class="col-lg-11">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Item</label>  
                            <select data-placeholder="Choose item..." name="products[]" class="chosen-select" style="width:100%;"> 
                                <option value="" selected="">Select item...</option>       
                                <?php $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND type='Non Medical' ");
                                while ($row = mysqli_fetch_array($getitems)) {
                                    $inventoryitem_id = $row['inventoryitem_id'];
                                    $itemname = $row['itemname'];        
                                ?>     
                                <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="form-group col-lg-6"> 
                            <label>Cost Price</label>   
                            <input type="text" class="form-control" name="price[]" required="required">
                        </div>
                    </div> 
                </div>
                <div class="col-lg-1">
                    <button class="remove_subobj2 btn btn-danger" type="button" style="height:40px;margin-top:22px;padding-top:5px;">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            `); //add input box
            $('.chosen-select').chosen({
                width: "100%"
            });

        });

        $('.subobj2').on("click", ".remove_subobj2", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.outer').remove();
            x--;
        });
    </script>
</body>

</html>