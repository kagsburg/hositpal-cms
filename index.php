<?php
include 'includes/conn.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
	header('Location:login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Home </title>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
	<link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

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
				<div class="form-head d-flex mb-3 mb-md-5 align-items-start page-titles">
					<div class="mr-auto d-none d-lg-block">
						<h3 class="text-primary font-w600">Welcome to ELCT-ELVD </h3>
						<p class="mb-0">Nyakato Health Center!</p>
					</div>

				</div>
				<?php 
				if (($_SESSION['elcthospitallevel'] == 'admin')) {
					// Get current date
					$currentDate = strtotime(date("Y-m-d"));

					// Calculate the date 3 months from now
					$expiryDateThreshold =  strtotime("+3 months");
					$getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 and contractend >= '$currentDate' and contractend <= '$expiryDateThreshold'");
					if (mysqli_num_rows($getstaff) > 0) {
						while ($row = mysqli_fetch_array($getstaff)){
							$contractstart = $row['contractstart'];
							$contractend = $row['contractend'];
							$today = strtotime(date('Y-m-d'));
								?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong>Contract Expiring Soon!</strong> <?php echo $row['fullname'] ?> contract is expiring on <?php echo date('Y-m-d',$contractend) ?>.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<?php
							
							// check if contract has expired
							if ($today > $contractend) {
								?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong>Contract Expired!</strong> <?php echo $row['fullname'] ?> contract has expired.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<?php
							}
						}
					}
				}
				if ($_SESSION['elcthospitallevel']=='doctor'){
					// check and get all patients on emergency mode 
					$getemergency = mysqli_query($con, "SELECT * FROM admissions WHERE status=1 and mode='emergency' and attended is null");
					if (mysqli_num_rows($getemergency) > 0){
						while ($row = mysqli_fetch_array($getemergency)){
							$patientid = $row['patient_id'];
							$admission_id =$row['admission_id'];
							$getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status=1 and patient_id ='$patientid'");
							$row = mysqli_fetch_array($getpatient);
							$fullname = $row['firstname'].' '.$row['secondname'];
							$patientid = $row['patient_id'];
							$getque = mysqli_query($con, "SELECT * FROM patientsque WHERE admission_id='$admission_id'and  room ='doctor' AND status=0");
							if (mysqli_num_rows($getque) > 0){
								$row = mysqli_fetch_array($getque);
								$que = $row['patientsque_id'];
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Emergency Patient!</strong> <?php echo $fullname ?> is on emergency mode.
								<a href="attendemergency?patientid=<?php echo $patientid ?>&que=<?php  $que;?>" class="btn btn-primary btn-sm">Attend</a>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<?php
						}}
					}
				}
				
				?>
				<?php 
				  if ($_SESSION['elcthospitallevel']=='lab technologist'){
					?>
					<div class="col-xl-6 col-xxl-12">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-danger">
								<div class="card-body  p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-user-plus"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Awaiting Patients</p>
											<?php
											$count2=0;
											$getque = mysqli_query($con, "SELECT * FROM patientsque WHERE  room='lab' AND status=0");
                                            while ($row = mysqli_fetch_array($getque)) {
                                                $patientsque_id = $row['patientsque_id'];
                                                $admission_id = $row['admission_id'];
                                                $prev_id = $row['prev_id'];
                                                $timestamp= $row['timestamp'];

                                                $getadmission = mysqli_query($con, "SELECT * FROM admissions WHERE admission_id='$admission_id' and status ='1'");
                                                if (mysqli_num_rows($getadmission) > 0){
													$count2++;
												}
											}
											?>
											<h3 class="text-white"><?php echo $count2; ?></h3>											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-success">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-home"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Pending Results</p>
											<?php
											$count=0;	
											$getque=mysqli_query($con,"SELECT * FROM patientsque WHERE payment IN(1,0) AND room='lab' AND status in (1,0)");  
                                    if (mysqli_num_rows($getque) >0){
                                        while ($row = mysqli_fetch_array($getque)) {
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                                             $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id' and status=1");
                                                             if (mysqli_num_rows($getadmission) >0){
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");
                                     $getpendinglab = mysqli_query($con, "SELECT * FROM labreports where patientsque_id='$patientsque_id' AND admission_id='$admission_id' and approved=0  and status='1'") or die(mysqli_error($con));  
                                     if (mysqli_num_rows($getpendinglab) > 0){
										$count++;
									 }
									}
								}
							}
											?>
											<h3 class="text-white"><?php echo $count; ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-info">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Total Employees</p>
											<?php
											$getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 and (role='lab technician' or role='lab technologist') ");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getstaff); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-secondary">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-medkit"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Lab Measurements</p>
											<?php
											 $gettypes =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($gettypes); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					 
					 <?php
				  }else{
					?>
				<div class="col-xl-6 col-xxl-12">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-danger">
								<div class="card-body  p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-user-plus"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Patients</p>
											<?php
											$getpatients = mysqli_query($con, "SELECT * FROM patients WHERE status=1");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getpatients); ?></h3>											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-success">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-home"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Wards</p>
											<?php
											$getwards = mysqli_query($con, "SELECT * FROM wards WHERE status=1");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getwards); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-info">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-users"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Employees</p>
											<?php
											$getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1 ");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getstaff); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-secondary">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-medkit"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Diseases</p>
											<?php
											$getdiseases = mysqli_query($con, "SELECT * FROM diseases WHERE status=1");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getdiseases); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-sm-6">
							<div class="widget-stat card bg-primary">
								<div class="card-body p-4">
									<div class="media">
										<span class="mr-3">
											<i class="fa fa-folder-open"></i>
										</span>
										<div class="media-body text-white text-right">
											<p class="mb-1">Departments</p>
											<?php
											$getdepartments = mysqli_query($con, "SELECT * FROM departments WHERE status=1");
											?>
											<h3 class="text-white"><?php echo mysqli_num_rows($getdepartments); ?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
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
	<!-- Required vendors -->
	<script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>


	<!-- Dashboard 1 -->
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->


	<!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>