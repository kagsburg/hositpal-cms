    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                      if(isset($_POST['examtype'])){
                       $examtype=  mysqli_real_escape_string($con,trim($_POST['examtype']));
                       if(empty($examtype)){
                           $errors[]='Exam Type Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM examtypes WHERE examtype='$examtype' AND status=1 AND examtype_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Exam Type Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE  examtypes SET examtype='$examtype' WHERE examtype_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>