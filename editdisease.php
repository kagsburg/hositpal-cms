    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
               if(isset($_POST['codename'],$_POST['codenumber'])){
                       $codename=mysqli_real_escape_string($con,trim($_POST['codename']));
                       $codenumber=mysqli_real_escape_string($con,trim($_POST['codenumber']));
                       if((empty($codename))||(empty($codenumber))){
                           $errors[]='All Fields Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM diseases WHERE codenumber='$codenumber' AND status=1 AND disease_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Disease Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE diseases SET codenumber='$codenumber',codename='$codename' WHERE disease_id='$id'") or die(mysqli_error($con));
                  header('Location:'.$_SERVER['HTTP_REFERER']);   
                      }
                      } 
                      } 
                                    ?>