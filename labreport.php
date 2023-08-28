<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/bills.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
$id=$_GET['que'];
$patient_id = $_GET['patient_id'];
$test= $_GET['test'];
// $patient=get_patient_by_id($pdo,$patient_id);
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lab Report</title>
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
                            <h4> Lab Report</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="waitingpatients"> In Patients</a></li> -->
                            <li class="breadcrumb-item active"><a href="#">Lab Report</a></li>
                        </ol>
                    </div>
                </div>
       	<div class="row">
                     <?php
                                  $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'");  
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
                               $bill= get_bill_by_patient_only($pdo, $patient_id,null, 1);
                               $paymentype = $bill[0]['payment_method'];
                            //    $patient = get_patient_by_id($pdo, $patient_id);
                            //    $paymentype = $patient["paymenttype"];
                                                    if ($paymentype == "insurance"){
                                                        $insu=$row2['insurancecompany'];
                                                        $getinsurance = mysqli_query($con,"SELECT * FROM insurancecompanies WHERE insurancecompany_id ='$insu'")or die(mysqli_error($con));
                                                        $insur = mysqli_fetch_array($getinsurance);
                                                        $company=$insur['company'];
                                                    }else if ($paymentype == "credit"){
                                                        $rst = $row2['creditclient'];
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
     $labtests='';
     $getreport= mysqli_query($con, "SELECT * FROM labreports WHERE status=1 and admission_id='$admission_id' and test='$test'") or die(mysqli_error($con));
       while ($rowtitle = mysqli_fetch_array($getreport)) {
        $medicalservice_id = $rowtitle['test'];        
        $admin_id2 = $rowtitle['admin_id'];
        $approve = $rowtitle['approved'];
        $title=$rowtitle['title'];
        $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
        $row2 = mysqli_fetch_array($getservice);
        $medicalservice = $row2['investigationtype'];
        $investigationtype_id=$row2['investigationtype_id'];
        $labtests.= $medicalservice.'';
        $report_date=$rowtitle['timestamp'];
        $getuser = mysqli_query($con, "SELECT * FROM staff WHERE staff_id ='$admin_id'") or die(mysqli_error($con));
        $rowuser = mysqli_fetch_array($getuser);
        $user = $rowuser['fullname'];
        $getuser = mysqli_query($con, "SELECT * FROM staff WHERE staff_id ='$admin_id2'") or die(mysqli_error($con));
        $rowuser = mysqli_fetch_array($getuser);
        $user2 = $rowuser['fullname'];

       }      
                               ?>
                    
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Test <?php echo $labtests ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <address>
                                        <strong>Names:<?php echo $fullname ?></strong><br>
                                            <strong>Gender:<?php echo $gender ?> </strong><br>
                                            <strong>PIN #: <?php echo $pin ?> </strong>
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
                                        ?></span>  </strong><br>
                                            <strong>Date: <?php echo date('Y-m-d',$report_date); ?> </strong>
                                        </address>
                                    </div>
                                    <div class="col-lg-4">
                                        <address>
                                            <strong>Order By: <?php echo $user?></strong><br>
                                            <strong>Conducted By : <span><?php echo $user2?></span></strong><br>
                                            <?php if ($approve !=0){ ?>
                                            <strong>Authorized  By : <span><?php 
                                             $getuser = mysqli_query($con, "SELECT * FROM staff WHERE staff_id ='$approve'") or die(mysqli_error($con));
                                             $rowuser2 = mysqli_fetch_array($getuser);
                                             $user2 = $rowuser2['fullname'];
                                             echo $user2;
                                                ?></span></strong><br>
                                            <?php } ?>
                                        </address>
                                    </div>
                                </div>
                                <?php 
                                
                                ?>
                                <div class="basic-form">   
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <p> <?php echo $title ?></p>
                                    </div>
                                    <h5>FINDINGS</h5>
                                <table style="min-width: 845px">
                                <tbody>
                                <?php 
                                $getreport = mysqli_query($con, "SELECT * FROM labreports WHERE status=1 and admission_id='$admission_id'and test='$test'") or die(mysqli_error($con));
                                while ($rowtitle = mysqli_fetch_array($getreport)) {
                                    $medicalservice_id = $rowtitle['test'];
                                    $result=$rowtitle['result'];
                                    $unit_id=$rowtitle['siunit'];
                                    $start= $rowtitle['start'];
                                    $end= $rowtitle['end'];
                                    $details=$rowtitle['details'];
                                    $approve = $rowtitle['approved'];
                                    $admin_id2 = $rowtitle['admin_id'];
                                    $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                    $row2 = mysqli_fetch_array($getservice);
                                    $medicalservice = $row2['investigationtype'];
                                    $investigationtype_id=$row2['investigationtype_id'];
                                    $range = $row2['range_type'];
                                    $has_answer = $row2['has_answers'];
                                                            $has_answer = $row2['has_answers'];
                                                            $getunit =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit_id'");
                                                            if (mysqli_num_rows($getunit) == 0) {
                                                                $measurement = "";
                                                            }else{
                
                                                                $row1 =  mysqli_fetch_array($getunit);
                                                                $measurement_id = $row1['measurement_id'];
                                                                $measurement = $row1['measurement'];
                                                            }
                                                            $flag = '';
                                                            if ($has_answer == 1) {
                                                                $getanswer = mysqli_query($con, "SELECT * FROM investigationselect WHERE status=1 AND investigationselect_id ='$result'");
                                                                if (mysqli_num_rows($getanswer) == 0) {
                                                                    $result = "";
                                                                }else{
                                                                    $row3 = mysqli_fetch_array($getanswer);
                                                                    $result = $row3['answer'];
                                                                }
                                                            }
                                                            if ($range == 1) {
                                                                $getrange = mysqli_query($con, "SELECT * FROM investigationtypesrange WHERE status=1 AND investigationtype_id='$investigationtype_id'");
                                                                if (mysqli_num_rows($getrange) == 0) {
                                                                    $range = "";
                                                                }else{
                                                                    $row3 = mysqli_fetch_array($getrange);
                                                                    $lowx = $row3['lowx'];
                                                                    $lowx = $row3['lowy'];
                                                                    $lowx = $row3['normalx'];
                                                                    $lowx = $row3['normaly'];
                                                                    $lowx = $row3['highx'];
                                                                    $lowx = $row3['highy'];
                                                                    // check if the result is within range
                                                                    if ($result >= $lowx && $result <= $lowy) {
                                                                        $interval = $lowx .' - '.$lowy;
                                                                        $result = "<span class='text-success'>".$result."</span>";
                                                                        $flag = 'L';
                                                                    }elseif ($result >= $normalx && $result <= $normaly) {
                                                                        $interval = $normalx .' - '.$normalx;
                                                                        $result = "<span class='text-success'>".$result."</span>";
                                                                        $flag = 'N';
                                                                    }elseif ($result >= $highx && $result <= $highy) {
                                                                        $interval = $highx .' - '.$highy;
                                                                        $flag = 'H';
                                                                    }else{
                                                                        $interval = $lowx .' - '.$lowy;
                                                                        $result = "<span class='text-danger'>".$result."</span>";
                                                                        $flag = 'N/A';
                                                                    }

                                                                }
                                                            }
                                    ?>
                                   
                                   


                                                            <tr>
                                                                <td>
                                        
                                            <h5>Test</h5>
                                            <p><?php echo $medicalservice ?></p>
                                        
                                                                </td><td>
                                        
                                            <h5>RESULT</h5>
                                            <p><?php echo $result ?></p>
                                        
                                        </td>
                                        <td>
                                            <h5>START TIME</h5>
                                            <p><?php echo $start ?></p>
                                        </td>
                                        <td>
                                            <h5>END TIME</h5>
                                            <p><?php echo $end ?></p>
                                        </td>
                                        <!-- <td>
                                            <h5>SI Unit</h5>
                                            <p><?php echo $measurement ?></p>
                                        </td> -->

                                        <?php if ($range == 1){?>
                                            <td>
                                            <h5>Flag</h5>
                                            <p><?php echo $flag ?></p>
                                        </td><td>
                                            <h5>RefInterval</h5>
                                            <p><?php echo $flag ?></p>
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <h5>Details</h5>
                                            <p><?php echo $details ?></p>
                                        
                                        </td>
                                        </tr>
                                        
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                        
                                        <td>
                                        </td>
                                        <td>
                                        <a href="printlab?patient_id=<?php echo $patient_id ?>&que=<?php echo $id?>&test=<?php echo $test ?>" target="_blank" class="btn btn-primary">Print</a>
                                            <?php if ($approve == 0 && ($_SESSION['elcthospitallevel'] == 'lab technologist')){?>
                                                <a href="approvereport.php?patientsque_id=<?php echo $id; ?>&admission_id=<?php echo $admission_id ?>&test=<?php echo $test ?>" class="btn btn-primary">Edit</a>
                                        <a href="approvereport.php?patientsque_id=<?php echo $id; ?>&admission_id=<?php echo $admission_id ?>&test=<?php echo $test ?>" class="btn btn-primary">Approve</a>
                                        <?php } ?>

                                        </td>
                                        <?php if ($approve != 0){?>
                                        
                                        <?php } ?>
                                        </tr>

                                        </table>
                                    <!-- <div>
                                        <a href="printreport.php?patientsque_id=<?php echo $patientsque_id; ?>&id=<?php echo $patient_id ?>" class="btn btn-primary">Print</a>
                                    </div> -->

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
