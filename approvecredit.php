<?php
include 'includes/conn.php';
include 'utils/services.php';
include 'utils/bills.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
   header('Location:login.php');
} else {
   $id = $_GET['id'];
   // $change=  mysqli_query($con,"UPDATE patients SET status='0' WHERE patient_id='$id'") or die(mysqli_error($con));
   mysqli_query($con, "UPDATE paymethod SET status='1' WHERE paymethod_id='" . $id . "'") or die(mysqli_error($con));
   
   // $paymenttype = 'credit';
   // $insurancecompany = null;
   // // get patient from paymethod
   // $stmt = $pdo->prepare("SELECT * FROM paymethod WHERE paymethod_id=?");
   // $stmt->execute([$id]);
   // $getpatient = $stmt->fetch();
   // $patient = $getpatient['patient_id'];
   
   // $service = get_registration_service($pdo);
   // $registration_bill = get_bill_by_type_and_patient($pdo, "unselective", $service['id'], $patient, 1);
   // if (!empty($registration_bill)) {
   //    $service_charge = get_service_charge($pdo, $service['id'], $paymenttype, $insurancecompany, 2);
   //    update_bill($pdo, $registration_bill['bill_id'], [
   //       "payment_method" => $service_charge['payment_type'],
   //       "amount" => $service_charge['charge'],
   //    ]);
   // }

   header('Location:' . $_SERVER['HTTP_REFERER']);
}
