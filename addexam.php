    <?php
   include 'includes/conn.php';
 if(($_SESSION['elcthospitallevel']!='admin')){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                         if(isset($_POST['exam'],$_POST['siunit'],$_POST['usuallyvalue'],$_POST['category'])){
                             $exam= mysqli_real_escape_string($con,trim($_POST['exam']));
                             $usuallyvalue= mysqli_real_escape_string($con,trim($_POST['usuallyvalue']));
                             $siunit=$_POST['siunit'];
                             $category=$_POST['category'];
                                if(empty($_POST['exam'])){
                                    echo '  <div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                }else{                                                                          
              mysqli_query($con,"INSERT INTO exams(exam,siunit,examtype_id,category_id,usuallyvalue,status) VALUES('$exam','$siunit','$id','$category','$usuallyvalue','1')") or die(mysqli_error($con));
              header('Location:examcategories?id='.$id.'#exams');
                                 }
                            }
                      } 
                          ?>