    <?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login');
        }else{
       $id=$_GET['id'];
                   if(isset($_POST['price'])){
                    $price=mysqli_real_escape_string($con,trim($_POST['price']));                  
                                
     if(empty($price)){
         $errors[]='Some Fields marked * are Empty';
     }
                      if(!empty($errors)){
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-danger">'.$error.'</div>';              
                          }
                      }else{                 
                      mysqli_query($con,"UPDATE supplierproducts SET price='$price' WHERE supplierproduct_id='$id'") or die(mysqli_error($con));
                      
                      }
                      }  
  header('Location:'.$_SERVER['HTTP_REFERER']);
      }
                          ?>