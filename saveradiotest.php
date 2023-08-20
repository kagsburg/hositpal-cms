<?php
    include 'includes/conn.php';
    if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }else{
    if(isset($_POST['submitreport'])){
        $month=date('F',$timenow);
       $year=date('Y',$timenow);
       $exitmode="";
       $destination="";
       $reason= "Radiology Report";           
       $results= mysqli_real_escape_string($con,trim($_POST['test']));   
       $clinic= mysqli_real_escape_string($con,trim($_POST['clinic']));   
       $id= mysqli_real_escape_string($con,trim($_POST['id']));   
       $radioorder_id= mysqli_real_escape_string($con,trim($_POST['radioorder_id']));
       $start= mysqli_real_escape_string($con,trim($_POST['start']));
         $end= mysqli_real_escape_string($con,trim($_POST['end']));

       $count = $_POST['count'];   
       if ($count == 1) {
       $conclusion= mysqli_real_escape_string($con,trim($_POST['conclusion'])); 
       }     
       $description=mysqli_real_escape_string($con,trim($_POST['description']));
  
     $responsible= "";  
if((empty($month))||(empty($year))){
  $errors[]='Some Fields are empty';
}
if(!empty($errors)){
foreach ($errors as $error) {
echo '<div class="alert alert-danger">'.$error.'</div>';
 }
 exit();
}else{



foreach($_FILES as $val){
    $allowed_ext=array('jpg','jpeg','png','gif','');  
    $image_name=$val['name'];
   $image_size=$val['size'];
   $image_temp=$val['tmp_name'];  
foreach($image_name as $key22 => $val_image){
    $ext=explode('.',$val_image);
    $image_ext=  strtolower(end($ext));
    $errors=array();
    if (in_array($image_ext,$allowed_ext)===false){
    $errors[]='File type not allowed';
    }
    $img_size = $image_size[$key22];
    if($img_size>10097152){
    $errors[]='Maximum size is 10Mb';
    }
    if(!empty($errors)){
        foreach($errors as $error){ 
        echo ' <div class="alert alert-danger" role="alert">'.$error.'
            </div>';
        }
        exit();
        }
}   

}
           
   mysqli_query($con, "INSERT INTO radiologyreports(patientsque_id,month,year,reason,clinic,description,start,end,results,conclusion,responsible,exitmode,destination,admin_id,timestamp,status) 
   VALUES('$id','$month','$year','$reason','$clinic','$description','$start','$end','$results','$conclusion','$responsible','$exitmode','$destination','".$_SESSION['elcthospitaladmin']."',UNIX_TIMESTAMP(),1)") or die(mysqli_error($con));
   $last_id= mysqli_insert_id($con);
//    update radio order 
    mysqli_query($con,"UPDATE patientradios set status='3' WHERE patientradio_id='$radioorder_id'") or die(mysqli_error($con));
   // Insert image content into database 
   foreach($_FILES as $val){
    $allowed_ext=array('jpg','jpeg','png','gif','');  
    $image_name=$val['name'];
   $image_size=$val['size'];
   $image_temp=$val['tmp_name']; 
  foreach ($image_name as $key23 => $val_image) {
   $ext=explode('.',$val_image);
   $image_ext=  strtolower(end($ext));
   mysqli_query($con, "INSERT INTO radiologyimages(radiology_report_id,image,status) VALUES('$last_id','$image_ext','1')") or die(mysqli_error($con)); 
   // get last created Id 
   $img_temp = $image_temp[$key23];
   $last_id_img = mysqli_insert_id($con);  
   $image_file1=md5($last_id_img).'.'.$image_ext;
   move_uploaded_file($img_temp,'./images/radiology/'.$image_file1);
   // mysqli_query($con, "UPDATE radiologyimages SET image='$image_file1' WHERE radiology_image_id='$last_id_img'") or die(mysqli_error($con));
   }
}
// 
if ($count == 1){
    // update conclusion
    mysqli_query($con,"UPDATE radiolodyreporttitle set conclusion='$conclusion' WHERE reporttitle='" . $_SESSION['reporttit_id'] . "'") or die(mysqli_error($con));
    unset($_SESSION['reporttit_id']);
    $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
       $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
       $prev_admin_id=$row_prev_admin_id['admin_id'];
       $prev_id = $row_prev_admin_id['prev_id'];
       mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
       $_SESSION['success'] = '<div class="alert alert-success">Radiology Report Successfully Added</div>';
       mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','radiographer',UNIX_TIMESTAMP(),1,'$prev_id')") or die(mysqli_error($con));
                // redirect to radiowaiting
                echo '<script>window.location.href = "radiowaiting.php";</script>';exit();

}

// get previous id admin id 
//     $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$id'") or die(mysqli_error($con));
//        $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
//        $prev_admin_id=$row_prev_admin_id['admin_id'];
//        mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
//    mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','radiographer',UNIX_TIMESTAMP(),1,'$id')") or die(mysqli_error($con));
//    $_SESSION['success'] = '<div class="alert alert-success">Radiology Report Successfully Added</div>';
//                // redirect to radiowaiting
//                echo '<script>window.location.href = "radiowaiting.php";</script>';exit();
}             
header('Location:'.$_SERVER['HTTP_REFERER']);
}                

 
                      } 
                          ?>