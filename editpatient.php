<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='receptionist')){
header('Location:login.php');
   }
   $id=$_GET['id'];
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>
 <!--<meta charset="utf-8">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Patient</title>
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
 if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                 include 'fr/editpatient.php';                     
                                       }else{
?>
     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Edit Patient </h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="patients">Patients</a></li>
                            <li class="breadcrumb-item active"><a>Edit Patient</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Patient </h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <?php
                            if(isset($_POST['month'],$_POST['year'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['province'],$_POST['town'],$_POST['zone'],$_POST['quarter'],$_POST['subhillnumber'],$_POST['ageorigin'],$_POST['agegroup'],$_POST['destination'],$_POST['paymentmethod']))  {
                            $firstname= mysqli_real_escape_string($con,trim($_POST['firstname']));    
                            $headfirstname= mysqli_real_escape_string($con,trim($_POST['headfirstname']));    
                            $lastname= mysqli_real_escape_string($con,trim($_POST['lastname']));    
                            $headlastname= mysqli_real_escape_string($con,trim($_POST['headlastname']));    
                            $month=$_POST['month'];    
                            $year=$_POST['year'];    
                            $gender= mysqli_real_escape_string($con,trim($_POST['gender']));    
                            $months= mysqli_real_escape_string($con,trim($_POST['months']));    
                            $years= mysqli_real_escape_string($con,trim($_POST['years']));    
                            $province= mysqli_real_escape_string($con,trim($_POST['province']));    
                            $town= mysqli_real_escape_string($con,trim($_POST['town']));    
                            $zone= mysqli_real_escape_string($con,trim($_POST['zone']));    
                            $quarter= mysqli_real_escape_string($con,trim($_POST['quarter']));    
                            $subhillnumber= mysqli_real_escape_string($con,trim($_POST['subhillnumber']));   
                            $ageorigin= mysqli_real_escape_string($con,trim($_POST['ageorigin']));    
                            $agegroup= mysqli_real_escape_string($con,trim($_POST['agegroup']));    
                            $destination= mysqli_real_escape_string($con,trim($_POST['destination']));    
                            $paymentmethod= mysqli_real_escape_string($con,trim($_POST['paymentmethod']));    
                          
                            if((empty($firstname))||(empty($lastname))||(empty($gender))||(empty($destination))||(empty($paymentmethod))||(empty($agegroup))||(empty($ageorigin))){
                              echo '<div class="alert alert-danger">All Fields marked * Should be Filled</div>';
                              }
                          else{
                    if(isset($_POST['referred'])){
                      $referred=$_POST['referred'];
                    }else{
                   $referred='no';     
                    }
                      if(isset($_POST['isbelow'])){
                      $agecategory='months';
                      $age=$months;
                    }else{
                    $agecategory='years';
                       $age=$years;
                    }
       mysqli_query($con,"UPDATE patients SET month='$month',year='$year',firstname='$firstname',lastname='$lastname',gender='$gender',age='$age',agecategory='$agecategory',agegroup='$agegroup',ageorigin='$ageorigin',province='$province',town='$town',zone='$zone',quarter='$quarter',subhillnumber='$subhillnumber',headfirstname='$headfirstname',headlastname='$headlastname',referred='$referred',destination='$destination',paymentmethod='$paymentmethod' WHERE patient_id='$id'") or die(mysqli_error($con));
                
echo '<div class="alert alert-success">Patient Information Successfully Edited.</div>';
    }
        }
 $getpatients=mysqli_query($con,"SELECT * FROM patients WHERE status='1' AND patient_id='$id'");  
                                   $row = mysqli_fetch_array($getpatients);
                                      $patient_id=$row['patient_id'];    
                                        $firstname=$row['firstname'];    
                            $headfirstname= $row['headfirstname'];    
                            $lastname= $row['lastname'];    
                            $headlastname=$row['headlastname'];    
                            $month=$row['month'];    
                            $year=$row['year'];    
                            $age=$row['age'];    
                            $gender=$row['gender'];    
                            $referred=$row['referred'];    
                              $agecategory=$row['agecategory'];    
                            $province=$row['province'];    
                            $town=$row['town'];    
                            $zone=$row['zone'];    
                            $quarter=$row['quarter'];    
                            $subhillnumber=$row['subhillnumber'];   
                            $ageorigin=$row['ageorigin'];    
                            $agegroup=$row['agegroup'];    
                            $destination=$row['destination'];    
                            $timestamp=$row['timestamp'];    
                            $paymentmethod=$row['paymentmethod'];    
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
        $getgroups= mysqli_query($con,"SELECT * FROM agegroups WHERE status=1 AND agegroup_id='$agegroup'") or die(mysqli_error($con));
                                           $row1= mysqli_fetch_array($getgroups);
                                                $agegroup_id=$row1['agegroup_id'];
                                                $agegroup1=$row1['agegroup'];
                                                $code1=$row1['code'];
                             $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$destination'");
                                           $row4=  mysqli_fetch_array($getcategory);
                                           $servicecategory_id=$row4['servicecategory_id'];
                                           $servicecategory=$row4['servicecategory'];
                                   $getpayment= mysqli_query($con,"SELECT * FROM paymentmethods WHERE status=1 AND paymentmethod_id='$paymentmethod'") or die(mysqli_error($con));
                                       $row3= mysqli_fetch_array($getpayment);
                                     $paymentmethod1=$row3['paymentmethod'];
                                     $paymentcode=$row3['code']; 
        ?>
                        
     <form method="post" name='form' class="form" action=""  enctype="multipart/form-data">
         <div class="row">
               <div class="form-group col-lg-4"><label class="control-label">*Month</label>
                   <select class="form-control" name="month">
     <option value="<?php echo $month; ?>" selected="selected"><?php echo $month; ?></option>
  <option value="Janvier">January</option>
  <option value="Février">February</option>
  <option value="Mars">March</option>
  <option value="Avril">April</option>
<option value="Mai">May</option>
  <option value="Juin">June</option>
  <option value="Juillet">July</option>
  <option value="Août">August</option>
<option value="Septembre">September</option>
  <option value="Octobre">October</option>
  <option value="Novembre">November</option>
  <option value="Décembre">December</option>
</select>
             </div>
               <div class="form-group col-lg-4">
                               <label class=" control-label">* Select Year</label>                          
                                  <select name="year" class="form-control">
                                      <option value="<?php echo $year; ?>" selected="selected"><?php echo $year; ?></option>
                                                            <?php
                                                            $datenow=date('Y',$timenow); 
                                                                 for ($x = 0; $x <= 15; $x++) {
                                                                     $datenow=$datenow-1;
                                                      echo '<option value="'.$datenow.'">'.$datenow.'</option>';
                                                                        }
                                                                                  ?> 
                                        </select>
                                                        </div>
                                                        </div>
         <div class="row">
                                <div class="form-group col-lg-6"><label class="control-label">* First Name</label>
                                    <input type="text" name='firstname' class="form-control" placeholder="Enter firstname" required="required" value="<?php echo $firstname; ?>">                                                                          
                                </div>
               <div class="form-group col-lg-6"><label class="control-label">* Last Name</label>
                   <input type="text" name='lastname' class="form-control" placeholder="Enter last name" required="required" value="<?php echo $lastname; ?>">                                                                          
                                </div>
             <div class="col-lg-12"><h3>Area of Residence</h3></div>
         <div class="form-group col-lg-4"><label class="control-label">* Province</label>
             <input type="text" name='province' class="form-control" placeholder="Enter Province" required="required"  value="<?php echo $province; ?>">                                                                          
                                </div>
               <div class="form-group col-lg-4"><label class="control-label">* Town</label>
                   <input type="text" name='town' class="form-control" placeholder="Enter Town" required="required" value="<?php echo $town; ?>">                                                                          
                                </div>       
                   <div class="form-group col-lg-4"><label class="control-label">* Zone</label>
                       <input type="text" name='zone' class="form-control" placeholder="Enter Zone" required="required" value="<?php echo $zone; ?>">                                                                          
                                </div>
               <div class="form-group col-lg-4"><label class="control-label">Quarter</label>
                   <input type="text" name='quarter' class="form-control" placeholder="Enter Quarter" value="<?php echo $quarter; ?>">                                                                          
                                </div>       
                <div class="form-group col-lg-4"><label class="control-label">Sub-hill Street / avenue number</label>
                    <input type="text" name="subhillnumber" class="form-control" placeholder="subhill number" value="<?php echo $subhillnumber; ?>">                                                                          
                                </div>       
                 <div class="col-lg-12"><h3>Head of Family</h3></div>
                 <div class="form-group col-lg-6"><label class="control-label">* First Name</label>
                     <input type="text" name='headfirstname' class="form-control" placeholder="Enter firstname" required="required"  value="<?php echo $headfirstname; ?>">                                                                          
                                </div>
               <div class="form-group col-lg-6"><label class="control-label">* Sur Name</label>
                   <input type="text" name='headlastname' class="form-control" placeholder="Enter last name" required="required" value="<?php echo $headlastname; ?>">                                                                          
                                </div>
                                </div>
           <div class="row">
                                  <div class="form-group col-lg-4"><label class="control-label">* Sex</label>
  <select name="gender" class="form-control">
      <option value="<?php echo $gender; ?>" selected="selected"><?php echo $gender; ?></option>
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                       <div id='form_gender_errorloc' class='text-danger'></div>        
                                                                                                       </div>
               <?php
               if($agecategory=='years'){
               ?>
                <div class="col-lg-12">
	<div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input isbelow" id="customCheckBox1"  name="isbelow">
	<label class="custom-control-label" for="customCheckBox1">Is Patient Below 5 years ?</label>
	</div>
	   </div>
       
                <div class="form-group col-lg-4 forbelow"  style="display: none"><label class="control-label">Enter Age in Month</label>
                    <input type="text"  name="months" class="form-control " placeholder="Age in Month" value="<?php echo $age; ?>">
                                  </div>
              <div class="form-group col-lg-4 forabove"><label class="control-label">Enter Age in Years</label>
                  <input type="text"  name="years" class="form-control " placeholder="Age in Years" value="<?php echo $age; ?>">
                                  </div>
               <?php }else{?>
                 <div class="col-lg-12">
	<div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input isbelow" id="customCheckBox1"  name="isbelow" checked>
	<label class="custom-control-label" for="customCheckBox1">Is Patient Below 5 years ?</label>
	</div>
	   </div>
       
                <div class="form-group col-lg-4 forbelow"><label class="control-label">Enter Age in Month</label>
                    <input type="text"  name="months" class="form-control " placeholder="Age in Month" value="<?php echo $age; ?>">
                                  </div>
              <div class="form-group col-lg-4 forabove" style="display: none"><label class="control-label">Enter Age in Years</label>
                  <input type="text"  name="years" class="form-control " placeholder="Age in Years" value="<?php echo $age; ?>">
                                  </div>
               <?php }?>
              <div class="form-group col-lg-4"><label class="control-label">* Age Group</label>
  <select name="agegroup" class="form-control">
                                            <option value="<?php echo $agegroup; ?>"><?php echo $agegroup1; ?></option>
                                            <?php
                                            $getgroups= mysqli_query($con,"SELECT * FROM agegroups WHERE status=1") or die(mysqli_error($con));
                                            while($row= mysqli_fetch_array($getgroups)){
                                                $agegroup_id=$row['agegroup_id'];
                                                $agegroup=$row['agegroup'];
                                                $code=$row['code'];
                                            ?>
                                            <option value="<?php echo $agegroup_id; ?>"><?php echo $agegroup; ?></option>
                                            <?php }?>
                                        </select>
                                       <div id='form_agegroup_errorloc' class='text-danger'></div>        
                                   </div>
                  <div class="form-group col-lg-4"><label class="control-label">Group by Origin</label>
  <select name="ageorigin" class="form-control">
      <option value="<?php echo $ageorigin; ?>"><?php echo $ageorigin; ?></option>
      <option value="Dist">Dist</option>
      <option value="HD">HD</option>
      <option value="HP">HP</option>
      <option value="HB">HB</option>
  </select>
                       <div id='form_groupbyorigin_errorloc' class='text-danger'></div>   
                                  </div>
            <div class="col-lg-12">
                <div class="form-group">
              <div class="form-check">
                 <?php
                 if($referred=='yes'){
                 ?>
                  <input class="form-check-input" type="checkbox" value="yes" name="referred" checked>
                 <?php }else{ ?>
                  <input class="form-check-input" type="checkbox" value="yes" name="referred">
     <?php }?>
  <label class="form-check-label" for="defaultCheck1">Referred by Out Patients Section</label>
</div>    
           </div>
	
	   </div>
                <div class="form-group col-lg-6"><label class="control-label">Service destination*</label>
                         <select name="destination" class="form-control">
      <option value="<?php echo $destination; ?>"><?php echo $servicecategory; ?></option>
     <?php
          $getcategories=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1");
        while( $row1=  mysqli_fetch_array($getcategories)){
        $servicecategory_id=$row1['servicecategory_id'];
        $servicecategory=$row1['servicecategory'];
                                                         ?>
                                            <option value="<?php echo $servicecategory_id; ?>"><?php echo $servicecategory; ?></option>
                            <?php }?>

  </select>
                       <div id='form_destination_errorloc' class='text-danger'></div>   
                                  </div>
                <div class="form-group col-lg-6"><label class="control-label">Payment Method*</label>
                         <select name="paymentmethod" class="form-control">
      <option value="<?php echo $paymentmethod; ?>"><?php echo $paymentmethod1; ?></option>
     <?php
                                            $getmethods= mysqli_query($con,"SELECT * FROM paymentmethods WHERE status=1") or die(mysqli_error($con));
                                       while($row= mysqli_fetch_array($getmethods)){
                                                $paymentmethod_id=$row['paymentmethod_id'];
                                                $paymentmethod=$row['paymentmethod'];
                                                $code=$row['code'];
                                            ?>
                                            <option value="<?php echo $paymentmethod_id; ?>"><?php echo $paymentmethod; ?></option>
                                            <?php }?>
  </select>
                         <div id='form_paymentmethod_errorloc' class='text-danger'></div>   
                                  </div>
                                  </div>

                                     <div class="form-group pull-right">
                                         <button class="btn btn-primary" type="submit">Submit</button>
                                                                  </div>
                            </form>
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
        <script>
                  $('.isbelow').click(function(){
    if($(this).prop("checked")=== true){
       $('.forbelow').show();    
       $('.forabove').hide();    
               }else{
      $('.forbelow').hide();    
         $('.forabove').show();   
        }
    } );
        var frmvalidator  = new Validator("form");
 frmvalidator.EnableOnPageErrorDisplay();
 frmvalidator.EnableMsgsTogether();
                    frmvalidator.addValidation("gender","req","*Gender is required");
              frmvalidator.addValidation("destination","req","*Destination is required");
              frmvalidator.addValidation("agegroup","req","*Age Group is required");
              frmvalidator.addValidation("paymentmethod","req","*Payment Method is required");
              frmvalidator.addValidation("ageorigin","req","*Group by Origin  is required");
       </script>
</body>

</html>
