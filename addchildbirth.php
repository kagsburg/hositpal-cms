<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
  $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
 <!--<meta charset="utf-8">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register Child Birth</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="css/chosen/chosen.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
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
 if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                 include 'fr/addchildbirth.php';                     
                                       }else{
?>
     <div class="content-body">
            <!-- row -->
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
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Register Child Birth for <?php echo $firstname.' '.$lastname.' (#'.$pin.')'; ?></h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="childbirths">Child Birth</a></li>
                            <li class="breadcrumb-item active"><a href="addchildbirth">Add Child Birth</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Child Birth</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                            if(isset($_POST['submit']))  {
                                       $qualification=$_POST['qualification'];
                                    $risk=$_POST['risk'];
                                    $gesture= mysqli_real_escape_string($con,trim($_POST['gesture']));
                                    $parity= mysqli_real_escape_string($con,trim($_POST['parity']));
                                    $childrenalive=$_POST['childrenalive'];
                                    $abortions=$_POST['abortions'];
                                    $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                            $childbirthtype= mysqli_real_escape_string($con,trim($_POST['childbirthtype']));    
                            $events=$_POST['events'];    
                            $indications=$_POST['indications'];    
                            $complications=$_POST['complications'];    
                            $condition=$_POST['condition'];    
                            $apgar=$_POST['apgar'];    
                            $sex=$_POST['sex'];                                 
                         $stillbirthstatus=$_POST['stillbirthstatus'];    
                       $ptme= mysqli_real_escape_string($con,trim($_POST['ptme']));  
                       $deliverydate= mysqli_real_escape_string($con,strtotime($_POST['deliverydate']));  
                       $releasedate= mysqli_real_escape_string($con,strtotime($_POST['releasedate']));  
                       $contraceptive= mysqli_real_escape_string($con,trim($_POST['contraceptive']));  
                    if((empty($month))||(empty($year))||(empty($qualification))||(empty($childbirthtype))||(empty($releasedate))||(empty($deliverydate))){
                              echo '<div class="alert alert-danger">All Fields marked * Should be Filled</div>';
                              }
                          else{
                    if(isset($_POST['diabetes'])){
                      $diabetes=$_POST['diabetes'];
                    }else{
                   $diabetes='No';     
                    }
                      if(isset($_POST['bloodpressure'])){
                      $bloodpressure=$_POST['bloodpressure'];                      
                    }else{
                  $bloodpressure='No';
                    }
                      if(isset($_POST['birthatrisk'])){
                      $birthatrisk=$_POST['birthatrisk'];                      
                    }else{
                  $birthatrisk='No';
                    }
                      if(isset($_POST['malaria'])){
                      $malaria=$_POST['malaria'];                      
                    }else{
                  $malaria='No';
                    }
                   if(isset($_POST['abortion'])){
                      $abortion=$_POST['abortion'];                      
                    }else{
                  $abortion='No';
                    }  
                     if(isset($_POST['anemia'])){
                      $anemia=$_POST['anemia'];                      
                    }else{
                  $anemia='No';
                    }
                      if(isset($_POST['motherdied'])){
                      $motherdied=$_POST['motherdied'];                      
                    }else{
                  $motherdied='No';
                    }
       mysqli_query($con,"INSERT INTO childbirths(month,year,admission_id,qualification,risk,gesture,parity,childrenalive,abortions,diabetes,bloodpressure,birthatrisk,childbirthtype,abortion,malaria,anemia,motherdied,ptme,deliverydate,contraceptive,releasedate,admin_id,timestamp,status) VALUES('$month','$year','$id','$qualification','$risk','$gesture','$parity','$childrenalive','$abortions','$diabetes','$bloodpressure','$birthatrisk','$childbirthtype','$abortion','$malaria','$anemia','$motherdied','$ptme','$deliverydate','$contraceptive','$releasedate','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
       $last_id= mysqli_insert_id($con);  
       foreach ($complications as $complication) {
            mysqli_query($con,"INSERT INTO  complications(complication,childbirth_id,status) VALUES('$complication','$last_id',1)") or die(mysqli_error($con));
      }
         foreach ($events as $event) {
            mysqli_query($con,"INSERT INTO  deliveryevents(deliveryevent,childbirth_id,status) VALUES('$event','$last_id',1)") or die(mysqli_error($con));
      }
     foreach ($indications as $indication) {
     mysqli_query($con,"INSERT INTO  indications(indication,childbirth_id,status) VALUES('$indication','$last_id',1)") or die(mysqli_error($con));
      }
       foreach ($stillbirthstatus as $stillbirthstatus) {
            mysqli_query($con,"INSERT INTO  stillbirthstatus(stillbirthstatus,childbirth_id,status) VALUES('$stillbirthstatus','$last_id',1)") or die(mysqli_error($con));
      }  
      $allconditions= sizeof($condition);
     for($i=0;$i<$allconditions;$i++){
    mysqli_query($con,"INSERT INTO childbirthoutcomes(childbirth_id,outcome,apgar,sex,status) VALUES('$last_id','$condition[$i]','$apgar[$i]','$sex[$i]','1')") or die(mysqli_error($con));
}  
echo '<div class="alert alert-success">Child Birth Successfully Added.</div>';
    }
        }
    ?>
                        
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
       
         <div class="row">
                               
                    <div class="form-group col-lg-6"><label class="control-label">* Qualification of the person in charge</label>
 <select name="qualification" class="form-control">
        <option value="">Select ...</option>
        <?php           
                       $getresponsiblequalifications= mysqli_query($con,"SELECT * FROM responsiblequalifications WHERE status=1");
                                while($row1= mysqli_fetch_array($getresponsiblequalifications)){
                               $responsiblequalification_id=$row1['responsiblequalification_id'];
                               $responsiblequalification=$row1['responsiblequalification'];       
                               $code=$row1['code'];
                             ?>  
        <option value="<?php echo $responsiblequalification_id; ?>"><?php echo $responsiblequalification;  ?></option>
                                <?php }?>
 </select>
                           <div id='form_qualification_errorloc' class='text-danger'></div>
                    </div>
            <div class="form-group col-lg-12">
                <label>*Risk</label><br>
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="risk" id="inlineRadio1" value="< 18 ans">
  <label class="form-check-label" for="inlineRadio1">< 18 ans</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="risk" id="inlineRadio2" value="> 35 ans">
  <label class="form-check-label" for="inlineRadio2">> 35 ans</label>
</div></div>
        
             <div class="col-lg-12"><h3>Obstetric ATCD</h3></div>
            <div class="form-group col-lg-3"><label class="control-label">Gesture</label>
<input type="number" name='gesture' class="form-control" placeholder="Enter Gesture">                                                                          
                                </div>
               <div class="form-group col-lg-3"><label class="control-label">Parity</label>
<input type="number" name='parity' class="form-control" placeholder="Enter Parity">                                                                          
                                </div>       
                   <div class="form-group col-lg-3"><label class="control-label">Number of children alive</label>
<input type="number" name='childrenalive' class="form-control" placeholder="Enter children alive" required="required">                                                                          
                                </div>
  <div class="form-group col-lg-3"><label class="control-label">Number of Abortions</label>
<input type="number" name='abortions' class="form-control" placeholder="Enter Number of Abortions">                                                                          
                                </div>       
           
                                </div>
           <div class="row">
            <div class="form-group col-lg-12 mb-4 mt-4">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="diabetes">
  <label class="form-check-label" for="inlineCheckbox1">Has Diabetes?</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="bloodpressure">
  <label class="form-check-label" for="inlineCheckbox2">Knew of her High Blood Pressure?</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="birthatrisk">
  <label class="form-check-label" for="inlineCheckbox2">Childbirth detected at risk by the CPN</label>
</div>
       </div>
  
              <div class="form-group col-lg-6"><label class="control-label">* Child Birth Type</label>
  <select name="childbirthtype" class="form-control">
                                            <option value="">Select Child Birth Type...</option>
                                       <option value="dystocique">dystocique</option>
                                       <option value="accouchement eutocique">eutocic childbirth</option>
                                        </select>
                                       <div id='form_childbirthtype_errorloc' class='text-danger'></div>        
                                   </div>
                                <div class="form-group col-lg-12 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="abortion">
  <label class="form-check-label" for="inlineCheckbox2">Is Childbirth an abortion?</label>
</div>
      <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="malaria">
  <label class="form-check-label" for="inlineCheckbox2">Woman has malaria?</label>
</div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="anemia">
  <label class="form-check-label" for="inlineCheckbox2">Woman has Anemia?</label>
</div>                   
  </div>
               <div class="col-lg-12 form-group">
                   <label>Delivery Process</label>
            
                   <select name="events[]" data-placeholder="Choose Events..." class="chosen-select" style="width:100%;"  multiple>
                                            <option value="">select events...</option>
                <option value="Forceps">Forceps</option>
                <option value="Ventouse">Ventouse</option>
                <option value="Manoeuvre interne">Manoeuvre interne</option>
                <option value="Manoeuvre externe">Manoeuvre externe</option>
                <option value="Césarienne">Césarienne</option>
                    
                                        </select>
           </div>
                  <div class="col-lg-12 form-group">
                   <label>Cesarean section indications</label>
                 <select name="indications[]" data-placeholder="Choose indications..." class="chosen-select" style="width:100%;"  multiple>
                                            <option value="">select indications...</option>
                <option value="Disp. Foetopelevienne">Disp. Foetopelevienne</option>
                <option value="Placenta praevi">Placenta praevi</option>
                <option value="Présentation inadéquate">Présentation inadéquate</option>
                <option value="Procidence du cordon">Procidence du cordon</option>
                <option value="Rupture utérine">Rupture utérine</option>
                <option value="Utérus cicatriciel">Utérus cicatriciel</option>
                <option value="Souffrance foetale">Souffrance foetale</option>
                    
                                        </select>
           </div>
               <div class="col-lg-12 form-group">
                   <label>Direct obstetric complications</label>
                 <select name="complications[]" data-placeholder="Choose complications..." class="chosen-select" style="width:100%;"  multiple>
                                            <option value="">select complications...</option>
                <option value="Hémorragie antépartum">Hémorragie antépartum</option>
                <option value="Hémorragie post partum">Hémorragie post partum</option>
                <option value="Pré éclampsie">Pré éclampsie</option>
                <option value="Eclampsie">Eclampsie</option>
                    </select>
           </div>
                                  
               
                                </div>
              <div class='subobj'>
                         <div class='row'>
                               <div class="col-lg-12"><h3>Childbirth outcomes (If born alive)</h3></div>       
                              <div class="col-lg-4 form-group">
                   <label>Condition</label>
                 <select name="condition[]"  class="form-control">
                    <option value="" selected="selected">select condition...</option>
                      <option value="Naissance vivante - à terme >= 2.5 kg">Live birth - at term> = 2.5 kg</option>
                <option value="Naissance vivante - à terme < 2.5 kg">Live birth - term <2.5 kg</option>
                <option value="Naissance vivante - prématurés">Live birth - premature</option>
           </select>
                   </div>
              <div class="col-lg-4 form-group">
                  <label>Child's APGAR</label>
                  <input type="text" class="form-control" name="apgar[]" placeholder="Enter APGAR">
              </div>
                <div class="col-lg-2 form-group">
                   <label>Sex</label>
                 <select name="sex[]"  class="form-control">
             <option value="" selected="selected">select Sex...</option>
                 <option value="M">M</option>
                 <option value="F">F</option>
           
                 </select>
                                </div>
                <div class="form-group col-lg-2">
                                                         <a href='#' class="subobj_button btn btn-success btn-xs" style="margin-top:30px">Add More</a>                                              
                                            </div> 
                                            </div> 
                                </div>
                <div class="col-lg-12"><h3>Deaths</h3></div>   
                                    <div class='subobj1'>
                         <div class='row'>
                 <div class="col-lg-6 form-group">
                   <label>Status of Stillbirths</label>
                 <select name="stillbirthstatus[]"  class="form-control">
                    <option value="" selected="selected">select status...</option>              
                <option value="Mort-nés – BCF +">Mort-nés – BCF +</option>
                  <option value="Mort-nés – BCF - frais">Mort-nés – BCF - frais</option>
                  <option value="Mort-nés – BCF – macéré">Mort-nés – BCF – macéré</option>
               </select>
              </div>
                                  <div class="form-group col-lg-2">
                                                         <a href='#' class="subobj1_button btn btn-success btn-xs" style="margin-top:30px">Add More</a>                                              
                                            </div> 
                                </div>
                                </div>
                <div class="row">
                  <div class="form-group col-lg-12 mb-4">
                <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="yes" name="motherdied">
  <label class="form-check-label" for="inlineCheckbox2">Mother Died During Birth?</label>
</div>
</div>
                <div class="col-lg-6 form-group">
                   <label>PTME</label>
                 <select name="ptme"  class="form-control">
                    <option value="" selected="selected">select options...</option>              
                <option value="VIH+ déjà connu HIV">VIH+ déjà connu HIV</option>
                  <option value="Déjà sous ARV">Déjà sous ARV</option>
                  <option value="Dépis. VIH au cours du travail">Dépis. VIH au cours du travail</option>
                  <option value="Fe mise sous ARVFe">Fe mise sous ARVFe</option>
                  <option value="NN mis sous ARV">NN mis sous ARV</option>
                  <option value="Hépatite virale B+ déjà connu">Hépatite virale B+ déjà connu</option>
                  <option value="Déjà sous traitement pour Hépatite">Déjà sous traitement pour Hépatite</option>
                  <option value="NN de mères HVB ayant reçu le vaccin HVB dans les 24 heures NN de HVB +">NN de mères HVB ayant reçu le vaccin HVB dans les 24 heures NN de HVB +</option>
               </select>
              </div>
                     <div class="col-lg-6 form-group">
                   <label>Delivery Date *</label>
                   <input type="date" class="form-control" name="deliverydate" required="required">
                 </div>
                      <div class="col-lg-6 form-group">
                   <label>Contraceptive Method Recieved (If Any)</label>
                   <input type="text" class="form-control" name="contraceptive">
                 </div>
                   <div class="col-lg-6 form-group">
                   <label>Release Date</label>
                   <input type="date" class="form-control" name="releasedate" required="required">
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
      <script src="js/chosen/chosen.jquery.js"></script>
        <script>
                $('.subobj_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.subobj').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row"> <div class="form-group col-lg-4">  <label>Condition</label><select name="condition[]"  class="form-control"> <option value="Live birth - at term> = 2.5 kg">Live birth - at term> = 2.5 kg</option>  <option value="" selected="selected">select condition...</option> <option value="Live birth - term <2.5 kg">Live birth - term <2.5 kg</option><option value="Live birth - premature">Live birth - premature</option> </select></div> <div class="form-group col-lg-5"><label>Child APGAR</label> <input type="text" class="form-control" name="apgar[]" placeholder="Enter APGAR"> </div> <div class="form-group col-lg-3">  <label>Sex</label><select name="sex[]"  class="form-control"><option value="" selected="selected">select Sex...</option><option value="M">M</option> <option value="F">F</option></select></div></div> </div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>'); //add input box
         });
          $('.subobj').on("click",".remove_subobj", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
       $('.subobj1_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.subobj1').append('<div class="row"><div class="col-lg-6"><div class="row"> <div class="form-group col-lg-12"><select name="stillbirthstatus[]"  class="form-control"> <option value="" selected="selected">select status...</option><option value="Mort-nés – BCF +">Mort-nés – BCF +</option> <option value="Mort-nés – BCF - frais">Mort-nés – BCF - frais</option> <option value="Mort-nés – BCF – macéré">Mort-nés – BCF – macéré</option> </select></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;"><i class="fa fa-minus"></i></button></div>'); //add input box
         });
          $('.subobj1').on("click",".remove_subobj1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
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

        var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
          
              frmvalidator.addValidation("patient","req","*Patient is required");
              frmvalidator.addValidation("month","req","*Month  is required");
              frmvalidator.addValidation("year","req","*Year  is required");
              frmvalidator.addValidation("qualification","req","*Qualification  is required");
       </script>
</body>

</html>
