<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Service Price</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/chosen/chosen.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
	<link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
	
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
                            <h4>Add Service Price</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="serviceprices">Service Prices</a></li>
                            <li class="breadcrumb-item active"><a href="addserviceprice">Add Price</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Service Price</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                  <?php
   if(isset($_POST['company'],$_POST['charge'],$_POST['category'])){     
        $category=$_POST['category']; 
         $charge=$_POST['charge']; 
        $company=$_POST['company']; 
 if(empty($category)){
   $errors[]='Category Not Selected'; 
}
 if($category=='insured'){
     if(empty($company)){
     $errors[]='Insurance company not  selected';        
     }
 }
  if($category=='non insured'){
     if(empty($charge)){
     $errors[]='Charge should be filled';        
     }
 }
if(!empty($errors)){
foreach($errors as $error){ 
 ?>
 <div class="alert alert-danger"><?php echo $error; ?></div>
<?php 
}         }else{    
                  if($category=='insured'){      
                  if(isset($_POST['services'])){
                  $services=$_POST['services'];    
                  foreach ($services as $services){
                  $check= mysqli_query($con, "SELECT * FROM insuredservices WHERE medicalservice_id='$services' AND insurancecompany_id='$company' AND status=1");
                     if(mysqli_num_rows($check)==0){
              mysqli_query($con,"INSERT INTO insuredservices(medicalservice_id,insurancecompany_id,status) VALUES('$services','$company','1')") or die(mysqli_error($con));
                  }
                  }
                  }
                  }
                     if($category=='non insured'){
                            if(isset($_POST['services'])){
                  $services=$_POST['services'];    
                  foreach ($services as $services){
             $addemployee=  mysqli_query($con,"INSERT INTO noninsuredservices(medicalservice_id,charge,status) VALUES('$services','$charge','1')");
               }                       
               }                       
               }                       
   
                echo '<div class="alert alert-success">Service Price successfully Added</div>';                
                                                                 
                                }
                                }
                                    ?>
                        
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
   
                              
                                 <div class="form-group">
                                     <label class="control-label">*Category</label>
                                        <select name="category" class="form-control categorytype">
                                            <option value="">select category...</option>
                                          <option value="insured">Insured</option>
                                            <option value="non insured">Non Insured</option>
                                        </select>
                                </div>
           <div class="form-group">
             <label>Medical Services</label>
                                          <select data-placeholder="Choose service(s).." class="form-control chosen-select" name='services[]' multiple style="width:100%;" tabindex="4">
                                            <option value="">select services...</option>
                                            <?php
                           $getmedicalservices=  mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getmedicalservices)){
                                              $medicalservice_id=$row1['medicalservice_id'];
                                              $medicalservice=$row1['medicalservice'];
                                              $category=$row1['category'];
                                                       ?>
                                            <option value="<?php echo $medicalservice_id; ?>"><?php echo $medicalservice; ?></option>
                            <?php }?>
                                        </select>                                   
                                </div>
         <div class="insured" style="display: none">
             <div class="form-group">
             <label>Insurance company</label>
                                        <select name="company" class="form-control">
                                            <option value="">Select company...</option>
                                            <?php
                              $getcompanies=  mysqli_query($con,"SELECT * FROM insurancecompanies WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcompanies)){
                                              $insurancecompany_id=$row1['insurancecompany_id'];
                                              $company=$row1['company'];
                                                       ?>
                                            <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>
                            <?php } ?>
                                        </select>                                   
                                </div>
       
                                </div>
          
          <div class="non-insured" style="display: none">
       
           <div class="form-group">
	                      <label>Charge</label>
                              <input type="number" class="form-control" name="charge" placeholder="Enter service charge">
	                    </div>    
	                    </div> 
                                                                                <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Add Price</button>
                                                                  </div>
                            </form>
                                </div>
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
       

    </div>
   
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <script src="js/chosen/chosen.jquery.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
          <script>
            $('.categorytype').on('change', function() {
               var getselect=$(this).val();
                 if((getselect==='')){ 
                 $('.insured').hide();
                 $('.non-insured').hide();
                           }  
               
                         if((getselect=='insured')){ 
                  $('.insured').show();
                 $('.non-insured').hide();
        
                           }  
                 if((getselect=='non insured')){ 
                  $('.insured').hide();
                 $('.non-insured').show();
                           }        
           });
                          var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }             
           </script>
</body>

</html>