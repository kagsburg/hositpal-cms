    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                      if(isset($_POST['department'])){
                       $department=  mysqli_real_escape_string($con,trim($_POST['department']));
                       if(empty($department)){
                           $errors[]='Department Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM departments WHERE department='$department' AND status=1 AND department_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Department Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE  departments SET department='$department' WHERE department_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>