<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
  $id=$_GET['id'];
   $checkdoneexams= mysqli_query($con, "SELECT * FROM doneexams WHERE  doneexam_id='$id' AND status=1 ORDER BY doneexam_id DESC") or die(mysqli_error($con));
                         $rowd= mysqli_fetch_array($checkdoneexams);
                      $doneexam_id=$rowd['doneexam_id'];
                      $examtype_id=$rowd['examtype_id'];
                        $patientsque_id=$rowd['patientsque_id'];
             $gettype=  mysqli_query($con,"SELECT * FROM examtypes WHERE status=1 AND examtype_id='$examtype_id'");
  $row1=  mysqli_fetch_array($gettype); 
   $examtype=$row1['examtype'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Examination Info</title>
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
                                           include 'fr/examdetails.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><?php echo $examtype; ?></h4>
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
                           <a href="examdetailsprint?id=<?php echo $id; ?>" class="btn btn-success mb-2">Print Report</a>
                    </div>
                      <?php      
                              $checkdoneexams= mysqli_query($con, "SELECT * FROM doneexams WHERE  doneexam_id='$id' AND status=1 ORDER BY doneexam_id DESC") or die(mysqli_error($con));
                         $rowd= mysqli_fetch_array($checkdoneexams);
                      $doneexam_id=$rowd['doneexam_id'];
                      $examtype_id=$rowd['examtype_id'];
                        $patientsque_id=$rowd['patientsque_id'];
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
         $checkdoneexams= mysqli_query($con, "SELECT * FROM doneexams WHERE  doneexam_id='$id' AND status=1 ORDER BY doneexam_id DESC") or die(mysqli_error($con));
                         $row3= mysqli_fetch_array($checkdoneexams);
                      $doneexam_id=$row3['doneexam_id'];
                      $examtype_id=$row3['examtype_id'];
               $month=$row3['month'];
               $year=$row3['year'];
               $analyser=$row3['analyser'];
               $code_id=$row3['code'];
                  $exitmode=$row3['exitmode'];
               $destination=$row3['destination'];
               $timestamp=$row3['timestamp'];
               $pregnant=$row3['pregnant'];
              $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$code_id'");
                           $row1=  mysqli_fetch_array($getcategory);
                          $servicecategory=$row1['servicecategory'];
                           $code=$row1['code'];
          ?>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                    <div class="profile-blog mb-5">
                        <img src="images/avatar.png" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <h4 class="text-primary"><?php echo $firstname.' '.$lastname; ?></h4>
                                    <p>#<?php echo $patient_id; ?></p>
                                 
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
                                                                    <tr><th>Analysed By</th><td><?php echo $analyser; ?></td></tr>
                                                               <tr><th>Is Exam for Pregnant Woman</th><td><?php echo $pregnant; ?></td></tr>
                                                               <tr><th>Exam Code</th><td><?php echo $servicecategory. '('. $code.')'; ?></td></tr>
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
                                                     <table class="table  table-bordered table-responsive-sm">
                                                           <thead>
                                                               <tr><th>Exam</th><th>Value</th><th>Result</th></tr>
                                                           </thead>
                                                           <tbody>
                                                               <?php
                                                               $getdetails= mysqli_query($con, "SELECT * FROM examdetails WHERE  exam_id='$id'");
                                                               while($row= mysqli_fetch_array($getdetails)){
                                                                   $exam_id=$row['exam'];
                                                                   $value=$row['value'];
                                                                   $result=$row['result'];
                                                                   $getexam= mysqli_query($con,"SELECT * FROM exams WHERE exam_id='$exam_id'");
                                                                   $row2= mysqli_fetch_array($getexam);
                                                                   $exam=$row2['exam'];
                                                                   $siunit=$row2['siunit'];
                                                                     $getunit=  mysqli_query($con,"SELECT * FROM units WHERE status=1 AND measurement_id='$siunit'");
                                                  $row3=  mysqli_fetch_array($getunit);
                                                 $measurement=$row3['measurement'];
                                                               ?>
                                                               <tr><td><?php echo $exam; ?></td><td><?php echo $value.' '.$measurement; ?></td><td><?php echo $result; ?></td></tr>   
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

	
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>