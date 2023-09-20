<?php
include 'includes/conn.php';
include 'utils/bills.php';
 if(($_SESSION['elcthospitallevel']!='receptionist')){
header('Location:login.php');
   }else{
$id=$_GET['id'];
$admitted=$_GET['admitted'];
$change=  mysqli_query($con,"UPDATE admissions SET status='2',dischargedate=UNIX_TIMESTAMP() WHERE admission_id='$id'") or die(mysqli_error($con));
#get the patient id
$patientid=  mysqli_query($con,"SELECT patient_id FROM admissions WHERE admission_id='$id'") or die(mysqli_error($con));
$row = mysqli_fetch_array($patientid);
$pat=$row['patient_id'];
$getpatientque = mysqli_query($con,"SELECT * FROM `patientsque`WHERE admission_id='$id'AND (room='doctor' or room='nurse' or room='clinic') and payment='1' and admintype='receptionist' and prev_id is null ") or die(mysqli_error($con));
$row = mysqli_fetch_array($getpatientque);
$queid=$row['patientsque_id'];
// add patient to patient history
$addtohistory = mysqli_query($con,"INSERT INTO patienthistory (admission_id,patient_id,patientque_id,admitted_id,status,timestamp,admin_id) VALUES ('$id','$pat','$queid','$admitted','1',UNIX_TIMESTAMP(),'" . $_SESSION['elcthospitaladmin'] . "')") or die(mysqli_error($con));
// update patient status 
// $changepatient = mysqli_query($con,"UPDATE patients SET level='4' WHERE patient_id='$pat'") or die(mysqli_error($con));
#get the patient invoice
$bill=get_bill_by_patient_only($pdo, $pat, 2);
#set all invoice items to archived 
foreach ($bill as $key => $value) {
    $billid=$value['bill_id'];
    $archive=  mysqli_query($con,"UPDATE bills SET status='4' WHERE bill_id='$billid'") or die(mysqli_error($con));
}
$change=  mysqli_query($con,"UPDATE admitted SET status='2'WHERE admitted_id='$admitted'") or die(mysqli_error($con));

header('Location:'.$_SERVER['HTTP_REFERER']);
   }
?>