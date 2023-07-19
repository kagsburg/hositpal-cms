    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                if(isset($_POST['tradename'],$_POST['genericname'],$_POST['minimum'],$_POST['unitprice'],$_POST['unitmeasurement'])){
     $tradename=mysqli_real_escape_string($con,trim($_POST['tradename']));
     $genericname=mysqli_real_escape_string($con,trim($_POST['genericname']));
     $minimum=$_POST['minimum']; 
     $subcategory=$_POST['subcategory']; 
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
         $addemployee=  mysqli_query($con,"UPDATE inventoryitems SET genericname='$genericname',tradename='$tradename',subcategory_id='$subcategory',unitprice='$unitprice',measurement_id='$unitmeasurement',minimum='$minimum' WHERE inventoryitem_id='$id'");
   header('Location:'.$_SERVER['HTTP_REFERER']);          
                 }
                                }
                                }
                                    ?>