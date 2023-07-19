<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='nurse')){
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
    <title>Add Patient Report</title>
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
                                <h4 class="card-title">Add Report</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">      
                                    <?php
                                    if(isset($_POST['details'])){
                                        $doctor=$_POST['doctor'];
                                        $details=$_POST['details'];           
                                     if(!empty($doctor)){
                            $getprevque=mysqli_query($con,"SELECT * FROM patientsque WHERE admission_id='$admission_id'   AND status=1 AND room='doctor' ORDER BY patientsque_id DESC");  
             if(mysqli_num_rows($getprevque)>0){              
                       mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$doctor','1','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
             }else{
                       mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$doctor','0','".$_SESSION['elcthospitaladmin']."','nurse',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
                  
             }
                       mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
                       if(isset($_POST['type'],$_POST['measurement'])){
                                      $type=$_POST['type'];
                                      $measurement=$_POST['measurement'];
                                    $allmeasurements=sizeof($measurement);
for($i=0;$i<$allmeasurements;$i++){
    mysqli_query($con,"INSERT INTO nursereports(type,measurement,patientsque_id,details,status) VALUES('$type[$i]','$measurement[$i]','$id','$details','1')") or die(mysqli_error($con));
}  
   }
    ?>  
                          
 <?php
echo '<div class="alert alert-success">Patient Report Successfully Added</div>';
    }             
    }             
   ?>
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">      
        
                                   
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
                               <button class="btn btn-primary" type="submit">Proceed</button>
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
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<script src="js/dashboard/dashboard-1.js"></script>
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