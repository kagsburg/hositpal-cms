<?php

define('REGISTRATION_SERVICE_ID', '1363');

/**
 * Get a service by id
 *
 * @param PDO $conn
 * @param integer $status
 * @return array | null
 */
function get_service(PDO $conn, $service_id, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM medicalservices WHERE medicalservice_id=? AND status=?");
    $stmt->execute([$service_id, $status]);
    $getservice = $stmt->fetch();
    if ($getservice) {
        $getservice["id"] = $getservice["medicalservice_id"];
        $getservice["name"] = $getservice["medicalservice"];
    }
    return $getservice;
}

/**
 * Get the registration service
 *
 * @param PDO $conn
 * @param integer $status
 * @return array
 */
function get_registration_service(PDO $conn)
{
    return get_service($conn, REGISTRATION_SERVICE_ID, 2);
}

/**
 * Get a service charge
 *
 * @param PDO $conn
 * @param integer $service_id
 * @param string $payment_type
 * @param integer $insurance_id
 * @param integer $status
 * @return array
 */
function get_service_charge(PDO $conn, $service_id, $payment_type, $insurance_id=null, $status=1)
{
    $stmt = $conn->prepare("SELECT * FROM medicalservices WHERE medicalservice_id=? AND status=?");
    $stmt->execute([$service_id, $status]);
    $getservice = $stmt->fetch();
    $getservice["id"] = $getservice["medicalservice_id"];
    $getservice["charge"] = $getservice["charge"];
    $getservice["name"] = $getservice["medicalservice"];
    if ($payment_type == 'insurance') {
        $stmt = $conn->prepare("SELECT * FROM insuredservices WHERE status=1 AND insurancecompany_id=? AND medicalservice_id=?");
        $stmt->execute([$insurance_id, $service_id]);
        $getinsured = $stmt->fetch();
        if ($getinsured) {
            $getservice["charge"] = $getinsured["charge"];
        } else {
            $payment_type = 'cash';
        }
    } else if ($payment_type == 'credit') {
        $getservice["charge"] = $getservice["creditprice"];
    }
    $getservice["payment_type"] = $payment_type;
    return $getservice;
}