<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
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
    <title> Print Requisition Orders</title>
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

     
        <div class="content-body" style="margin-left: 0px">
            <!-- row -->
			<div class="container-fluid">
	
            <div class="row">
                <div class="col-sm-12">
                <img alt="image" src="<?php echo BASE_URL; ?>/images/ELVD.png" width="100" />
                <h1>Nyakato Health Center </h1>
                </div>
                <div class="col-sm-6">
                   
                </div>
                        <div class="col-lg-6">
                            <?php
                           $getorder= mysqli_query($con,"SELECT * FROM stockorders WHERE  stockorder_id ='$id'") or die(mysqli_error($con));
                     $row= mysqli_fetch_array($getorder);
                      $restockorder_id=$row['stockorder_id'];
                      $section=$row['section'];
                      $admin_id=$row['admin_id'];
                      $timestamp=$row['timestamp'];
                      $status=$row['status'];
                           $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
                            if (strlen($restockorder_id) == 1) {
                                $pin = '000' . $restockorder_id;
                            }
                            if (strlen($restockorder_id) == 2) {
                                $pin = '00' . $restockorder_id;
                            }
                            if (strlen($restockorder_id) == 3) {
                                $pin = '0' . $restockorder_id;
                            }
                            if (strlen($restockorder_id) >= 4) {
                                $pin = $restockorder_id;
                            }
                            ?>
                            <h4 class="card-title">Requisition Order</h4>
                            <table class="table table-bordered">
                                <tr><th>Order Id</th><td><?php echo $pin ;?></td></tr>
                                <tr><th>Date Added</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                <tr><th>Section</th><td><?php echo $section; ?></td></tr>
                                <tr><th>Status</th><td><?php if($status==0){echo '<span class="text-danger">PENDING</span>'; }else if ($status == 4){echo '<span class="text-danger">CANCELLED</span>';} else{echo '<span class="text-success">APPROVED</span>'; }?></td></tr>
                              <tr><th>Added by</th><td><?php echo $fullname; ?></td></tr>
                           </table>
                        </div>
                     <div class="col-lg-10">
                        
                                <div class="card">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                         <div class="table-responsive">
                                        <table id="example6" class="table ">
                                            <thead>
                                                <tr>
                                                <th>Item Name</th>
                                                <!-- <th>Total Quantity</th> -->
                                                <th>Avaliable Quantity</th>
                                                <th>Quantity</th>
                                                <th>Measurement Unit</th>

                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <?php
                                                $totalcharge = 0;
                                               $getitems= mysqli_query($con,"SELECT * FROM ordereditems WHERE stockorder_id='$id' ");
                                            while($row1= mysqli_fetch_array($getitems)){
                                                $quantity = $row1['quantity'];
                                                $item_id = $row1['item_id'];
                                                $getitems = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$item_id'");
                                                $row = mysqli_fetch_array($getitems);
                                                $inventoryitem_id = $row['inventoryitem_id'];
                                                $itemname = $row['itemname'];
                                                $measurement_id = $row['measurement_id'];
                                                $minimum = $row['minimum'];
                                                $unitprice = $row['unitprice'];
                                                $subcategory_id = $row['subcategory_id'];
                                                $getunit =  mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                $row2 =  mysqli_fetch_array($getunit);
                                                $measurement = $row2['measurement'];
                                                if ($section != 'pharmacy'){
                                                    $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id'and store=2 ") or die(mysqli_error($con));

                                                }else {
                                                    $getstock = mysqli_query($con, "SELECT SUM(quantity) as totalstock,expiry FROM stockitems WHERE product_id='$inventoryitem_id' and store=3 ") or die(mysqli_error($con));
                                                }
                                            
                                                $row3 = mysqli_fetch_array($getstock);
                                                $totalstock = $row3['totalstock'];
                                                $exipry = $row3['expiry'];
                                                $totalordered = 0;
                                                $getordered = mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$inventoryitem_id' ") or die(mysqli_error($con));
                                                while ($row4 = mysqli_fetch_array($getordered)) {
                                                    $stockorder_id = $row4['stockorder_id'];
                                                    $quantity = $row4['quantity'];
                                                    $getorder = mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$stockorder_id' AND section='$section' and status=1 ");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $totalordered = $totalordered + $quantity;
                                                    }
                                                }
                                                $instock = $totalstock - $totalordered;
                                                        ?>
                                                        <tr class="gradeA">
                                                    <td><?php echo $itemname; ?></td>
                                                    <!-- <td><?php echo $totalstock; ?></td> -->
                                                    <td><?php echo $instock; ?></td>
                                                    <td><?php echo $quantity; ?></td>
                                                    <td><?php echo $measurement; ?></td>

                                                </tr>
                                             <?php }      ?>
                                            </tbody>     
                                            
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
//  include 'includes/footer.php';
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
    
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
<script type="text/javascript">
        $('document').ready(function(){
                     window.print(); 
        });     
    </script>
</body>

</html>