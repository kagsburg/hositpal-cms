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
    <title>Ambulant Orders</title>
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
                                           include 'fr/ambulantorders.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Ambulant Orders</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="ambulantorders">Ambulant Orders</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       	                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders</h4>
                            </div>
                            <div class="card-body">
                          <table id="example5" class="display" style="min-width: 645px">
                        <thead>
                          <tr>
                            <th>Order No</th> 
                            <th>Patient Name</th> 
                            <th>Date</th> 
                            <th>Drugs issued</th> 
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                       <?php
                       $getorders= mysqli_query($con,"SELECT * FROM ambulantorders WHERE status=1") or die(mysqli_error($con));
                       while ($row = mysqli_fetch_array($getorders)) {
                   $ambulantorder_id=$row['ambulantorder_id'];
                   $patientname=$row['patientname'];
                   $timestamp=$row['timestamp'];
                   $processed=$row['processed'];
                         if(strlen($ambulantorder_id)==1){
      $pin='000'.$ambulantorder_id;
     }
       if(strlen($ambulantorder_id)==2){
      $pin='00'.$ambulantorder_id;
     }
        if(strlen($ambulantorder_id)==3){
      $pin='0'.$ambulantorder_id;
     }
  if(strlen($ambulantorder_id)>=4){
      $pin=$ambulantorder_id;
     }       
                       ?>
                            <tr>
                            <td>#<?php echo $pin; ?></td>
                            <td><?php echo $patientname; ?></td>
                            <td><?php echo date('d/M/Y',$timestamp); ?></td>
                            <td><?php echo $processed; ?></td>
                          <td>
                              <a href="ambulantinvoice?id=<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-info" target="_blank">View Invoice</a>
                                  <?php
                        $forpharmacy= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id=17 AND status=1");
                   if(mysqli_num_rows($forpharmacy)>0){
                   ?>
                              <a href="confirmdrugissue?id=<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-primary" onclick="return confirm_issue<?php echo $ambulantorder_id; ?>()">Confirm Issue</a>
  <script type="text/javascript">
function confirm_issue<?php echo $ambulantorder_id; ?>() {
  return confirm('You are about To Approve drugs issue. Are you sure you want to proceed?');
}
</script>
    <?php }?>
                              <a href="removeambulantorder?id=<?php echo $ambulantorder_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $ambulantorder_id; ?>()">Remove</a>
  <script type="text/javascript">
function confirm_delete<?php echo $ambulantorder_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>
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