<?php
include 'includes/conn.php';
include 'utils/bills.php';
include 'utils/patients.php';
include 'utils/services.php';
$roles = array('admin', 'accountant', 'cashier');
if (!in_array($_SESSION['elcthospitallevel'], $roles)) {
    header('Location:login.php');
}

$paymethod = isset($_GET['id']) ? $_GET['id']: null;
$payment= isset($_GET['type']) ? $_GET['type']: null;

$payments = get_all_bills_patient($pdo, $paymethod,$payment);
$patient = get_patient_by_id($pdo, $paymethod);
$fullname = $patient['fullname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Paid Services</title>
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
                            <h4>Patient Payments</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Patient Payments</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-4 mb-3">
                        <a href="printpaidbills.php?id=<?php echo $paymethod ?>&type=<?php echo $payment ?>" class="btn btn-primary">Print</a>
                       
                        
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Payments for <?php echo $fullname ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example6" class="table  table-bordered display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Service </th>
                                                <!-- <th>Full Names</th>
                                                <th>Gender</th> -->
                                                <th>Room </th>
                                                
                                                <th>Amount</th>
                                                <!-- <th>Payment Mode</th>-->
                                                <!-- <th>Action</th>  -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                   
                                            $total=0;
                                            foreach ($payments as $payment) {
                                                $payment_method = $payment['payment_method'];
                                                $amount = $payment['amount'];
                                                $payment_id = $payment['bill_id'];
                                                $pat = $payment['patient_id'];
                                                $patientsque_id= $payment['patientsque_id'];
                                                $bill_type_id=$payment['type_id'];
                                                
                                                $type = $payment['type'];
                                                $type_id = $payment['type_id'];
                                                $pin = str_pad($payment_id, 4, '0', STR_PAD_LEFT);
                                                
                                                if ($type != "unselective") {
                                                    $type = ucfirst($type);
                                                } else {
                                                    $service = get_service($pdo, $type_id, 2);
                                                    $type = isset($service['name']) ? $service['name'] : "N/A";
                                                }
                                               
                                            
                                             $getroom = mysqli_query($con, "SELECT room from patientsque WHERE patientsque_id='$patientsque_id'");
                                                                                $row23 = mysqli_fetch_array($getroom);
                                                                                $room = $row23['room'];
                                                                                // print_r($type); 
                                                                            if ($type == 'Pharmacy') {
                                                                                $getorder = mysqli_query($con, "SELECT * FROM pharmacyorders WHERE status=0  AND pharmacyorder_id='$bill_type_id'");
                                                                                if (mysqli_num_rows($getorder) > 0){
                                                                                $row1o = mysqli_fetch_array($getorder);
                                                                                $pharmacyorder_id = $row1o['pharmacyorder_id'];
                                                                                $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id'") or die(mysqli_error($con));
                                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                                $item_id = $row['item_id'];
                                                                                $prescription = $row['prescription'];
                                                                                $quantity = $row['quantity'];
                                                                                $getitem = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$item_id'");
                                                                                $row2 = mysqli_fetch_array($getitem);
                                                                                $commercialname = $row2['itemname'];
                                                                                // $dosage = $row2['dosage'];
                                                                                $unitprice = $row2['unitprice'];
                                                                                $subtotal = intval($quantity) * intval($unitprice);
                                                                                $total +=  $subtotal;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $commercialname . ' (' . $prescription . ')' ?></td>
                                                                                    <td><?php echo $room; ?> </td>
                                                                                    <td><?php echo $quantity; ?></td>
                                                                                    <td><?php echo $unitprice; ?></td>
                                                                                    <td><?php echo $subtotal; ?></td>
                                                                                </tr>

                                                                                <?php }}
                                                                            } else if ($type == 'Medical_service') {
                                                                                // print_r($bill_type_id);
                                                                                $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$bill_type_id'");
                                                                                $rowo = mysqli_fetch_array($getorder);
                                                                                $timestamp = $rowo['timestamp'];
                                                                                // $paymethod = $rowo['paymentmethod'];
                                                                                $serviceorder_id = $rowo['serviceorder_id'];
                                                                                $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' ") or die(mysqli_error($con));
                                                                                while ($row = mysqli_fetch_array($getordered)) {
                                                                                $medicalservice_id = $row['medicalservice_id'];
                                                                                $unitcharge = $row['charge'];
                                                                                $total = $total + $unitcharge;
                                                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                                                $row2 = mysqli_fetch_array($getservice);
                                                                                $medicalservice = $row2['medicalservice'];

                                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo $medicalservice; ?></td>
                                                                                    <td><?php echo $room; ?> </td>
                                                                                    <!-- <td>1</td> -->
                                                                                    <!-- <td><?php echo $unitcharge; ?></td> -->
                                                                                    <td><?php echo $unitcharge; ?></td>
                                                                                </tr>
                                                                                <?php
                                                                                }
                                                                            } else if ($type == 'unselective') {
                                                                                
                                                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status=2 AND medicalservice_id='$type_id'");
                                                                                $row2 = mysqli_fetch_array($getservice);
                                                                                $medicalservice = $row2['medicalservice'];
                                                                                $unitcharge = $amount;
                                                                                $total = $total + $unitcharge;

                                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo $medicalservice; ?></td>
                                                                                    <td><?php echo $room; ?> </td>
                                                                                    <!-- <td>1</td>
                                                                                    <td><?php echo $unitcharge; ?></td> -->
                                                                                    <td><?php echo $unitcharge; ?></td>
                                                                                </tr>
                                                                                <?php                        
                                                                            }
                                                                            else if ($type == 'Lab'){
                                                                                $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE laborder_id='$bill_type_id'");
                                                                                if (mysqli_num_rows($getorder) > 0) {
                                                                                    $rowo = mysqli_fetch_array($getorder);
                                                                                    $timestamp = $rowo['timestamp'];
                                                                                    // $paymethod = $rowo['paymentmethod'];
                                                                                    $serviceorder_id = $rowo['laborder_id'];
                                                                                    $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' ") or die(mysqli_error($con));
                                                                                    while ($row = mysqli_fetch_array($getordered)) {
                                                                                        $medicalservice_id = $row['investigationtype_id'];
                                                                                        $unitcharge = $row['charge'];
                                                                                        $total = $total + $unitcharge;
                                                                                        $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                                                        $row2 = mysqli_fetch_array($getservice);
                                                                                        $medicalservice = $row2['investigationtype'];

                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $medicalservice; ?></td>
                                                                                            <td><?php echo $room; ?> </td>
                                                                                            <!-- <td>1</td>
                                                                                            <td><?php echo $unitcharge; ?></td> -->
                                                                                            <td><?php echo $unitcharge; ?></td>
                                                                                        </tr>
                                                                                    <?php }
                                                                                }
                                                                            }else if ($type =="Radiography"){
                                                                                $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE radioorder_id='$bill_type_id'");
                                                                                if (mysqli_num_rows($getorder) > 0) {
                                                                                    $rowo = mysqli_fetch_array($getorder);
                                                                                    $timestamp = $rowo['timestamp'];
                                                                                    // $paymethod = $rowo['paymentmethod'];
                                                                                    $serviceorder_id = $rowo['radioorder_id'];
                                                                                    $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id='$serviceorder_id'") or die(mysqli_error($con));
                                                                                    while ($row = mysqli_fetch_array($getordered)) {
                                                                                        $medicalservice_id = $row['radioinvestigationtype_id'];
                                                                                        $unitcharge = $row['charge'];
                                                                                        $total = $total + $unitcharge;
                                                                                        $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                                                        $row2 = mysqli_fetch_array($getservice);
                                                                                        $medicalservice = $row2['investigationtype'];

                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $medicalservice; ?></td>
                                                                                            <td><?php echo $room; ?> </td>
                                                                                            <!-- <td>1</td>
                                                                                            <td><?php echo $unitcharge; ?></td> -->
                                                                                            <td><?php echo $unitcharge; ?></td>
                                                                                        </tr>
                                                                            <?php }
                                                                                }
                                                                            
                                                                            }else if ($type == "Admission"){
                                                                                // get admission details
                                                                                $getorder = mysqli_query($con, "SELECT * FROM admitted WHERE admitted_id='$bill_type_id'");
                                                                                if (mysqli_num_rows( $getorder) > 0){
                                                                                    $rowo = mysqli_fetch_array($getorder);
                                                                                    // print_r($rowo);
                                                                                    $bed = $rowo['bed_id'];
                                                                                    $price =$rowo['price'];
                                                                                    $total = $total + $price;
                                                                                    $bed_name = mysqli_query($con, "SELECT * FROM beds WHERE bed_id='$bed'");
                                                                                    $row2 = mysqli_fetch_array($bed_name);
                                                                                    $bed_no = $row2['bedname'];
                                                                                    $ward_id = $row2['ward_id'];
                                                                                    $ward_name = mysqli_query($con, "SELECT * FROM wards WHERE ward_id='$ward_id'");
                                                                                    $row3 = mysqli_fetch_array($ward_name);
                                                                                    $ward_no = $row3['wardname'];
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo "Admission"; ?></td>
                                                                                        <td><?php echo $ward_no." ".$bed_no; ?> </td>
                                                                                        <!-- <td>1</td>
                                                                                        <td><?php echo $price; ?></td> -->
                                                                                        <td><?php echo $price; ?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                    
                                                                            }
                                                                            }
                                                                        }

                                                 ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <!-- <td style="border:none">&nbsp;</td>
                                            <td style="border:none">&nbsp;</td> -->
                                            <th colspan="2">TOTAL</th>
                                            <td><?php echo number_format($total); ?></td>
                                            </tr>


                                        </tfoot>
                                    </table>
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
        $(function() {
            $('#paymethod').change(function() {
                var chosenPaymethod = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('paymethod', chosenPaymethod);
                window.location.href = url.href;
            });
        })
    </script>
</body>

</html>