    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                      if(isset($_POST['classname'])){
                       $classname=mysqli_real_escape_string($con,trim($_POST['classname']));
                       if(empty($classname)){
                           $errors[]='Class Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM pharmacologicalclasses WHERE  pharmacologicalclass='$classname' AND status=1 AND pharmacologicalclass_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Class Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE  pharmacologicalclasses SET pharmacologicalclass='$classname' WHERE pharmacologicalclass_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>