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
    <title>Salaries </title>
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
                            <h4>Salaries</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="salaries">Salaries</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Salary</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                      if(isset($_POST['salary'])){
                       $salary=  mysqli_real_escape_string($con,trim($_POST['salary']));
                       if(empty($salary)){
                           $errors[]='Salary Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM salaries WHERE salary='$salary' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Salary Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO salaries(salary,status) VALUES('$salary',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Salary Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">

                                            <div class="form-group">
	                      <label>Salary</label>
                              <input type="number" class="form-control" name="salary" required="required">
	                    </div>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                                           
                                      
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
                            <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Salaries</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" style="width:100%">
                        <thead>
                          <tr>
                            <th>Salary Name</th>                       
                                                 
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getsalaries=  mysqli_query($con,"SELECT * FROM salaries WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getsalaries)){
                                              $salary_id=$row1['salary_id'];
                                              $salary=$row1['salary'];
                                                         ?>
                          <tr>
                            <td><?php echo $salary; ?></td>
                        
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal<?php echo $salary_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                                <a href="removesalary?id=<?php echo $salary_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $salary_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $salary_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="basicModal<?php echo $salary_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit salary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editsalary?id=<?php echo $salary_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Salary  name</label>
                              <input type="text" class="form-control" name="salary" required="required" value="<?php echo $salary; ?>">
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