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
    <title>Add Transfusion Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/chosen/chosen.css" rel="stylesheet">
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
                                           include 'fr/addtransfusion.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Blood Transfusion Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Transfusion</a></li>
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
                       <h4 class="card-title">Add Report</h4>
                       </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                                    if(isset($_POST['submit'])){
                                        $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                   $requesttime=mysqli_real_escape_string($con,trim($_POST['requesttime']));
                                   $bloodtype=mysqli_real_escape_string($con,trim($_POST['bloodtype']));
                                   $quantityrequested=mysqli_real_escape_string($con,trim($_POST['quantityrequested']));
                                   $packetsrequested=mysqli_real_escape_string($con,trim($_POST['packetsrequested']));
                                   $quantityrecieved=mysqli_real_escape_string($con,trim($_POST['quantityrecieved']));
                                   $packetsrecieved=mysqli_real_escape_string($con,trim($_POST['packetsrecieved']));
                                   $reason=mysqli_real_escape_string($con,trim($_POST['reason'])); 
                                   $receipttime=mysqli_real_escape_string($con,trim($_POST['receipttime'])); 
                                   $days=mysqli_real_escape_string($con,trim($_POST['days'])); 
                                   $packetnumbers=mysqli_real_escape_string($con,trim($_POST['packetnumbers'])); 
                                   $response=mysqli_real_escape_string($con,trim($_POST['response'])); 
                                   $reactions=$_POST['reactions']; 
                                       if(isset($_POST['anotherday'])){
                                           $timeduration=$days;
                                       }else{
                                        $timeduration=$receipttime;
                                       }
                               if((empty($month))||(empty($year))||(empty($quantityrequested))||(empty($packetsrequested))||(empty($bloodtype))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
                  mysqli_query($con, "INSERT INTO transfusions(patientsque_id,month,year,requesttime,bloodtype,quantityrequested,packetsrequested,quantityreceived,packetsreceived,reason,receipttime,packetnumbers,response,admin_id,timestamp,status) VALUES('$id','$month','$year','$requesttime','$bloodtype','$quantityrequested','$packetsrequested','$quantityrecieved','$packetsrecieved','$reason','$timeduration','$packetnumbers','$response','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
                 $last_id= mysqli_insert_id($con);
                 foreach ($reactions as $reaction) {
                    mysqli_query($con, "INSERT INTO reactions(transfusion_id,reaction,status) VALUES('$last_id','$reaction',1)") or die(mysqli_error($con));    
                 }
              echo '<div class="alert alert-success">Transfusion Successfully Added</div>';

    }             
    }             
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
               
            <div class="form-group col-lg-6">
                <label class="control-label">Request Time*</label>
                <input type="time" name='requesttime' class="form-control" placeholder="Enter Request time" required="required">                                                                          
              </div>     
                            <div class="form-group col-lg-12"><label class="control-label">Blood Type*</label>
                                      <select name="bloodtype" class="form-control">
                                         <option value="">Select Result...</option>
                                         <?php
             $bloodtypes= mysqli_query($con, "SELECT * FROM bloodtypes WHERE status=1");       
              while($row= mysqli_fetch_array($bloodtypes)){
              $bloodtype_id=$row['bloodtype_id'];    
              $bloodtype=$row['bloodtype'];    
              $code=$row['code'];                  
                            ?>
                  <option value="<?php echo $bloodtype_id; ?>"><?php echo $bloodtype.' ('.$code.')'; ?></option>
              <?php }?>
                                      </select>
                           <div id='form_bloodtype_errorloc' class='text-danger'></div>
                       </div>
    <div class="form-group col-lg-6"><label class="control-label">Quantity requested (ml)</label>
<input type="text" name='quantityrequested' class="form-control" placeholder="Enter Quantity requested">                                                                          
                                </div>
      <div class="form-group col-lg-6"><label class="control-label">Number of Packets Requested</label>
          <input type="number" name='packetsrequested' class="form-control" placeholder="Enter Number of Packets" required="required">                                                                          
                                </div>
                     <div class="form-group col-lg-6"><label class="control-label">Reason for Blood Request*</label>
  <select name="reason" class="form-control">
      <option value="">Select Request...</option>
                                       <option value="Anémie">Anémie</option>
                                       <option value="Hémorragie post-partum">Hémorragie post-partum</option>
                                       <option value="Césarienne">Césarienne</option>
                                       <option value="Intervention chirurgicale">Intervention chirurgicale</option>
                                       <option value="Trauma AVP (Traumatismes par accident de la voie publique)">Trauma AVP (Traumatismes par accident de la voie publique)</option>
                                       <option value="Trauma autres">Trauma autres</option>
                                       <option value="Autres raisons/motifs">Autres raisons/motifs</option>
                                        </select>
                           <div id='form_reason_errorloc' class='text-danger'></div>
                       </div>
             <div class="form-group col-lg-12 mb-4 mt-2">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" id="sameday" name="anotherday">
  <label class="form-check-label" for="inlineCheckbox1">Is reception on another day?</label>
</div> 
</div> 
    <div class="form-group col-lg-6 fortime"><label class="control-label">Time of receipt of bags</label>
          <input type="time" name='receipttime' class="form-control" placeholder="Time of receipt of bags">                                                                          
                                </div>
                      <div class="form-group col-lg-6 fordays"  style="display: none"><label class="control-label">Number of Days Elapsed</label>
          <input type="number" name='days' class="form-control" placeholder="Number of Days">                                                                          
                                </div>
                                <div class="form-group col-lg-6"><label class="control-label">Total Packets Allocated</label>
          <input type="number" name='packetsrecieved' class="form-control" placeholder="Number of Packets" required="required">                                                                          
                                </div>
              <div class="form-group col-lg-12"><label class="control-label">Numbers of the Packets allocated (Seperate by commas)</label>
          <input type="text" name='packetnumbers' class="form-control" placeholder="Numbers on the Packets" required="required">                                                                          
                                </div>
                                   <div class="form-group col-lg-6"><label class="control-label">Total Blood Quantity (ml) Allocated</label>
          <input type="text" name='quantityrecieved' class="form-control" placeholder="Enter Quantity" required="required">                                                                          
                                </div>
                         <div class="form-group col-lg-6"><label class="control-label">Blood Bank Response*</label>
  <select name="response" class="form-control">
      <option value="">Select  Response...</option>
     <option value="Totale">Total</option>
     <option value="Partielle">Partial</option>
     <option value="Aucune">None</option>
  </select>                                
</div> 
                        <div class="form-group col-lg-12"><label class="control-label">Reactions Observed*</label>
 <select name="reactions[]" data-placeholder="Choose Reactions..." class="chosen-select" style="width:100%;"  multiple>
                     <option value="">select Reactions...</option>
                <option value="Frisson">Thrill</option>
                <option value="Fièvre">Fever</option>
                <option value="Douleur">Pain</option>
                <option value="Dyspnée">Dyspnea</option>
                <option value="Nausée">Nausea</option>
                <option value="Vomissements">Vomiting</option>
                <option value="Evanouissement">Fainting</option>
                <option value="Convulsion">Convulsion</option>
                <option value="Urticaire">Urticaria</option>
                <option value="Décès dû à un accident transfusionnel">Death due to transfusion accident</option>
                <option value="Décès durant transfusion">Death during transfusion</option>
                <option value="Décès par manque de sang">Death from lack of blood</option>
                    
                                        </select>                              
</div> 
         <div class="form-group pull-left">
                           
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
            <script src="js/chosen/chosen.jquery.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
        <script>
               $('#sameday').click(function(){
    if($(this).prop("checked")=== true){
       $('.fordays').show();    
       $('.fortime').hide();    
               }else{
      $('.fordays').hide();    
   $('.fortime').show();    
        }
    } );
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

              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                 frmvalidator.addValidation("bloodtype","req","*Blood Type is required");
                 frmvalidator.addValidation("reason","req","*Reason is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
          </script>
</body>

</html>