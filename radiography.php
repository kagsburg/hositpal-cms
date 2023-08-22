<?php
include 'includes/conn.php';
include 'utils/patients.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
$patientsque_id=$_GET['patientsque_id'];
$patient_id = $_GET['id'];
$test=$_GET['test'];
// $patient=get_patient_by_id($pdo,$patient_id);
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Radiology Report</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
      <script src="ckeditor/ckeditor.js"></script>
       <link href="css/chosen/chosen.css" rel="stylesheet">
    <link rel="stylesheet" href="ckeditor/samples/sample.css">
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
                                           include 'fr/addradiologyreport.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4> Radiology Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li> -->
                            <li class="breadcrumb-item active"><a href="#">Radiology Report</a></li>
                        </ol>
                    </div>
                </div>
       	<div class="row">
                     <?php
                                  $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientsque_id'");  
                                    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                          $admin_id = $row['admin_id'];
                                          $attendant=$row['attendant'];
                                          $prev_id = $row['prev_id'];
                                 $getadmission= mysqli_query($con,"SELECT * FROM admissions WHERE admission_id='$admission_id' ");
                                $row1= mysqli_fetch_array($getadmission);
                               $patient_id=$row1['patient_id'];
                                     $getpatient=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$patient_id'");  
                               $row2= mysqli_fetch_array($getpatient);
                               $firstname = $row2['firstname'];
                               $secondname = $row2['secondname'];
                               $thirdname = $row2['thirdname'];
                               $bloodgroup = $row2['bloodgroup'];
                               $fullname = $firstname.' '.$secondname.' '.$thirdname;
                               $dob = $row2['dob'];
                               $weight = $row2['weight'];
                               $height = $row2['height'];
                               $temp = $row2['temp'];
                               $bp = $row2['bp'];
                               $allergies = $row2['allergies'];
                               $diseases = $row2['diseases'];
                               $pregnancies = $row2['pregnancies'];
                               $gender = $row2['gender'];
                               $insurancecompany = $row2['insurancecompany'];
                               $ext = $row2['ext'];
                               $patient = get_patient_by_id($pdo, $patient_id);
                               $paymentype = $patient["paymenttype"];
                               $ordered = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
                                 $rowordered = mysqli_fetch_array($ordered);
                                    $orderedby = $rowordered['fullname'];
                                                    if ($paymentype == "insurance"){
                                                        $insu=$patient['insurancecompany'];
                                                        $getinsurance = mysqli_query($con,"SELECT * FROM insurancecompanies WHERE insurancecompany_id ='$insu'")or die(mysqli_error($con));
                                                        $insur = mysqli_fetch_array($getinsurance);
                                                        $company=$insur['company'];
                                                    }else if ($paymentype == "credit"){
                                                        $rst = $patient['creditclient'];
                                                        $getinsurance = mysqli_query($con, "SELECT * FROM creditclients where creditclient_id ='$rst'")or die(mysqli_error($con));
                                                        $cred= mysqli_fetch_array($getinsurance);
                                                        $company = $cred['clientname'];
                                                    }else{
                                                        $company = "Cash";
                                                    }

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
     $getreporttitle = mysqli_query($con, "SELECT * FROM radiolodyreporttitle WHERE status=1 and admission_id='$admission_id'") or die(mysqli_error($con));
        $rowtitle = mysqli_fetch_array($getreporttitle);
        $title = $rowtitle['title'];
        $summary = $rowtitle['summary'];
        $report_id = $rowtitle['reporttitle'];
        $report_date = $rowtitle['timestamp'];
        $conculsion = $rowtitle['conclusion'];
        $getreport2 = mysqli_query($con, "SELECT * FROM radiologyreports WHERE status=1 and report_id='$report_id' and results='$test'") or die(mysqli_error($con));
        $rowreport = mysqli_fetch_array($getreport2);
        $admin_id = $rowreport['admin_id'];
        $conducted= mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$admin_id'") or die(mysqli_error($con));
        $rowconducted = mysqli_fetch_array($conducted);
        $conductedby = $rowconducted['fullname'];
                               ?>
                    
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $title ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <address>
                                        <strong>Names:<?php echo $fullname ?></strong><br>
                                            <strong>Gender:<?php echo $gender ?></strong><br>
                                            <strong>PIN #: <?php echo $pin ?></strong>
                                        </address>
                                    </div>
                                    <div class="col-lg-4">
                                        <address>
                                            <strong>Sponsor: <?php echo $company?></strong><br>
                                            <strong>Age: <span><?php 
                                        $dob1 = date("Y-m-d", strtotime($dob));
                                        $dob2 = new DateTime($dob1);
                                        $now = new DateTime();
                                        $difference = $now->diff($dob2);
                                        echo $difference->y;
                                        ?></span> </strong><br>
                                            <strong> Date: <?php echo date('Y-m-d',$report_date); ?></strong>
                                        </address>
                                    </div>
                                    <div class="col-lg-4">
                                        <address>
                                            <strong>Order By: <?php echo $orderedby?></strong><br>
                                            <strong>Conducted By : <span><?php echo $conductedby?></span></strong><br>
                                        </address>
                                    </div>
                                </div>
                                <h5>RELEVANT CLINICAL SUMMARY</h5>
                                <p><?php echo $summary ?></p>
                                <div class="basic-form">      
                                <h5>FINDINGS</h5>
                                <div class="row">
                                <?php 
                                $getreport = mysqli_query($con, "SELECT * FROM radiologyreports WHERE status=1 and report_id='$report_id' and results='$test'") or die(mysqli_error($con));
                                while ($rowreport = mysqli_fetch_array($getreport)) {
                                    $results = $rowreport['results'];
                                    $report_radio_id = $rowreport['radiologyreport_id'];
                                    $description = $rowreport['description'];
                                    $report_date = $rowreport['timestamp'];
                                    $conculsion = $rowreport['conclusion'];
                                    $admin_id = $rowreport['admin_id'];
                                    $start = $rowreport['start'];
                                    $end = $rowreport['end'];
                                    $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$results'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];
                                    ?>
                                    
                                        <div class="col-lg-12">
                                            <!-- <h5><?php echo $medicalservice ?></h5> -->
                                            <p><?php echo $description ?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>START TIME</h5>
                                            <p><?php echo $start ?></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>END TIME</h5>
                                            <p><?php echo $end ?></p>
                                        </div>
                                        <hr>
                                        <?php 
                                        $getimages = mysqli_query($con, "SELECT * FROM radiologyimages WHERE status=1 and radiology_report_id='$report_radio_id'") or die(mysqli_error($con));
                                        if (mysqli_num_rows($getimages) == 0) {
                                            ?>
                                            <?php
                                        }else{
                                        while ($rowimages = mysqli_fetch_array($getimages)) {
                                            // $image = $row2['image'];
                                            $ext = $rowimages['image'];
                                            $image_id = $rowimages['radioimage_id'];
                                            if (!empty($ext))
                                                $pimage = md5($image_id) . '.' . $ext;
                                            else 
                                                $pimage = "noimage.png";
                                            
                                            ?>
                                            <div class="col-lg-4">
                                                <img src="<?php echo BASE_URL ?>/images/radiology/<?php echo $pimage; ?>" width="100%">
                                            </div>
                                        <?php }} ?>
                                        
                                    <?php } ?>
                                    <div class="col-lg-12">
                                        <h5>CONCLUSION</h5>
                                        <p><?php echo $conculsion ?></p>
                                    </div>
                                    <div>
                                        <a href="printreport.php?patientsque_id=<?php echo $patientsque_id; ?>&id=<?php echo $patient_id ?>&test=<?php echo $test; ?>" class="btn btn-primary">Print</a>
                                    </div>

                                </div>
                            </div>
                        </div>
	                </div>
                     
                            </div>
			   </div>
            </div>
                                       <?php }?>
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
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
         <script src="js/chosen/chosen.jquery.js"></script>

</body>

</html>
