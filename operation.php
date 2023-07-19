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
    <title>Operation Information</title>
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
                                           include 'fr/operation.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Operation Information</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="operations">Operations</a></li>
                            <li class="breadcrumb-item active"><a href="#">View Operation</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                      <?php      
                             $getoperation=mysqli_query($con,"SELECT * FROM operations WHERE   status=1 AND operation_id='$id'");  
                                      $row = mysqli_fetch_array($getoperation);
                                       $operation_id=$row['operation_id'];
                                          $patientsque_id=$row['patientsque_id'];
                                          $month=$row['month'];
                                          $year=$row['year'];
                                          $prescriber=$row['prescriber']; 
                                          $diagnosticcode=$row['diagnosticcode']; 
                                          $diagnosis=$row['diagnosis']; 
                                                 $pregnant=$row['pregnant']; 
                                         $operationcondition=$row['operationcondition']; 
                                         $anesthesiacode=$row['anesthesiacode']; 
                                         $anesthesia=$row['anesthesia']; 
                                         $actcode=$row['actcode']; 
                                         $acttitle=$row['acttitle']; 
                                         $died=$row['died']; 
                                         $mainauthor=$row['mainauthor']; 
                                         $mainassistant=$row['mainassistant']; 
                                         $anesthesiologist=$row['anesthesiologist']; 
                                         $protocol=$row['protocol']; 
                                          $timestamp=$row['timestamp']; 
                                          $observations=$row['observations']; 
                                          $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientsque_id'");  
                                    $rowp = mysqli_fetch_array($getque);
                                          $patientsque_id=$rowp['patientsque_id'];
                                          $admission_id=$rowp['admission_id'];
                                               $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];        
                                $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                              $lastname=$row2['lastname'];    
                            $gender=$row2['gender'];    
                                 $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                                   $row = mysqli_fetch_array($getpatient);
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
                              <table class="table  table-striped" style="width:100%">
                                                           <tbody>
                                                               <tr><th>Added On</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                                               <tr><th>Month</th><td><?php echo $month.', '.$year; ?></td></tr>
                                                               <tr><th>Fullnames</th><td><?php echo $firstname.' '.$lastname; ?></td></tr>
                                                               <tr><th>Age</th><td><?php echo $age; ?></td></tr>
                                                               <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                                                               <tr><th>Area of Residence</th><td><?php echo $town.', '.$province; ?></td></tr>
                                                               <tr><th>Age Group</th><td><?php echo $agegroup1.' ('.$code1.')'; ?></td></tr>
                                                               <tr><th>Prescriber</th><td><?php echo $prescriber; ?></td></tr>
                                                               <tr><th>Is Patient Pregnant?</th><td><?php echo $pregnant; ?></td></tr>
                                                               <tr><th>Diagnostic Code</th><td><?php echo $diagnosticcode;  ?></td></tr>
                                                               <tr><th>Diagnosis leading to Operation</th><td><?php echo $diagnosis; ?></td></tr>
                                                               <tr><th>Condition</th><td><?php echo $operationcondition; ?></td></tr>
                                                               <tr><th>Code of Anesthesia</th><td><?php echo $anesthesiacode; ?></td></tr>
                                                               <tr><th>Anesthesia Type</th><td><?php echo $anesthesia; ?></td></tr>
                                                               <tr><th>Code Act</th><td><?php echo $actcode; ?></td></tr>
                                                               <tr><th>Code Title</th><td><?php echo $acttitle; ?></td></tr>
                                                               <tr><th>Protocol</th><td><?php echo $protocol; ?></td></tr>
                                                               <tr><th>Did patient die during the operation?</th><td><?php echo $died; ?></td></tr>
                                                               <tr><th>Main Operation Author</th><td><?php echo $mainauthor; ?></td></tr>
                                                               <tr><th>Person who was the main assistant</th><td><?php echo $mainassistant; ?></td></tr>
                                                            <tr><th>Played the role of anesthesiologist</th><td><?php echo $anesthesiologist; ?></td></tr>
                                                               <tr><th>Observations during Operation</th><td><?php echo $observations; ?></td></tr>
                                                           
                                                           </tbody>
                                                       </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                       <?php }?>
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