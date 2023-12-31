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
    <title>Add Clinic Patient Radiology Report</title>
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
                                           include 'fr/addradiologyreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Radiology Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Radiology Report</a></li>
                        </ol>
                    </div>
                </div>
       	<div class="row">
                     <?php
                                  $getque = mysqli_query($con, "SELECT * FROM clinic_clients WHERE clinic_cl_id='$id'");
                                  $row1 = mysqli_fetch_array($getque);
                                  $patient_id = $row1['clinic_cl_id'];
                                 $fullname1 = $row1['name'];
                                 $location = $row1['location'];
                                 $attendant= $row1['user_id'];
                                 $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                 $rows = mysqli_fetch_array($getstaff);
                                 $fullname = $rows['fullname'];
                                  if (strlen($patient_id) == 1) {
                                      $pin = '000' . $patient_id;
                                  }
                                  if (strlen($patient_id) == 2) {
                                      $pin = '00' . $patient_id;
                                  }
                                  if (strlen($patient_id) == 3) {
                                      $pin = '0' . $patient_id;
                                  }
                                  if (strlen($patient_id) >= 4) {
                                      $pin = $patient_id;
                                  }
                                    
                               ?>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">
                  
                                  <div class="profile-blog mb-5">
                                      <!-- <img src="images/avatar.png" alt="" class="img-fluid mt-4 mb-4 w-100"> -->
                                    <h4 class="text-primary"><?php echo $fullname1; ?></h4>
                                                               
                                           </div>
                                </div>
                                </div>
                                </div>
                     <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Radiology Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                 if(isset($_POST['submit'])){
                                         $month=date('F',$timenow);
                                        $year=date('Y',$timenow);
                                        $exitmode="";
                                        $destination="";
                                        $reason= " Clinic Radiology Report";           
                                        $results= "";              
                                        $conclusion= mysqli_real_escape_string($con,trim($_POST['conclusion']));      
                                      $description= "";     
                                      $responsible= "";  

                                        //   print_r($_FILES['file']);
                                        //   print_r($_POST['description']);
                                        //   print_r($_POST['test']);
                                        //   exit();
                             if((empty($month))||(empty($year) || empty($_FILES['file']))){
                                   $errors[]='Some Fields are empty';
                               }
                               if(!empty($errors)){
                               foreach ($errors as $error) {
                               echo '<div class="alert alert-danger">'.$error.'</div>';
                                  }
                               }else{
                                foreach ($_POST['test'] as $key => $value) {
                                    // print_r($value);
                                    $test=$value;
                                    $description=$_POST['description'][$key];
                                    $image_name=$_FILES['file']['name'][$key];
                                    $image_size=$_FILES['file']['size'][$key];
                                    $image_temp=$_FILES['file']['tmp_name'][$key];
                                    $allowed_ext=array('jpg','jpeg','png','gif','');                                    
                                    foreach($image_name as $key22 => $val_image){
                                        // print_r($);
                                        $ext=explode('.',$val_image);
                                        $image_ext=  strtolower(end($ext));
                                        $errors=array();
                                        if (in_array($image_ext,$allowed_ext)===false){
                                        $errors[]='File type not allowed';
                                        }
                                        $img_size = $image_size[$key22];
                                        if($img_size>10097152){
                                        $errors[]='Maximum size is 10Mb';
                                        }
                                        if(!empty($errors)){
                                            foreach($errors as $error){ 
                                            echo ' <div class="alert alert-danger" role="alert">'.$error.'
                                                </div>';
                                            }
                                            exit();
                                            }
                                    }                                
                                    mysqli_query($con, "INSERT INTO radiologyreports(patientsque_id,month,year,reason,clinic,description,results,conclusion,responsible,exitmode,destination,admin_id,timestamp,status) 
                                    VALUES('$id','$month','$year','$reason',1,'$description','$value','$conclusion','$responsible','$exitmode','$destination','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
                                    $last_id= mysqli_insert_id($con);
                                    // Insert image content into database 
                                   foreach ($image_name as $key23 => $val_image) {
                                    $ext=explode('.',$val_image);
                                    $image_ext=  strtolower(end($ext));
                                    mysqli_query($con, "INSERT INTO radiologyimages(radiology_report_id,image,status) VALUES('$last_id','$image_ext','1')") or die(mysqli_error($con)); 
                                    // get last created Id 
                                    $img_temp = $image_temp[$key23];
                                    $last_id_img = mysqli_insert_id($con);  
                                    $image_file1=md5($last_id_img).'.'.$image_ext;
                                    move_uploaded_file($img_temp,'./images/radiology/'.$image_file1);
                                    // mysqli_query($con, "UPDATE radiologyimages SET image='$image_file1' WHERE radiology_image_id='$last_id_img'") or die(mysqli_error($con));
                                    }
                                }
    // mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','radiographer',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
    $_SESSION['success'] = '<div class="alert alert-success">Radiology Report Successfully Added</div>';
                                     // redirect to radiowaiting
                                     echo '<script>window.location.href = "clinicwaiting.php?ty=radiography";</script>';exit();
    }             
    }             
                
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                  <div class="row">
              
                  <?php 
                                                $total = 0;
                                                    $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE  patientsque_id='$id' and source='clinic'") or die(mysqli_error($con)); 
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        $serviceorder_id = $rowo['radioorder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $medicalservice_id = $row['radioinvestigationtype_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];
                                                            ?>

                                                            <div class='row'>
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test done</label>
                                                                    <input type="hidden" name="test[<?php echo $medicalservice_id; ?>]" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-5">
                                                                    <label>Result Images</label>
                                                                    <input type="file" name="file[<?php echo $medicalservice_id; ?>][]" class="form-control" multiple="multiple" placeholder="Enter Results " required="required" > 
                                                                    <!-- <input type="text" name="result[<?php echo $medicalservice_id; ?>]" class="form-control " placeholder="Enter result"> -->
                                                                </div>
                                                                <div class="form-group col-lg-12"><label class="control-label">Description</label>
                                                                    <textarea  name="description[<?php echo $medicalservice_id; ?>]" class="form-control" placeholder="Enter description " required="required" rows="4"></textarea>                                                                            
                                                                </div>
                                                                <!-- <div class="form-group col-lg-1">
                                                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                                </div> -->
                                                            </div>
                                                        <?php 
                                                        } 
                                                    }
                                                ?>
   
               <div class="form-group col-lg-12"><label class="control-label">Conclusion</label>
                    <textarea  name="conclusion" class="form-control" placeholder="Enter Conclusion " required="required" rows="4"></textarea>                                                                       
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
