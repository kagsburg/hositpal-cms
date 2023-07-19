<?php
include 'includes/conn.php';
include 'utils/patients.php';
if (($_SESSION['elcthospitallevel'] != 'receptionist')) {
    header('Location:login.php');
} else {
    $patient_id = $_GET['id'];
    $nurse = "1";
    $employee = $_SESSION['elcthospitaladmin'];
    // $errors = [];
    if (empty($patient_id)) {
        $errors[] = 'Please select a patient';
    }
    if (empty($nurse)) {
        $errors[] = 'Please select a nurse';
    }
    if (!empty($errors)) {
        foreach ($errors as $error) {
?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
<?php
        }
    } else {
        create_registration_request($pdo, $patient_id, $nurse, $employee);
    }
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
