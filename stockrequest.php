<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
   $id=$_GET['id'];
   $st=$_GET['st'];
      if(strlen($id)==1){
      $pin='000'.$id;
     }
       if(strlen($id)==2){
      $pin='00'.$id;
     }
        if(strlen($id)==3){
      $pin='0'.$id;
     }
  if(strlen($id)>=4){
      $pin=$id;
     }       
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Stock Order <?php echo $pin; ?></title>
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
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/stockrequest.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Items Order  #<?php echo $pin; ?></h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                              <?php if($st==1){?>
                            <li class="breadcrumb-item"><a href="approvedstockrequests">Approved Requests</a></li>
                              <?php }else{?>
                           <li class="breadcrumb-item"><a href="pendingstockrequests">Pending Requests</a></li>
                              <?php }?>
                           <li class="breadcrumb-item active"><a href="#">Order details</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-12">
                      <?php
                         $forpharmacy= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id=17 AND status=1");
                   if((mysqli_num_rows($forpharmacy)>0)&&$st==0){                  
                                                       ?>
                 <button data-toggle="modal" data-target="#process"  class="btn  btn-success mb-2">Process Request</button>
                              
                 <div class="modal fade" id="process" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Quantities Issued</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="processrequest?id=<?php echo $id; ?>" method="POST">
                                       <?php 
                                  $ordereditems= mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$id'") or die(mysqli_error($con));
                                      while ($row1 = mysqli_fetch_array($ordereditems)) {
                                      $quantity=$row1['quantity'];    
                                      $ordereditem_id=$row1['ordereditem_id'];  
                                      $item_id=$row1['item_id'];  
                                $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item_id'");  
                                     $row = mysqli_fetch_array($getitems);
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $pharmacologicalclass_id=$row['pharmacologicalclass_id'];
                                          $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                          $dosage=$row['dosage'];
                                          $unitprice=$row['unitprice'];
                      ?>
                                   <div class="form-group">
	                 <label><?php echo $commercialname.' ('.$dosage.')'; ?></label>
                              <input type="text" class="form-control" name="quantity[]" required="required" value="<?php echo $quantity; ?>">
	             </div>
                                   <input type="text" class="form-control" name="orderitem[]"  value="<?php echo $ordereditem_id; ?>"  style="display: none">
	      
                         
                                      <?php }?>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                      </div>                 
                          </form>
              </div>
           
            </div>
          </div>
        </div>
                                            <?php } ?>

    <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Order #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                 <table  class="table table-bordered table-striped">
                                     <thead>
                      <tr>
                                             <th>Order Date</th>
                                                 <th>Ordered by</th>
                                                 <th>Service</th>
                                              
                                                 <?php if($st==1){?>
                                              <th>Processed by</th>
                                                 <?php }?>
                                                 <th>Status</th>
                                   </thead>
                                   <tbody>
                                           <?php 
                                         $getordered= mysqli_query($con, "SELECT * FROM stockorders WHERE stockorder_id='$id'") or die(mysqli_error($con));
                                        $row = mysqli_fetch_array($getordered);
                                          $stockorder_id=$row['stockorder_id'];
                                           $timestamp=$row['timestamp'];
                                           $admin_id=$row['admin_id'];                                        	
                                           $status=$row['status'];                                        	
                                           $section=$row['section'];                                     	
                                           $approvedby=$row['approvedby'];                                     	
                                $getstaff=mysqli_query($con,"SELECT * FROM staff WHERE status=1  AND staff_id='$admin_id'");  
                                        $row1=mysqli_fetch_array($getstaff);
                                            $fullname=$row1['fullname'];
                             $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$section'");
                       $row2=  mysqli_fetch_array($getcategory);
                           $servicecategory=$row2['servicecategory'];
                                  if(strlen($stockorder_id)==1){
      $pin='000'.$stockorder_id;
     }
       if(strlen($stockorder_id)==2){
      $pin='00'.$stockorder_id;
     }
        if(strlen($stockorder_id)==3){
      $pin='0'.$stockorder_id;
     }
  if(strlen($stockorder_id)>=4){
      $pin=$stockorder_id;
     }       
     $getitems= mysqli_query($con,"SELECT * FROM ordereditems WHERE stockorder_id='$stockorder_id'");
                      ?>
                                          <tr class="gradeA">                                                           
                                       
                                            <td><?php echo date('d/M/Y',$timestamp); ?></td>
                                               <td><?php echo $fullname; ?></td>
                                               <td><?php echo $servicecategory;   ?></td>
                                     
                                                  <?php if($st==1){
                                          $getapprover=mysqli_query($con,"SELECT * FROM staff WHERE status=1  AND staff_id='$approvedby'");  
                                        $rowa=mysqli_fetch_array($getapprover);
                                            $approvername=$rowa['fullname'];              
                                                      ?>
                                                 <td><?php echo $approvername; ?></td>
                                                  <?php }?>
                                               <td><?php if($status==0){ echo '<span class="text-warning"><strong>PENDING</strong></span>'; }else{ echo '<span class="text-success"><strong>APPROVED</strong></span>'; } ?></td>
                                   
                                  </tr>

                                   </tbody>
                                 </table>
                            </div>
                            </div>
                            </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Order Items</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                                 <th>Id Number</th>
                                                 <th>Item Name</th>
                                                       <th>Dosage</th>
                                                <th>Quantity Requested</th>
                                                  <?php if($st==1){ ?>
                                                <th>Quantity Issued</th>
                                                  <?php }?>
                                         
                                   
                                                 
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php 
                                  $ordereditems= mysqli_query($con, "SELECT * FROM ordereditems WHERE stockorder_id='$id'") or die(mysqli_error($con));
                                      while ($row1 = mysqli_fetch_array($ordereditems)) {
                                      $quantity=$row1['quantity'];    
                                      $issued=$row1['issued'];    
                                      $item_id=$row1['item_id'];  
                                $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item_id'");  
                                     $row = mysqli_fetch_array($getitems);
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $pharmacologicalclass_id=$row['pharmacologicalclass_id'];
                                          $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                          $dosage=$row['dosage'];
                                          $unitprice=$row['unitprice'];
                      ?>
                                          <tr class="gradeA">                                                           
                                            <td><?php echo $pharmacyitem_id; ?></td>
                                            <td><?php echo $commercialname; ?></td>
                                               <td><?php echo $dosage; ?></td>     
                                               <td><?php echo $quantity; ?></td>
                                                  <?php if($st==1){ ?>
                                               <td><?php echo $issued; ?></td>
                                                  <?php }?>
                                                                                                                                          
                                                  
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
                                       <?php }?>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
     <?php 
 include 'includes/footer.php';
     ?>
     

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

	
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>