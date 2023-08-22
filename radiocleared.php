<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='radiographer')){
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
                            <li class="breadcrumb-item active"><a href="#"> Patients</a></li>
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
                                    <table id="example6" class="display" style="min-width: 845px">
                                      <thead>
                                        <tr>
                                          <th>DATE</th>    
                                           <th>PIN</th>
                                            <th>Full Names</th>
                                            <th>Gender</th>
                                             <th> Attended By</th>
                                                <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php                                               
                                 $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE payment in (1,0) AND room='radiography' AND status in (1,0)");  
                                        while ($row = mysqli_fetch_array($getque)) {
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                                             $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id' and status='1'");
                                                             if (mysqli_num_rows($getadmission)>0){
                                            $row1= mysqli_fetch_array($getadmission);
                                        $patient_id=$row1['patient_id'];
                                                $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                                        $row2= mysqli_fetch_array($getpatient);
                                            $firstname=$row2['firstname'];    
                                        $secondname=$row2['secondname'];    
                                        $thirdname=$row2['thirdname'];    
                                        $gender=$row2['gender'];    
                                        $ext=$row2['ext']; 
                                        $admin= mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientsque_id'");
                                        if (mysqli_num_rows($admin)>0){
                                        $row4= mysqli_fetch_array($admin);
                                        $admin_id=$row4['admin_id'];
                                        $timestamp=$row4['timestamp'];
                                            $attendant = mysqli_query($con, "SELECT * FROM staff where staff_id='$admin_id'") or die(mysqli_error($con));
                                            $row3 = mysqli_fetch_array($attendant);
                                            $attfullname = $row3['fullname'];
                                        }else{
                                            $attfullname='Not yet attended';
                                            $timestamp=0;
                                        }
                                               
                                                if (strlen($patient_id) == 1) {
                                                    $pin = '000' . $patient_id;
                                                }
                                                if (strlen($patient_id) == 2) {
                                                    $pin = '00' . $patient_id;
                                                }
                                                if (strlen($patient_id) == 3) {
                                                    $pin = '0' . $patient_id;
                                                }
                                                if (strlen($patient_id) >= 4) {
                                                    $pin = $patient_id;
                                                }   
                                           ?>
                                          <tr class="gradeA">
                                              <td>
                                            <?php echo date('Y-m-d',$timestamp); ?>
                                              </td>
                                            <td>
                                            <?php echo $pin; ?>           
                                            </td>
                                            <td><?php echo $firstname.' '.$secondname.' '.$thirdname; ?></td>
                                              <td><?php echo $gender; ?></td>                                                                         
                                              <td><?php echo $attfullname; ?></td>  
                                            <td>   

                                                    <a href="radiologylist?id=<?php echo $patientsque_id; ?>&ty=1" class="btn btn-primary btn-sm">View Report</a>
                                            </td>
                                         
                                         
                                        </tr>
                    
                                        <?php }}?>
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
    <script>
        $('#example6').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
        </script>
   
</body>

</html>