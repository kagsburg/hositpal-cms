<?php
include 'includes/conn.php';
include 'utils/bills.php';
 if(($_SESSION['elcthospitallevel']!='receptionist')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$change=  mysqli_query($con,"UPDATE admissions SET status='2',dischargedate=UNIX_TIMESTAMP() WHERE admission_id='$id'") or die(mysqli_error($con));
#get the patient id
$patientid=  mysqli_query($con,"SELECT patient_id FROM admissions WHERE admission_id='$id'") or die(mysqli_error($con));
$row = mysqli_fetch_array($patientid);
#get the patient invoice
$bill=get_bill_by_patient_only($pdo, $row['patient_id'], 2);
#set all invoice items to archived 
foreach ($bill as $key => $value) {
    $billid=$value['bill_id'];
    $archive=  mysqli_query($con,"UPDATE bills SET status='4' WHERE bill_id='$billid'") or die(mysqli_error($con));
}
header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>