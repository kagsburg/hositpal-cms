<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pending Medication Orders</title>
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
                                           include 'fr/pendingnurseorders.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Pending Medication Orders</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="pendingnurseorders">Pending Orders</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       	                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pending Nurse Orders</h4>
                            </div>
                            <div class="card-body">
                          <table id="example5" class="display" style="min-width: 645px">
                        <thead>
                          <tr>
                            <th>Order No</th> 
                            <th>Patient Name</th> 
                            <th>Requested by</th> 
                            <th>Date</th> 
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                       <?php
                        if(($_SESSION['elcthospitallevel']=='nurse')){
                       $getorders= mysqli_query($con,"SELECT * FROM nurseorders WHERE status=0 AND admin_id='".$_SESSION['elcthospitaladmin']."'") or die(mysqli_error($con));
                        }else{
                          $getorders= mysqli_query($con,"SELECT * FROM nurseorders WHERE status=0") or die(mysqli_error($con));    
                        }
                       while ($row = mysqli_fetch_array($getorders)) {
                   $nurseorder_id=$row['nurseorder_id'];
                   $admitted_id=$row['admitted_id'];
                   $admin_id=$row['admin_id'];
                   $timestamp=$row['timestamp'];
                     $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
                     $getadmitted= mysqli_query($con,"SELECT * FROM admitted WHERE  admitted_id='$admitted_id'");
                  $row2 = mysqli_fetch_array($getadmitted);
                  $admission_id=$row2['admission_id'];    
                 $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                   $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row3= mysqli_fetch_array($getpatient);
                                $firstname=$row3['firstname'];    
                                 $lastname= $row3['lastname'];    
                         if(strlen($nurseorder_id)==1){
      $pin='000'.$nurseorder_id;
     }
       if(strlen($nurseorder_id)==2){
      $pin='00'.$nurseorder_id;
     }
        if(strlen($nurseorder_id)==3){
      $pin='0'.$nurseorder_id;
     }
  if(strlen($nurseorder_id)>=4){
      $pin=$nurseorder_id;
     }       
                       ?>
                            <tr>
                            <td>#<?php echo $pin; ?></td>
                            <td><?php echo $firstname.' '.$lastname; ?></td>
                            <td><?php echo $fullname ?></td>
                            <td><?php echo date('d/M/Y',$timestamp); ?></td>
                          <td>
             <button data-toggle="modal" data-target="#basicModal<?php echo $nurseorder_id; ?>"  class="btn btn-xs btn-info">View Details</button>
<?php
             if(($_SESSION['elcthospitallevel']=='nurse')){ ?>
             <a href="removenurseorder?id=<?php echo $nurseorder_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $nurseorder_id; ?>()">Decline</a>
  <script type="text/javascript">
function confirm_delete<?php echo $nurseorder_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>
             <?php }?>
<?php
             if(($_SESSION['elcthospitallevel']=='pharmacist')){ ?>
             <a href="approvenurseorder?id=<?php echo $nurseorder_id; ?>" class="btn btn-xs btn-success" onclick="return confirm_order<?php echo $nurseorder_id; ?>()">Approve</a>
  <script type="text/javascript">
function confirm_order<?php echo $nurseorder_id; ?>() {
  return confirm('You are about To Confirm this order. Are you sure you want to proceed?');
}
</script>
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
                                       <?php }?>
                              <?php
                      if(($_SESSION['elcthospitallevel']=='nurse')){
                       $getorders= mysqli_query($con,"SELECT * FROM nurseorders WHERE status=0 AND admin_id='".$_SESSION['elcthospitaladmin']."'") or die(mysqli_error($con));
                        }else{
                          $getorders= mysqli_query($con,"SELECT * FROM nurseorders WHERE status=0") or die(mysqli_error($con));    
                        }
                       while ($row = mysqli_fetch_array($getorders)) {
                   $nurseorder_id=$row['nurseorder_id'];
                   ?>
                       <div class="modal fade" id="basicModal<?php echo $nurseorder_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
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
                              <th scope="col">QUANTITY</th>                         
                          <th scope="col">RATE (BIF)</th>  
                          <th scope="col">SUB TOTAL (BIF)</th>  
                        </tr>
                     <?php
                     $total=0;
                     $subtotal=0;
                     $count=0;
                    $getproducts= mysqli_query($con,"SELECT * FROM nurseordereditems WHERE nurseorder_id='$nurseorder_id' AND status=1");
                   while($row1= mysqli_fetch_array($getproducts)){
                   $nurseordereditem_id=$row1['nurseordereditem_id'];
                   $item_id=$row1['item_id'];
                   $quantity=$row1['quantity'];
                      $unitprice=$row1['unitprice']; 
                  $subtotal=$quantity*$unitprice;
                  $total=$subtotal+$total;
                  $count=$count+1;
                  $getitem=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item_id'");  
                                     $row = mysqli_fetch_array($getitem);
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $dosage=$row['dosage'];
                               $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                        $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                          $row2=  mysqli_fetch_array($getcats);
                                          $pharmaceuticalform=$row2['pharmaceuticalform'];
              ?>
                        <tr>
                          <td><?php echo $commercialname.'( '.$pharmaceuticalform.')'; ?></td>
                                  <td><?php echo $quantity; ?></td>
                             <td> <?php echo $unitprice; ?></td>
                             <td><?php echo number_format($subtotal); ?></td>
                        
                        </tr>
           <?php }
        
           
           ?>
                        <tr><td style="border:none">&nbsp;</td><td style="border:none">&nbsp;</td><th>TOTAL</th><td><?php echo number_format($total); ?></td></tr>
                        <tr>                      </table>
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