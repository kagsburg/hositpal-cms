<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
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
    <title>Ambulant Invoice</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
	
</head>

      <style>
          body{font-size: 18px;color: #000;font-family: "Roboto", sans-serif}
     .table.table-bordered td, .table.table-bordered th {
    border-color: #000000;
}
.table td,.table th {
    color: #000;
    font-size: 18px;
}
.table th {
    font-weight: bold;
}
      </style>
</head>
<body>

        <div class="row">
        <div class="col-lg-12">        
          <div class="section-body">
            <div class="invoice">
              <?php 

if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
  include 'fr/ambulantinvoice.php';                     
  }else{
?>
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                         <img alt="image" src="<?php echo BASE_URL;?>/images/tanganyika.jpg"  width="100" />
                         <div class="row">                    	
                        <?php
                         $getorder= mysqli_query($con,"SELECT * FROM ambulantorders WHERE status=1 AND ambulantorder_id='$id'") or die(mysqli_error($con));
                     $row = mysqli_fetch_array($getorder);
                   $ambulantorder_id=$row['ambulantorder_id'];
                   $patientname=$row['patientname'];
                   $timestamp=$row['timestamp'];
                      if(strlen($ambulantorder_id)==1){
      $pin='000'.$ambulantorder_id;
     }
       if(strlen($ambulantorder_id)==2){
      $pin='00'.$ambulantorder_id;
     }
        if(strlen($ambulantorder_id)==3){
      $pin='0'.$ambulantorder_id;
     }
  if(strlen($ambulantorder_id)>=4){
      $pin=$ambulantorder_id;
     }         
                    ?>
                                           	
                    </div>
                   <h1 class="text-center"> <strong>PATIENT INVOICE</strong></h1>    
                    <hr>
                  
                    <div class="row">
                      <div class="col-sm-4">
                      	
		                    <strong>Billed To:</strong>
		      <address>
                                        <?php echo $patientname; ?><br>
                                    		        
		                         </address>
		                
                      </div>                    
                        <div class="col-sm-4"></div>
                         <div class="col-sm-4">
                             <table class="table table-bordered">
                                 <tbody>
                                     
                                     <tr>  <th>Date</th> <td><?php echo date('d M Y',$timestamp); ?></td>    </tr>
                             
                                     <tr>  <th>Invoice No</th> <td><?php echo $pin; ?></td>    </tr>
                                 </tbody>
                             </table>
		                
                      </div>                    
                  
                    </div>
                                      </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table  table-bordered">
                        <tr>
                             <th scope="col">ITEM</th>
                               <th scope="col">CP FIGURE</th>
                          <th scope="col">QUANTITY</th>                         
                          <th scope="col">RATE (BIF)</th>  
                          <th scope="col">SUB TOTAL (BIF)</th>  
                        </tr>
                     <?php
                     $total=0;
                     $subtotal=0;
                     $count=0;
                    $getproducts= mysqli_query($con,"SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$id' AND status=1");
                   while($row1= mysqli_fetch_array($getproducts)){
                   $ambulantordereditem_id=$row1['ambulantordereditem_id'];
                   $item_id=$row1['item_id'];
                   $quantity=$row1['quantity'];
                   $cpfigure=$row1['cpfigure'];
                   $unitprice=$row1['unitprice']; 
                  $subtotal=$quantity*$unitprice;
                  $total=$subtotal+$total;
                  $count=$count+1;
                  $getitem=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 AND pharmacyitem_id='$item_id'");  
                                     $row = mysqli_fetch_array($getitem);
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $dosage=$row['dosage'];
                               $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                        $getcats=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                          $row2=  mysqli_fetch_array($getcats);
                                          $pharmaceuticalform=$row2['pharmaceuticalform'];
              ?>
                        <tr>
                          <td><?php echo $commercialname.'( '.$pharmaceuticalform.')'; ?></td>
                               <td><?php echo $cpfigure; ?></td>
                               <td><?php echo $quantity; ?></td>
                             <td> <?php echo $unitprice; ?></td>
                             <td><?php echo number_format($subtotal); ?></td>
                        
                        </tr>
           <?php }
        
           
           ?>
                        <tr><td style="border:none">&nbsp;</td><td style="border:none">&nbsp;</td><td style="border:none">&nbsp;</td><th>TOTAL</th><td><?php echo number_format($total); ?></td></tr>
                        <tr>                      </table>
                    </div>
                      <p class="mt-4">@<?php echo date('Y',time())?>All Rights Reserved to Tanganyika Care</p>
                  </div>
                    
                </div><hr>
           
              </div>
                  <?php }
        
           
           ?>
            </div>
         
        </div>
        </div>
        </div>
        
 <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
<script src="vendor/apexchart/apexchart.js"></script>
        <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
	
 <script type="text/javascript">
        window.print();
    </script>
</body>

</html>