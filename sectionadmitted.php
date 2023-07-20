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
    <title>Admitted Patients</title>
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
                                           include 'fr/sectionadmitted.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Admitted Patients</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="admitted">Admitted Patients</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Admitted Patients</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                        <tr>
                                              <th>PIN</th>
                                              <th>Full Names</th>
                                            <th>Ward</th>
                                              <th>Bed Number</th>
                                              <th>Admission Date</th>
                                              <th>Added By</th>
                                             <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php      
                   $getadmitted= mysqli_query($con,"SELECT * FROM admitted WHERE status=1 ORDER BY admitted_id DESC");
                while ($row = mysqli_fetch_array($getadmitted)) {
                  $admission_id=$row['admission_id'];    
                  $admitted_id=$row['admitted_id'];    
                  $bed_id=$row['bed_id'];    
                  $price=$row['price'];    
                  $admissiondate=$row['admissiondate'];    
                  $admin_id=$row['admin_id'];    
                      $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id'");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                              $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                                $firstname=$row2['firstname'];    
                              $lastname=$row2['secondname'];    
                            $gender=$row2['gender'];    
                            $getstaff= mysqli_query($con,"SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));                        
                            $rows= mysqli_fetch_array($getstaff);
                            $fullname=$rows['fullname'];
                 $getbed= mysqli_query($con,"SELECT * FROM beds WHERE bed_id='$bed_id' AND status=1") or die(mysqli_error($con));
     $rowb= mysqli_fetch_array($getbed);
     $ward_id=$rowb['ward_id'];
     $bednumber=$rowb['bedname'];
      $getward=  mysqli_query($con,"SELECT * FROM wards WHERE status=1 AND ward_id='$ward_id'");
      $roww= mysqli_fetch_array($getward);
       $wardname=$roww['wardname'];
       $section_id=$roww['wardtype_id'];
      
      if(strlen($patient_id)==1){
      $pin='0000'.$patient_id;
     }
       if(strlen($patient_id)==2){
      $pin='000'.$patient_id;
     }
        if(strlen($patient_id)==3){
      $pin='00'.$patient_id;
     }
        if(strlen($patient_id)==4){
      $pin='0'.$patient_id;
     }
  if(strlen($patient_id)>=5){
      $pin=$patient_id;
     }       
    $checksection= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id='$section_id' AND status=1");
 if(mysqli_num_rows($checksection)>0){
    ?>
                                          <tr class="gradeA">
                                              <td><?php echo $pin; ?></td>
                                                          
                                            <td><?php echo $firstname.' '.$lastname; ?></td>
                                      <td><?php echo $wardname; ?></td>
                                         <td><?php echo $bednumber; ?></td>                                
                                        <td><?php echo date('d/M/Y',$admissiondate); ?></td>                                
                                        <td><?php echo $fullname; ?></td>                                
                                      <td>     
                                       <a href="admission?id=<?php echo $admitted_id; ?>" class="btn btn-success btn-xs">View Details</a>  
                                     </td>
                                     </tr>
                 <?php } }?>
                                        </tbody>     
                                    </table>     
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
   
</body>

</html>