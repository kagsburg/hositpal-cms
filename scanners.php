<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Scanners</title>
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
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/scanners.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Scanners Done</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Scanners</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Scanners Done</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                        <tr>
                                              <th>PIN</th>
                                              <th>Full Names</th>
                                            <th>Month & Year</th>
                                             <th>Date</th>
                                              <th>Reason</th>
                                                 <th>Exit Mode</th>
                                                 <th>Results</th>
                                             <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php                                               
                                     $checkscanner= mysqli_query($con, "SELECT * FROM scannerreports WHERE status=1") or die(mysqli_error($con));
                                 while($row= mysqli_fetch_array($checkscanner)){
               $month=$row3['month'];
                    $patientsque_id=$row['patientsque_id'];
                    $scannerreport_id=$row['scannerreport_id'];
               $year=$row['year'];
               $reason=$row['reason'];
               $description=$row['description'];
               $conclusion=$row3['conclusion'];
               $results=$row['results'];
             $responsible=$row['responsible'];
                $exitmode=$row['exitmode'];
               $destination=$row['destination'];
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
                                                       
                                            <td><?php echo $firstname.' '.$lastname; ?></td>
                                            <td><?php echo $month.' '.$year; ?></td>
                                                <td><?php echo date('d/M/Y',$timestamp); ?></td>
                                              <td><?php echo $reason; ?></td>
                                              <td><?php echo $exitmode; ?></td>
                                            <td><?php echo $results; ?></td>
                                                                      <td>   
                                                    <a href="scannerreport?id=<?php echo $scannerreport_id; ?>" class="btn btn-sm btn-info">View Report</a>
                                          </td>
                                         
                                         
                                        </tr>
               
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
     
     <?php 
                                       }
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