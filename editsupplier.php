    <?php
include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login');
        }else{
       $id=$_GET['id'];
                   if(isset($_POST['suppliername'],$_POST['address'],$_POST['phone'],$_POST['email'])){
                    $suppliername=mysqli_real_escape_string($con,trim($_POST['suppliername']));
                    $address=mysqli_real_escape_string($con,trim($_POST['address']));
                    $phone=mysqli_real_escape_string($con,trim($_POST['phone']));
                  $email=  mysqli_real_escape_string($con,trim($_POST['email']));    
                                
     if((empty($suppliername))||(empty($address))||(empty($phone))){
         $errors[]='Some Fields marked * are Empty';
     }
                      if(!empty($errors)){
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-danger">'.$error.'</div>';              
                          }
                      }else{                 
                      mysqli_query($con,"UPDATE suppliers SET suppliername='$suppliername',address='$address',phone='$phone',email='$email' WHERE supplier_id='$id'") or die(mysqli_error($con));
                      
                      }
                      }  
  header('Location:'.$_SERVER['HTTP_REFERER']);
      }
                          ?>