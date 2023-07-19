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
    <title>Insurance  Companies</title>
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
                            <h4>Insurance Companies</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="insurance">Insurance Companies</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Insurance Company</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                      if(isset($_POST['company'])){
                       $company=  mysqli_real_escape_string($con,trim($_POST['company']));
                       if(empty($company)){
                           $errors[]='Company Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM insurancecompanies WHERE company='$company' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Company Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO insurancecompanies(company,status) VALUES('$company',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Company Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">
                                            <div class="form-group">
	                      <label>Company</label>
                              <input type="text" class="form-control" name="company" required="required">
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
                                <h4 class="card-title">Insurance companies</h4>
                            </div>
                            <div class="card-body">
                          <table id="example5" class="display" class="table table-striped"  style="width:100%;">
                        <thead>
                          <tr>
                            <th>Company</th>                       
                            <th>Types</th>                       
                                                 
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getcompanies=  mysqli_query($con,"SELECT * FROM insurancecompanies WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcompanies)){
                                              $insurancecompany_id=$row1['insurancecompany_id'];
                                              $company=$row1['company'];
                                $gettypes=  mysqli_query($con,"SELECT * FROM insurancetypes WHERE status=1 AND insurancecompany_id='$insurancecompany_id'");
                           ?>
                          <tr>
                            <td><?php echo $company; ?></td>
                            <td><?php echo mysqli_num_rows($gettypes); ?></td>
                        
                          
                            <td>
                                <a href="insurancetypes?id=<?php echo $insurancecompany_id; ?>" class="btn btn-xs btn-success">Types</a>
                                  <button data-toggle="modal" data-target="#basicModal<?php echo $insurancecompany_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                              <a href="removeinsurancecompany?id=<?php echo $insurancecompany_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $insurancecompany_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $insurancecompany_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="basicModal<?php echo $insurancecompany_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Insurance company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editinsurancecompany?id=<?php echo $insurancecompany_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Company</label>
                              <input type="text" class="form-control" name="company" required="required" value="<?php echo $company; ?>">
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
</body>

</html>