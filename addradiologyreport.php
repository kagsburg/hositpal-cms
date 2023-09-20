<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
$id=$_GET['id'];
$test=$_GET['test'];
$getservice2 = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$test'");
$row2 = mysqli_fetch_array($getservice2);
$medicalservice2 = $row2['investigationtype'];
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Radiology Report</title>
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
                            <h4>Add <?php echo $medicalservice2 ?> Radiology Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li> -->
                            <li class="breadcrumb-item active"><a href="#">Add Radiology Report</a></li>
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
                                          $admin_id = $row['admin_id'];
                                          $attendant=$row['attendant'];
                                          $prev_id = $row['prev_id'];
                                 $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                                  $lastname=$row2['secondname'] ;   
                            $gender=$row2['gender'];    
                            $bloodgroup = $row2['bloodgroup'];
                            $dob = $row2['dob'];
                            $weight = $row2['weight'];
                            $height = ($row2['height'] != '') ? $row2['height'] : 'N/A';
                            $temp = ($row2['temp'] != '') ? $row2['temp'] : 'N/A';
                            $bp = ($row2['bp'] != '') ? $row2['bp'] : 'N/A';
                            $clinic = $row2['clinic'];
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
                                           <h4 class="text-primary mt-4 mb-4">Medical Information</h4>
                                <div class="profile-blog mb-5">
                                    <address>
                                        <p>Age: <span><?php 
                                        $dob1 = date("Y-m-d", $dob);
                                        $dob2 = new DateTime($dob1);
                                        $now = new DateTime();
                                        $difference = $now->diff($dob2);
                                        echo $difference->y;
                                        ?></span></p>
                                        <p>Blood Group : <span><?php echo $bloodgroup; ?></span></p>
                                        <p>Weight (kgs)  : <span><?php echo $weight; ?></span></p>
                                        <p>Height : <span><?php echo $height; ?></span></p>
                                        <p>Temperature : <span><?php echo $temp; ?></span></p>
                                        <p>Blood Pressure : <span><?php echo $bp; ?></span></p>
                                    </address>
                                </div>
                                </div>
                                </div>
                                </div>
                     <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add <?php echo $medicalservice2 ?> Radiology Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                   
                           
     <form method="post" name='form' class="form" action="saveradiotest"  enctype="multipart/form-data">      
                    
                  <div class="row">
                  <div class="form-group col-lg-12"><label class="control-label uppercase">Report Title</label>
                    <textarea  name="title_1" class="form-control" placeholder="Enter Report Title" required="required" rows="4"></textarea>                                                                       
                                </div>
                                <div class="form-group col-lg-12"><label class="control-label">CLINICAL SUMMARY</label>
                    <textarea  name="summary_1" class="form-control" placeholder="Enter Report CLINICAL SUMMARY" required="required" rows="4"></textarea>                                                                       
                                </div>
                                            <?php 
                                                $total = 0;
                                                    $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE  patientsque_id='$id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        $serviceorder_id = $rowo['radioorder_id'];
                                                        $getordered2 = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND status in (1,2)") or die(mysqli_error($con));
                                                        $count = mysqli_num_rows($getordered2);
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id ='$serviceorder_id' AND radioinvestigationtype_id='$test'") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $medicalservice_id = $row['radioinvestigationtype_id'];
                                                            $patientradio_id = $row['patientradio_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];
                                                            ?>

                                                            <div class='row'>
                                                            <input type="hidden" name="count" value="<?php echo $count; ?>">
                                                                <input type="hidden" name="clinic" value="<?php echo $clinic; ?>">
                                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="radioorder_id" value="<?php echo $patientradio_id; ?>">
                                                                <input type="hidden" name="admission_id" value="<?php echo $admission_id; ?>">
                                                                
                                                                <div class="form-group col-lg-6">
                                                                    <label>Test done</label>
                                                                    <input type="hidden" name="test" placeholder="Enter test" value="<?php echo $medicalservice_id; ?>">
                                                                    <input type="text" class="form-control " placeholder="Enter test" value="<?php echo $medicalservice; ?>" disabled>
                                                                </div>
                                                                <div class="form-group col-lg-5">
                                                                    <label>Result Images</label>
                                                                    <input type="file" name="file[]" class="form-control" multiple="multiple" placeholder="Enter Results " > 
                                                                     
                                                                </div>
                                                                <div class="form-group col-lg-12"><label class="control-label">Start Time</label>
                                                                    <input type="time" name="start" class="form-control" placeholder="Enter Start Time " required="required" />                                                                            
                                                                </div> 
                                                                <div class="form-group col-lg-12"><label class="control-label">End Time</label>
                                                                <input type="time" name="end" class="form-control" placeholder="Enter End Time " required="required" />                                                                            
                                                                                                                                               
                                                                </div> 
                                                                
                                                                <div class="form-group col-lg-12"><label class="control-label">Description</label>
                                                                    <textarea  name="description" class="form-control" placeholder="Enter description " required="required" rows="4"></textarea>                                                                            
                                                                </div> 
                                                            </div>
                                                        <?php 
                                                        } 
                                                    }
                                                ?>
               <div class="form-group col-lg-12"><label class="control-label">Conclusion</label>
                    <textarea  name="conclusion" class="form-control" placeholder="Enter Conclusion " required="required" rows="4"></textarea>                                                                       
                                </div>   
                                         </div>
                                     <div class="form-group pull-right">
                                         <button class="btn btn-primary" type="submit" name="submitreport" onclick="return confirm_approve() ">Proceed</button>
                                         <script type="text/javascript">
                                            function confirm_approve() {
                                                return confirm('You are about To Submit Report to Doctor. Are you sure you want to proceed?');
                                            }
                                        </script>
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

</body>

</html>
