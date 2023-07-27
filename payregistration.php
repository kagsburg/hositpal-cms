<?php
include 'includes/conn.php';
include 'utils/services.php';
include 'utils/bills.php';
include 'utils/patients.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
} else {
    $patient_id = $_GET['id'];
    $paymentmethod = $_POST['paymentmethod'];
    if ($paymentmethod == ''){
        // $errors[] = 'Please select a payment method';
        $_SESSION['error'] = 'Please select a payment method';
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
    $patient = get_patient($pdo, $patient_id, 3);
    $insurance = $patient['insurancecompany'];
    $service = get_service_charge($pdo, REGISTRATION_SERVICE_ID, $paymentmethod, $insurance, '2');
    create_bill($pdo, $patient_id, null, null, 'unselective', $service["id"], $service["charge"], $service["payment_type"]);

    header('Location:' . $_SERVER['HTTP_REFERER']);
}
