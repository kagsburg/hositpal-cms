    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
       $cat=$_GET['cat'];
             if(isset($_POST['subcategory'])){
                       $subcategory=mysqli_real_escape_string($con,trim($_POST['subcategory']));
                       if(empty($subcategory)){
                           $errors[]='Sub Category Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM subcategories WHERE subcategory='$subcategory' AND status=1 AND category_id='$cat' AND subcategoryid!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Sub Category Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{                         
                           mysqli_query($con,"UPDATE  subcategories SET subcategory='$subcategory' WHERE subcategory_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>