    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                   if(isset($_POST['classification'])){
                                if(empty($_POST['classification'])){
                                    echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                }else{
                               $classification=mysqli_real_escape_string($con,trim($_POST['classification']));
                                                          
              mysqli_query($con,"UPDATE classifications SET classification='$classification' WHERE classification_id='$id'") or die(mysqli_error($con));
              header('Location:'.$_SERVER['HTTP_REFERER']);
                      }
                      } 
                      } 
                          ?>