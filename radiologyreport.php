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
    <title>Radiology Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
     <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        .profile-tab .nav-item .nav-link{
            margin-right: 10px;font-size: 15px;
            padding: 0.5rem 0.8rem;
}
    </style>
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
                                           include 'fr/radiologyreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Radiology Report</h4>
                    </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="waitingpatients">In patients</a></li>
                            <li class="breadcrumb-item active"><a href="#">View Details</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                    <div class="col-lg-12">
                        <a href="radiologyreportprint?id=<?php echo $id; ?>" class="btn btn-success mb-2">Print Report</a>
                    </div>
                      <?php      
                                    $checkradiology= mysqli_query($con, "SELECT * FROM radiologyreports WHERE radiologyreport_id='$id' AND status=1") or die(mysqli_error($con));
                                    $rowe= mysqli_fetch_array($checkradiology);
                               $radiologyreport_id=$rowe['radiologyreport_id'];
                            $patientsque_id=$rowe['patientsque_id'];
                                  $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientsque_id'");  
                                    $rowq= mysqli_fetch_array($getque);
                                $patientsque_id=$rowq['patientsque_id'];
                               $admission_id=$rowq['admission_id'];
                              $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];        
                                $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row= mysqli_fetch_array($getpatient);
                                $firstname=$row['firstname'];    
                            $headfirstname= $row['headfirstname'];    
                            $lastname= $row['lastname'];    
                            $headlastname=$row['headlastname'];    
                              $age=$row['age'];    
                              $agecategory=$row['agecategory'];    
                            $gender=$row['gender'];    
                            $referred=$row['referred'];   
                            $province=$row['province'];    
                            $town=$row['town'];    
                            $zone=$row['zone'];    
                             $timestamp=$row['timestamp'];    
                            $quarter=$row['quarter'];    
                             $agegroup=$row['agegroup'];    
                            
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
        $getgroups= mysqli_query($con,"SELECT * FROM agegroups WHERE status=1 AND agegroup_id='$agegroup'") or die(mysqli_error($con));
                                           $row1= mysqli_fetch_array($getgroups);
                                                $agegroup_id=$row1['agegroup_id'];
                                                $agegroup1=$row1['agegroup'];
                                                $code1=$row1['code'];
               $checkradiology= mysqli_query($con, "SELECT * FROM radiologyreports WHERE radiologyreport_id='$id' AND status=1") or die(mysqli_error($con));
                                 $row3= mysqli_fetch_array($checkradiology);
               $month=$row3['month'];
               $year=$row3['year'];
               $reason=$row3['reason'];
               $description=$row3['description'];
               $conclusion=$row3['conclusion'];
               $results=$row3['results'];
             $responsible=$row3['responsible'];
                $exitmode=$row3['exitmode'];
               $destination=$row3['destination'];
                   ?>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                    <div class="profile-blog mb-5">
                        <img src="images/avatar.png" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname.' '.$lastname; ?></h4>
                                    <p>#<?php echo $pin; ?></p>
                                 
                                           </div>
                          
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                            
                                       <div class="table-responsive">
                                                           <table class="table  table-striped table-responsive-sm">
                                                           <tbody>
                                                                 <tr><th>Month</th><td><?php echo $month.', '.$year; ?></td></tr>
                                                               <tr><th>Fullnames</th><td><?php echo $firstname.' '.$lastname; ?></td></tr>
                                                               <tr><th>Age</th><td><?php echo $age; ?></td></tr>
                                                                   <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                                                               <tr><th>Area of Residence</th><td><?php echo $town.', '.$province; ?></td></tr>
                                                               <tr><th>Age Group</th><td><?php echo $agegroup1.' ('.$code1.')'; ?></td></tr>
                                                               <tr><th>In Date</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                                                    <tr><th>Reason</th><td><?php echo $reason; ?></td></tr>
                                                               <tr><th>Description</th><td><?php echo $description; ?></td></tr>
                                                               <tr><th>Results</th><td><?php echo $results; ?></td></tr>
                                                               <tr><th>Conclusion</th><td><?php echo $conclusion; ?></td></tr>
                                                                      <tr><th>Responsible</th><td><?php echo $responsible; ?></td></tr>
                                                                       <tr><th>Mode of Exit</th><td><?php echo $exitmode; ?></td></tr>
                                                               <?php
                                                                   if($exitmode=='transfert intra hôpital'){
                                                                         $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$destination'");
                                                        $row1=  mysqli_fetch_array($getcategory);
                                                          $servicecategory=$row1['servicecategory'];
                                                               ?>
                                                               <tr><th>Destination</th><td><?php echo $servicecategory; ?></td></tr>
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
                                       <?php } ?>
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