<?php
include 'includes/conn.php';
 if($_SESSION['elcthospitallevel']!='store manager'){
header('Location:login');
   }
 foreach($_SESSION["bproducts"] as $product){ //loop though items and prepare html content
             unset($_SESSION["bproducts"]);
 }
 header('Location:addorder');
			
?>
