<?php
include 'includes/conn.php';
include 'utils/bills.php';
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
                    // $bill = get_bill_by_id($pdo, $id, 2);
                    $bill=get_bill_by_patient_only($pdo, $id,2); 
                    if (empty($bill)) {
                      $bill = get_bill_by_id($pdo, $id, 8);                      
                    }
                    $patient_id = $bill[0]['patient_id'];
                    $admission_id = $bill[0]['admission_id'];
                    $type = $bill[0]['type'];
                    // $amount = $bill['amount'];
                    // $status = $bill['status'];
                    $type_id = $bill[0]['type_id'];
                    $paymethod = $bill[0]['payment_method'];
                    $room = $type;

                    
                    $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status IN ('1', '3') AND patient_id='$patient_id'");
                    $row2 = mysqli_fetch_array($getpatient);
                    $firstname = $row2['firstname'];
                    $secondname = $row2['secondname'];
                    $thirdname = $row2['thirdname'];
                    $gender = $row2['gender'];
                    $insurancecompany = $row2['insurancecompany'];

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

                    ?>

                  </div>
                  <h1 class="text-center" style="font-family:Times New roman;color: #000"> <strong>PATIENT INVOICE</strong></h1>
                  <hr>

                  <div class="row">
                    <div class="col-sm-4">

                      <strong style="font-family:Times New roman">Billed To:</strong>
                      <address style="font-family:Times New roman; font-size:30px;">
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
                          if ($type == 'medical_service') {
                            $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$type_id'");
                            $rowo = mysqli_fetch_array($getorder);
                            $serviceorder_id = $rowo['serviceorder_id'];
                          }
                          $timestamp = $rowo['timestamp'];
                          // die($insurancecompany);
                          $insurer = !empty($rowo['insurer']) ? $rowo['insurer'] : (!empty($insurancecompany) ? $insurancecompany : 0);
                          if ($insurer > 0 && $paymethod == "insurance") {
                            // $percentage = $rowo['percentage'];
                            $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1 AND insurancecompany_id='$insurer'");
                            $row1 =  mysqli_fetch_array($getcompanies);
                            $insurancecompany_id = $row1['insurancecompany_id'];
                            $company = $row1['company'];
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
                            <td><?php if ($paymethod == "cash") {
                                  echo 'CASH';
                                } else if ($paymethod == "insurance") {
                                  echo 'INSURANCE';
                                } else if ($paymethod == "credit") {
                                  echo 'CREDIT';
                                } else {
                                  echo 'OTHER';
                                }
                                ?></td>
                          </tr>
                          <?php if ($insurer > 0 && $paymethod == "insurance") { ?>
                            <tr>
                              <th>Company</th>
                              <td><?php echo $company ; ?></td>
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
                        <th scope="col">ROOM</th>
                        <th scope="col">QTY</th>
                        <th scope="col">RATE </th>
                        <th scope="col">SUB TOTAL</th>
                      </tr>
                      <?php
                      $total = 0;
                      $subtotal = 0;
                      $count = 0;
                      foreach($bill as $b) {
                        // print_r($b);
                        $type = $b['type'];
                        $bill_type_id = $b['type_id'];
                        $type_id = $b['type_id'];
                        $amount = $b['amount'];
                        $status = $b['status'];
                        $patientque_id = $b['patientsque_id'];
                                                    $getroom = mysqli_query($con, "SELECT room from patientsque WHERE patientsque_id='$patientque_id'");
                                                    $row23 = mysqli_fetch_array($getroom);
                                                    $room = $row23['room'];
                        // print_r($type); 
                        echo "<br>";
                      if ($type == 'pharmacy') {
                        $getorder = mysqli_query($con, "SELECT * FROM pharmacyorders WHERE status=0  AND pharmacyorder_id='$bill_type_id'");
                        if (mysqli_num_rows($getorder) > 0){
                        $row1o = mysqli_fetch_array($getorder);
                        $pharmacyorder_id = $row1o['pharmacyorder_id'];
                        $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id' AND status=2") or die(mysqli_error($con));
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
                      } else if ($type == 'medical_service') {

                        $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$bill_type_id'");
                        $rowo = mysqli_fetch_array($getorder);
                        $timestamp = $rowo['timestamp'];
                        // $paymethod = $rowo['paymentmethod'];
                        $serviceorder_id = $rowo['serviceorder_id'];
                        $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=2") or die(mysqli_error($con));
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
                            <td>1</td>
                            <td><?php echo $unitcharge; ?></td>
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
                            <td>1</td>
                            <td><?php echo $unitcharge; ?></td>
                            <td><?php echo $unitcharge; ?></td>
                          </tr>
                        <?php                        
                      }
                      else if ($type == 'lab'){
                        $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE laborder_id='$bill_type_id'");
                        if (mysqli_num_rows($getorder) > 0) {
                            $rowo = mysqli_fetch_array($getorder);
                            $timestamp = $rowo['timestamp'];
                            // $paymethod = $rowo['paymentmethod'];
                            $serviceorder_id = $rowo['laborder_id'];
                            $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status=2") or die(mysqli_error($con));
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
                                    <td>1</td>
                                    <td><?php echo $unitcharge; ?></td>
                                    <td><?php echo $unitcharge; ?></td>
                                </tr>
                            <?php }
                        }
                      }else if ($type =="radiography"){
                        $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE radioorder_id='$bill_type_id'");
                        if (mysqli_num_rows($getorder) > 0) {
                            $rowo = mysqli_fetch_array($getorder);
                            $timestamp = $rowo['timestamp'];
                            // $paymethod = $rowo['paymentmethod'];
                            $serviceorder_id = $rowo['radioorder_id'];
                            $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id='$serviceorder_id' AND status=2") or die(mysqli_error($con));
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
                                    <td>1</td>
                                    <td><?php echo $unitcharge; ?></td>
                                    <td><?php echo $unitcharge; ?></td>
                                </tr>
                    <?php }
                        }
                    
                      }else if ($type == "admission"){
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
                                <td>1</td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $price; ?></td>
                            </tr>
                            <?php
                            
                      }
                    }
                    }
                      if (false && $insurer > 0 && $paymethod == "insurance") {
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
                          <th colspan="2">TOTAL</th>
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