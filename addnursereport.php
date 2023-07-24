<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='nurse')){
header('Location:login.php');
   }
$id=$_GET['id'];
 // get service order 
 $getservice = mysqli_query($con, "SELECT * FROM serviceorders WHERE patientsque_id='$id' AND status=0");
 $services = array();
 if (mysqli_num_rows($getservice) > 0) {
     while ($rows = mysqli_fetch_array($getservice)) {
         $service_id = $rows['serviceorder_id'];
         $getpatservice = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$service_id' AND status=1");
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
                $services[$service_id] = $service_name;
            }
         } else {
             $service_name = " ";
         }
     }
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
                                    <div class="card-header"><h4 class="card-title">Patient Services</h4></div>
                                    <?php 
                                    foreach($services as $service){
                                        echo '<div class=""><p>'.$service.'</p></div>';
                                    }
                                    ?>
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
                            
                       mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$admin_id','0','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
                       mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                       if(isset($_POST['type'],$_POST['measurement'])){
                                      $type=$_POST['type'];
                                      $measurement=$_POST['measurement'];
                                    $allmeasurements=sizeof($measurement);
                                for($i=0;$i<$allmeasurements;$i++){
                                    mysqli_query($con,"INSERT INTO nursereports(type,measurement,patientsque_id,details,status) VALUES('$type[$i]','$measurement[$i]','$id','$details','1')") or die(mysqli_error($con));
                                }  
                            }
                            // update patient que status
                            mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
    ?>  
                          
 <?php
echo '<div class="alert alert-success">Patient Report Successfully Added</div>';
                
    }   
    if (isset($_POST['minordetails'])) {
        $case=$_POST['case'];
        $casedetails=$_POST['casedet'];
        foreach ($case as $key => $value) {
            $case=$value;
            $case_details=$casedetails[$key];
            if($case!=''){
                mysqli_query($con,"INSERT INTO minor(admission_id,service_id,casetype,details,admin_id,patientsque_id,timestamp,status) VALUES('$admission_id','$key','$case','$case_details','" . $_SESSION['elcthospitaladmin'] . "','$id',UNIX_TIMESTAMP(),'1')") or die(mysqli_error($con));
            }
        }
        // mysqli_query($con,"INSERT INTO minortheater(admission_id,case_details,case_name,patientsque_id,status) VALUES('$casedetails','$case','$id','1')") or die(mysqli_error($con));
        mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
        echo '<div class="alert alert-success">Patient Report Successfully Updated</div>';
    }
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
     <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-vitals" role="tabpanel" aria-labelledby="vitals-tab">
            <div class="col-lg-12"><h4>Measurements taken</h4></div>
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
               <!-- <div class="form-group">
	                 <label>Select Doctor</label>
                              <select class="form-control room" name="doctor">
                                  <option selected="selected" value="">Select option..</option>
                                  <?php 
                                 $getstaff=mysqli_query($con,"SELECT * FROM staff WHERE status=1 AND role='doctor'");  
                                        while ($row = mysqli_fetch_array($getstaff)) {
                                          $staff_id=$row['staff_id'];
                                           $fullname=$row['fullname'];
                                           ?>
                                  <option  value="<?php echo $staff_id; ?>"><?php echo $fullname; ?></option>
                                        <?php }?>
                              </select>
	                    </div> -->
          <div class="form-group"><label class="control-label">* More Details if any</label>
                                  <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="details"></textarea>
                                                                                                        </div>
         <div class="form-group pull-left">
                                         <!--<a class="btn btn-success" a href="addpatient3.php">Back</a>-->
                                                                  </div>
                                     <div class="form-group pull-right">
                               <button class="btn btn-primary" type="submit" name="submitvitals" >Save</button>
                                                                  </div>
        </div>
        <div class="tab-pane fade" id="nav-minor" role="tabpanel" aria-labelledby="minor-tab">
        <div class="col-lg-12"><h4>Minor theater</h4></div>   
            <?php
             foreach ($services as $key => $value) {
                ?>
                <div class="form-group col-lg-12">
                   <label>Case  for <?php echo $value ?></label>
                   <input type="text"  name="case[<?php echo $key; ?>]" class="form-control " placeholder="Enter case" required>
                </div>
                <div class="form-group col-lg-12">
                   <label>Description </label>
                   <textarea class="ckeditor" cols="70" id="editor1" rows="8" name="casedet[<?php echo $key;?>]"></textarea>
                </div>
                
                <?php
                }?>
                <div class="form-group pull-right">
                               <button class="btn btn-primary" type="submit" name="minordetails">Save</button>
                </div>

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