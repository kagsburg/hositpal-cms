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
    <title>Suppliers</title>
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
                            <h4>Suppliers</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="suppliers">Suppliers</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Suppliers</h4>
                            </div>
                            <div class="card-body">
               <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                <tr>
                           <th scope="col">Supplier Name</th>
                       
                           <th scope="col">Phone</th>    
                          <th scope="col">Address</th>   
                          <th scope="col">Email</th>   
                        
                          <th scope="col">&nbsp;</th>
                   
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                   $suppliers=  mysqli_query($con, "SELECT * FROM suppliers WHERE status=1") or die(mysqli_error($con));
                   while($row=  mysqli_fetch_array($suppliers)){
                       $supplier_id=$row['supplier_id'];
                       $suppliername=$row['suppliername'];
                     $email=$row['email'];
                
                       $phone=$row['phone'];
                       $address=$row['address'];               
                  ?>
                        <tr>
                          <td><?php echo $suppliername;?></td>
                                  <td><?php echo $phone;?></td>
                          <td><?php echo $address;?></td>
                          <td><?php echo $email;?></td>
                       
                    
                        <td>
                            <a href="#"data-toggle="modal" data-target="#supplier<?php echo $supplier_id; ?>"  class="btn btn-xs btn-info">Edit</a>
                              <a href="supplieritems?id=<?php echo $supplier_id; ?>" class="btn btn-xs btn-primary">Items</a>                      
                            <a href="removesupplier?id=<?php echo $supplier_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $supplier_id;?>()">Remove</a>
                       <script type="text/javascript">
function confirm_delete<?php echo $supplier_id; ?>() {
  return confirm('You are about To Remove this item. Are you sure you want to proceed?');
}
</script>
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
        </div>
        <?php
             $suppliers=  mysqli_query($con, "SELECT * FROM suppliers WHERE status=1") or die(mysqli_error($con));
                   while($row=  mysqli_fetch_array($suppliers)){
                       $supplier_id=$row['supplier_id'];
                       $suppliername=$row['suppliername'];
                 
                     $email=$row['email'];
                       $phone=$row['phone'];
                       $address=$row['address'];
                                    ?>
                 <div class="modal fade" id="supplier<?php echo $supplier_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"   aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                                  <form action="editsupplier?id=<?php echo $supplier_id; ?>" method="POST">
                                 <div class="form-group">
                                        <label>Supplier Name *</label>
                                        <input type="text" class="form-control" name="suppliername" required="required" value="<?php echo $suppliername; ?>">
	                    </div>
                                   
                                   <div class="form-group">
                                        <label>Address *</label>
                                        <input type="text" class="form-control" name="address" required="required" value="<?php echo $address; ?>">
	                    </div>
                                                        <div class="form-group">
                                        <label>Phone*</label>
                                        <input type="text" class="form-control" name="phone" required="required" value="<?php echo $address; ?>">
	                    </div>
                                     <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
	                    </div>   
                                      
                            <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>           
                          </form>
              </div>
           
            </div>
          </div>
        </div>
                   <?php } ?>  
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