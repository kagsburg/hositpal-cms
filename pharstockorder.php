<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')&&(($_SESSION['elcthospitallevel']!='store manager'))&&(($_SESSION['elcthospitallevel']!='head physician'))&&(($_SESSION['elcthospitallevel']!='pharmacist'))){
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
        <title>Ordered Items</title>
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
                                <li class="breadcrumb-item"><a href="viewpharstock">Stock Orders</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void()">Order Details</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                           $getorder= mysqli_query($con,"SELECT * FROM stockitems WHERE pharstockorder_id='$id' AND status IN (3,1,4)") or die(mysqli_error($con));
                     $row= mysqli_fetch_array($getorder);
                      $restockorder_id=$row['pharstockorder_id'];
                      $store_id=$row['store'];
                      $item = $row['product_id'];
                      $admin_id=$row['admin_id'];
                      $timestamp=$row['timestamp'];
                      $status=$row['status'];
                      
                         $getstore=mysqli_query($con,"SELECT * FROM stores WHERE status=1 AND store_id='$store_id'");
                        $row1=  mysqli_fetch_array($getstore);
                          $storename=$row1['store'];
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
                            <table class="table table-bordered">
                                <tr><th>Order Id</th><td><?php echo $pin ;?></td></tr>
                                <tr><th>Date Added</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                <!-- <tr><th>Store</th><td><?php echo $storename; ?></td></tr> -->
                                <tr><th>Status</th><td><?php if($status==3){echo '<span class="text-danger">PENDING</span>'; }else if ($status == 4){echo '<span class="text-danger">CANCELLED</span>';} else{echo '<span class="text-success">APPROVED</span>'; }?></td></tr>
                              <tr><th>Added by</th><td><?php echo $fullname; ?></td></tr>
                           </table>
                        </div>
                     <div class="col-lg-10">
                        
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">All Ordered Items</h4>
                                    </div>
                                    <div class="card-body">
                                         <div class="table-responsive">
                                        <table id="example5" class="display">
                                            <thead>
                                                <tr>
                                                    <th>Item Name</th>
                                                    
                                                    <th>Quantity</th>
                                                    <th>Expiry</th>

                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <?php
                                                $totalcharge = 0;
                                               $getitems= mysqli_query($con,"SELECT * FROM stockitems WHERE pharstockorder_id='$id' AND status IN (3,1,4)");
                                while($row= mysqli_fetch_array($getitems)){
                                                       $stockitem_id =$row["stockitem_id"];
                                                        $product_id= $row["product_id"];
                                                        $quantity=$row["quantity"];
                                                        $expiry=$row["expiry"];
                                                        $pharstockorder_id=$row["pharstockorder_id"];                                                   
                                         $getitem=mysqli_query($con,"SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$product_id'");  
                                          $row1 = mysqli_fetch_array($getitem);
                                                  $itemname=$row1['itemname'];
                                           $measurement_id=$row1['measurement_id'];
                                                        $getunit = mysqli_query($con, "SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                                                        $row2 = mysqli_fetch_array($getunit);
                                                        $measurement = $row2['measurement'];
                                                        
                                                        ?>
                                                        <tr class="gradeA">                                                           
                                                            <td><?php echo $itemname. ' (' . $measurement . ')'; ?></td>
                                                            <td><?php echo $quantity; ?></td>
                                                            <td><?php echo $expiry; ?></td>
                                                   </tr>
                                             <?php }      ?>
                                            </tbody>           
                                        </table>   
                                        <?php
                                            if(($status==3)&&($_SESSION['elcthospitallevel']=='admin' || $_SESSION['elcthospitallevel']=='head physician')){
                                            ?>  
                                        <a href="approvepharstock?id=<?php echo $pharstockorder_id; ?>" class="btn btn-info btn-xs" onclick="return confirm_approve<?php echo $pharstockorder_id; ?>()">Approve</a>
                                         <a href="cancelpharstockorder?id=<?php echo $pharstockorder_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_cancel<?php echo $pharstockorder_id; ?>()">Cancel</a>
                                         <script type="text/javascript">
                                            function confirm_cancel<?php echo $pharstockorder_id; ?>() {
                                                    return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                                                }
                                            function confirm_approve<?php echo $pharstockorder_id; ?>() {
                                            return confirm('You are about To Approve this List. Are you sure you want to proceed?');
                                            }
                                        </script>
                     <?php } ?>
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

</body>

</html>