<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }
   $id=$_GET['id'];
       $getsupplier=  mysqli_query($con, "SELECT * FROM suppliers WHERE status=1 AND supplier_id='$id'") or die(mysqli_error($con));
                   $row=  mysqli_fetch_array($getsupplier);
                            $suppliername=$row['suppliername'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $suppliername; ?> Items Supplied</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
          <link href="css/chosen/chosen.css" rel="stylesheet">
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
                            <h4><?php echo $suppliername; ?> Items Supplied</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="suppliers">Suppliers</a></li>
                            <li class="breadcrumb-item active"><a href="#">Supplier Items</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		
                            <div class="col-lg-12">
                                <a href="#" data-toggle="modal" data-target="#additem" class="btn btn-success mb-1">Add More</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $suppliername; ?> Items Supplied</h4>
                            </div>
                            <div class="card-body">
               <div class="table-responsive">
                                    <table id="example5" class="display" style="min-width: 845px">
                                      <thead>
                                <tr>
                           <th scope="col">Item Name</th>
                         <th scope="col">Price</th>    
                        
                          <th scope="col">&nbsp;</th>
                   
                        </tr>
                      </thead>
                      <tbody>
                  <?php
                   $supplieritems=  mysqli_query($con, "SELECT * FROM supplierproducts WHERE status=1 AND supplier_id='$id'") or die(mysqli_error($con));
                   while($row=  mysqli_fetch_array($supplieritems)){
                       $supplierproduct_id=$row['supplierproduct_id'];
                       $product_id=$row['product_id'];
                     $price=$row['price'];
               $getitem=mysqli_query($con,"SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$product_id'");  
                                         $row2 = mysqli_fetch_array($getitem);                                     
                                           $itemname=$row2['itemname'];
                 ?>
                        <tr>
                          <td><?php echo $itemname;?></td>
                           <td><?php echo $price;?></td>
                       <td>
                            <a href="#" data-toggle="modal" data-target="#item<?php echo $supplierproduct_id; ?>"  class="btn btn-xs btn-info">Edit</a>
                           <a href="removesupplieritem?id=<?php echo $supplierproduct_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $supplierproduct_id;?>()">Remove</a>
                       <script type="text/javascript">
function confirm_delete<?php echo $supplierproduct_id; ?>() {
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
             $supplieritems=  mysqli_query($con, "SELECT * FROM supplierproducts WHERE status=1 AND supplier_id='$id'") or die(mysqli_error($con));
                   while($row=  mysqli_fetch_array($supplieritems)){
                       $supplierproduct_id=$row['supplierproduct_id'];
                       $product_id=$row['product_id'];
                     $price=$row['price'];
               $getitem=mysqli_query($con,"SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id='$product_id'");  
                                         $row2 = mysqli_fetch_array($getitem);                                     
                                           $tradename=$row2['itemname'];
                                           //$genericname=$row2['genericname'];    
                                    ?>
                 <div class="modal fade" id="item<?php echo $supplierproduct_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"   aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $tradename; ?> Supplier Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                                  <form action="editsupplieritem?id=<?php echo $supplierproduct_id; ?>" method="POST">
                      
                                         <div class="form-group">
                   <label>Cost Price</label>
                   <input type="text" class="form-control" name="price" required="required" value="<?php echo $price; ?>">
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
     <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"   aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item Supplied</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                           <div class="modal-body">
                                  <form action="addsupplieritem?id=<?php echo $id; ?>" method="POST">
                                         <div class="form-group">
                   <label>Product</label>
                        <select   name="product" class="form-control">
                            <option value="" selected="selected">Select Product...</option>
                        <?php
                      $getitems=mysqli_query($con,"SELECT * FROM inventoryitems WHERE status=1 ORDER BY itemname");  
                                        while ($row = mysqli_fetch_array($getitems)) {
                                          $inventoryitem_id=$row['inventoryitem_id'];
                                           $itemname=$row['itemname'];
                    ?>
                          <option value="<?php echo $inventoryitem_id; ?>"><?php echo $itemname; ?></option>
                   <?php } ?>
                      </select>
                                         </div>
                                         <div class="form-group">
                   <label>Cost Price</label>
                   <input type="text" class="form-control" name="price" required="required">
	 </div>
                                      
                            <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit</button>
                      </div>           
                          </form>
              </div>
           
            </div>
          </div>
        </div>
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
   <script src="js/chosen/chosen.jquery.js"></script>
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