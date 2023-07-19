<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Medical Items</title>
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
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/itemsprint.php';                     
                                       }else{
?>
     
        <div class="content-body" style="margin-left: 0px">
            <!-- row -->
			<div class="container-fluid">
	
       		<div class="row">
       		<div class="col-lg-12">
                
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Stock Items as of <?php echo date('d/M/Y',$timenow); ?></h4>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                                 <th>Id Number</th>
                                                 <th>Generic Name</th>
                                                 <th>Commercial Name</th>
                                                 <th>Unit of Measure</th>
                                                 <th>Pharmacological class</th>
                                                 <th>Pharmaceutical form</th>
                                                 <th>Dosage</th>
                                                 <th>Minimum Unit</th>
                                                 <th>Unit Price</th>
                                                 <th>In Stock</th>
                                                                                               
                                        </tr>
                                    </thead>
                                        <tbody>   
                                         <?php 
                                  $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ORDER BY commercialname");   
                                     while ($row = mysqli_fetch_array($getitems)) {
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $pharmacologicalclass_id=$row['pharmacologicalclass_id'];
                                          $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                          $dosage=$row['dosage'];
                                           $measurement_id=$row['measurement_id'];
                                           $minimum=$row['minimum'];
                                           $unitprice=$row['unitprice'];
                                          $getclass=  mysqli_query($con,"SELECT * FROM pharmacologicalclasses WHERE status=1 AND pharmacologicalclass_id='$pharmacologicalclass_id'");
                                           $row1=  mysqli_fetch_array($getclass);
                                           $pharmacologicalclass=$row1['pharmacologicalclass'];
                                  $getforms=mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                                    $row3=  mysqli_fetch_array($getforms);
                                    $pharmaceuticalform=$row3['pharmaceuticalform'];
                                       $getunit=  mysqli_query($con,"SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                            $row2=  mysqli_fetch_array($getunit);
                                 $measurement=$row2['measurement'];
                                   $getstock= mysqli_query($con, "SELECT SUM(quantity) as totalstock FROM stockitems WHERE product_id='$pharmacyitem_id'") or die(mysqli_error($con));
                     $row4= mysqli_fetch_array($getstock);
                     $totalstock=$row4['totalstock'];     
                     $totalordered=0;
                      $getordered= mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$pharmacyitem_id'") or die(mysqli_error($con));
                      while($row5= mysqli_fetch_array($getordered)){
                          $stockorder_id=$row5['stockorder_id'];
                          $quantity=$row5['quantity'];
                        $totalordered=$totalordered+$quantity;
                       }
                       $instock=$totalstock-$totalordered;
                           ?>
                                          <tr class="gradeA">                                                           
                                            <td><?php echo '#'.$pharmacyitem_id; ?></td>
                                            <td><?php echo $genericname; ?></td>
                                            <td><?php echo $commercialname; ?></td>
                                            <td><?php echo $measurement; ?></td>
                                            <td><?php echo $pharmacologicalclass; ?></td>
                                            <td><?php echo $pharmaceuticalform; ?></td>
                                            <td><?php echo $dosage; ?></td>
                                             <td><?php echo $minimum; ?></td>                                                                    
                                             <td><?php echo $unitprice; ?></td>   
                                             <td><?php echo $instock; ?></td>   
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
    
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
<script type="text/javascript">
        $('document').ready(function(){
                     window.print(); 
        });     
    </script>
</body>

</html>