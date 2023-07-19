    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                           if(isset($_POST['store'])){
                       $store=mysqli_real_escape_string($con,trim($_POST['store']));
                       if(empty($store)){
                           $errors[]='Store Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM stores WHERE store='$store' AND status=1 AND store_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Store Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{                       
                           mysqli_query($con,"UPDATE  stores SET store='$store' WHERE store_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>