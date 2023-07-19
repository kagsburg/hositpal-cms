    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                 if(isset($_POST['formname'])){
                       $formname=mysqli_real_escape_string($con,trim($_POST['formname']));
                       if(empty($formname)){
                           $errors[]='Form Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE  pharmaceuticalform='$formname' AND status=1 AND pharmaceuticalform_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Form Name Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{                       
                           mysqli_query($con,"UPDATE  pharmaceuticalforms SET pharmaceuticalform='$formname' WHERE pharmaceuticalform_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>