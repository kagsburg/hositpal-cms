    <?php
   include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
       $ty=$_GET['ty'];
                         if(isset($_POST['exam'],$_POST['siunit'],$_POST['usuallyvalue'],$_POST['category'])){
                             $exam= mysqli_real_escape_string($con,trim($_POST['exam']));
                             $usuallyvalue= mysqli_real_escape_string($con,trim($_POST['usuallyvalue']));
                             $siunit=$_POST['siunit'];
                             $category=$_POST['category'];
                                if(empty($_POST['exam'])){
                                    echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                }else{                                                                          
              mysqli_query($con,"UPDATE exams SET exam='$exam',siunit='$siunit',category_id='$category',usuallyvalue='$usuallyvalue' WHERE exam_id='$id'") or die(mysqli_error($con));
              header('Location:examcategories?id='.$ty.'#exams');
                                 }
                            }
                      } 
                          ?>