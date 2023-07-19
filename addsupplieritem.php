    <?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login');
        }else{
       $id=$_GET['id'];
                   if(isset($_POST['price'],$_POST['product'])){
                    $product=mysqli_real_escape_string($con,trim($_POST['product']));                  
                    $price=mysqli_real_escape_string($con,trim($_POST['price']));                  
                                
     if((empty($price))||(empty($product))){
         $errors[]='Some Fields marked * are Empty';
     }
                      if(!empty($errors)){
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-danger">'.$error.'</div>';              
                          }
                      }else{                 
                     mysqli_query($con,"INSERT INTO supplierproducts(product_id,price,supplier_id,status) VALUES('$product','$price','$id',1)");
                     }
                      }  
  header('Location:'.$_SERVER['HTTP_REFERER']);
      }
                          ?>