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
    <title>Exam Types</title>
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
                                           include 'fr/examtypes.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Exam Types</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="examtypes">Exam Types</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Type</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                      if(isset($_POST['examtype'])){
                       $examtype=  mysqli_real_escape_string($con,trim($_POST['examtype']));
                     
                       if(empty($examtype)){
                           $errors[]='Type Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM examtypes WHERE examtype='$examtype' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Type Already Added';    
                       }
              
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO examtypes(examtype,status) VALUES('$examtype',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Type Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">
                                            <div class="form-group">
	                      <label>Exam Type</label>
                              <input type="text" class="form-control" name="examtype" required="required">
	                    </div>
                                   
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                                           
                                      
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
                            <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Exam Types</h4>
                            </div>
                            <div class="card-body">
                         <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
                            <th>Type</th>                       
                          <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $gettypes=  mysqli_query($con,"SELECT * FROM examtypes WHERE status=1");
                            while( $row1=  mysqli_fetch_array($gettypes)){
                                              $examtype_id=$row1['examtype_id'];
                                              $examtype=$row1['examtype'];
                                            ?>
                          <tr>
                            <td><?php echo $examtype; ?></td>
                         <td>
                                <a href="examcategories?id=<?php echo $examtype_id; ?>" class="btn btn-xs btn-primary">Categories</a>
                                <button data-toggle="modal" data-target="#basicModal<?php echo $examtype_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                               <a href="removeexamtype?id=<?php echo $examtype_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $examtype_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $examtype_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="basicModal<?php echo $examtype_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Exam Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editexamtype?id=<?php echo $examtype_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Type  name</label>
                              <input type="text" class="form-control" name="examtype" required="required" value="<?php echo $examtype; ?>">
	                    </div>
                                  
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>                 
                          </form>
              </div>
           
            </div>
          </div>
        </div>
                            <?php }?>
                        </tbody>
                        </table>               
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
	
	
	<!-- Dashboard 1 -->
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
	
	
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>