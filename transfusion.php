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
    <title>Transfusion Details</title>
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
                                           include 'fr/transfusion.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Transfusion Information</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="transfusions">Transfusions</a></li>
                            <li class="breadcrumb-item active"><a href="#">View Transfusion</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                      <?php      
                                         $gettransfusion=mysqli_query($con,"SELECT * FROM transfusions WHERE   status=1 AND transfusion_id='$id'");  
                                      $row = mysqli_fetch_array($gettransfusion);
                                       $transfusion_id=$row['transfusion_id'];
                                          $patientsque_id=$row['patientsque_id'];
                                          $month=$row['month'];
                                          $year=$row['year'];
                                          $bloodtype=$row['bloodtype']; 
                                          $quantityrequested=$row['quantityrequested']; 
                                          $quantityrecieved=$row['quantityreceived']; 
                                          $packetsrequested=$row['packetsrequested']; 
                                          $packetsreceived=$row['packetsreceived']; 
                                          $requesttime=$row['requesttime']; 
                                          $reason=$row['reason']; 
                                          $receipttime=$row['receipttime']; 
                                          $packetnumbers=$row['packetnumbers']; 
                                          $response=$row['response']; 
                                          $timestamp=$row['timestamp']; 
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
                                  $getbloodtype= mysqli_query($con, "SELECT * FROM bloodtypes WHERE status=1 AND bloodtype_id='$bloodtype'");       
              $rowb= mysqli_fetch_array($getbloodtype);
              $bloodtype_id=$rowb['bloodtype_id'];    
              $bloodtypename=$rowb['bloodtype'];    
              $bloodtypecode=$rowb['code'];   
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
                                                               <tr><th>Request Time</th><td><?php echo $requesttime; ?></td></tr>
                                                               <tr><th>Blood Type</th><td><?php echo $bloodtypename.' ('.$bloodtypecode.')'; ?></td></tr>
                                                               <tr><th>Reason</th><td><?php echo $reason; ?></td></tr>
                                                               <tr><th>Quantity Requested</th><td><?php echo $quantityrequested;  ?></td></tr>
                                                                    <tr><th>Packets Requested</th><td><?php echo $packetsrequested; ?></td></tr>
                                                               <tr><th>Quantity Received</th><td><?php echo $quantityrecieved;  ?></td></tr>
                                                               <tr><th>Packets Received</th><td><?php echo $packetsreceived; ?></td></tr>                                                               
                                                               <tr><th>Receipt Time</th><td><?php if(is_numeric($receipttime)){ echo 'D+'.$receipttime;}else{ echo $receipttime; } ?></td></tr>
                                                               <tr><th>Packet numbers</th><td><?php echo $packetnumbers; ?></td></tr>
                                                               <tr><th>Blood Bank Response</th><td><?php echo $response; ?></td></tr>
                                                               <tr><th>Reactions</th><td><?php
                                                               $getreactions= mysqli_query($con,"SELECT * FROM reactions WHERE transfusion_id='$transfusion_id' AND status=1") or die(mysqli_error($con));
                                                              while($rowr= mysqli_fetch_array($getreactions)){
                                                                  $reaction=$rowr['reaction'];
                                                                  echo '-'.$reaction.'<br>';
                                                              }
                                                               ?></td></tr>
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