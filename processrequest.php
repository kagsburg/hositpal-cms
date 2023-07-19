    <?php
    include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }else{
       $id=$_GET['id'];
                      if(isset($_POST['submit'])){
                       $quantity=$_POST['quantity'];
                       $orderitem=$_POST['orderitem'];
                       mysqli_query($con, "UPDATE stockorders SET status=1,approvedby='".$_SESSION['elcthospitaladmin']."'  WHERE stockorder_id='$id'");
                 $orderitems= sizeof($orderitem);
                 for($i=0;$i<$orderitems;$i++){
      mysqli_query($con,"UPDATE ordereditems SET issued='$quantity[$i]'  WHERE stockorder_id='$id' AND  ordereditem_id='$orderitem[$i]'") or die(mysqli_error($con));
header('Location:stockrequest?id='.$id.'&&st=1');
                      }
                      }
                      } 
                          ?>