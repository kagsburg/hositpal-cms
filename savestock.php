<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'store manager')) {
    header('Location:login.php');
}
if (!isset($_SESSION["bproducts"])) {
    header('Location:addstock');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Save Stock</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
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
                            <h4>Save Stock</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Save stock</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Save New Stock</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION["bproducts"]) && count($_SESSION["bproducts"]) > 0) {
                                    foreach ($_SESSION["bproducts"] as $product) { //loop though items and prepare html content

                                        //set variables to use them in HTML content below
                                        $menuitem = $product["menuitem"];
                                        $item_id = $product["item_id"];
                                        $product_qty = $product["product_qty"];
                                        $expiry = $product["expiry"];
                                        mysqli_query($con, "INSERT INTO stockitems(product_id,quantity,expiry,admin_id,timestamp,status) VALUES('$item_id','$product_qty','$expiry','" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
                                    }
                                    unset($_SESSION["bproducts"]);
                                }
                                ?>
                                <div class="alert alert-success">Stock Successfully Added</div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>

    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
</body>

</html>