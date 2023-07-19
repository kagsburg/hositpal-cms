    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                         if(isset($_POST['company'])){
                       $company=  mysqli_real_escape_string($con,trim($_POST['company']));
                       if(empty($company)){
                           $errors[]='Company Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM insurancecompanies WHERE company='$company' AND status=1 AND insurancecompany_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Company Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                         mysqli_query($con,"UPDATE insurancecompanies SET company='$company' WHERE insurancecompany_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>