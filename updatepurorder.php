<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='store manager')){
header('Location:login.php');
   }
    if(!isset($_SESSION["bproducts"])){ 
 header('Location:addorder');   
}else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Update  Purchase Order</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
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
                            <h4>Update Purchase</h4>
                           
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="addorder">Add Order</a></li>
                            <li class="breadcrumb-item active"><a href="#">Save Order</a></li>
                        </ol>
                    </div>
                </div>
       		<div class="row">
       		<div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Purchase Order</h4>
                            </div>
                            <div class="card-body">
                        <?php
                     
                        if(isset($_SESSION["bproducts"]) && count($_SESSION["bproducts"])>0){
                            // update the restock order
                            $store = $_POST['store'];
                            $supplier=$_POST['supplier'];
                            $date=$_POST['deliverydate'];
                            $restock_id=$_POST['restockorder'];
                            $change = mysqli_query($con,"UPDATE restockorders SET store_id='$store',supplier_id='$supplier',deliver_date='$date' WHERE restockorder_id='$restock_id'") or die(mysqli_error($con));
                           
                foreach($_SESSION["bproducts"] as $product){ //loop though items and prepare html content
                //set variables to use them in HTML content below              
                    $menuitem = $product["menuitem"]; 
                    $item_id = $product["item"];
                    $product_qty = $product["quantity"];
                    $type = $product['type'];
                    $stockitem = isset ($product['stockitem_id']) ? $product['stockitem_id']: '';
                    if ($supplier==0){
                        $price=$product['unitprice'];
                    }else{
                       $supplieritems=  mysqli_query($con, "SELECT * FROM supplierproducts WHERE status=1 AND supplier_id='$supplier' AND product_id='$item_id'") or die(mysqli_error($con));
                         $rows=  mysqli_fetch_array($supplieritems);                       
                        $price=$rows['price'];
                    }
                    // check if restockitems id exists 
                    // $check = mysqli_query($con,"SELECT * FROM restockitems WHERE restockorder_id='$restock_id' AND product_id='$item_id'") or die(mysqli_error($con));
                    if ($stockitem == ''){
                        mysqli_query($con,"INSERT INTO restockitems(restockorder_id,product_id,type,quantity,unitcharge,status) VALUES('$restock_id','$item_id','$type','$product_qty','$price',1)") or die(mysqli_error($con));                    
                    }
                }
                unset($_SESSION["bproducts"]);   
}
                        ?>
                                <div class="alert alert-success">Purchase Order Successfully Updated.Click <strong><a href="stockorders">Here</a></strong> to view orders</div>
                  </div>
                </div>    
               
              </div>
          
            </div>
            </div>
   
              </div>
              </div>
        
       <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="vendor/apexchart/apexchart.js"></script>
    
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
</body>

</html>
<?php }?>