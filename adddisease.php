<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Disease</title>
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
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Disease</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="diseases">Diseases</a></li>
                            <li class="breadcrumb-item active"><a href="adddisease">Add Disease</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Disease</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                       if(isset($_POST['codename'],$_POST['codenumber'])){
                       $codename=mysqli_real_escape_string($con,trim($_POST['codename']));
                       $codenumber=mysqli_real_escape_string($con,trim($_POST['codenumber']));
                       if((empty($codename))||(empty($codenumber))){
                           $errors[]='All Feilds Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM diseases WHERE codenumber='$codenumber' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Disease Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO diseases(codenumber,codename,admin_id,timestamp,status) VALUES('$codenumber','$codename','".$_SESSION['elcthospitaladmin']."','$timenow',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Disease Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">

                                            <div class="form-group">
	                      <label>Code number</label>
                              <input type="text" class="form-control" name="codenumber" required="required">
	                    </div>
                                         <div class="form-group">
	                      <label>Code name</label>
                              <input type="text" class="form-control" name="codename" required="required">
	                    </div>
                      <div class="form-group">
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
	
</body>

</html>