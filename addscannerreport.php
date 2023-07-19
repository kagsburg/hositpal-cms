<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
$id=$_GET['id'];
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Scanner Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
      <script src="ckeditor/ckeditor.js"></script>
       <link href="css/chosen/chosen.css" rel="stylesheet">
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
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
                                           include 'fr/addscannerreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Scanner Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Scanner Report</a></li>
                        </ol>
                    </div>
                </div>
       	<div class="row">
                     <?php
                                  $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'");  
                                    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                          $attendant=$row['attendant'];
                                 $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                                  $lastname=$row2['lastname'];    
                            $gender=$row2['gender'];    
                                                if(strlen($patient_id)==1){
      $pin='000'.$patient_id;
     }
       if(strlen($patient_id)==2){
      $pin='00'.$patient_id;
     }
        if(strlen($patient_id)==3){
      $pin='0'.$patient_id;
     }
  if(strlen($patient_id)>=4){
      $pin=$patient_id;
     }      
                               ?>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">
                  
                                  <div class="profile-blog mb-5">
                                      <img src="images/avatar.png" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname.' '.$lastname; ?></h4>
                                                               
                                           </div>
                                </div>
                                </div>
                                </div>
                     <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Scanner Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                 if(isset($_POST['submit'])){
                                         $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                        $exitmode=$_POST['exitmode'];
                                        $destination=$_POST['destination'];
                                        $reason= mysqli_real_escape_string($con,strtotime($_POST['reason']));           
                                        $results= mysqli_real_escape_string($con,trim($_POST['results']));              
                                        $conclusion= mysqli_real_escape_string($con,trim($_POST['conclusion']));      
                                      $description= mysqli_real_escape_string($con,trim($_POST['description']));     
                                      $responsible= mysqli_real_escape_string($con,trim($_POST['responsible']));        
                             if((empty($month))||(empty($year))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
         mysqli_query($con, "INSERT INTO scannerreports(patientsque_id,month,year,reason,description,results,conclusion,responsible,exitmode,destination,admin_id,timestamp,status) VALUES('$id','$month','$year','$reason','$description','$results','$conclusion','$responsible','$exitmode','$destination','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
          $last_id= mysqli_insert_id($con);  
         mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
       if($exitmode=='transfert intra hôpital'){
    mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status) VALUES('$admission_id','$destination','0','1','".$_SESSION['elcthospitaladmin']."','technician',UNIX_TIMESTAMP(),0)") or die(mysqli_error($con));
       }
         echo '<div class="alert alert-success">Radiology Report Successfully Added</div>';
    }             
    }             
                
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
               
        
                                                                    
   <div class="form-group col-lg-12"><label class="control-label">Reason</label>
                    <textarea  name="reason" class="form-control" placeholder="Enter Reason " required="required" rows="4"></textarea>                                                                       
                                </div>
   
        <div class="form-group col-lg-12"><label class="control-label">Description</label>
       <textarea  name="description" class="form-control" placeholder="Enter description " required="required" rows="4"></textarea>                                                                            
                                </div>     
                 <div class="form-group col-lg-12"><label class="control-label">Results</label>
                    <textarea  name="results" class="form-control" placeholder="Enter Results " required="required" rows="4"></textarea>                                                                       
                                </div>
               <div class="form-group col-lg-12"><label class="control-label">Conclusion</label>
                    <textarea  name="conclusion" class="form-control" placeholder="Enter Conclusion " required="required" rows="4"></textarea>                                                                       
                                </div>      
          
               <div class="form-group col-lg-12"><label class="control-label">Responsible</label>
<input type="text" name='responsible' class="form-control" placeholder="Enter  who is responsible">                                                                          
                                </div>       
           

            <div class="form-group col-lg-12"><label class="control-label">Exit mode*</label>
                             <select name="exitmode" class="form-control" id="authorizedexitmode">
                                          <option value="">Select mode...</option>
                                        <option value="transfert intra hôpital">Intra-hospital transfer</option>
                                       <option value="exits">Exits Hospital</option>
                                   </select>
                                         </div>
                                         </div>
         <div class="form-group destination" style="display: none"><label class="control-label">Destination*</label>
              <select name="destination" class="form-control">
                                            <option value="">Select Destination...</option>
                                         <?php
                               $getcategories=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $servicecategory_id=$row1['servicecategory_id'];
                                              $servicecategory=$row1['servicecategory'];
                                              $code=$row1['code'];
                                                         ?>
                                            <option value="<?php echo $servicecategory_id; ?>"><?php echo $servicecategory; ?></option>
                            <?php }?>
                                        </select>                                                                     
                                </div>    
         <div class="form-group pull-left">
                                         <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                                                  </div>
                                     <div class="form-group pull-right">
                                         <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                                                  </div>
                            </form>
                                </div>
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
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
         <script src="js/chosen/chosen.jquery.js"></script>
        <script>
                   $('#authorizedexitmode').on('change', function() {
               var getvalue=$(this).val();
                    if((getvalue==='transfert intra hôpital')){ 
            $('.destination').show();   
        }else{
          $('.destination').hide();        
        }
        });
              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                 frmvalidator.addValidation("exitmode","req","*Exit mode is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
   
            </script>
</body>

</html>