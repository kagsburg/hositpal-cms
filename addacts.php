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
    <title>Register Acts</title>
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
                                           include 'fr/addacts.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Register Acts</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Register patient acts</a></li>
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
                                <h4 class="card-title">Acts Register</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                 if(isset($_POST['submit'])){
                                        $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                        $exitdate= mysqli_real_escape_string($con,strtotime($_POST['exitdate']));           
                                        $exittime= mysqli_real_escape_string($con,trim($_POST['exittime']));              
                                        $exitmode= mysqli_real_escape_string($con,trim($_POST['exitmode']));      
                                       $diagnosis= mysqli_real_escape_string($con,trim($_POST['diagnosis']));           
                                      $comments= mysqli_real_escape_string($con,trim($_POST['comments']));         
                                         $destination=$_POST['destination'];    
                                        $drug=$_POST['drug'];
                                        $prescription=$_POST['prescription'];
                                        $quantity=$_POST['quantity'];
                                          if(isset($_POST['pregnant'])){
                                           $pregnant=$_POST['pregnant'];
                                       }else{
                                        $pregnant='No';
                                       }
                                             if(isset($_POST['death'])){
                                           $death=$_POST['death'];
                                       }else{
                                        $death='No';
                                       }
                                       
                               if((empty($month))||(empty($year))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
                       mysqli_query($con, "INSERT INTO acts(patientsque_id,month,year,exittime,exitdate,exitmode,pregnant,diagnosis,comments,death,destination,admin_id,timestamp,status) VALUES('$id','$month','$year','$exittime','$exitdate','$exitmode','$pregnant','$diagnosis','$comments','$death','$destination','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
     mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
       if(!empty($destination)){
    mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','$destination','0','0','".$_SESSION['elcthospitaladmin']."','technician',UNIX_TIMESTAMP(),0,'$id')") or die(mysqli_error($con));
   $lastid= mysqli_insert_id($con);
    if(isset($_POST['services'])){ 
     mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,insurer,percentage,source,status) VALUES('$lastid','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),0,0,'','acts',0)") or die(mysqli_error($con));
     $last_id= mysqli_insert_id($con);
     $services=$_POST['services']; 
     foreach ($services as $service) {
      $getmedicalservice=  mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$service'");
       $row1=  mysqli_fetch_array($getmedicalservice);
         $charge=$row1['charge'];
     mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$service','$charge',1)") or die(mysqli_error($con)); 
     }
     }  
  $alldrugs=sizeof($drug);
     if($destination==17){
      mysqli_query($con, "INSERT INTO pharmacyorders(patientsque_id,admin_id,timestamp,payment,insurer,percentage,source,status) VALUES('$lastid','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),0,0,'','acts',0)") or die(mysqli_error($con));
     $last_id= mysqli_insert_id($con);   
for($i=0;$i<$alldrugs;$i++){
    mysqli_query($con,"INSERT INTO pharmacyordereditems(item_id,pharmacyorder_id,prescription,quantity,status) VALUES('$drug[$i]','$last_id','$prescription[$i]','$quantity[$i]','1')") or die(mysqli_error($con));

    } 
     } 
     } 
  echo '<div class="alert alert-success">Patient Act Successfully Added</div>';
    }             
    }             
                
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
         
              
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
                       </div>
                    
         <div class="row auditsec" style="display: none">
        <div class="form-group col-lg-12 mb-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"  value="yes" name="audited" id="audited">
  <label class="form-check-label" for="inlineCheckbox1">Is Maternal Death Audited?</label>
</div> 
</div> 
                      <div class="form-group col-lg-6 auditdate" style="display: none"><label class="control-label">Audit Date</label>
<input type="date" name='auditdate' class="form-control" placeholder="Enter  Date">                                                                          
       </div>
       </div>
           <div class="row">
               
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
            
                                         </div>
      
                    <div class="row destination" style="display: none">
                    <div class="col-lg-6">
                    <div class="form-group">
                <label>Select Destination Section</label>
          <select name="destination" class="form-control" id="destination">
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
   </div>
                          <div class="col-lg-12">
                 <?php 
                            $getcategories=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $servicecategory_id=$row1['servicecategory_id'];
                                              $servicecategory=$row1['servicecategory'];
                                            ?>
                            <div   id="medicalservice<?php echo $servicecategory_id;?>" style="display:none;width:100%;" class="row medicalservices form-group">        
                                <div class="col-lg-12 form-group"><strong>Select Services</strong></div>
            		  <?php                        
                            $getmedicalservices=  mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND servicecategory_id='$servicecategory_id' ORDER BY medicalservice");
                            while( $row1=  mysqli_fetch_array($getmedicalservices)){
                                              $medicalservice_id=$row1['medicalservice_id'];
                                              $medicalservice=$row1['medicalservice'];
                                              $charge=$row1['charge'];
            ?>
         <div class="col-lg-6">
         <div class="form-check form-check-inline">
             <label class="form-check-label" style="font-size:13px">
                 <input type="checkbox" class="form-check-input" value="<?php echo $medicalservice_id; ?>" name="services[]"><?php echo $medicalservice; ?>
                              </label>
                                            </div>
        </div>
        
            <?php } ?>					
    </div>
            <?php }?>
                              <div class='pharmacysec' style="display:none">
                       <div class='row'>
                         <div class="col-lg-12"><p><strong>Add Drugs</strong></p></div>
                 <div class="form-group col-lg-6">
                   <label>Drug item</label>
                   <select class="form-control" name="drug[]">
                       <option value="" selected="">Select Drug...</option>
               <?php
                           $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ORDER BY commercialname");  
                              while ($row = mysqli_fetch_array($getitems)) {
                             $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $dosage=$row['dosage'];
                                          $unitprice=$row['unitprice'];
                                        $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                           $getforms=mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                                    $row3=  mysqli_fetch_array($getforms);
                                    $pharmaceuticalform=$row3['pharmaceuticalform'];
                   ?>
                       <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo $commercialname.' ('.$pharmaceuticalform.')'?></option>
                           <?php }?>
                       </select>
               </div>
                   <div class="form-group col-lg-5">
                   <label>Prescription</label>
                   <input type="text"  name="prescription[]" class="form-control " placeholder="Enter value">
	 </div>
                  <div class="form-group col-lg-1">
                        <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>                                              
                     </div> 
                         <div class="form-group col-lg-6">
                   <label>Quantity</label>
                   <input type="text"  name="quantity[]" class="form-control " placeholder="Enter value">
	 </div>
	 </div>
	 </div>                                           
			
			  </div>
  </div>                           
         <div class="row">
               <div class="form-group col-lg-12 mb-4 mt-2">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="pregnant">
  <label class="form-check-label" for="inlineCheckbox1">Is Patient Pregnant Woman?</label>
</div> 
</div> 
                 <div class="form-group col-lg-6"><label class="control-label">Date of Exit*</label>
                <input type="date" name='exitdate' class="form-control" placeholder="Enter Exit Date" required="required">                                                                          
                                </div>   
                   <div class="form-group col-lg-6"><label class="control-label">Time of Exit*</label>
                    <input type="time" name='exittime' class="form-control" placeholder="Enter Exit time" required="required">                                                                          
                                </div>
   <div class="form-group col-lg-12"><label class="control-label"> Clinical / Physical signs</label>
                    <textarea  name="diagnosis" class="form-control" placeholder="Enter Signs" required="required" rows="4"></textarea>                                                                       
                                </div>
           
               <div class="form-group col-lg-12 mb-4">
                    <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox"  value="yes" name="death">
  <label class="form-check-label" for="inlineCheckbox1">Death During Act?</label>
</div> 
</div> 
        <div class="form-group col-lg-12"><label class="control-label">Main Diagnosis</label>
       <textarea  name="comments" class="form-control" placeholder="Main Diagnosis " required="required" rows="4"></textarea>                                                                            
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
                           $('#exitmode').on('change', function() {
               var getselect=$(this).val();
               if((getselect==='Décès maternel')){ 
                 $('.auditsec').show();
                      $('#audited').click(function(){
    if($(this).prop("checked")=== true){
       $('.auditdate').show();    
               }else{
      $('.auditdate').hide();    
           }
    } );
  }  
                           else{
              $('.auditsec').hide();
                     }
        if((getselect==='Autorisée')){ 
                 $('.authorizedexitmode').show();
                        $('#authorizedexitmode').on('change', function() {
               var getvalue=$(this).val();
                    if((getvalue==='transfert intra hôpital')){ 
            $('.destination').show();        
      $('#medicalservicename').click(function() {
        if ( $('#destination').val() === '') {
        	alert("Please Select a destination first");
        }     
    });   
    
          $('#destination').change(function() {
        if ( ($(this).val() !== '')&&($(this).val() !== '17')) {
//       	 $(this).closest("form").attr('action',  $(this).val());
        	 $("#medicalservicename").hide();
                 $( ".medicalservices" ).each(function( index ) {

		        		// console.log(this.id);
		                 $("#"+this.id).hide();
		            

		        });

             $("#medicalservice"+ $('#destination').val()).show();
         var townid=  $("#medicalservice"+ $('#destination').val());
                   var config = {
                '.chosen-select'   : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            } 
         $('.medicalservices').change(function() {                               
             	 $(this).closest("form").attr('action',  $(this).val());                  
                    });
          }
       else {
             $("#medicalservicename").show();
                 $( ".medicalservices" ).hide();
         }
           if ($(this).val() === '17') {
                $( ".medicalservices" ).hide();
                    $( ".pharmacysec" ).show();
                 $('.subobj1_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.pharmacysec').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Drug</label>   <select class="form-control" name="drug[]">  <option value="" selected="">Select Drug...</option>     <?php    $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ");        while ($row = mysqli_fetch_array($getitems)) {       $pharmacyitem_id=$row["pharmacyitem_id"];  $genericname=$row["genericname"];    $commercialname=$row["commercialname"];        $dosage=$row["dosage"];    $unitprice=$row['unitprice'];    $pharmaceuticalform_id=$row['pharmaceuticalform_id'];     $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");         $row1=  mysqli_fetch_array($getcats);                      $pharmaceuticalform=$row1['pharmaceuticalform'];  ?>     <option value="<?php echo $pharmacyitem_id.'_'.$unitprice; ?>"><?php echo  trim(preg_replace('/[^a-zA-Z0-9\-]/', ' ', $commercialname))." (".$pharmaceuticalform.")"; ?></option>      <?php }?>    </select> </div>  <div class="form-group col-lg-6"> <label>Prescription</label>   <input type="text"  name="prescription[]" class="form-control " placeholder="Enter value"></div> <div class="form-group col-lg-6"><label>Quantity</label>  <input type="text"  name="quantity[]" class="form-control " placeholder="Enter value"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>');   });
          $('.pharmacysec').on("click",".remove_subobj1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
         }else{
          $( ".pharmacysec" ).hide();      
         }
    });
        }else{
               $('.destination').hide();    
        }
             });
             }
                 else{
              $('.authorizedexitmode').hide();
                     }
           } );
                 $('#code').change(function() {
        if ( ($(this).val() !== '')) {
//       	 $(this).closest("form").attr('action',  $(this).val());
        
                 $( ".descriptions" ).each(function( index ) {

		        		// console.log(this.id);
		                 $("#"+this.id).hide();
		            

		        });

             $("#description"+ $('#code').val()).show();
//         var townid=  $("#description"+ $('#code').val());
//         $('.descriptions').change(function() {                               
//             	 $(this).closest("form").attr('action',  $(this).val());                  
//                    });
          }
       else {
           $( ".descriptions" ).hide();
         }
                 });
              var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                 frmvalidator.addValidation("exitmode","req","*Exit mode is required");
      
             frmvalidator.addValidation("paymentmethod","req","*Payment Method is required");
            </script>
</body>

</html>
