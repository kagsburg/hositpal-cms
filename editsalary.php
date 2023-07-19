    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                       if(isset($_POST['salary'])){
                       $salary=  mysqli_real_escape_string($con,trim($_POST['salary']));
                       if(empty($salary)){
                           $errors[]='Salary Name Required';
                       }
                       $check=  mysqli_query($con,"SELECT * FROM salaries WHERE salary='$salary' AND status=1 AND salary_id!='$id'");
                       if(mysqli_num_rows($check)>0){
                           $errors[]='Salary Already Added';    
                       }
                       if(!empty($errors)){
                       foreach ($errors as $error){
                       echo '<div class="alert alert-danger">'.$error.'</div>';
                       }
                       }else{              
                           mysqli_query($con,"UPDATE  salaries SET salary='$salary' WHERE salary_id='$id'") or die(mysqli_error($con));
 header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>