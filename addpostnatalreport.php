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
    <title>Add Post Natal Consultation</title>
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
                                           include 'fr/addpostnatalreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Post Natal Consultation</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add  Consultation</a></li>
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
                                <h4 class="card-title">Add Post Natal Consultation</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                 if(isset($_POST['submit'])){
                          $birthdate= mysqli_real_escape_string($con,strtotime($_POST['birthdate']));           
                                        $maritalsituation= mysqli_real_escape_string($con,trim($_POST['maritalsituation']));              
                                        $babyname= mysqli_real_escape_string($con,trim($_POST['babyname']));      
                                      $birthplace= mysqli_real_escape_string($con,trim($_POST['birthplace']));     
                                      $firstvisit= mysqli_real_escape_string($con,trim($_POST['firstvisit']));     
                                      $othervisits= mysqli_real_escape_string($con,trim($_POST['othervisits']));     
                                      $onctx= mysqli_real_escape_string($con,trim($_POST['onctx']));     
                                      $babiessampled= mysqli_real_escape_string($con,trim($_POST['babiessampled']));     
                                      $vitamina= mysqli_real_escape_string($con,trim($_POST['vitamina']));     
                                      $problems= mysqli_real_escape_string($con,trim($_POST['problems']));     
                                      $decisions= mysqli_real_escape_string($con,trim($_POST['decisions']));     
                                       
                                               if(isset($_POST['hivknown'])){
                                                  $hivknown=$_POST['hivknown']; 
                                               }   else{
                                                 $hivknown='no';   
                                               }                       
                                               if(isset($_POST['onarvs'])){
                                                  $onarvs=$_POST['onarvs']; 
                                               }   else{
                                                 $onarvs='no';   
                                               }                                                    
                                               if(isset($_POST['testing'])){
                                                          $testing=$_POST['testing']; 
                                               }   else{
                                                 $testing='no';   
                                               }                                          
                                               if(isset($_POST['fearvs'])){
                                                          $fearvs=$_POST['fearvs']; 
                                               }   else{
                                                 $fearvs='no';   
                                               }   
                                                  if(isset($_POST['pfmembership'])){
                                                          $pfmembership=$_POST['pfmembership']; 
                                               }   else{
                                                 $pfmembership='no';   
                                               }  
                                             
                                               if(isset($_POST['arvwomenmembership'])){
                                                          $arvwomenmembership=$_POST['arvwomenmembership']; 
                                               }   else{
                                                 $arvwomenmembership='no';   
                                               }                                                                                          
                                               if(isset($_POST['obstetricfistulas'])){
                                                          $obstetricfistulas=$_POST['obstetricfistulas']; 
                                               }   else{
                                                 $obstetricfistulas='no';   
                                               }                                                                                                                   
                                               if(isset($_POST['puerperalinfection'])){
                                                          $puerperalinfection=$_POST['puerperalinfection']; 
                                               }   else{
                                                 $puerperalinfection='no';   
                                               }                                                                                                     
                               if((empty($birthplace))||(empty($birthdate))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
    
            mysqli_query($con, "INSERT INTO postnatalreports(patientsque_id,birthdate,maritalsituation,hivknown,onarvs,testing,fearvs,babyname,birthplace,firstvisit,othervisits,onctx,babiessampled,vitamina,pfmembership,arvwomenmembership,obstetricfistulas,puerperalinfection,problems,decisions,admin_id,timestamp,status) VALUES('$id','$birthdate','$maritalsituation','$hivknown','$onarvs','$testing','$fearvs','$babyname','$birthplace','$firstvisit','$othervisits','$onctx','$babiessampled','$vitamina','$pfmembership','$arvwomenmembership','$obstetricfistulas','$puerperalinfection','$problems','$decisions','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
     
  echo '<div class="alert alert-success">Post Natal Report Successfully Added</div>';
    }             
    }             
                
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
                <div class="form-group col-lg-6">
                               <label class=" control-label">* Birthchild Date</label>                          
                               <input type="date" class="form-control" name="birthdate" required="required">
                                                        </div>
               <div class="form-group col-lg-6">
                               <label class=" control-label">* Marital Situation</label>                          
                               <input type="text" class="form-control" name="maritalsituation">
                                                        </div>
                                                        </div>
         <div class="row">
             <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="hivknown">
  <label class="form-check-label" for="inlineCheckbox2">HIV + already known?</label>
</div>
</div>     
       <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="onarvs">
  <label class="form-check-label" for="inlineCheckbox2">Already on ARVs?</label>
</div>
</div>           
             <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="testing">
  <label class="form-check-label" for="inlineCheckbox2">HIV testing during the visit?</label>
</div>
</div> 
            <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="fearvs">
  <label class="form-check-label" for="inlineCheckbox2"> Fe put on ARVs?</label>
</div>
</div>       
</div>       
         <div class="row">   
   <div class="form-group col-lg-12"><label class="control-label">Baby's Fullname</label>
         <input  name="babyname" class="form-control" placeholder="Enter Baby fullname ">                                                                     
                                </div>
   
       <div class="form-group col-lg-6"><label class="control-label">Place of birth</label>
                   <select class="form-control" name="birthplace">
     <option value="" selected="selected">Select place...</option>
  <option value="CDS">CDS</option>
  <option value="Hospital">Hospital</option>   
  <option value="Home">Home</option>   
                   </select>
       </div>     
                 <div class="form-group col-lg-6"><label class="control-label">First visits / Provenance</label>
                   <select class="form-control" name="firstvisit">
     <option value="" selected="selected">Select...</option>
  <option value="Dans 2 jours">In 2 days</option>
  <option value="3 à 14 jours">In 3 to 14</option>   
  <option value="Après 14 jours">After 14 days</option>   
                   </select>
       </div>     
              <div class="form-group col-lg-6"><label class="control-label">Other Visits</label>
                   <select class="form-control" name="othervisits">
     <option value="" selected="selected">Select...</option>
  <option value="Dans 2 jours">In 2 days</option>
  <option value="3 à 14 jours">In 3 to 14</option>   
  <option value="Après 14 jours">After 14 days</option>   
                   </select>
       </div>     
    <div class="form-group col-lg-6"><label class="control-label">Babies of HIV + mothers put on CTX</label>
          <input  name="onctx" class="form-control" placeholder="Enter value">                                                                     
                                </div>
              <div class="form-group col-lg-6"><label class="control-label">Babies of HIV + mothers sampled</label>
          <input  name="babiessampled" class="form-control" placeholder="Enter value">                                                                     
                                </div>       
               <div class="form-group col-lg-6"><label class="control-label">Vitamin A</label>
<input type="text" name='vitamina' class="form-control" placeholder="Enter Value">                                                                          
                                </div>  
</div>     
         <div class="row">
             <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="pfmembership">
  <label class="form-check-label" for="inlineCheckbox2">PF membership</label>
</div>
</div>  
                <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="arvwomenmembership">
  <label class="form-check-label" for="inlineCheckbox2">  PF membership for women on ARV</label>
</div>
</div>  
     <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="obstetricfistulas">
  <label class="form-check-label" for="inlineCheckbox2">  Evocative signs of obstetric fistulas</label>
</div>
</div>  
          <div class="form-group col-lg-6 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="puerperalinfection">
  <label class="form-check-label" for="inlineCheckbox2">Puerperal infection</label>
</div>
</div>     
             <div class="form-group col-lg-12"><label class="control-label">Problems detected in mother or baby</label>
                    <textarea  name="problems" class="form-control" placeholder="Enter Problems" required="required" rows="4"></textarea>                                                                       
                                </div>    
                <div class="form-group col-lg-12"><label class="control-label">Decisions Taken/ Observations</label>
                    <textarea  name="decisions" class="form-control" placeholder="Enter Decisions" required="required" rows="4"></textarea>                                                                       
                                </div>    
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
             
              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                 frmvalidator.addValidation("exitmode","req","*Exit mode is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
             frmvalidator.addValidation("paymentmethod","req","*Payment Method is required");
            </script>
</body>

</html>