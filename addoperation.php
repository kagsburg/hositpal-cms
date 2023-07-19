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
    <title>Add Operation</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
      <script src="ckeditor/ckeditor.js"></script>
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
                                           include 'fr/addoperation.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Operation</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Operation</a></li>
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
                                <h4 class="card-title">Add Operation</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                                    if(isset($_POST['month'],$_POST['year'],$_POST['prescriber'],$_POST['diagnosticcode'],$_POST['diagnosis'],$_POST['condition'],$_POST['anesthesiacode'],$_POST['anesthesia'],$_POST['actcode'],$_POST['acttitle'],$_POST['mainauthor'],$_POST['mainassistant'],$_POST['mainassistant'],$_POST['anesthesiologist'],$_POST['observations'],$_POST['protocol'])){
                                        $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                        $prescriber= mysqli_real_escape_string($con,trim($_POST['prescriber']));           
                                      $diagnosticcode= mysqli_real_escape_string($con,trim($_POST['diagnosticcode']));           
                                        $diagnosis= mysqli_real_escape_string($con,trim($_POST['diagnosis']));           
                                        $condition= mysqli_real_escape_string($con,trim($_POST['condition']));           
                                        $anesthesiacode= mysqli_real_escape_string($con,trim($_POST['anesthesiacode']));           
                                        $anesthesia= mysqli_real_escape_string($con,trim($_POST['anesthesia']));           
                                        $actcode= mysqli_real_escape_string($con,trim($_POST['actcode']));           
                                        $acttitle= mysqli_real_escape_string($con,trim($_POST['acttitle']));        
                                        $died= mysqli_real_escape_string($con,trim($_POST['died']));        
                                       $mainauthor=mysqli_real_escape_string($con,trim($_POST['mainauthor']));
                                       $mainassistant=mysqli_real_escape_string($con,trim($_POST['mainassistant']));
                                   $anesthesiologist=mysqli_real_escape_string($con,trim($_POST['anesthesiologist']));
                                   $observations=mysqli_real_escape_string($con,trim($_POST['observations']));
                                   $protocol=mysqli_real_escape_string($con,trim($_POST['protocol']));
                                        if(isset($_POST['pregnant'])){
                                           $pregnant=$_POST['pregnant'];
                                       }else{
                                        $pregnant='No';
                                       }
                                           if(isset($_POST['died'])){
                                           $died=$_POST['died'];
                                       }else{
                                        $pregnant='No';
                                       }
                               if((empty($month))||(empty($year))||(empty($prescriber))||(empty($condition))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
            mysqli_query($con, "INSERT INTO operations(patientsque_id,month,year,prescriber,diagnosticcode,diagnosis,operationcondition,anesthesiacode,anesthesia,actcode,acttitle,died,mainauthor,mainassistant,anesthesiologist,protocol,observations,pregnant,admin_id,timestamp,status) VALUES('$id','$month','$year','$prescriber','$diagnosticcode','$diagnosis','$condition','$anesthesiacode','$anesthesia','$actcode','$acttitle','$died','$mainauthor','$mainassistant','$anesthesiologist','$protocol','$observations','$pregnant','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
echo '<div class="alert alert-success">Operation Successfully Added</div>';
    }             
    }             
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
           
            <div class="form-group col-lg-12"><label class="control-label">Prescriber Name*</label>
                <input type="text" name='prescriber' class="form-control" placeholder="Enter Prescriber Name" required="required">                                                                          
                                </div>     
        <div class="form-group col-lg-12 mb-4 mt-4">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="pregnant">
  <label class="form-check-label" for="inlineCheckbox1">Is Operation for Pregnant Woman?</label>
</div> 
</div> 
    <div class="form-group col-lg-6"><label class="control-label">Diagnostic Code</label>
<input type="text" name='diagnosticcode' class="form-control" placeholder="Enter  code">                                                                          
                                </div>
        <div class="form-group col-lg-12"><label class="control-label">Diagnosis leading to Operation</label>
            <textarea name='diagnosis' class="form-control" placeholder="Enter Diagnosis" rows="4"></textarea>                                                                         
                                </div>
                     <div class="form-group col-lg-6"><label class="control-label">Condition*</label>
  <select name="condition" class="form-control">
                                            <option value="">Select Result...</option>
                                       <option value="Programmé">Scheduled</option>
                                       <option value="En urgence">Emergency</option>
                                                </select>
                           <div id='form_condition_errorloc' class='text-danger'></div>
                       </div>
                       </div>
         <div class="row">
            <div class="form-group col-lg-6"><label class="control-label">Code of Anesthesia used</label>
<input type="text" name='anesthesiacode' class="form-control" placeholder="Enter  code" required="required">                                                                          
                                </div>
                <div class="form-group col-lg-12"><label class="control-label">Type of Anesthesia used*</label>
                    <textarea  name="anesthesia" class="form-control" placeholder="Enter value" required="required" rows="4"></textarea>                                                                       
                                </div>
          <div class="form-group col-lg-6"><label class="control-label">Code of Act*</label>
<input type="text" name='actcode' class="form-control" placeholder="Enter  code" required="required">                                                                          
                                </div>
                <div class="form-group col-lg-12"><label class="control-label">Title of Act*</label>
                    <textarea  name="acttitle" class="form-control" placeholder="Enter title" required="required" rows="4"></textarea>                                                                       
                                </div>
              <div class="form-group col-lg-12"><label class="control-label">Protocol*</label>
                    <textarea  name="protocol" class="form-control" placeholder="Enter Protocol" required="required" rows="4"></textarea>                                                                       
                                </div>
               <div class="form-group col-lg-12 mb-4 mt-4">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="died">
  <label class="form-check-label" for="inlineCheckbox1">Did patient die during the operation?</label>
</div> 
</div> 
              <div class="form-group col-lg-6"><label class="control-label">Main Operation Author*</label>
<input type="text" name='mainauthor' class="form-control" placeholder="Enter  Fullname" required="required">                                                                          
                                </div>
               <div class="form-group col-lg-6"><label class="control-label">Person who was the main assistant*</label>
<input type="text" name='mainassistant' class="form-control" placeholder="Enter  Fullname" required="required">                                                                          
                                </div>
               <div class="form-group col-lg-6"><label class="control-label">Played the role of anesthesiologist*</label>
                   <input type="text" name='anesthesiologist' class="form-control" placeholder="Enter  fullname" required="required">                                                                          
                                </div>
    <div class="form-group col-lg-12"><label class="control-label">Observations during Operation*</label>
                    <textarea  name="observations" class="form-control" placeholder="Enter Observations" required="required" rows="4"></textarea>                                                                       
                                </div>           
</div> 
         <div class="form-group pull-left">
                                         <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                                                  </div>
                                     <div class="form-group pull-right">
                               <button class="btn btn-primary" type="submit">Submit</button>
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
        <script>
              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                 frmvalidator.addValidation("examresult","req","*Exam result is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
          </script>
</body>

</html>