<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='nurse')){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cleared Patients</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
     <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
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
                            <h4>Cleared Patients</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Cleared Patients</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All cleared Patients</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                        <tr>
                                              <th>PIN</th>
                                              <th>Image</th>
                                            <th>Full Names</th>
                                            <th>Gender</th>
                                             <th>Next Attendant</th>
                                                <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php                                               
                                 $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE payment='1' AND attendant='".$_SESSION['elcthospitaladmin']."' AND status=1");  
                                        while ($row = mysqli_fetch_array($getque)) {
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
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
                            
           $getnextque=mysqli_query($con,"SELECT * FROM patientsque WHERE admission_id='$admission_id' AND admin_id='".$_SESSION['elcthospitaladmin']."'");  
                    $rown= mysqli_fetch_array($getnextque);
                   $attendant=$rown['attendant'];     
                   $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
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
                                          <tr class="gradeA">
                                              <td><?php echo $pin; ?></td>
                                                               <td>
                                                                   <a href="images/patients/<?php echo md5($patient_id).'.'.$ext.'?'.  time(); ?>" target="_blank">
                                          <img src="images/patients/thumbs/<?php echo md5($patient_id).'.'.$ext.'?'.  time(); ?>" width="60">
                                                                   </a>
                                                       </td>
                                            <td><?php echo $firstname.' '.$secondname.' '.$thirdname; ?></td>
                                              <td><?php echo $gender; ?></td>                                                                         
                                              <td><?php echo $fullname; ?></td>                                
                                                              
                                            
                                                   <td>   
          <button data-toggle="modal" data-target="#basicModal<?php echo $patientsque_id; ?>"  class="btn btn-xs btn-info">Nurse Report</button>             
                                        </td>
                                         
                                         
                                        </tr>
                    <div class="modal fade" id="basicModal<?php echo $patientsque_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nurse Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
               <?php
               $nursereports= mysqli_query($con, "SELECT * FROM nursereports WHERE patientsque_id='$patientsque_id'") or die(mysqli_error($con));
               while($row= mysqli_fetch_array($nursereports)){
                   $type=$row['type'];
                   $measurement=$row['measurement'];
                   $details=$row['details'];
               ?>     
                                 <div class="row mb-2">
                                                        <div class="col-sm-5 col-5">
                                                            <h5 class="f-w-500"><?php echo $type; ?><span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-7 col-7"><span><?php echo $measurement; ?></span>
                                                        </div>
                                                    </div>
               <?php }?>
                               <label class="text-primary"><strong>Details</strong></label>
                               <?php echo $details; ?>
                           </div>
                           </div>
                           </div>
                           </div>
                                        <?php }?>
                                        </tbody>     
                                    </table>     
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
  <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
    


    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
   
</body>

</html>