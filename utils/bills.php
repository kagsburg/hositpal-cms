<?php 

function get_all_bills(PDO $conn, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE status=?");
    $stmt->execute([$status]);
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}
function get_all_bills_group_patient(PDO $conn, $status=1)
{
    if ($status == 1){
        $stmt = $conn->prepare("SELECT * FROM bills WHERE status in (1,8) GROUP BY patient_id");
        $stmt->execute();
    }else{
        $stmt = $conn->prepare("SELECT * FROM bills WHERE status=? GROUP BY patient_id");
        $stmt->execute([$status]);
    }
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}
function get_active_clinic_patient(PDO $conn, $status)
{
    $stmt = $conn->prepare("SELECT * FROM clinic_clients WHERE clinic_cl_id =? ");
    $stmt->execute([$status]);
    $getpatient = $stmt->fetch();
    if (empty($getpatient)) return null;
    $getpatient["pin"] = str_pad($status, 4, '0', STR_PAD_LEFT);
    return $getpatient;
}
function update_clinic_patient(PDO $conn, $clinic_id, $name, $weight, $bloodgroup, $pregnancy_month, $dob, $phone, $partner_name, $partner_no, $location)
{
    $stmt = $conn->prepare("UPDATE clinic_clients SET name=?,location=?,dob=?,phone=?,weight=?,bloodgroup=?,pregnancy_month=?,partner_name=?,partner_mobile=? WHERE clinic_cl_id=?");
    $stmt->execute([$name, $location,$dob,$phone,$weight,$bloodgroup,$pregnancy_month,$partner_name,$partner_no,$clinic_id]);
    return $stmt->rowCount();
}
function get_all_bill_group_patient_accountant(PDO $conn,$payment_method)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE status IN (1,8) and payment_method=? GROUP BY patient_id");
    $stmt->execute([$payment_method]);
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}
function get_all_bills_group_patient_only_cash(PDO $conn, $status=1){
    $stmt = $conn->prepare("SELECT * FROM bills WHERE status=? AND (payment_method='cash' OR payment_method='insurance') GROUP BY patient_id");
    $stmt->execute([$status]);
    $getallbills = $stmt->fetchAll();
    // get patient's insurance id 
    foreach ($getallbills as $key => $value) {
        $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id=?");
        $stmt->execute([$value['patient_id']]);
        $getpatient = $stmt->fetch();
        if ($getpatient['insurancecompany'] != null){
            $stmt = $conn->prepare("SELECT * FROM insurance_companies WHERE insurance_id=?");
            $stmt->execute([$getpatient['insurancecompany']]);
            $getinsurance = $stmt->fetch();
            $getallbills[$key]['plan'] = $getinsurance['plan'];
        }
        $getallbills[$key]['insurance_id'] = $getpatient['insurancecompany'];
    }
    return $getallbills;
}

function get_all_payments(PDO $conn, $payment_method=null)
{
    if ($payment_method) {
        $stmt = $conn->prepare("SELECT * FROM bill_payments WHERE payment_method=? ORDER BY bill_payment_id DESC");
        $stmt->execute([$payment_method]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM bill_payments ORDER BY bill_payment_id DESC");
        $stmt->execute();
    }
    $getallpayments = $stmt->fetchAll();
    return $getallpayments;
}
function get_all_payments_groupby_patient(PDO $conn,$payment_method=null){
    if ($payment_method) {
        $stmt = $conn->prepare("SELECT DISTINCT patient_id,bills.* FROM bills WHERE payment_method=? and status in (2) GROUP BY patient_id ORDER BY bill_id DESC");
        $stmt->execute([$payment_method]);
    } else{
        $stmt = $conn->prepare("SELECT DISTINCT patient_id,bills.* FROM bills WHERE status in (2) GROUP BY patient_id ORDER BY bill_id DESC");
        $stmt->execute();
    }
    $getallpayments = $stmt->fetchAll();
    return $getallpayments;
}
function get_all_bills_patient(PDO $conn, $patient_id,$payment_method){
    $stmt = $conn->prepare("SELECT * from bills where patient_id=? and payment_method=? and status in (2)");
    $stmt->execute([$patient_id,$payment_method]);
    $getallbills = $stmt->fetchAll();
    foreach ($getallbills as $key => $value) {
        $stmt = $conn->prepare("SELECT * FROM bill_payments WHERE bill_id=? and payment_method=?");
        $stmt->execute([$value['bill_id'],$payment_method]);
        $getpayment = $stmt->fetch();
        $getallbills[$key]['payment'] = $getpayment;
    }
    return $getallbills;
}
function get_all_bills_by_patient(PDO $conn, $patient_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND status=?");
    $stmt->execute([$patient_id, $status]);
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}

function has_bill(PDO $conn, $patient_id, $type, $type_id, $status=null)
{
    $statusql = is_null($status) ? "" : " AND status='?'";
    $args = [$patient_id, $type, $type_id];
    if (!is_null($status)) $args[] = $status;
    $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND type=? AND type_id=? $statusql");
    $stmt->execute($args);
    $getbill = $stmt->fetch();
    if ($getbill) return true;
    else return false;
}

function get_all_bills_by_admission(PDO $conn, $admission_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE admission_id=? AND status=?");
    $stmt->execute([$admission_id, $status]);
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}

function get_admission_bills_for_paymethod(PDO $conn, $admission_id, $payment_method)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE admission_id=? AND status IN (1,2) AND payment_method=?");
    $stmt->execute([$admission_id, $payment_method]);
    $getallbills = $stmt->fetchAll();
    return $getallbills;
}

function   get_bill_by_id(PDO $conn, $bill_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE bill_id=? AND status=?");
    $stmt->execute([$bill_id, $status]);
    $getbill = $stmt->fetch();
    return $getbill;
} 

function get_bill_by_patient_only(PDO $conn, $patient_id,$admission_id=null, $status=1)
{
    if ($status == 1){
        if ($admission_id == null){
            $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND status IN (1)");
            $stmt->execute([$patient_id]);
    }else{
        $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND admission_id=? AND status IN (1,8)");
            $stmt->execute([$patient_id,$admission_id]);
    }
    }else{
        if ($admission_id == null){
            $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND status=?");
            $stmt->execute([$patient_id, $status]);
        }else{
            $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=?AND admission_id=? AND status IN (2,8)");
            $stmt->execute([$patient_id,$admission_id]);
        }
    }
    $getbill = $stmt->fetchAll();
    return $getbill;
}
function get_bill_by_patient(PDO $conn, $patient_id){
    $stmt = $conn->prepare("SELECT * FROM bills WHERE patient_id=? AND status IN (1,8)");
    $stmt->execute([$patient_id]);
    $getbill = $stmt->fetchAll();
    return $getbill;
}

function get_bill_by_type_and_patient(PDO $conn, $type, $type_id, $patient_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM bills WHERE type=? AND type_id=? AND patient_id=? AND status=?");
    $stmt->execute([$type, $type_id, $patient_id, $status]);
    $getbill = $stmt->fetch();
    return $getbill;
}
//function to add inpatient admission bill
function create_bill_inpatient(PDO $conn, $patient_id, $admission_id, $queue_id,$type, $admitted_id, $payment_method="", $status=1)
{
    $amount = 0;
    // get bed charge and number of days 
    $stmt = $conn->prepare("SELECT * FROM admitted WHERE admission_id=? and status=3");
    $stmt->execute([$admission_id]);
    $getadmission = $stmt->fetch();
    $stmt = $conn->prepare("SELECT * FROM beds WHERE bed_id=?");
    $stmt->execute([$getadmission['bed_id']]);
    $getbed = $stmt->fetch();
    // get number of days
    $disb1 = date("Y-m-d", $getadmission['admissiondate']);
    $disb2 = date("Y-m-d", $getadmission['dischargedate']);
    $datetime1 = new DateTime($disb1);
    $datetime2 = new DateTime($disb2);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');
    $amount += ($getbed['bedfee'] * $days);
    $stmt = $conn->prepare("INSERT INTO bills (patient_id, admission_id, patientsque_id, type, type_id, amount, payment_method, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$patient_id, $admission_id, $queue_id, $type, $admitted_id, $amount, $payment_method, $status]);
    return $conn->lastInsertId();
}

// adding patientsque_id for backward compatibility
function create_bill(PDO $conn, $patient_id, $admission_id, $queue_id, $type, $type_id, $amount, $payment_method="", $status=1)
{
    $stmt = $conn->prepare("INSERT INTO bills (patient_id, admission_id, patientsque_id, type, type_id, amount, payment_method, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$patient_id, $admission_id, $queue_id, $type, $type_id, $amount, $payment_method, $status]);
    return $conn->lastInsertId();
}

function update_bill_amount(PDO $conn, $bill_id, $amount)
{
    $stmt = $conn->prepare("UPDATE bills SET amount=? WHERE bill_id=?");
    $stmt->execute([$amount, $bill_id]);
}

function update_bill(PDO $conn, $bill_id, $updates) {
    $set_clause = implode(',', array_map(function($col) { return "$col=?"; }, array_keys($updates)));
    $values = array_values($updates);
    array_push($values, $bill_id);
    $stmt = $conn->prepare("UPDATE bills SET $set_clause WHERE bill_id=?");
    $stmt->execute($values);
}

function update_bill_status(PDO $conn, $bill_id, $status, $payment_method=null)
{
    if ($payment_method) {
        $stmt = $conn->prepare("UPDATE bills SET status=?, payment_method=? WHERE bill_id=?");
        $stmt->execute([$status, $payment_method, $bill_id]);
    } else {
        $stmt = $conn->prepare("UPDATE bills SET status=? WHERE bill_id=?");
        $stmt->execute([$status, $bill_id]);
    }
}

function make_bill_payment(PDO $conn, $bill_id, $amount, $payment_method,$countbills,$patient_id, $totalservice,$admission)
{
    if ($countbills > 1){
        #get all bills amount 
        $bills = get_bill_by_patient_only($conn, $patient_id,$admission, 1);
        if ($totalservice >= $amount){
            foreach($bills as $bl){
                $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                $stmt->execute([$bl['bill_id'],$bl['amount'],$bl['payment_method']]);    
                update_bill_status($conn,$bl['bill_id'],2,$bl['payment_method']);       
            }   
        }else{
            foreach($bills as $bl){
                if ($totalservice >= $bl['amount']){
                    $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                    $stmt->execute([$bl['bill_id'],$bl['amount'],$bl['payment_method']]);    
                    update_bill_status($conn,$bl['bill_id'],2,$bl['payment_method']);       
                    $totalservice = $totalservice - $bl['amount'];
                }else{
                    $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                    $stmt->execute([$bl['bill_id'],$totalservice,$bl['payment_method']]);    
                    update_bill_status($conn,$bl['bill_id'],8,$bl['payment_method']);       
                    $totalservice = 0;
                }      
            }
        }

    }else{
        if ($totalservice >= $amount){
            $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
            $stmt->execute([$bill_id, $amount, $payment_method]);
            update_bill_status($conn, $bill_id, 2, $payment_method);
        }else{
            $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
            $stmt->execute([$bill_id, $totalservice, $payment_method]);
            update_bill_status($conn, $bill_id, 8, $payment_method);
        }  
    }
}
function make_bill_payment_accountant(PDO $conn, $bill_id, $amount,$total, $payment_method,$countbills,$patient_id){
    if ($countbills > 1){
        $bills = get_bill_by_patient($conn, $patient_id);
        if ($amount >= $total){
            foreach($bills as $bl){
                $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                $stmt->execute([$bl['bill_id'],$bl['amount'],$bl['payment_method']]);    
                update_bill_status($conn,$bl['bill_id'],2,$bl['payment_method']);       
            }
        }else{
            // pay the bill that covers the amount
            foreach($bills as $bl){
                if ($amount >= $bl['amount']){
                    $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                    $stmt->execute([$bl['bill_id'],$bl['amount'],$bl['payment_method']]);    
                    update_bill_status($conn,$bl['bill_id'],2,$bl['payment_method']);       
                    $amount = $amount - $bl['amount'];
                }else{
                    $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
                    $stmt->execute([$bl['bill_id'],$amount,$bl['payment_method']]);    
                    update_bill_status($conn,$bl['bill_id'],8,$bl['payment_method']);       
                    $amount = 0;
                }
            }       
        }

    }else{
        // check the provide amount covers the total bill
        if ($amount >= $total){
            $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
            $stmt->execute([$bill_id, $amount, $payment_method]);
            update_bill_status($conn, $bill_id, 2, $payment_method);
        }else{
            $stmt = $conn->prepare("INSERT INTO bill_payments (bill_id, amount, payment_method) VALUES (?, ?, ?)");
            $stmt->execute([$bill_id, $amount, $payment_method]);
            update_bill_status($conn, $bill_id, 8, $payment_method);
        }
    }

}
function clear_bill(PDO $conn,$patient_id)
{ 
    $bills =get_all_bills_by_patient($conn,$patient_id);
    foreach($bills as $bl ){
        $stmt = $conn->prepare("UPDATE bills SET status=5 WHERE bill_id=?");
        $stmt->execute([$bl['bill_id']]);
    }
    // remove patient admission
    $admstmt = $conn->prepare("UPDATE admissions set status=0 where patient_id =?");
    $admstmt->execute([$patient_id]);
}

// SQL to create bill and payment tables
// CREATE TABLE `bills` (
//   `bill_id` int(11) NOT NULL,
//   `patient_id` int(11) NOT NULL,
//   `admission_id` int(11),
//   `type` varchar(50) NOT NULL,
//   `type_id` int(11),
//   `amount` double NOT NULL,
//   `payment_method` varchar(50) DEFAULT NULL,
//   `status` int(11) NOT NULL DEFAULT 1,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
//   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

// CREATE TABLE `bill_payments` (
//   `bill_payment_id` int(11) NOT NULL,
//   `bill_id` int(11) NOT NULL,
//   `amount` double NOT NULL,
//   `payment_method` varchar(50) NOT NULL,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
//   `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

// ALTER TABLE `bills`
//   ADD PRIMARY KEY (`bill_id`);

// ALTER TABLE `bill_payments`
//   ADD PRIMARY KEY (`bill_payment_id`);

// ALTER TABLE `bills`
//   MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

// ALTER TABLE `bill_payments`
//   MODIFY `bill_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
