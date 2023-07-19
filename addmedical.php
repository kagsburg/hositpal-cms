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
    <title>Add Item</title>
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
                            <h4>Add Item</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="medical">Medical Items</a></li>
                            <li class="breadcrumb-item active"><a href="additem">Add Item</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Item</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">


                                    <form method="post" name='form' class="form" enctype="multipart/form-data">

                                        <div class="form-group"><label class="control-label">* Trade Name</label>
                                            <input type="text" name='tradename' class="form-control" placeholder="Enter trade name" required="required">
                                        </div>
                                        <div class="form-group"><label class="control-label">* Generic Name</label>
                                            <input type="text" name='genericname' class="form-control" placeholder="Enter generic name" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="name1">Category</label>
                                            <div class="controls">
                                                <select name="category" class="form-control" id="category">
                                                    <option value="">select category...</option>
                                                    <?php
                                                    $getcats =  mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND type='Medical items'");
                                                    while ($row1 =  mysqli_fetch_array($getcats)) {
                                                        $itemcategory_id = $row1['itemcategory_id'];
                                                        $category = $row1['category'];
                                                    ?>
                                                        <option value="<?php echo $itemcategory_id; ?>"><?php echo $category; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label class="control-label" for="name1">Sub Category</label>
                                            <div class="controls">
                                                <select name="subcategoryname" id="subcategoryname" class="form-control">
                                                    <option value="">Select Sub Category...</option>
                                                </select>
                                                <?php
                                                $getcats =  mysqli_query($con, "SELECT * FROM itemcategories WHERE status=1 AND type='Medical items'");
                                                while ($row =  mysqli_fetch_array($getcats)) {
                                                    $itemcategory_id = $row['itemcategory_id'];
                                                ?>

                                                    <select name="subcategory" id="subcategory<?php echo $itemcategory_id; ?>" style="display:none;" class="subcategories form-control">
                                                        <option value="">Select Sub Category ...</option>
                                                        <?php
                                                        $getsubs =  mysqli_query($con, "SELECT * FROM subcategories WHERE status=1 AND category_id='$itemcategory_id'");
                                                        while ($row1 =  mysqli_fetch_array($getsubs)) {
                                                            $subcategory_id = $row1['subcategory_id'];
                                                            $subcategory = $row1['subcategory'];
                                                        ?>
                                                            <option value="savemedical?sub=<?php echo $subcategory_id; ?>"><?php echo $subcategory; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } ?>

                                            </div>
                                        </div>


                                        <div class="form-group"><label class="control-label">*Measurement unit</label>
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
                                        <div class="form-group"><label class="control-label">*Price Per Unit</label>
                                            <input type="text" name='unitprice' class="form-control" placeholder="Enter Price per Unit" required="required">
                                        </div>
                                        <div class="form-group"><label class="control-label">*Minimum re-order point</label>
                                            <input type="number" name='minimum' class="form-control" placeholder="Enter Minimum re-order point" required="required">
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
    <script type="text/javascript">
        $('#subcategoryname').click(function() {
            if ($('#category').val() === '') {
                alert("Please Select a Category First");
            }
        });

        $('#category').change(function() {
            if ($(this).val() !== '') {
                //        $(this).closest("form").attr('action',  $(this).val());
                $("#subcategoryname").hide();
                $(".subcategories").each(function(index) {

                    // console.log(this.id);
                    $("#" + this.id).hide();


                });

                $("#subcategory" + $('#category').val()).show();
                var townid = $("subcategory" + $('#category').val());
                $('.subcategories').change(function() {
                    $(this).closest("form").attr('action', $(this).val());
                });
            } else {

                $("#subcategoryname").show();
                $(".categories").hide();

            }
        });
    </script>
</body>

</html>