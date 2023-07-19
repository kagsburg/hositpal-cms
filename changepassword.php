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
    <title>Change Password</title>
    
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
                                           include 'fr/changepassword.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Set New Password</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                           <li class="breadcrumb-item active"><a href="#">Set Password</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Set New Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                         <?php
                               if(isset($_POST['oldpass'],$_POST['newpass'],$_POST['repeat'],$_POST['email'])){                               
                                   $email=  mysqli_real_escape_string($con,$_POST['email']);
                                   $old=  mysqli_real_escape_string($con,$_POST['oldpass']);
                                   $new=  mysqli_real_escape_string($con,$_POST['newpass']);
                                   $repeat=  mysqli_real_escape_string($con,$_POST['repeat']);
                                  if((empty($old))||(empty($new))||(empty($repeat))){
                                       $errors[]=' Enter all Fields to Proceed';
                                  }
                                   $getstaff=mysqli_query($con,"SELECT * FROM staff WHERE staff_id='".$_SESSION['elcthospitaladmin']."'");         
                                   $row2= mysqli_fetch_array($getstaff);                                        
                                     $pass= $row2['password'];
                                          if($pass!=md5($old)){
                                       $errors[]=' Enter Correct Old Password';
                                       }
                       $checkk=  mysqli_query($con,"SELECT * FROM staff WHERE email='$email' AND status=1 AND staff_id!='".$_SESSION['elcthospitaladmin']."'");
   if(mysqli_num_rows($checkk)>0){
       $errors[]='Email Already in use';
   }
                 if($new!=$repeat){
                                       $errors[]=' The New password does not match with the repeat';
                                                                        }
                                if(!empty($errors)){
foreach($errors as $error){ 
 ?>
 <div class="alert alert-danger"><?php echo $error; ?></div>
<?php 
}         }   else{
                                       
                   $addit2=  mysqli_query($con,"UPDATE staff SET password='".md5($new)."',email='$email'  WHERE staff_id='".$_SESSION['elcthospitaladmin']."'") or die(mysqli_errno());
                                           echo '<div class="alert alert-success">Password Successfully changed.Click <a href="logout">Here</a> to login Again</div>';
//                                        echo '<div class="alert alert-success">Start Date  not Added</div>';
                                   }
                               }
                                $getstaff=mysqli_query($con,"SELECT * FROM staff WHERE staff_id='".$_SESSION['elcthospitaladmin']."'");                              
                                $row = mysqli_fetch_array($getstaff);
                                          $staff_id=$row['staff_id'];
                                           $fullname=$row['fullname'];
                                             $email= $row['email'];
                                ?>
                      <form role="form" name="form" action="" method="post">      
                                 <div class="form-group"> <label class="control-label">Email</label>
    <input type="text" name="email" class="form-control" placeholder="Change Email"  required="required" value="<?php echo $email; ?>">
                                 </div>
                         <div class="form-group">
                             <label class="control-label">Enter Old Password</label>
                              <input type="password" name="oldpass" class="form-control" placeholder="Enter  Old Password"  required="required"></div>
                                     <div class="form-group">
                                                            <label class="control-label">Enter new Password</label>
                              <input type="password" name="newpass" class="form-control" placeholder="Enter  new Password"  required="required"></div>
                                         <div class="form-group"> <label class="control-label">Repeat New Password</label>

                              <input type="password" name="repeat" class="form-control" placeholder="Repeat new Password"  required="required"></div>
                                                                                                  
                                <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Change Password</button>
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