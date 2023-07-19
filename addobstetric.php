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
    <title>Add Gyneco-Obstetric Report</title>
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
                                           include 'fr/addobstetric.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Gyneco-Obstetric Report</h4>
                       </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="inpatients"> In Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Gyneco-Obstetric Report</a></li>
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
                            $getprevque=mysqli_query($con,"SELECT * FROM patientsque WHERE admission_id='$admission_id'   AND status=1 ORDER BY patientsque_id DESC");  
              $rowp= mysqli_fetch_array($getprevque);
                $preroom=$rowp['room'];
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
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                 if(isset($_POST['submit'])){
                                      $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                        $ptme=$_POST['ptme'];
                                        $exitdate= mysqli_real_escape_string($con,strtotime($_POST['exitdate']));           
                                        $exittime= mysqli_real_escape_string($con,trim($_POST['exittime']));           
                                        $entrymode= mysqli_real_escape_string($con,trim($_POST['entrymode']));           
                                        $exitmode= mysqli_real_escape_string($con,trim($_POST['exitmode']));           
                                      $diagnosiscode= mysqli_real_escape_string($con,trim($_POST['diagnosiscode']));           
                                        $diagnosis= mysqli_real_escape_string($con,trim($_POST['diagnosis']));           
                                        $authorizedexitmode= mysqli_real_escape_string($con,trim($_POST['authorizedexitmode']));           
                                        $context= mysqli_real_escape_string($con,trim($_POST['context']));           
                                      $comments= mysqli_real_escape_string($con,trim($_POST['comments']));        
                                      $paymentmethod= mysqli_real_escape_string($con,trim($_POST['paymentmethod']));        
                                        if(isset($_POST['postprocedureinfection'])){
                                           $postprocedureinfection=$_POST['postprocedureinfection'];
                                       }else{
                                        $postprocedureinfection='No';
                                       }
                               if((empty($month))||(empty($year))||(empty($entrymode))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
            mysqli_query($con, "INSERT INTO obstetrics(patientsque_id,month,year,entrymode,ptme,exitdate,exittime,exitmode,authorizedexitmode,diagnosiscode,diagnosis,context,postprocedureinfection,paymentmethod,comments,admin_id,timestamp,status) VALUES('$id','$month','$year','$entrymode','$ptme','$exitdate','$exittime','$exitmode','$authorizedexitmode','$diagnosiscode','$diagnosis','$context','$postprocedureinfection','$paymentmethod','$comments','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
            echo '<div class="alert alert-success">Data Successfully Added</div>';
    }             
    }             
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
            
                       <?php
                                    if(mysqli_num_rows($getprevque)>0){ 
                              ?>
                              <select name="entrymode" class="form-control"  style="display: none">
                                  <option value="<?php echo $preroom; ?>" selected="selected">From another department</option>
                              </select>
                                    <?php }else{?>
                         <div class="form-group col-lg-6">
                                    <label class="control-label">Entry Mode*</label>
                                 <select name="entrymode" class="form-control" id="entrymode">
                                     <option value="">Select Entry Mode...</option>
                                   
                                       <option value="Réf CDS">Sent by a health center with a ticket,</option>
                                       <option value="Réf autre hôpital">From Another hospital with a ticket</option>
                                       <option value="Intra-hop: Consult">From the hospital outpatient clinic</option>
                                         <option value="Non référé">Other cases</option>
                                   
                                                </select>
                           <div id='form_entrymode_errorloc' class='text-danger'></div>
                       </div>
                       <?php }?>
                     <div class="col-lg-12 form-group">
                   <label>PTME</label>
                 <select name="ptme"  class="form-control">
                    <option value="" selected="selected">select options...</option>              
                <option value="HIV + et qu’elle le savait déjà">Woman is HIV + and she already knew it</option>
                  <option value="Déjà sous ARV">Woman is already on ARVs</option>
                  <option value="est mise sous ARV pour la 1ère fois">Woman is on ARVs for the first time,</option>
                  <option value="connaît pas son statut VIH et qu’elle est dépistée au cours de l’hospitalisation">Woman does not know her HIV status and is tested during hospitalization,</option>
                            </select>
              </div>                         
             
                       </div>
                 
         <div class="row">
             <div class="col-lg-12"><p><strong>Main Diagnosis</strong></p></div>
          <div class="form-group col-lg-6"><label class="control-label">Diagnosis Code*</label>
<input type="text" name='diagnosiscode' class="form-control" placeholder="Enter  code" required="required">                                                                          
                                </div>
                <div class="form-group col-lg-6"><label class="control-label">Diagnosis*</label>
<input type="text" name='diagnosis' class="form-control" placeholder="Enter  Diagnosis" required="required">                                                                          
                                </div>
   <div class="form-group col-lg-12"><label class="control-label"> Diagnosis Context</label>
                    <textarea  name="context" class="form-control" placeholder="Enter Diagnosis context" required="required" rows="4"></textarea>                                                                       
                                </div>
     <div class="form-group col-lg-6"><label class="control-label">Date of Exit*</label>
                <input type="date" name='exitdate' class="form-control" placeholder="Enter Exit Date" required="required">                                                                          
                                </div>   
                <div class="form-group col-lg-6"><label class="control-label">Time of Exit*</label>
                    <input type="time" name='exittime' class="form-control" placeholder="Enter Exit time" required="required">                                                                          
                                </div>        
               <div class="form-group col-lg-6"><label class="control-label">Exit Mode*</label>
                             <select name="exitmode" class="form-control" id="exitmode">
                                          <option value="">Select Exit mode...</option>
                                       <option value="Autorisée">Authorized</option>
                                       <option value="Contre avis medIcal">Against Medical Opinion</option>
                                       <option value="Evadé">Escaped</option>
                                       <option value="Décès avant 24 heures">Death Before 24 Hours</option>
                                       <option value="Mort après 24 heures">Death After 24 Hours</option>
                                       <option value="Décès maternel">Maternal death</option>
                                                </select>
                           <div id='form_exitmode_errorloc' class='text-danger'></div>
                       </div>
               <div class="form-group col-lg-6 authorizedexitmode" style="display: none"><label class="control-label">Exit mode for authorized*</label>
                             <select name="authorizedexitmode" class="form-control" id="authorizedexitmode">
                                          <option value="">Select mode...</option>
                                       <option value="contre-référence">counter-reference</option>
                                       <option value="Retour vers niveau inférieur">Return to lower level</option>
                                       <option value="transfert vers niveau équivalent">Transfer to equivalent level</option>
                                       <option value="transfert vers niveau supérieur">Transfer to higher level</option>
                                       <option value="transfert intra hôpital">Intra-hospital transfer</option>
                                       <option value="Amélioré / Retour à domicile">Improved / Return home</option>
                                                </select>
                                         </div>
             <div class="form-group col-lg-6 destination" style="display: none">
	        <label>Select Destination Department</label>
                              <select name="destination" class="form-control">
      <option value="" selected="">select ...</option>
    <?php
                               $getcategories=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $servicecategory_id=$row1['servicecategory_id'];
                                              $servicecategory=$row1['servicecategory'];
                                                         ?>
                                            <option value="<?php echo $servicecategory_id; ?>"><?php echo $servicecategory; ?></option>
                            <?php }?>
  </select>
   </div>
               <div class="form-group col-lg-12 mb-4 mt-4">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="postprocedureinfection">
  <label class="form-check-label" for="inlineCheckbox1">Post-procedure infection?</label>
</div> 
</div> 
           
           <div class="form-group col-lg-6"><label class="control-label">Payment Method*</label>
                         <select name="paymentmethod" class="form-control">
      <option value="" selected="">select Method ...</option>
     <?php
                                            $getmethods= mysqli_query($con,"SELECT * FROM paymentmethods WHERE status=1") or die(mysqli_error($con));
                                       while($row= mysqli_fetch_array($getmethods)){
                                                $paymentmethod_id=$row['paymentmethod_id'];
                                                $paymentmethod=$row['paymentmethod'];
                                                $code=$row['code'];
                                            ?>
                                            <option value="<?php echo $paymentmethod_id; ?>"><?php echo $paymentmethod; ?></option>
                                            <?php }?>
  </select>
                         <div id='form_paymentmethod_errorloc' class='text-danger'></div>   
                                  </div>
              <div class="form-group col-lg-12"><label class="control-label">Comments and observations</label>
                    <textarea  name="comments" class="form-control" placeholder="Enter comments and observations" required="required" rows="4"></textarea>                                                                       
                                </div>
</div> 
     <div class="form-group">
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
        <script>
                       $('#exitmode').on('change', function() {
               var getselect=$(this).val();
                   if((getselect==='Autorisée')){ 
                 $('.authorizedexitmode').show();
                        $('#authorizedexitmode').on('change', function() {
               var getvalue=$(this).val();
                    if((getvalue==='transfert intra hôpital')){ 
            $('.destination').show();            
        }else{
               $('.destination').hide();    
        }
             });
         }else{
              $('.authorizedexitmode').hide();
                     }
           } );
              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
//                 frmvalidator.addValidation("entrymode","req","*Entry mode is required");
                 frmvalidator.addValidation("exitmode","req","*Exit mode is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
             frmvalidator.addValidation("paymentmethod","req","*Payment Method is required");
          </script>
</body>

</html>