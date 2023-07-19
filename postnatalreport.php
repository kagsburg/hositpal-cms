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
    <title>Post Natal Report</title>
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
                                           include 'fr/postnatalreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Post Natal Report</h4>
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
                      <?php      
                                $checkpostnatal= mysqli_query($con, "SELECT * FROM postnatalreports WHERE postnatalreport_id='$id' AND status=1") or die(mysqli_error($con));
                        $rowp= mysqli_fetch_array($checkpostnatal);
                          $postnatalreport_id=$rowp['postnatalreport_id'];
                            $patientsque_id=$rowp['patientsque_id'];
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
                           $checkpostnatal= mysqli_query($con, "SELECT * FROM postnatalreports WHERE postnatalreport_id='$id' AND status=1") or die(mysqli_error($con));
                              $row3= mysqli_fetch_array($checkpostnatal);
               $birthdate=$row3['birthdate'];           
                                        $maritalsituation=$row3['maritalsituation'];              
                                        $babyname=$row3['babyname'];      
                                      $birthplace=$row3['birthplace'];     
                                      $firstvisit=$row3['firstvisit'];     
                                      $othervisits=$row3['othervisits'];     
                                      $onctx=$row3['onctx'];     
                                      $babiessampled=$row3['babiessampled'];     
                                      $vitamina=$row3['vitamina'];     
                                      $problems=$row3['problems'];   
                                      $decisions=$row3['decisions'];   
                                      $hivknown=$row3['hivknown'];   
                                      $onarvs=$row3['onarvs'];   
                                      $testing=$row3['testing'];   
                                      $fearvs=$row3['fearvs'];   
                                      $pfmembership=$row3['pfmembership'];   
                                      $arvwomenmembership=$row3['arvwomenmembership'];   
                                      $obstetricfistulas=$row3['obstetricfistulas'];   
                                      $puerperalinfection=$row3['puerperalinfection'];   
                             $timestamp=$row3['timestamp'];    
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
                                                                 <tr><th>Age</th><td><?php echo $age; ?></td></tr>
                                                            
                                                               <tr><th>Area of Residence</th><td><?php echo $town.', '.$province; ?></td></tr>
                                                               <tr><th>Age Group</th><td><?php echo $agegroup1.' ('.$code1.')'; ?></td></tr>
                                                                 <tr><th>Birth Date</th><td><?php echo date('d/M/Y',$birthdate); ?></td></tr>
                                                               <tr><th>Marital Situation</th><td><?php echo $maritalsituation; ?></td></tr>
                                                               <tr><th>HIV + already known?</th><td><?php echo $hivknown; ?></td></tr>
                                                                <tr><th>Already on ARVs?</th><td><?php echo $onarvs; ?></td></tr>
                                                               <tr><th>HIV testing during the visit?</th><td><?php echo $testing; ?></td></tr>
                                                               <tr><th>Fe put on ARVs?</th><td><?php echo $fearvs; ?></td></tr>
                                                               <tr><th>Baby's Fullname</th><td><?php echo $babyname; ?></td></tr>
                                                                    <tr><th>Place of birth</th><td><?php echo $birthplace; ?></td></tr>
                                                               <tr><th>First visits / Provenance</th><td><?php echo $firstvisit ?></td></tr>
                                                               <tr><th>Other Visits</th><td><?php echo $othervisits; ?></td></tr>
                                                               <tr><th>Babies of HIV + mothers put on CTX</th><td><?php echo $onctx; ?></td></tr>
                                                               <tr><th>Babies of HIV + mothers sampled</th><td><?php echo $babiessampled; ?></td></tr>
                                                               <tr><th>Vitamin A</th><td><?php echo $vitamina; ?></td></tr>
                                                               <tr><th>PF membership</th><td><?php echo $pfmembership; ?></td></tr>
                                                               <tr><th>PF membership for women on ARV</th><td><?php echo $arvwomenmembership; ?></td></tr>
                                                               <tr><th>Evocative signs of obstetric fistulas</th><td><?php echo $obstetricfistulas; ?></td></tr>
                                                               <tr><th>Puerperal infection</th><td><?php echo $puerperalinfection; ?></td></tr>
                                                          <tr><th>Problems detected in mother or baby</th><td><?php echo $problems; ?></td></tr>
                                                          <tr><th>Decisions Taken</th><td><?php echo $decisions; ?></td></tr>
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