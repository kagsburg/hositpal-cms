<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')&&(($_SESSION['elcthospitallevel']!='store manager'))&&(($_SESSION['elcthospitallevel']!='head physician'))&&(($_SESSION['elcthospitallevel']!='pharmacist'))){
header('Location:login.php');
   }
   $ty = isset ($_GET['ty']) ? $_GET['ty'] : '';
   $type =  mysqli_real_escape_string($con, $ty);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pharmacy Stock Orders</title>
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
                            <h4>Pharmacy Stock Orders</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Stock Orders</a></li>
                        </ol>
                    </div>
                </div>
                <?php 
                if (isset($_SESSION['success'])){
                    echo $_SESSION['success'];
                    unset ($_SESSION['success']);
                }
                ?>
       		<div class="row">
       		<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stock Orders</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                 <table id="example5" class="display">
                                      <thead>
                                        <tr>
                                            <th>Order Date</th>
                                                <th>Store</th>
                                                 <th>Items</th>
                                                 <th>Status</th>
                                                  <th>Action</th>
                                                 
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php 
                                         if ($type == '0'){
                                            $getorders= mysqli_query($con,"SELECT * FROM restockorders WHERE  status IN (0,1) and supplier_id =0");
                                         }
                                         else if ($type == '1'){
                                            $getorders= mysqli_query($con,"SELECT * FROM restockorders WHERE  status IN (0,1) and supplier_id !=0");
                                         }
                                         else{
                                            $getorders= mysqli_query($con,"SELECT * FROM pharstockorders WHERE  status IN (0,1)");
                                         }
                    while($row= mysqli_fetch_array($getorders)){
                      $restockorder_id=$row['pharstockorder_id'];
                      $store_id=$row['store'];
                      $timestamp=$row['timestamp'];
                      $status=$row['status'];
                         $getstore=mysqli_query($con,"SELECT * FROM stores WHERE status=1 AND store_id='$store_id'");
                        $row1=  mysqli_fetch_array($getstore);
                          $store=$row1['store'];
                          $getitems= mysqli_query($con,"SELECT * FROM stockitems WHERE pharstockorder_id='$restockorder_id' AND status IN (3,1)");
                          $row2=  mysqli_fetch_array($getitems);
                          $type = $row2['type'];
                       ?>
                                          <tr class="gradeA">                                                           
                                            <td><?php echo date('d/M/Y',$timestamp); ?></td>
                                            <td><?php echo $store; ?></td>
                                               <!-- <td><?php echo $suppliername; ?></td> -->
                                               <td><?php echo mysqli_num_rows($getitems); ?></td>
                                            <td><?php if($status==0){echo '<span class="text-danger">PENDING</span>'; }else if($status == 1) {echo '<span class="text-success">APPROVED</span>'; }else{echo '<span class="text-danger">CANCELLED</span>';}?></td>                                                                                                          
                                                <td>     
                   <a href="pharstockorder?id=<?php echo $restockorder_id; ?>" class="btn btn-primary btn-xs">Details</a>
                   <?php
                   if(($status==0)&&($_SESSION['elcthospitallevel']=='admin' || $_SESSION['elcthospitallevel']=='head physician')){
                   ?>
                     <a href="cancelpharstockorder?id=<?php echo $restockorder_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_cancel<?php echo $restockorder_id; ?>()">Cancel</a>
                     <a href="editpharstockorder?id=<?php echo $restockorder_id; ?>&ty=<?php echo $type; ?>" class="btn btn-info btn-xs">Edit</a>
                 
                   <script type="text/javascript">
                    function confirm_cancel<?php echo $restockorder_id; ?>() {
                            return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                        }
                    function confirm_approve<?php echo $restockorder_id; ?>() {
                    return confirm('You are about To Approve this List. Are you sure you want to proceed?');
                    }
                    </script>
                   
                   <?php }
                   if (($status == 0) &&($_SESSION['elcthospitallevel']=='pharmacist')){
                   ?>
                    <a href="editpharstockorder?id=<?php echo $restockorder_id; ?>&ty=<?php echo $type; ?>" class="btn btn-info btn-xs">Edit</a>
                    <a href="cancelpharstockorder?id=<?php echo $restockorder_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_cancel<?php echo $restockorder_id; ?>()">Delete</a>
                    <script type="text/javascript">
                    function confirm_cancel<?php echo $restockorder_id; ?>() {
                            return confirm('You are about To Cancel this List. Are you sure you want to proceed?');
                        }
                    </script>
                     <?php } 
                     if ($status == 1 ){
                        ?>
                        <a href="printstockorder?id=<?php echo $restockorder_id; ?>" class="btn btn-info btn-xs">Print</a>
                        <?php }?>
                                                                                       </td>
                                  </tr>

                                        <?php }?>
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
        
        </script>
	
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>