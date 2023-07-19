<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
   $id=$_GET['id'];
    $gettype=  mysqli_query($con,"SELECT * FROM examtypes WHERE status=1 AND examtype_id='$id'");
  $row1=  mysqli_fetch_array($gettype); 
   $examtype=$row1['examtype'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $examtype; ?> Categories</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
             <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                                           include 'fr/examcategories.php';                     
                                       }else{
?>
     
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><?php echo $examtype; ?></h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="examtypes">Exam Types</a></li>
                            <li class="breadcrumb-item active"><a href="#"> Details</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                       <?php
                      if(isset($_POST['category'])){
                       $category=  mysqli_real_escape_string($con,trim($_POST['category']));
                     
                       if(empty($category)){
                           $errors[]='Type Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM examcategories WHERE category='$category' AND status=1");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Type Already Added';    
                       }
              
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"INSERT INTO examcategories(category,examtype_id,status) VALUES('$category','$id',1)") or die(mysqli_error($con));
                           echo '<div class="alert alert-success">Type Successfully Added</div>';
                      }
                      } 
                          ?>
                                    <form action="" method="POST">
                                            <div class="form-group">
	                      <label>Category</label>
                              <input type="text" class="form-control" name="category" required="required">
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
                                <h4 class="card-title">Categories</h4>
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
                            $getcategories=  mysqli_query($con,"SELECT * FROM examcategories WHERE status=1 AND examtype_id='$id'");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $category_id=$row1['category_id'];
                                              $category=$row1['category'];
                                            ?>
                          <tr>
                            <td><?php echo $category; ?></td>
                         <td>
                               
                                <button data-toggle="modal" data-target="#basicModal<?php echo $category_id; ?>"  class="btn btn-xs btn-info">Edit</button>
                                <a href="removeexamcategory?id=<?php echo $category_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $category_id;?>()">Remove</a>
                             
                                    <script type="text/javascript">
function confirm_delete<?php echo $category_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>

                            </td>                       
                          </tr>
                       <div class="modal fade" id="basicModal<?php echo $category_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editexamcategory?id=<?php echo $category_id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Category  name</label>
                              <input type="text" class="form-control" name="category" required="required" value="<?php echo $category; ?>">
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
                    <div class="col-lg-12" id="exams">
                <button data-toggle="modal" data-target="#addexam"  class="btn  btn-success mb-2">Add Examination</button>
          <div class="modal fade" id="addexam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="addexam?id=<?php echo $id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Exam name*</label>
                              <input type="text" class="form-control" name="exam" required="required">
	                    </div>
                                       <div class="form-group">
	                      <label>SI Unit</label>
                              <select class="form-control" name="siunit">
                                  <option value="" selected="selected">Select Unit</option>
                                    <?php
                               $getunits=  mysqli_query($con,"SELECT * FROM units WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getunits)){
                                              $measurement_id=$row1['measurement_id'];
                                              $measurement=$row1['measurement'];
                            ?>
                             <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>
                            <?php }?>
                              </select>
	                    </div>
                                          <div class="form-group">
	                      <label>Select Category</label>
                              <select class="form-control" name="category">
                                  <option value="" selected="selected">Select Category</option>
                                    <?php
                                     $getcategories=  mysqli_query($con,"SELECT * FROM examcategories WHERE status=1 AND examtype_id='$id'");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $category_id=$row1['category_id'];
                                              $category=$row1['category'];
                            ?>
                             <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                            <?php }?>
                              </select>
	                    </div>
                                    <div class="form-group">
	                      <label>Usually Value</label>
                              <input type="text" class="form-control" name="usuallyvalue">
	                    </div>
                                   <div class="form-group">
                                       <button class="btn btn-sm btn-primary" type="submit">Add</button>
                                   </div>
                               </form>
                               
	                    </div>
	                    </div>
	                    </div>
	                    </div>
                     <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $examtype; ?> Examinations</h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                        <tr>
                                              <th>Exam</th>
                                              <th>Category</th>
                                              <th>SI Unit</th>
                                            <th>Usually Value</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                          $getexams= mysqli_query($con, "SELECT * FROM exams WHERE examtype_id='$id' AND status=1");
                                          while($row= mysqli_fetch_array($getexams)){
                                              $exam=$row['exam'];
                                              $exam_id=$row['exam_id'];
                                              $siunit=$row['siunit'];
                                              $category_id=$row['category_id'];
                                              $usuallyvalue=$row['usuallyvalue'];
                                             $getcategory=  mysqli_query($con,"SELECT * FROM examcategories WHERE status=1 AND category_id='$category_id'");
                                           $row1=  mysqli_fetch_array($getcategory);
                                             $category=$row1['category'];
                                               $getunit=  mysqli_query($con,"SELECT * FROM units WHERE status=1 AND measurement_id='$siunit'");
                                                  $row2=  mysqli_fetch_array($getunit);
                                                 $measurement=$row2['measurement'];
                                          ?>
                                          <tr>
                                              <td><?php echo $exam; ?></td>
                                              <td><?php echo $category; ?></td>
                                              <td><?php echo $measurement; ?></td>
                                              <td><?php echo $usuallyvalue; ?></td>
                                              <td>
                                                  <button data-toggle="modal" data-target="#edit<?php echo $exam_id; ?>"  class="btn  btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>      
                                                     <a href="removeexam?id=<?php echo $exam_id; ?>" class="btn btn-danger btn-xs" onclick="return confirm_delete<?php echo $exam_id;?>()">Remove</a>
                                             <script type="text/javascript">
function confirm_delete<?php echo $exam_id; ?>() {
  return confirm('You are about To Remove this Member. Are you sure you want to proceed?');
}
</script>     

          <div class="modal fade" id="edit<?php echo $exam_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                               <form action="editexam?id=<?php echo $exam_id; ?>&&ty=<?php echo $id; ?>" method="POST">
                                    <div class="form-group">
	                      <label>Exam name*</label>
                              <input type="text" class="form-control" name="exam" required="required" value="<?php echo $exam; ?>">
	                    </div>
                                       <div class="form-group">
	                      <label>SI Unit</label>
                              <select class="form-control" name="siunit">
                                  <option value="<?php echo $siunit; ?>" selected="selected"><?php echo $measurement; ?></option>
                                    <?php
                               $getunits=  mysqli_query($con,"SELECT * FROM units WHERE status=1");
                            while( $row1=  mysqli_fetch_array($getunits)){
                                              $measurement_id=$row1['measurement_id'];
                                              $measurement=$row1['measurement'];
                            ?>
                             <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>
                            <?php }?>
                              </select>
	                    </div>
                                          <div class="form-group">
	                      <label>Select Category</label>
                              <select class="form-control" name="category">
                                  <option value="<?php echo $category_id; ?>" selected="selected"><?php echo $category; ?></option>
                                    <?php
                                     $getcategories=  mysqli_query($con,"SELECT * FROM examcategories WHERE status=1 AND examtype_id='$id'");
                            while( $row1=  mysqli_fetch_array($getcategories)){
                                              $category_id=$row1['category_id'];
                                              $category=$row1['category'];
                            ?>
                             <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                            <?php }?>
                              </select>
	                    </div>
                                    <div class="form-group">
	                      <label>Usually Value</label>
                              <input type="text" class="form-control" name="usuallyvalue" value="<?php echo $usuallyvalue; ?>">
	                    </div>
                                   <div class="form-group">
                                       <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                                   </div>
                               </form>
                               
	                    </div>
	                    </div>
	                    </div>
	                    </div>
                                              </td>
                                            </tr>
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
	
	  <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>