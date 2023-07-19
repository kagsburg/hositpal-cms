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
    <title>ChildBirth Information</title>
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
                                           include 'fr/childbirth.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Child Birth Information</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="childbirths">Child Births</a></li>
                            <li class="breadcrumb-item active"><a href="#">View ChildBirth</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                      <?php      
                            $getchildbirths=mysqli_query($con,"SELECT * FROM childbirths WHERE   status=1 AND childbirth_id='$id'");  
                                        $row2 = mysqli_fetch_array($getchildbirths);
                                          $childbirth_id=$row2['childbirth_id'];
                                          $patientsque_id=$row2['admission_id'];
                                          $month=$row2['month'];
                                          $year=$row2['year'];
                                          $qualification=$row2['qualification'];
                                          $risk=$row2['risk'];
                                          $gesture=$row2['gesture'];
                                          $parity=$row2['parity'];
                                          $childrenalive=$row2['childrenalive'];
                                          $abortions=$row2['abortions'];
                                          $diabetes=$row2['diabetes'];
                                          $bloodpressure=$row2['bloodpressure'];
                                          $birthatrisk=$row2['birthatrisk'];
                                          $childbirthtype=$row2['childbirthtype'];
                                          $abortion=$row2['abortion'];
                                          $malaria=$row2['malaria'];
                                          $anemia=$row2['anemia'];
                                          $motherdied=$row2['motherdied'];
                                          $ptme=$row2['ptme'];
                                          $deliverydate=$row2['deliverydate']; 
                                          $contraceptive=$row2['contraceptive']; 
                                          $releasedate=$row2['releasedate']; 
                                          $admin_id=$row2['admin_id']; 
                                          $timestamp=$row2['timestamp']; 
                                        $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientsque_id'");  
                                    $rowp = mysqli_fetch_array($getque);
                                          $patientsque_id=$rowp['patientsque_id'];
                                          $admission_id=$rowp['admission_id'];
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
                            $quarter=$row['quarter'];    
                             $agegroup=$row['agegroup'];    
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
        $getgroups= mysqli_query($con,"SELECT * FROM agegroups WHERE status=1 AND agegroup_id='$agegroup'") or die(mysqli_error($con));
                                           $row1= mysqli_fetch_array($getgroups);
                                                $agegroup_id=$row1['agegroup_id'];
                                                $agegroup1=$row1['agegroup'];
                                                $code1=$row1['code'];
        $getresponsiblequalifications= mysqli_query($con,"SELECT * FROM responsiblequalifications WHERE status=1 AND responsiblequalification_id='$qualification'");
                               $roww= mysqli_fetch_array($getresponsiblequalifications);
                               $responsiblequalification_id=$roww['responsiblequalification_id'];
                               $responsiblequalification=$roww['responsiblequalification'];       
                               $code=$roww['code'];                          
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
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#basic" data-toggle="tab" class="nav-link show active">General Info</a>
                                            </li>
                                            <li class="nav-item"><a href="#outcomes" data-toggle="tab" class="nav-link">Childbirth outcomes (If born alive)</a>
                                            </li>
                                             
                                        </ul>
                                        <div class="tab-content">
                                            <div id="basic" class="tab-pane fade active show">
                                            
                                                <div class="my-post-content pt-3">
                                                     
                                                           <table class="table  table-striped" style="width:100%">
                                                           <tbody>
                                                               <tr><th>Added On</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                                               <tr><th>Month</th><td><?php echo $month.', '.$year; ?></td></tr>
                                                               <tr><th>Fullnames</th><td><?php echo $firstname.' '.$lastname; ?></td></tr>
                                                               <tr><th>Age</th><td><?php echo $age; ?></td></tr>
                                                                   <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                                                               <tr><th>Area of Residence</th><td><?php echo $town.', '.$province; ?></td></tr>
                                                               <tr><th>Age Group</th><td><?php echo $agegroup1.' ('.$code1.')'; ?></td></tr>
                                                               <tr><th>Person in charge qualification</th><td><?php echo $responsiblequalification.' ('.$code.')'; ?></td></tr>
                                                               <tr><th>Risk</th><td><?php echo $risk; ?></td></tr>
                                                               <tr><th>Gesture</th><td><?php echo $gesture; ?></td></tr>
                                                               <tr><th>Parity</th><td><?php echo $parity; ?></td></tr>
                                                               <tr><th>Number of children alive</th><td><?php echo $childrenalive; ?></td></tr>
                                                               <tr><th>Abortions</th><td><?php echo $abortions; ?></td></tr>
                                                               <tr><th>Has Diabetes?</th><td><?php echo $diabetes; ?></td></tr>
                                                               <tr><th>Knew of her High Blood Pressure?</th><td><?php echo $bloodpressure; ?></td></tr>
                                                               <tr><th>Childbirth detected at risk by the CPN</th><td><?php echo $birthatrisk; ?></td></tr>
                                                               <tr><th>Child Birth Type</th><td><?php echo $childbirthtype; ?></td></tr>
                                                               <tr><th>Is Childbirth an abortion?</th><td><?php echo $abortion; ?></td></tr>
                                                               <tr><th>Delivery Process</th><td>
                                                                        <ol>
                                                                   <?php                                                           
                                                               $deliveryevents= mysqli_query($con, "SELECT * FROM deliveryevents WHERE childbirth_id='$id'") or die(mysqli_error($con));
                                                                   while($rowd= mysqli_fetch_array($deliveryevents)){
                                                                    $deliveryevent=$rowd['deliveryevent'];
                                                                    echo '<li>-'.$deliveryevent.'</li>';
                                                                   }
                                                             ?>
                                                                       </ol>
                                                                   </td></tr>
                                                            <tr><th>Cesarean section indications</th><td>
                                                                        <ol>
                                                                   <?php                                                           
                                                               $indications= mysqli_query($con, "SELECT * FROM indications WHERE childbirth_id='$id'") or die(mysqli_error($con));
                                                                   while($rowd= mysqli_fetch_array($indications)){
                                                                    $indication=$rowd['indication'];
                                                                    echo '<li>-'.$indication.'</li>';
                                                                   }
                                                             ?>
                                                                       </ol>
                                                                   </td></tr>
                                                               <tr><th>Direct obstetric complications</th><td>
                                                                        <ol>
                                                                   <?php                                                           
                                                               $complications= mysqli_query($con, "SELECT * FROM complications WHERE childbirth_id='$id'") or die(mysqli_error($con));
                                                                   while($rowd= mysqli_fetch_array($complications)){
                                                                    $complication=$rowd['complication'];
                                                                    echo '<li>-'.$complication.'</li>';
                                                                   }
                                                             ?>
                                                                       </ol>
                                                                   </td></tr>
                                                               <tr><th>Mother has malaria?</th><td><?php echo $malaria; ?></td></tr>
                                                               <tr><th>Mother has anemia?</th><td><?php echo $anemia; ?></td></tr>
                                                               <tr><th>Mother Died During Birth?</th><td><?php echo $motherdied; ?></td></tr>
                                                               <tr><th>Status of Stillbirth (If any)</th><td>  <ol>
                                                                   <?php                                                           
                                                               $getstillbirthstatus= mysqli_query($con, "SELECT * FROM stillbirthstatus WHERE stillbirthstatus_id='$id'") or die(mysqli_error($con));
                                                                   while($rowd= mysqli_fetch_array($getstillbirthstatus)){
                                                                    $stillbirthstatus=$rowd['stillbirthstatus'];
                                                                    echo '<li>-'.$stillbirthstatus.'</li>';
                                                                   }
                                                             ?>
                                                                       </ol></td></tr>
                                                               <tr><th>PTME</th><td><?php echo $ptme; ?></td></tr>
                                                               <tr><th>Delivery Date</th><td><?php echo date('d/M/Y',$deliverydate); ?></td></tr>
                                                               <tr><th>Contraceptive Method Recieved</th><td><?php echo $contraceptive; ?></td></tr>
                                                                <tr><th>Release Date</th><td><?php echo date('d/M/Y',$releasedate); ?></td></tr>
                                                           </tbody>
                                                       </table>
                                                                                                      
                                                </div>
                                            </div>
                                            <div id="outcomes" class="tab-pane fade">
                                               
                                                <div class="profile-personal-info mt-2">
                                                     <table class="table  table-striped" style="width:100%">
                                                         <thead>   <tr><th>Condition</th><th>Child's APGAR</th><th>Sex</th></tr></thead>
                                                           <tbody>
                                                               <?php
                                                               $getoutcomes= mysqli_query($con,"SELECT * FROM childbirthoutcomes WHERE childbirth_id='$id' AND status=1") or die(mysqli_error($con));
                                                               while ($row3 = mysqli_fetch_array($getoutcomes)) {
                                                                   $outcome=$row3['outcome'];
                                                                   $apgar=$row3['apgar'];
                                                                   $sex=$row3['sex'];
                                                                              ?>
                                                               <tr><td><?php echo $outcome; ?></td><td><?php echo $apgar; ?></td><td><?php echo $sex; ?></td></tr>
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

	
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>