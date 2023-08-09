<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'insurance officer')) {
    header('Location:login.php');
}
if (!isset($_SESSION["bproducts"])) {
    header('Location:addissurequisition?ty=Non Medical');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Selected Items</title>
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
                            <h4>Selected Items</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Request stock</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Selected Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                        <form method="GET" name='form' class="form" action="requestissstock" enctype="multipart/form-data">
                           
                            <a href="cancelstocklist" class="btn btn-danger" onclick="return confirm_cancel()">CANCEL</a>
                            <button class="btn btn-info" type="submit">SUBMIT</button>
                        </form>
                        <script type="text/javascript">
                            function confirm_cancel() {
                                return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                            }
                        </script>
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
    <script>
        $('.reason').on('change', function() {
            var getselect = $(this).val();
            if ((getselect == 'patient')) {
                $('.admitted').show();
            } else {
                $('.admitted').hide();
            }
        });
    </script>

    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>