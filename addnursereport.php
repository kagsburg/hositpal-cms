<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='nurse')){
header('Location:login.php');
   }
$id=$_GET['id'];
$test=$_GET['test'];
 // get service order 
 $getservice = mysqli_query($con, "SELECT * FROM serviceorders WHERE patientsque_id='$id' AND status=1");
 $services = array();
 if (mysqli_num_rows($getservice) > 0) {
    $rows= mysqli_fetch_array($getservice);
    $service_name = $rows['serviceorder_id'];
    $getcount = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$service_name' AND status in (1,2)");
    $count = mysqli_num_rows($getcount);
    print($count);
    //  while ($rows = mysqli_fetch_array($getservice)) {
        //  $service_id = $rows['serviceorder_id'];
         $getpatservice = mysqli_query($con, "SELECT * FROM patientservices WHERE patientservice_id='$test' AND status in (1,2)");
         if (mysqli_num_rows($getpatservice) > 0) {
            while ($rows = mysqli_fetch_array($getpatservice)) {
                $service_name = $rows['medicalservice_id'];
                $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE medicalservice_id='$service_name' AND status=1");
                if (mysqli_num_rows($getservice) > 0) {
                    $rows = mysqli_fetch_array($getservice);
                    $service_name = $rows['medicalservice'];
                    $service_id = $rows['medicalservice_id'];
                } else {
                    $service_name = " ";
                }
                // $services[$service_id] = $service_name;
            }
         } else {
             $service_name = " ";
         }
    //  }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Patient Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
      <script src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/select2/css/select2.min.css" rel="stylesheet">
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
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients">Waiting patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add Report</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <?php
                         $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'");  
                                    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $admin_id= $row['admin_id'];
                                          $room=$row['room'];
                                          $attendant=$row['attendant'];
                                 $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                            $secondname=$row2['secondname'];    
                            $thirdname=$row2['thirdname'];    
                            $gender=$row2['gender'];    
                               $ext=$row2['ext']; 
                               
                    $bloodgroup = $row2['bloodgroup'];
                    $dob = $row2['dob'];
                    $weight = $row2['weight'];
                    $height = ($row2['height'] != '') ? $row2['height'] : 'N/A';
                    $temp = ($row2['temp'] != '') ? $row2['temp'] : 'N/A';
                    $bp = ($row2['bp'] != '') ? $row2['bp'] : 'N/A';
                                if(strlen($admission_id)==1){
      $pin='000'.$admission_id;
     }
       if(strlen($admission_id)==2){
      $pin='00'.$admission_id;
     }
        if(strlen($admission_id)==3){
      $pin='0'.$admission_id;
     }
  if(strlen($admission_id)>=4){
      $pin=$admission_id;
     }       
                               ?>
                               <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Patient Service <?php echo $service_name  ?></h4></div>
                                    
                                </div>
                               </div>
                    <div class="col-lg-3">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Patient #<?php echo $pin; ?></h4>
                            </div>
                            <div class="card-body">
                  
                                  <div class="profile-blog mb-5">
                                    <img src="images/patients/thumbs/<?php echo md5($patient_id).'.'.$ext.'?'.  time(); ?>" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname.' '.$secondname.' '.$thirdname; ?></h4>
                                                               
                                           </div>
                                           <h4 class="text-primary mt-4 mb-4">Medical Information</h4>
                                <div class="profile-blog mb-5">
                                    <address>
                                        <p>Age: <span><?php 
                                        $dob1 = date("Y-m-d", strtotime($dob));
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
                            <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="vitals-tab" data-toggle="tab" data-target="#nav-vitals" type="button" role="tab" aria-controls="nav-vitals" aria-selected="true">Vitals</button>
                                <button class="nav-link" id="minor-tab" data-toggle="tab" data-target="#nav-minor" type="button" role="tab" aria-controls="nav-minor" aria-selected="false">Minor theater</button>
                                <!-- <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> -->
                            </div>
                            </nav>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                                    if(isset($_POST['submitvitals'])){
                                        // $doctor=$_POST['doctor'];
                                        $details=$_POST['details']; 
                       if(isset($_POST['type'],$_POST['measurement'])){
                                      $type=$_POST['type'];
                                      $measurement=$_POST['measurement'];
                                    $allmeasurements=sizeof($measurement);
                                for($i=0;$i<$allmeasurements;$i++){
                                    mysqli_query($con,"INSERT INTO nursereports(type,measurement,patientsque_id,details,status) VALUES('$type[$i]','$measurement[$i]','$id','$details','1')") or die(mysqli_error($con));
                                }  
                            }
                            mysqli_query($con,"UPDATE patientservices set status='3' WHERE patientservice_id='$test'") or die(mysqli_error($con));
            
                            if ($count == 1){
                                $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
                                $prev_id = $row_prev_admin_id['prev_id'];
                                // update conclusion
                                $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='nurse' and prev_id ='$prev_id'") or die(mysqli_error($con));
                                if(mysqli_num_rows($checkpending)>0){
                                    $row_id=mysqli_fetch_array($checkpending);
                                    $patientque_id=$row_id['patientsque_id'];
                                    mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                                     mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                    
                                    $_SESSION['success'] = '<div class="alert alert-success">Nurse Report Successfully Added</div>';
                                    // redirect to radiowaiting
                                    echo '<script>window.location.href = "waitingpatients";</script>';exit();
                                }else{
                                
                                $prev_admin_id=$row_prev_admin_id['admin_id'];
                                $admission_id = $row_prev_admin_id['admission_id'];
                                mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                $_SESSION['success'] = '<div class="alert alert-success">Radiology Report Successfully Added</div>';
                                mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),1,'$prev_id')") or die(mysqli_error($con));
                                            // redirect to radiowaiting
                                            echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
                            }
                            }else{
                                $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
                                $prev_id = $row_prev_admin_id['prev_id'];
                                // status 8 is for radiology report but all tests are not done
                                $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='nurse' and prev_id ='$prev_id'") or die(mysqli_error($con));
                                if(mysqli_num_rows($checkpending)>0){
                                
                                    // redirect to radiowaiting
                                    echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
                                }else{
                                $prev_admin_id=$row_prev_admin_id['admin_id'];
                                $admission_id = $row_prev_admin_id['admission_id'];
                                //    mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                                $_SESSION['success'] = '<div class="alert alert-success">Nurse Report Successfully Added</div>';
                                mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),8,'$prev_id')") or die(mysqli_error($con));
                                            // redirect to radiowaiting
                                            echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
                            }      
                            } 
                           
    ?>  
                          
 <?php
                
    }   
    if (isset($_POST['minordetails'])) {
        $case=mysqli_escape_string($con,trim($_POST['case']));
        $casedetails=mysqli_escape_string($con,trim($_POST['casedetails']));
        $service_id=$_POST['service_id'];
        $count=$_POST['count'];
        if (empty($case) || empty($casedetails)) {
            echo '<div class="alert alert-danger">Please fill all fields</div>';
        }else{
        mysqli_query($con,"INSERT INTO minor(admission_id,service_id,casetype,details,admin_id,patientsque_id,timestamp,status) 
        VALUES('$admission_id','$service_id','$case','$casedetails','" . $_SESSION['elcthospitaladmin'] . "','$id',UNIX_TIMESTAMP(),'1')") or die(mysqli_error($con));
    mysqli_query($con,"UPDATE patientservices set status='3' WHERE patientservice_id='$test'") or die(mysqli_error($con));
            
        if ($count == 1){
            $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
               $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
               $prev_id = $row_prev_admin_id['prev_id'];
            // update conclusion
            $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='nurse' and prev_id ='$prev_id'") or die(mysqli_error($con));
            if(mysqli_num_rows($checkpending)>0){
                $row_id=mysqli_fetch_array($checkpending);
                $patientque_id=$row_id['patientsque_id'];
                mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                $_SESSION['success'] = '<div class="alert alert-success">Nurse Report Successfully Added</div>';
                // redirect to radiowaiting
                echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
            }else{
            
               $prev_admin_id=$row_prev_admin_id['admin_id'];
               $admission_id = $row_prev_admin_id['admission_id'];
               mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
               $_SESSION['success'] = '<div class="alert alert-success">Radiology Report Successfully Added</div>';
               mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),1,'$prev_id')") or die(mysqli_error($con));
                        // redirect to radiowaiting
                        echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
        }
        }else{
            $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
               $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
               $prev_id = $row_prev_admin_id['prev_id'];
            // status 8 is for radiology report but all tests are not done
            $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='nurse' and prev_id ='$prev_id'") or die(mysqli_error($con));
            if(mysqli_num_rows($checkpending)>0){
               
                // redirect to radiowaiting
                echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
            }else{
               $prev_admin_id=$row_prev_admin_id['admin_id'];
               $admission_id = $row_prev_admin_id['admission_id'];
            //    mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
               $_SESSION['success'] = '<div class="alert alert-success">Nurse Report Successfully Added</div>';
               mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),8,'$prev_id')") or die(mysqli_error($con));
                        // redirect to radiowaiting
                        echo '<script>window.location.href = "viewnursedetails?id='.$id.'";</script>';exit();
        }      
        } 
    }
        echo '<div class="alert alert-success">Nurse Report Successfully Added</div>';
    }
   ?>
          
     <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-vitals" role="tabpanel" aria-labelledby="vitals-tab">
        <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
            <input type="hidden" name="count" value="<?php echo $count; ?>">
            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
            <div class="col-lg-12"><h4>Vitals taken</h4></div>
                            <div class="col-lg-12">
                                        <div class='subobj1'>
                                        <div class='row'>
                    <div class="form-group col-lg-6">
                    <label>Type (e.g Weight)</label>
                        <input type="text"  name="type[]" class="form-control " placeholder="Enter type">
                    </div>
                        <div class="form-group col-lg-5">
                    <label>Value</label>
                    <input type="text"  name="measurement[]" class="form-control " placeholder="Enter value">
                        </div>
                    
                            <div class="form-group col-lg-1">
                            <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>                                              
                        </div> 
            </div>
            </div>
            </div>
          <div class="form-group"><label class="control-label">* More Details if any</label>
                                  <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details"></textarea>
                                                                                                        </div>
         <div class="form-group pull-left">
                                         <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                                                  </div>
                                     <div class="form-group pull-right">
                               <button class="btn btn-primary" type="submit" name="submitvitals" onclick="return confirm_approve()" >Save</button>
                                                                  </div>
        </form>
        </div>
        <div class="tab-pane fade" id="nav-minor" role="tabpanel" aria-labelledby="minor-tab">
        <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
        <div class="col-lg-12"><h4>Minor theater</h4></div>   
            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
            <input type="hidden" name="count" value="<?php echo $count; ?>">
                <div class="form-group col-lg-12">
                   <label>Case  for <?php echo $service_name ?></label>
                   <input type="text"  name="case" class="form-control " placeholder="Enter case" required>
                </div>
                <div class="form-group col-lg-12">
                   <label>Description </label>
                   <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="casedetails"></textarea>
                </div>
                <div class="form-group pull-right">
                               <button class="btn btn-primary" type="submit" name="minordetails" onclick="return confirm_approve()">Save</button>
                </div>
                </form>

        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
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
     <!-- Required vendors -->
     <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <!-- <script src="vendor/apexchart/apexchart.js"></script> -->
    <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->

    <!-- Datatable -->
    <script src="vendor/select2/js/select2.min.js"></script>
    <script type="text/javascript">
                                            function confirm_approve() {
                                                return confirm('You are about To Submit Report to Doctor. Are you sure you want to proceed?');
                                            }
                                        </script>
    <script src="js/plugins-init/select2-init.js"></script>
        <script>
             $('.subobj1_button').click(function(e){ //on add input button click
        e.preventDefault();  
        $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6"><label>Type (e.g Weight)</label>    <input type="text"  name="type[]" class="form-control " placeholder="Enter type"></div>  <div class="form-group col-lg-6"> <label>Value</label>   <input type="text"  name="measurement[]" class="form-control " placeholder="Enter value"></div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
         });
          $('.subobj1').on("click",".remove_subobj1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
        </script>
</body>

</html>