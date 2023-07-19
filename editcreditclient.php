<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
        $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Client</title>
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
                            <h4>Edit Credit Client</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="creditclients">Credit Clients</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit Client</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
                     <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Client</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                    <?php 
                      if(isset($_POST['submit'])){
                          $clientname= mysqli_real_escape_string($con,trim($_POST['clientname']));
                          $location= mysqli_real_escape_string($con,trim($_POST['location']));
                          $contacts= mysqli_real_escape_string($con,trim($_POST['contacts']));
                          $email= mysqli_real_escape_string($con,trim($_POST['email']));
                          $details= mysqli_real_escape_string($con,trim($_POST['details']));
                          $credittype= mysqli_real_escape_string($con,trim($_POST['credittype']));
                          if((empty($clientname))||(empty($location))||(empty($contacts))||(empty($credittype))){
                              echo '<div class="alert alert-danger">Some fields are empty</div>';    
                          }else{
                              mysqli_query($con,"UPDATE creditclients SET clientname='$clientname',location='$location',credittype='$credittype',contacts='$contacts',email='$email',details='$details' WHERE creditclient_id='$id'") or die(mysqli_error($con));
                              echo '<div class="alert alert-success">Client Successfully Edited</div>';
                              }
                      } 
                            $getclient=mysqli_query($con,"SELECT * FROM creditclients WHERE status=1 AND creditclient_id='$id'");  
                                     $row = mysqli_fetch_array($getclient);
                                        $creditclient_id=$row['creditclient_id'];
                                           $clientname=$row['clientname'];
                                          $contacts=$row['contacts'];
                                          $credittype=$row['credittype'];
                                          $email=$row['email'];
                                          $details=$row['details'];
                                         $location=$row['location'];
                       ?> 
     <form method="post" name='form' class="form"   enctype="multipart/form-data">
        <div class="form-group"><label class="control-label">* Organisation Name</label>
                                    <input type="text" name='clientname' class="form-control" placeholder="Enter client name" required="required" value="<?php echo $clientname; ?>">                                                                          
                                </div>
             <div class="form-group"><label class="control-label">* Location/Address</label>
<input type="text" name='location' class="form-control" placeholder="Enter location" required="required" value="<?php echo $location; ?>">                                                                          
                                </div>
      <div class="form-group">
          <label class="control-label">* Contact Details</label>
<input type="text" name='contacts' class="form-control" placeholder="Enter contacts" required="required" value="<?php echo $contacts; ?>">                                                                          
     </div>
   <div class="form-group">
    <label class="control-label">* Credit Type</label>
             <select name="credittype" class="form-control">
                 <option value="<?php echo $credittype; ?>" selected="selected"><?php echo $credittype; ?></option>
                 <option value="Prepaid">Prepaid</option>
                 <option value="Postpaid">Postpaid</option>
             </select>                                                                          
                </div>
    <div class="form-group"><label class="control-label">Email</label>
<input type="text" name='email' class="form-control" placeholder="Enter email" value="<?php echo $email; ?>">                                                                          
                                </div>
    
            <div class="form-group"><label class="control-label">More Details</label>
                <textarea  name='details' class="form-control" placeholder="Enter More details"><?php echo $details; ?></textarea>                                                                          
                                </div>
                <div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="submit">Edit Client</button>
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
       

    </div>
   
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
        <script language="JavaScript" src="js/gen_validatorv4.js" type="text/javascript"></script>
	<!-- <script src="js/dashboard/dashboard-1.js"></script> -->
         <script type="text/javascript">
               $('#subcategoryname').click(function() {
        if ( $('#category').val() === '') {
        	alert("Please Select a Category First");
        }     
    });   
    
          $('#category').change(function() {
        if ( $(this).val() !== '') {
//        $(this).closest("form").attr('action',  $(this).val());
        	 $("#subcategoryname").hide();
                 $( ".subcategories" ).each(function( index ) {

		        		// console.log(this.id);
		                 $("#"+this.id).hide();
		            

		        });

             $("#subcategory"+ $('#category').val()).show();
             var townid=  $("subcategory"+ $('#category').val());
           $('.subcategories').change(function() {                               
             	 $(this).closest("form").attr('action',  $(this).val());                  
                    });
        }
       else {
       	
             $("#subcategoryname").show();
                 $( ".categories" ).hide();
                           
                     }
    });
           </script>
</body>

</html>