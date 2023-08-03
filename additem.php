<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
$ty = $_GET['ty'];
if (isset($_GET['sub'])) {
    $sub = $_GET['sub'];
} else {
    $sub = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add <?php echo $ty; ?> Item</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

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
                            <h4>Add <?php echo $ty; ?> Item</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="items?ty=<?php echo $ty; ?>"> <?php echo $ty; ?> Items</a></li>
                            <li class="breadcrumb-item active"><a href="additem">Add Item</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add <?php echo $ty; ?> Item</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['itemname'], $_POST['minimum'], $_POST['category'], $_POST['unitmeasurement'])) {

                                        $itemname = mysqli_real_escape_string($con, trim($_POST['itemname']));
                                        $minimum = $_POST['minimum'];
                                        $category = $_POST['category'];
                                        $subcategory = $_POST['subcategory'];
                                        $unitprice = $_POST['unitprice'];
                                        $creditprice = $_POST['creditprice'];
                                        $strength = mysqli_real_escape_string($con, trim($_POST['strength']));
                                        $unitmeasurement = $_POST['unitmeasurement'];
                                        $company = $_POST['company'];
                                        $insurancecharge = $_POST['insurancecharge'];

                                        if (empty($category)) {
                                            $errors[] = 'Type Not Selected';
                                        }

                                        if ((is_numeric($minimum) == FALSE) || ((is_numeric($unitprice) == FALSE)) || ((is_numeric($creditprice) == FALSE))) {
                                            $errors[] = 'Minimum Value or Unit Price or Credit Price should be Numeric';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                    ?>
                                                <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php
                                            }
                                        } else {
                                            $sub = $subcategory;
                                            $additem =  mysqli_query($con, "INSERT INTO inventoryitems(itemname,measurement_id,minimum,unitprice,creditprice,strength,subcategory_id,type,timestamp,status) VALUES('$itemname','$unitmeasurement','$minimum','$unitprice','$creditprice','$strength','$sub','$ty','$timenow','1')") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);
                                            $companies = sizeof($company);
                                            for ($i = 0; $i < $companies; $i++) {
                                                if (!empty($company[$i])) {
                                                    mysqli_query($con, "INSERT INTO insuredinventoryitems(inventoryitem_id,insurancecompany_id,charge,status) VALUES('$last_id','$company[$i]','$insurancecharge[$i]','1')") or die(mysqli_error($con));
                                                }
                                            }
                                            echo '<div class="alert alert-success">Item Successfully Added</div>';
                                        }
                                    }
                                    ?>

                                    <form method="post" name='form' class="form" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="control-label">* Item Name</label>
                                            <input type="text" name='itemname' class="form-control" placeholder="Enter item name" required="required">
                                        </div>
                                        <div class="form-group"><label class="control-label">*<?php echo $ty; ?> Category</label>
                                            <select name="category" class="form-control" id="category">
                                                <option value="">select category...</option>
                                                <?php
                                                if ($ty == "Medicine"){
                                                    $type = $ty;
                                                }else{
                                                    $type = $ty . ' items';
                                                }
                                                $getcats =  mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND type='$type'");
                                                while ($row1 =  mysqli_fetch_array($getcats)) {
                                                    $itemcategory_id = $row1['itemcategory_id'];
                                                    $category = $row1['category'];
                                                ?>
                                                    <option value="<?php echo $itemcategory_id; ?>"><?php echo $category; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="name1">Sub Category</label>
                                            <div class="controls">
                                                <select id="subcategoryname" class="form-control">
                                                    <option value="">Select Sub Category...</option>
                                                </select>
                                                
                                                <select name="subcategory" id="subcategories" class="form-control" style="display: none;">
                                                    <option value="">Select Sub Category...</option>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group" <?php if ($ty != 'Medicine') { ?>style="display:none" <?php } ?>>
                                            <label class="control-label">Strength</label>
                                            <input type="text" name="strength" class="form-control" placeholder="Enter Strength">
                                        </div>
                                        <div class="form-group" ><label class="control-label">*Measurement unit</label>
                                            <select name="unitmeasurement" class="form-control">
                                                <option value="">select Measurement...</option>
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
                                        
                                        
                                        <div class="form-group"><label class="control-label">*Minimum re-order point</label>
                                            <input type="number" name='minimum' class="form-control" placeholder="Enter Minimum re-order point" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">*Price Per Unit</label>
                                            <input type="text" name='unitprice' class="form-control" placeholder="Enter Price per Unit" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Price</label>
                                            <input type="text" class="form-control" name="creditprice" placeholder="Enter price for credit clients">
                                        </div>
                                        <p><strong>Add Insurance Charges</strong></p>

                                        <div class='subobj'>
                                            <div class='row'>
                                                <div class="form-group col-lg-6">
                                                    <label>Insurance company</label>
                                                    <select name="company[]" class="form-control">
                                                        <option value="">Select company...</option>
                                                        <?php
                                                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                                            $insurancecompany_id = $row1['insurancecompany_id'];
                                                            $company = $row1['company'];
                                                        ?>
                                                            <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-5"><label class="control-label">Charge</label>
                                                    <input type="number" name='insurancecharge[]' class="form-control" placeholder="Enter Service Price">
                                                </div>

                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Add Item</button>
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
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('#subcategoryname').click(function() {
            if ($('#category').val() === '') {
                alert("Please Select a Category First");
            }
        });

        var subcategories = [
            <?php
            $cats = mysqli_query($con, "SELECT * FROM subcategories WHERE status = 1");
            while ($row1 = mysqli_fetch_assoc($cats))
                echo json_encode($row1) . ",";
            ?>
        ];
            
        $('#category').change(function() {
            var cat = $(this).val();
            if (cat !== '') {
                //        $(this).closest("form").attr('action',  $(this).val());
                $("#subcategoryname").hide();
                $("#subcategories").show();

                $('#subcategories').html('<option value="" selected="selected">Select Sub Category...</option>');
                var filtered = subcategories.filter(c => c.category_id == cat)
                filtered.forEach(function(row) {
                    $('#subcategories').append($("<option>").text(row.subcategory).val(row.subcategory_id));
                });

            } else {
                $("#subcategoryname").show();
                //          	 $(this).closest("form").attr('action',  $('#subcategoryname').val());                  
                $("#subcategories").val("");
                $("#subcategories").hide();

            }
        });

        $('.subobj_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj').append(`<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6">                                 <label>Insurance company</label>   <select name="company[]" class="form-control"> <option value="">Select company...</option>  <?php $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                                                                                                                                                                                                                                                                                                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {                                                                                                                                                                                                                                                                                                                                               $insurancecompany_id = $row1['insurancecompany_id'];
                                                                                                                                                                                                                                                                                                                                                                            $company = $row1['company'];           ?>    <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>                       <?php } ?>                       </select>   </div><div class="form-group col-lg-6"><label class="control-label">Charge</label>                   <input type="number" name="insurancecharge[]" class="form-control" placeholder="Enter Service Price"></div></div></div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>`); //add input box
        });
        $('.subobj').on("click", ".remove_subobj", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    </script>
</body>

</html>