<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$startdate = strtotime($_GET['st']);
$enddate =  strtotime($_GET['en']);
$sec = $_GET['sec'];
$getcategories =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$sec'");
$row1 =  mysqli_fetch_array($getcategories);
$servicecategory_id = $row1['servicecategory_id'];
$servicecategory = $row1['servicecategory'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $servicecategory; ?> Income Report between <?php echo date('d/M/Y', $startdate); ?> and <?php echo date('d/M/Y', $enddate); ?></title>
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
        if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
            include 'fr/incomereport.php';
        } else {

        ?>

            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4><?php echo $servicecategory; ?> Income Report between <?php echo date('d/M/Y', $startdate); ?> and <?php echo date('d/M/Y', $enddate); ?></h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="getincomereport">Get Report</a></li>
                                <li class="breadcrumb-item active"><a href="#">Income Report</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="incomereportprint?st=<?php echo $startdate; ?>&&en=<?php echo $enddate; ?>&&sec=<?php echo $sec; ?>" class="btn btn-success mb-2" target="_blank">PRINT</a>
                            <a href="incomereportexcel?st=<?php echo $startdate; ?>&&en=<?php echo $enddate; ?>&&sec=<?php echo $sec; ?>" class="btn btn-info mb-2">EXPORT TO EXCEL</a>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?php echo $servicecategory; ?> Income Report between <?php echo date('d/M/Y', $startdate); ?> and <?php echo date('d/M/Y', $enddate); ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table id="example5" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Section</th>
                                                    <th>Income</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                if ($sec == 'all') {
                                                    $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
                                                    while ($rowo = mysqli_fetch_array($getorder)) {
                                                        $timestamp = $rowo['timestamp'];
                                                        $patientsque_id = $rowo['patientsque_id'];
                                                        $serviceorder_id = $rowo['serviceorder_id'];
                                                        $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE  payment=1 AND patientsque_id='$patientsque_id'");
                                                        $row = mysqli_fetch_array($getque);
                                                        $patientsque_id = $row['patientsque_id'];
                                                        $admission_id = $row['admission_id'];
                                                        $room = $row['room'];
                                                        $admin_id = $row['admin_id'];
                                                        $attendant = $row['attendant'];
                                                        $getcategory =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$room'");
                                                        $row4 =  mysqli_fetch_array($getcategory);
                                                        $servicecategory = $row4['servicecategory'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        $totalcharge = 0;
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $medicalservice_id = $row['medicalservice_id'];
                                                            $unitcharge = $row['charge'];
                                                            $totalcharge = $totalcharge + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status IN (1,2) AND medicalservice_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['medicalservice'];
                                                        }
                                                        $total = $totalcharge + $total;
                                                ?>
                                                        <tr class="gradeA">
                                                            <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                            <td><?php echo $servicecategory; ?></td>

                                                            <td><?php echo $totalcharge; ?></td>

                                                        </tr>

                                                    <?php  }
                                                    $pharmacytotal = 0;
                                                    $getorder = mysqli_query($con, "SELECT * FROM pharmacyorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
                                                    while ($rowo = mysqli_fetch_array($getorder)) {
                                                        $timestamp = $rowo['timestamp'];
                                                        $pharmacyorder_id = $rowo['pharmacyorder_id'];
                                                        $patientsque_id = $rowo['patientsque_id'];
                                                        $ordertotal = 0;
                                                        $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $item = $row['item_id'];
                                                            $prescription = $row['prescription'];
                                                            $quantity = $row['quantity'];
                                                            $split = explode('_', $item);
                                                            $item_id = current($split);
                                                            $unitprice = end($split);
                                                            $ordertotal = $ordertotal + ($unitprice * $quantity);
                                                        }
                                                        $pharmacytotal = $pharmacytotal + $ordertotal;
                                                    ?>
                                                        <tr class="gradeA">
                                                            <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                            <td>PHARMACIE</td>

                                                            <td><?php echo $ordertotal; ?></td>

                                                        </tr>
                                                    <?php    }
                                                    $ambulanttotal = 0;
                                                    $getambulantorders = mysqli_query($con, "SELECT * FROM ambulantorders WHERE status=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'") or die(mysqli_error($con));
                                                    while ($rowa = mysqli_fetch_array($getambulantorders)) {
                                                        $ambulantorder_id = $rowa['ambulantorder_id'];
                                                        $ambulantsubtotal = 0;
                                                        $getproducts = mysqli_query($con, "SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$ambulantorder_id' AND status=1");
                                                        while ($row1 = mysqli_fetch_array($getproducts)) {
                                                            $ambulantordereditem_id = $row1['ambulantordereditem_id'];
                                                            $item_id = $row1['item_id'];
                                                            $quantity = $row1['quantity'];
                                                            $cpfigure = $row1['cpfigure'];
                                                            $unitprice = $row1['unitprice'];
                                                            $subtotal = $quantity * $unitprice;
                                                            $ambulantsubtotal = $subtotal + $ambulantsubtotal;
                                                        }
                                                        $ambulanttotal = $ambulanttotal + $ambulantsubtotal;
                                                    ?>
                                                        <tr class="gradeA">
                                                            <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                            <td>PHARMACIE</td>

                                                            <td><?php echo $ambulantsubtotal; ?></td>
                                                        </tr>
                                                        <?php  }
                                                } else {
                                                    $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
                                                    while ($rowo = mysqli_fetch_array($getorder)) {
                                                        $timestamp = $rowo['timestamp'];
                                                        $patientsque_id = $rowo['patientsque_id'];
                                                        $serviceorder_id = $rowo['serviceorder_id'];
                                                        $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE  payment=1 AND patientsque_id='$patientsque_id' AND room='$sec'");
                                                        if (mysqli_num_rows($getque) > 0) {
                                                            $row = mysqli_fetch_array($getque);
                                                            $patientsque_id = $row['patientsque_id'];
                                                            $admission_id = $row['admission_id'];
                                                            $room = $row['room'];
                                                            $admin_id = $row['admin_id'];
                                                            $attendant = $row['attendant'];
                                                            $getcategory =  mysqli_query($con, "SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$room'");
                                                            $row4 =  mysqli_fetch_array($getcategory);
                                                            $servicecategory = $row4['servicecategory'];
                                                            $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                            $totalcharge = 0;
                                                            while ($row = mysqli_fetch_array($getordered)) {
                                                                $medicalservice_id = $row['medicalservice_id'];
                                                                $unitcharge = $row['charge'];
                                                                $totalcharge = $totalcharge + $unitcharge;
                                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                                $row2 = mysqli_fetch_array($getservice);
                                                                $medicalservice = $row2['medicalservice'];
                                                            }
                                                            $total = $totalcharge + $total;
                                                        ?>
                                                            <tr class="gradeA">
                                                                <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                                <td><?php echo $servicecategory; ?></td>
                                                                <td><?php echo $totalcharge; ?></td>
                                                            </tr>
                                                        <?php   }
                                                    }
                                                    $pharmacytotal = 0;
                                                    $ambulanttotal = 0;
                                                    if ($sec == 17) {
                                                        $getorder = mysqli_query($con, "SELECT * FROM pharmacyorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
                                                        while ($rowo = mysqli_fetch_array($getorder)) {
                                                            $timestamp = $rowo['timestamp'];
                                                            $pharmacyorder_id = $rowo['pharmacyorder_id'];
                                                            $patientsque_id = $rowo['patientsque_id'];
                                                            $ordertotal = 0;
                                                            $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id' AND status=1") or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($getordered)) {
                                                                $item = $row['item_id'];
                                                                $prescription = $row['prescription'];
                                                                $quantity = $row['quantity'];
                                                                $split = explode('_', $item);
                                                                $item_id = current($split);
                                                                $unitprice = end($split);
                                                                $ordertotal = $ordertotal + ($unitprice * $quantity);
                                                            }
                                                            $pharmacytotal = $pharmacytotal + $ordertotal;
                                                        ?>
                                                            <tr class="gradeA">
                                                                <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                                <td>PHARMACIE</td>

                                                                <td><?php echo $ordertotal; ?></td>

                                                            </tr>
                                                        <?php    }
                                                        $getambulantorders = mysqli_query($con, "SELECT * FROM ambulantorders WHERE status=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'") or die(mysqli_error($con));
                                                        while ($rowa = mysqli_fetch_array($getambulantorders)) {
                                                            $ambulantorder_id = $rowa['ambulantorder_id'];
                                                            $ambulantsubtotal = 0;
                                                            $getproducts = mysqli_query($con, "SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$ambulantorder_id' AND status=1");
                                                            while ($row1 = mysqli_fetch_array($getproducts)) {
                                                                $ambulantordereditem_id = $row1['ambulantordereditem_id'];
                                                                $item_id = $row1['item_id'];
                                                                $quantity = $row1['quantity'];
                                                                $cpfigure = $row1['cpfigure'];
                                                                $unitprice = $row1['unitprice'];
                                                                $subtotal = $quantity * $unitprice;
                                                                $ambulantsubtotal = $subtotal + $ambulantsubtotal;
                                                            }
                                                            $ambulanttotal = $ambulanttotal + $ambulantsubtotal;
                                                        ?>
                                                            <tr class="gradeA">
                                                                <td><?php echo date('d/M/Y', $timestamp); ?></td>
                                                                <td>PHARMACIE</td>

                                                                <td><?php echo $ambulantsubtotal; ?></td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <th>TOTAL</th>
                                                <td>&nbsp;</td>
                                                <td><?php echo number_format($total + $pharmacytotal + $ambulanttotal); ?></td>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
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

</body>

</html>