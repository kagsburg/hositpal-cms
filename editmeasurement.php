    <?php
    include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                         if(isset($_POST['measurement'])){
                                if(empty($_POST['measurement'])){
                                    echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                }else{
                               $measurement=  mysqli_real_escape_string($con,trim($_POST['measurement']));                                                          
              mysqli_query($con,"UPDATE unitmeasurements SET measurement='$measurement' WHERE measurement_id='$id'") or die(mysqli_error($con));
              header('Location:'.$_SERVER['HTTP_REFERER']);
                                 }
                            }
                      } 
                          ?>