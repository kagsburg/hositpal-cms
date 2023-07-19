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
    <title>Examination Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
     <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
       <style>
          body{font-size: 18px;color: #000;font-family: "Roboto", sans-serif}
     .table.table-bordered td, .table.table-bordered th {
    border-color: #000000;
}
.table td,.table th {
    color: #000;
    font-size: 18px;
}
.table th {
    font-weight: bold;
}
      </style>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
<?php 

if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/examinationprint.php';                     
                                       }else{
?>
      <div class="section-body">
            
            <!-- row -->
			<div class="container-fluid">
       		<div class="row">
              
                      <?php      
                                       $checkexams= mysqli_query($con, "SELECT * FROM examinations WHERE examination_id='$id' AND status=1") or die(mysqli_error($con));
                                    $rowe= mysqli_fetch_array($checkexams);
                               $examination_id=$rowe['examination_id'];
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
           $checkexams= mysqli_query($con, "SELECT * FROM examinations WHERE examination_id='$id' AND status=1") or die(mysqli_error($con));
            $row3= mysqli_fetch_array($checkexams);
               $month=$row3['month'];
               $year=$row3['year'];
               $prescriber=$row3['prescriber'];
               $examcode=$row3['examcode'];
               $examination=$row3['examination'];
               $examresult=$row3['examresult'];
               $examvalue=$row3['examvalue'];
               $timestamp=$row3['timestamp'];
               $pregnant=$row3['pregnant'];
                   $exitmode=$row3['exitmode'];
               $destination=$row3['destination'];
                   ?>
                
                    <div class="col-lg-10 offset-1">
                        <div class="row">
                                  <div class="col-sm-3"> <img alt="image" src="<?php echo BASE_URL;?>/images/tanganyika.jpg"  width="100" /></div>		
                    <div class="col-sm-9">    <h1 class="text-center"> <strong>EXAMINATION REPORT</strong></h1>    </div>
                        </div>
                    
                            
                                       <div class="table-responsive">
                                                           <table class="table  table-striped table-responsive-sm">
                                                           <tbody>
                                                                 <tr><th>Full Name</th><td><?php echo $firstname.' '.$lastname; ?></td></tr>
                                                                 <tr><th>PIN</th><td>#<?php echo $pin; ?></td></tr>
                                                                 <tr><th>Month</th><td><?php echo $month.', '.$year; ?></td></tr>
                                                                                      <tr><th>Age</th><td><?php echo $age; ?></td></tr>
                                                                   <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                                                               <tr><th>Area of Residence</th><td><?php echo $town.', '.$province; ?></td></tr>
                                                               <tr><th>Age Group</th><td><?php echo $agegroup1.' ('.$code1.')'; ?></td></tr>
                                                               <tr><th>In Date</th><td><?php echo date('d/M/Y',$timestamp); ?></td></tr>
                                                                    <tr><th>Prescriber Name</th><td><?php echo $prescriber; ?></td></tr>
                                                               <tr><th>Is Exam for Pregnant Woman</th><td><?php echo $pregnant; ?></td></tr>
                                                               <tr><th>Exam Code</th><td><?php echo $examcode; ?></td></tr>
                                                               <tr><th>Examination</th><td><?php echo $examination; ?></td></tr>
                                                            <tr><th>Result</th><td><?php echo $examresult; ?></td></tr>
                                                               <tr><th>Exam Value</th><td><?php echo $examvalue; ?></td></tr>
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
                                       <?php } ?>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
     <div class="footer">
            <div class="copyright">
                <p style="font-size: 12px">Copyright © <?php echo date('Y', time());?>. Tanganyika Care Polytechnic</p>
            </div>
        </div>
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
<script type="text/javascript">
        window.print();
    </script>
</html>