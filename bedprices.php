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
    <title>Bed Prices</title>
    
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
                            <h4>Bed Prices</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                           <li class="breadcrumb-item active"><a href="#">Bed Prices</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Bed Price</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                       if(isset($_POST['wardtype'],$_POST['wardname'],$_POST['beds'])){
                       $wardname=mysqli_real_escape_string($con,trim($_POST['wardname']));
                       $wardtype=mysqli_real_escape_string($con,trim($_POST['wardtype']));
                       $beds=$_POST['beds'];
                       if(empty($wardtype)){
                           $errors[]='Ward type Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM wards WHERE wardname='$wardname' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Ward name Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO wards(wardname,wardtype_id,beds,bedfee,status) VALUES('$wardname','$wardtype','$beds','',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Ward Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">
                                        
                                        <div class="form-group"><label class="control-label">* Ward Type</label>
                                        <select name="wardtype" class="form-control">
                                            <option value="">select type...</option>
                                        <?php
                            $getcats=  mysqli_query($con,"SELECT * FROM wardtypes WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getcats)){
                                              $wardtype_id=$row1['wardtype_id'];
                                              $wardtype=$row1['wardtype'];
                                                       ?>
                                            <option value="<?php echo $wardtype_id; ?>"><?php echo $wardtype; ?></option>
                            <?php }?>
                                          
                                        </select>
                                </div>
                                            <div class="form-group">
	                      <label>Bed Price</label>
                              <input type="number" class="form-control" name="bedprice" required="required">
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
                                <h4 class="card-title">Medical Services</h4>
                            </div>
                            <div class="card-body">
                          <table id="example5" class="display" class="table table-striped"  style="width:100%;">
                        <thead>
                          <tr>
                            <th>Ward Type</th>   
                            <th>Bed Price</th>   
                            <th>Action</th>                        
                          </tr>
                        </thead>
                        <tbody>
                         
                          <tr>
                            <td>Paediatric</td>
                                   <td>45000</td>                
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal"  class="btn btn-xs btn-info">Edit</button>
                                <a href="#" class="btn btn-xs btn-danger" onclick="return confirm_delete()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                             <tr>
                            <td>Maternity</td>
                            <td>100000</td>
                                              
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal"  class="btn btn-xs btn-info">Edit</button>
                                <a href="#" class="btn btn-xs btn-danger" onclick="return confirm_delete()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <tr>
                            <td>Male Ward</td>
                                   <td>180000</td>                
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal"  class="btn btn-xs btn-info">Edit</button>
                                <a href="#" class="btn btn-xs btn-danger" onclick="return confirm_delete()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                             <tr>
                            <td>Female Ward</td>
                                  <td>230000</td>                 
                          
                            <td>
                                <button data-toggle="modal" data-target="#basicModal"  class="btn btn-xs btn-info">Edit</button>
                                <a href="#" class="btn btn-xs btn-danger" onclick="return confirm_delete()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
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