    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                        if(isset($_POST['wardtype'])){
                       $wardtype=mysqli_real_escape_string($con,trim($_POST['wardtype']));
                       if(empty($wardtype)){
                           $errors[]='ward type Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM wardtypes WHERE wardtype='$wardtype' AND status=1 AND wardtype_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Ward type Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE  wardtypes SET wardtype='$wardtype' WHERE wardtype_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>