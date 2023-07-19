<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
  header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Pending Ambulant Orders</title>
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
      include 'fr/pendingambulantorders.php';
    } else {
    ?>

      <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
          <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
              <div class="welcome-text">
                <h4>Pending Ambulant Order Payments</h4>

              </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item active"><a href="pendingambulantorders">Pending Orders</a></li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Pending Order Payments</h4>
                </div>
                <div class="card-body">
                  <table id="example5" class="display" style="min-width: 645px">
                    <thead>
                      <tr>
                        <th>Order No</th>
                        <th>Patient Name</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $getorders = mysqli_query($con, "SELECT * FROM ambulantorders WHERE status=0") or die(mysqli_error($con));
                      while ($row = mysqli_fetch_array($getorders)) {
                        $ambulantorder_id = $row['ambulantorder_id'];
                        $patientname = $row['patientname'];
                        $timestamp = $row['timestamp'];
                        if (strlen($ambulantorder_id) == 1) {
                          $pin = '000' . $ambulantorder_id;
                        }
                        if (strlen($ambulantorder_id) == 2) {
                          $pin = '00' . $ambulantorder_id;
                        }
                        if (strlen($ambulantorder_id) == 3) {
                          $pin = '0' . $ambulantorder_id;
                        }
                        if (strlen($ambulantorder_id) >= 4) {
                          $pin = $ambulantorder_id;
                        }
                      ?>
                        <tr>
                          <td>#<?php echo $pin; ?></td>
                          <td><?php echo $patientname; ?></td>
                          <td><?php echo date('d/M/Y', $timestamp); ?></td>
                          <td>
                            <button data-toggle="modal" data-target="#basicModal<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-info">View Details</button>
                            <?php
                            $forcashier = mysqli_query($con, "SELECT * FROM staffdepts WHERE staff_id='" . $_SESSION['elcthospitaladmin'] . "' AND servicecategory_id=27 AND status=1");
                            if (mysqli_num_rows($forcashier) > 0) {
                            ?>
                              <a href="ambulantorderpayment?id=<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-primary" onclick="return confirm_payment<?php echo $ambulantorder_id; ?>()">Approve Payment</a>
                              <script type="text/javascript">
                                function confirm_payment<?php echo $ambulantorder_id; ?>() {
                                  return confirm('You are about To Approve order payment. Are you sure you want to proceed?');
                                }
                              </script>
                            <?php } ?>
                            <a href="removeambulantorder?id=<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $ambulantorder_id; ?>()">Remove</a>
                            <script type="text/javascript">
                              function confirm_delete<?php echo $ambulantorder_id; ?>() {
                                return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                              }
                            </script>
                          </td>
                        </tr>

                      <?php } ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php
    $getorders = mysqli_query($con, "SELECT * FROM ambulantorders WHERE status=1") or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($getorders)) {
      $ambulantorder_id = $row['ambulantorder_id'];
    ?>
      <div class="modal fade" id="basicModal<?php echo $ambulantorder_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table  table-bordered table-striped">
                  <tr>
                    <th scope="col">ITEM</th>
                    <th scope="col">CP FIGURE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">RATE (BIF)</th>
                    <th scope="col">SUB TOTAL (BIF)</th>
                  </tr>
                  <?php
                  $total = 0;
                  $subtotal = 0;
                  $count = 0;
                  $getproducts = mysqli_query($con, "SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$ambulantorder_id' AND status=1");
                  while ($row1 = mysqli_fetch_array($getproducts)) {
                    $ambulantordereditem_id = $row1['ambulantordereditem_id'];
                    $item_id = $row1['item_id'];
                    $quantity = $row1['quantity'];
                    $cpfigure = $row1['cpfigure'];
                    $unitprice = $row1['unitprice'];
                    $subtotal = $quantity * $unitprice;
                    $total = $subtotal + $total;
                    $count = $count + 1;
                    $getitem = mysqli_query($con, "SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item_id'");
                    $row = mysqli_fetch_array($getitem);
                    $pharmacyitem_id = $row['pharmacyitem_id'];
                    $genericname = $row['genericname'];
                    $commercialname = $row['commercialname'];
                    $dosage = $row['dosage'];
                    $pharmaceuticalform_id = $row['pharmaceuticalform_id'];
                    $getcats =  mysqli_query($con, "SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                    $row2 =  mysqli_fetch_array($getcats);
                    $pharmaceuticalform = $row2['pharmaceuticalform'];
                  ?>
                    <tr>
                      <td><?php echo $commercialname . '( ' . $pharmaceuticalform . ')'; ?></td>
                      <td><?php echo $cpfigure; ?></td>
                      <td><?php echo $quantity; ?></td>
                      <td> <?php echo $unitprice; ?></td>
                      <td><?php echo number_format($subtotal); ?></td>

                    </tr>
                  <?php }


                  ?>
                  <tr>
                    <td style="border:none">&nbsp;</td>
                    <td style="border:none">&nbsp;</td>
                    <td style="border:none">&nbsp;</td>
                    <th>TOTAL</th>
                    <td><?php echo number_format($total); ?></td>
                  </tr>
                  <tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
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