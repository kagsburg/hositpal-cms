<?php
include 'includes/conn.php';
include 'utils/patients.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Patient Invoice</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet" media="print">

</head>

<style>
    body {
        font-size: 18px;
        color: #000;
        font-family: "Times New Roman"
    }

    .table.table-bordered td,
    .table.table-bordered th {
        border-color: #000000;
        font-family: "Times New Roman"
    }

    .table td,
    .table th {
        color: #000;
        font-size: 18px;
        font-family: "Times New Roman"
    }

    .table th {
        font-weight: bold;
        font-family: "Times New Roman";
    }

    @media screen {

        body {
            /*margin: 2em;*/
            color: #fff;

        }

    }

    /* print styles */
    @media print {

        body {
            margin: 0;
            color: #000;
            background-color: #fff;
        }

    }
</style>


<body>

    <div class="row">
        <div class="col-lg-12" style="width:800px;margin:auto">
            <div class="section-body">
                <div class="invoice">
                    <?php
                    if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
                        include 'fr/paymentinvoice.php';
                    } else {
                    ?>
                        <div class="invoice-print">
                            <div class="row">
                                <div class="col-lg-12">
                                    <img alt="image" src="<?php echo BASE_URL; ?>/images/logo.png" width="100" />
                                    <div class="row">
                                        <?php
                                        $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='1' AND patient_id='$id'");
                                        $row2 = mysqli_fetch_array($getpatient);
                                        $patient_id = $row2['patient_id'];
                                        $firstname = $row2['firstname'];
                                        $secondname = $row2['secondname'];
                                        $thirdname = $row2['thirdname'];
                                        $gender = $row2['gender'];
                                        // $paymenttype = $row2['paymenttype'];
                                        $policyidnumber = $row2['policyidnumber'];
                                        $paymenttype = get_payment_method($con, $id);
                                        $insurance_id = $row2['insurancecompany'];
                                        if ($paymenttype == "insurance" && isset($insurance_id)) {
                                            $getinsurance = mysqli_query($con, "SELECT * FROM insurancecompanies WHERE insurancecompany_id='$insurance_id'") or die(mysqli_error($con));
                                            $insurance_row = mysqli_fetch_array($getinsurance);
                                            $insurancecompany = $insurance_row['company'];
                                        } else {
                                            $insurancecompany = "";
                                        }
                                        if (strlen($patient_id) == 1) {
                                            $pin = '000' . $patient_id;
                                        }
                                        if (strlen($patient_id) == 2) {
                                            $pin = '00' . $patient_id;
                                        }
                                        if (strlen($patient_id) == 3) {
                                            $pin = '0' . $patient_id;
                                        }
                                        if (strlen($patient_id) >= 4) {
                                            $pin = $patient_id;
                                        }
                                        // $getactsreport = mysqli_query($con, "SELECT * FROM acts WHERE patientsque_id='$patientsque_id'");
                                        ?>

                                    </div>
                                    <h1 class="text-center" style="font-family:Times New roman;color: #000"> <strong>PATIENT INVOICE</strong></h1>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-4">

                                            <strong style="font-family:Times New roman">Billed To:</strong>
                                            <address style="font-family:Times New roman">
                                                <?php echo $firstname . ' ' . $secondname . ' ' . $thirdname; ?><br>
                                                <?php echo '#' . $pin; ?><br>

                                            </address>

                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-5 pull-right" style="width:400px">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <?php
                                                    if (strlen($id) == 1) {
                                                        $pin2 = '000' . $id;
                                                    }
                                                    if (strlen($id) == 2) {
                                                        $pin2 = '00' . $id;
                                                    }
                                                    if (strlen($id) == 3) {
                                                        $pin2 = '0' . $id;
                                                    }
                                                    if (strlen($id) >= 4) {
                                                        $pin2 = $id;
                                                    }

                                                    
                                                    ?>
                                                    <tr>
                                                        <th>Date</th>
                                                        <td><?php echo date('d M Y', $timestamp); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Invoice No</th>
                                                        <td><?php echo $pin2; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Payment Method</th>
                                                        <td><?php if ($insurer == 0) {
                                                                echo 'CASH';
                                                            } else {
                                                                echo 'INSURANCE';
                                                            } ?></td>
                                                    </tr>
                                                    <?php if (!empty($insurance_id)) { ?>
                                                        <tr>
                                                            <th>Company</th>
                                                            <td><?php echo $insurancecompany . '(' . $percentage . '%)'; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table  table-bordered">
                                            <tr>
                                                <th scope="col">ITEM</th>
                                                <th scope="col">QTY</th>
                                                <th scope="col">RATE (TSHS)</th>
                                                <th scope="col">SUB TOTAL (TSHS)</th>
                                            </tr>
                                            <?php
                                            $total = 0;
                                            $subtotal = 0;
                                            $count = 0;

                                            $serviceorder_id = REGISTRATION_SERVICE_ID;
                                            $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE  patientsque_id='$id'");
                            $rowo = mysqli_fetch_array($getorder);
                            $serviceorder_id = $rowo['serviceorder_id'];
                                            $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($getordered)) {
                                                $medicalservice_id = $row['medicalservice_id'];
                                                echo $medicalservice_id;
                                                $unitcharge = $row['charge'];
                                                $total = $total + $unitcharge;
                                                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status IN (1,2) AND medicalservice_id='$medicalservice_id'");
                                                $row2 = mysqli_fetch_array($getservice);
                                                $medicalservice = $row2['medicalservice'];

                                            ?>
                                                <tr>
                                                    <td><?php echo $medicalservice; ?></td>
                                                    <td>1</td>
                                                    <td><?php echo $unitcharge; ?></td>
                                                    <td><?php echo $unitcharge; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            if ($insurer > 0) {
                                            ?>
                                                <tr>
                                                    <td style="border:none">&nbsp;</td>
                                                    <td style="border:none">&nbsp;</td>
                                                    <th>INSURANCE</th>
                                                    <td><?php $insurance = ($percentage * $total) / 100;
                                                        echo '-' . $insurance; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none">&nbsp;</td>
                                                    <td style="border:none">&nbsp;</td>
                                                    <th>TOTAL</th>
                                                    <td><?php echo number_format($total - $insurance); ?></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td style="border:none">&nbsp;</td>
                                                    <td style="border:none">&nbsp;</td>
                                                    <th>TOTAL</th>
                                                    <td><?php echo number_format($total); ?></td>
                                                </tr>

                                            <?php } ?>
                                        </table>
                                    </div>
                                    <p class="mt-4" style="font-family:Times New roman">@<?php echo date('Y', time()) ?>. All Rights Reserved to ELCT-ELVD Nyakato health Center</p>
                                </div>

                            </div>
                            <hr>

                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>

        <script src="vendor/global/global.min.js"></script>
        <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="vendor/chart.js/Chart.bundle.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/deznav-init.js"></script>
        <script src="vendor/apexchart/apexchart.js"></script>
        <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="js/plugins-init/datatables.init.js"></script>

        <script type="text/javascript">
            window.print();
        </script>
</body>

</html>