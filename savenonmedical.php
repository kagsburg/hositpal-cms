<?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
     $sub=$_GET['sub'];
?>
<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
<?php
   if(isset($_POST['tradename'],$_POST['minimum'],$_POST['unitprice'],$_POST['unitmeasurement'])){
     $tradename=mysqli_real_escape_string($con,trim($_POST['tradename']));
     $minimum=$_POST['minimum']; 
    $unitprice=$_POST['unitprice']; 
        $unitmeasurement=$_POST['unitmeasurement']; 
 if((is_numeric($minimum)==FALSE)||((is_numeric($unitprice)==FALSE))){
     $errors[]='Minimum Value or Unit Price should be Numeric';   
 }
if(!empty($errors)){
foreach($errors as $error){ 
 ?>
 <div class="alert alert-danger"><?php echo $error; ?></div>
<?php 
}         }else{                    
             $addemployee=  mysqli_query($con,"INSERT INTO inventoryitems(genericname,tradename,measurement_id,minimum,unitprice,subcategory_id,timestamp,status) VALUES('','$tradename','$unitmeasurement','$minimum','$unitprice','$sub','$timenow','1')") or die(mysqli_error($con));
      echo '<div class="col-lg-8"><div class="alert alert-success">Inventory Item successfully Added. Click <a href="nonmedical">here</a> to View items</div></div>';                
                 }
           }
                           
   }
?>