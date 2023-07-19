    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
            if(isset($_POST['category'],$_POST['code'])){
                       $category=  mysqli_real_escape_string($con,trim($_POST['category']));
                       $code=  mysqli_real_escape_string($con,trim($_POST['code']));
                       if(empty($category)){
                           $errors[]='Category Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM servicecategories WHERE servicecategory='$category' AND status=1 AND servicecategory_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Category Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{                
                           mysqli_query($con,"UPDATE  servicecategories SET servicecategory='$category',code='$code' WHERE servicecategory_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>