<?php 

function get_patient(PDO $conn, $patient_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id=? AND status=?");
    $stmt->execute([$patient_id, $status]);
    $getpatient = $stmt->fetch();
    if (empty($getpatient)) return null;
    $getpatient["insurance"] = $getpatient["insurancecompany"];
    $getpatient["id"] = $getpatient["patient_id"];
    $getpatient["fullname"] = $getpatient["firstname"] . " " . $getpatient["secondname"] . " " . $getpatient["thirdname"];
    $getpatient["pin"] = str_pad($patient_id, 4, '0', STR_PAD_LEFT);
    $getpatient["image"] = !empty($getpatient["ext"]) ? md5($getpatient["id"]) : "noimage.png";
    return $getpatient;
}

function get_active_patient(PDO $conn, $patient_id)
{
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id=? AND status IN ('1', '3')");
    $stmt->execute([$patient_id]);
    $getpatient = $stmt->fetch();
    $getpatient["fullname"] = $getpatient["firstname"] . " " . $getpatient["secondname"] . " " . $getpatient["thirdname"];
    $getpatient["pin"] = str_pad($patient_id, 4, '0', STR_PAD_LEFT);
    return $getpatient;
}

function get_payment_method(PDO $conn, $patient_id, $admission_id=null)
{
    $payment_type = null;
    if (!is_null($admission_id)) {
        // select from admissions
        $stmt = $conn->prepare("SELECT paymethod FROM admissions WHERE admission_id=?");
        $stmt->execute([$admission_id]);
        $getpay = $stmt->fetch();
        if ($getpay) {
            $payment_type = $getpay['paymethod'];
        }
    }
    if (is_null($payment_type)) {
        // select from paymethod
        $stmt = $conn->prepare("SELECT method FROM paymethod WHERE patient_id=? AND status='1'");
        $stmt->execute([$patient_id]);
        $getpay = $stmt->fetch();
        if ($getpay) {
            $payment_type = $getpay['method'];
        }
    }
    if (is_null($payment_type)) $payment_type = 'cash';
    return $payment_type;
}
function get_payment_methods(PDO $conn, $patient_id, $admission_id=null)
{
    $payment_types = [];
    if (!is_null($admission_id)){
        // select from admissions
        $stmt = $conn->prepare("SELECT paymethod FROM admissions WHERE admission_id=?");
        $stmt->execute([$admission_id]);
        $getpay = $stmt->fetchAll();
        if ($getpay) {
            foreach ($getpay as $pay) {
                $payment_types[] = $pay['paymethod'];
            }
        }
    }
    if (empty($payment_types)) {
        // select from paymethod
        $stmt = $conn->prepare("SELECT method FROM paymethod WHERE patient_id=? AND status='1'");
        $stmt->execute([$patient_id]);
        $getpay = $stmt->fetchAll();
        if ($getpay) {
            foreach ($getpay as $pay) {
                $payment_types[] = $pay['method'];
            }
        }
    }
    if (empty($payment_types)) $payment_types[] = 'cash';
    return $payment_types;
}

function get_last_admission(PDO $conn, $patient_id)
{
    $stmt = $conn->prepare("SELECT * FROM admissions WHERE patient_id=? ORDER BY admission_id DESC LIMIT 1");
    $stmt->execute([$patient_id]);
    $getadmission = $stmt->fetch();
    return $getadmission;
}

function get_admission(PDO $conn, $admission_id)
{
    $stmt = $conn->prepare("SELECT * FROM admissions WHERE admission_id=?");
    $stmt->execute([$admission_id]);
    $getadmission = $stmt->fetch();
    return $getadmission;
}

// a function to check if a patient has been admitted 
function is_admitted(PDO $conn, $patient_id)
{
    $stmt = $conn->prepare("SELECT * FROM admissions WHERE patient_id=? AND status='1'");
    $stmt->execute([$patient_id]);
    $getadmissions = $stmt->fetchAll();
    if (count($getadmissions) > 0) 
        return true;
    else
        return false;
}
function get_patient_insurance_plan(PDO $conn, $patient_id){
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id=?");
    $stmt->execute([$patient_id]);
    $getplan1 = $stmt->fetch();
    // get insurance 
    $stmt2= $conn->prepare("SELECT * FROM insurancecompanies where insurancecompany_id =?");
    $stmt2->execute([$getplan1['insurancecompany']]);
    $getplan=$stmt2->fetch();
    return $getplan;
}
function get_patient_credit_plan(PDO $conn, $patient_id){
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id=?");
    $stmt->execute([$patient_id]);
    $getplan1 = $stmt->fetch();
    // get insurance 
    $stmt2= $conn->prepare("SELECT * FROM creditclients where creditcompany_id =?");
    $stmt2->execute([$getplan1['creditclient']]);
    $getplan=$stmt2->fetch();
    return $getplan;
}
function get_all_patients(PDO $conn, $status=1, $order="desc")
{
    $stmt = $conn->prepare("SELECT * FROM patients WHERE status=? ORDER BY patient_id $order");
    $stmt->execute([$status]);
    while ($getpatient = $stmt->fetch()) {
        // if (!empty($getpatient)){
        $getpatient["fullname"] = $getpatient["firstname"] . " " . $getpatient["secondname"] . " " . $getpatient["thirdname"];
        $getpatient["pin"] = str_pad($getpatient["patient_id"], 4, '0', STR_PAD_LEFT);
        $getpatient["image"] = !empty($getpatient["ext"]) ? md5($getpatient["id"]) : "noimage.png";
        // }
        yield $getpatient;
    }
}

function update_patient_status(PDO $conn, $patient_id, $status)
{
    $stmt = $conn->prepare("UPDATE patients SET status=? WHERE patient_id=?");
    $stmt->execute([$status, $patient_id]);
}

function update_patient(PDO $conn, $patient_id, $updates)
{
    $set_clause = implode(',', array_map(function($col) { return "$col=?"; }, array_keys($updates)));
    $values = array_values($updates);
    array_push($values, $patient_id);
    $stmt = $conn->prepare("UPDATE patients SET $set_clause WHERE patient_id=?");
    $stmt->execute($values);
}


function get_pending_registrations_for_nurse(PDO $conn, $nurse_id)
{
    $stmt = $conn->prepare("SELECT * FROM registration_requests WHERE nurse=? AND status='1'");
    $stmt->execute([$nurse_id]);
    while ($getrequest = $stmt->fetch()) {
        $patient = get_patient($conn, $getrequest["patient_id"]);
        $getrequest["patient"] = $patient;
        yield $getrequest;
    }
}

function get_registration_request(PDO $conn, $request_id)
{
    $stmt = $conn->prepare("SELECT * FROM registration_requests WHERE id=?");
    $stmt->execute([$request_id]);
    $getrequest = $stmt->fetch();
    $patient = get_patient($conn, $getrequest["patient_id"]);
    $getrequest["patient"] = $patient;
    return $getrequest;
}

function create_registration_request(PDO $conn, $patient_id, $nurse_id, $employee_id)
{
    $stmt = $conn->prepare("INSERT INTO registration_requests(patient_id, nurse, employee, date) VALUES(?, ?, ?, ?)");
    $stmt->execute([$patient_id, $nurse_id, $employee_id, date("Y-m-d H:i:s")]);
    update_patient($conn, $patient_id, ["level" => 3]);
}

function clear_registration_request(PDO $conn, $request_id)
{
    $stmt = $conn->prepare("UPDATE registration_requests SET status='0' WHERE id=?");
    $stmt->execute([$request_id]);
}

// sql to create the registration_requests table
// CREATE TABLE `registration_requests` (
//     `id` int(11) NOT NULL,
//     `patient_id` int(11) NOT NULL,
//     `nurse` int(11) NOT NULL,
//     `employee` int(11) NOT NULL,
//     `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `status` int(11) NOT NULL DEFAULT '1'
//   ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

//   ALTER TABLE `registration_requests`
//   ADD PRIMARY KEY (`id`);

//   ALTER TABLE `registration_requests`
//   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

//   ALTER TABLE `registration_requests`
//   ADD CONSTRAINT `registration_requests_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
//   ADD CONSTRAINT `registration_requests_ibfk_2` FOREIGN KEY (`nurse`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
//   ADD CONSTRAINT `registration_requests_ibfk_3` FOREIGN KEY (`employee`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;


