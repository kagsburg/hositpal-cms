<?php
include 'includes/conn.php';
include "utils/patients.php";
include 'utils/bills.php';
include 'utils/services.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['q'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Payment</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <style>
        .form-control:disabled {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <?php
        include 'includes/header.php';
        if ((isset($_SESSION['lan'])) && ($_SESSION['lan'] == 'fr')) {
            include 'fr/addpayment.php';
        } else {

        ?>

            <div class="content-body">
                <!-- row -->
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Add Payment</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="pendingpayments">Pending Payments</a></li>
                                <li class="breadcrumb-item active"><a href="#">Add Payment</a></li>
                            </ol>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Patient Bill Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        // $bill = get_bill_by_id($pdo, $id, 1);  
                                        $bill= get_bill_by_patient_only($pdo, $id, 1);  
                                                                        //   print_r($bill);
                                        // $getque = mysqli_query($con, "SELECT * FROM patientsque WHERE  patientsque_id='$id'");
                                        // $row = mysqli_fetch_array($getque);
                                        // $patientsque_id = $row['patientsque_id'];
                                        $patient_id = $bill[0]['patient_id'];
                                        $bill_id=$bill[0]['bill_id'];
                                        $admission_id = $bill[0]['admission_id'];
                                        $patientsque_id = $bill[0]['patientsque_id'];
                                        $type = $bill[0]['type'];
                                        // $amount = $bill['amount'];
                                        // $status = $bill['status'];
                                        $bill_type_id = $bill[0]['type_id'];
                                        $payment_method = $bill[0]['payment_method'];
                                        $clinic = $bill[0]['clinic'];

                                        
                                        $qpaymenttype = isset($payment_method) ? $payment_method: "cash" ;// get_payment_method($pdo, $patient_id, $admission_id);
                                        
                                        
                                        $room = $type;
                                       
                                       
                                        if ($clinic == 0){
                                            $row2 = get_active_patient($pdo, $patient_id);
                                            $fullname = $row2['fullname'];
                                            $pin = $row2['pin'];
                                            $gender = $row2['gender'];
                                            $paymenttype = $row2['paymenttype'];
                                            $policyidnumber = $row2['policyidnumber'];
                                            $insurance_id = $row2['insurancecompany'];  
                                            $creditclient = $row2['creditclient'];                                     
                                            if (!empty($creditclient)) {
                                                $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE creditclient_id='$creditclient'");
                                                $row = mysqli_fetch_array($getclients);
                                                $clientname = $row['clientname'];
                                            } else {
                                                $clientname = "N/A";
                                            }
                                             

                                        }
                                        else if ($clinic == 1){
                                            $row2 = get_active_clinic_patient($pdo, $patient_id);
                                            $fullname = $row2['name'];
                                            $pin = $row2['pin'];
                                        }
                                        
                                      
                                        //     $getactsreport= mysqli_query($con,"SELECT * FROM acts WHERE patientsque_id='$patientsque_id'");
                                        ?>

                                        <?php
                                        $total = 0;


                                        ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="3" class="bg-dark" style="color: #fff"><?php echo $fullname . ' (' . $pin . ')'; ?></th>
                                                </tr>
                                                <?php
                                                
                                                if ($room == "lab" || $room == "radiography") { ?>
                                                    <tr>
                                                        <th colspan="2">Room</th>
                                                        <th>Measure</th>
                                                        <th>Unit Charge</th>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <th colspan="2">Room</th>
                                                        <th>Service</th>
                                                        <th>Unit Charge</th>
                                                    </tr>
                                                <?php } ?>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                foreach($bill as $b) {
                                                    // print_r($b);
                                                    $type = $b['type'];
                                                    $bill_type_id = $b['type_id'];
                                                    $patientque_id = $b['patientsque_id'];
                                                    if ($patientque_id != 0){
                                                        $getroom = mysqli_query($con, "SELECT room from patientsque WHERE patientsque_id='$patientque_id'");
                                                        $row23 = mysqli_fetch_array($getroom);
                                                        $room = $row23['room'];
                                                    }else{
                                                        $room ='';
                                                    }

                                                   
                                                if ($type == "medical_service") {
                                                    $getorder = mysqli_query($con, "SELECT * FROM serviceorders WHERE serviceorder_id='$bill_type_id'");
                                                    $rowo = mysqli_fetch_array($getorder);
                                                    $timestamp = $rowo['timestamp'];
                                                    // $paymethod = $rowo['paymentmethod'];
                                                    $serviceorder_id = $rowo['serviceorder_id'];

                                                    $getordered = mysqli_query($con, "SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                    while ($row = mysqli_fetch_array($getordered)) {
                                                        $id2 = $row['patientservice_id'];
                                                        $medicalservice_id = $row['medicalservice_id'];
                                                        $unitcharge = $row['charge'];
                                                        $total = $total + $unitcharge;
                                                        $getservice = mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");
                                                        $row2 = mysqli_fetch_array($getservice);
                                                        $medicalservice = $row2['medicalservice'];

                                                ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="selectcheck" id="select<?php echo $id2; ?>" data-id="<?php echo $id2; ?>" name="service[]" value="<?php echo $id2; ?>_<?php echo $unitcharge ?>" ></td>
                                                            <td><?php echo $room; ?></td>
                                                            <td><?php echo $medicalservice; ?></td>
                                                            <td><?php echo $unitcharge; ?></td>
                                                        </tr>
                                                        <?php }
                                                } else if ($type == "lab") {
                                                    $getorder = mysqli_query($con, "SELECT * FROM laborders WHERE laborder_id='$bill_type_id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        // $paymethod = $rowo['paymentmethod'];
                                                        $serviceorder_id = $rowo['laborder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientlabs WHERE laborder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $id2 = $row['patientlab_id'];
                                                            $medicalservice_id = $row['investigationtype_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 AND investigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];

                                                        ?>
                                                            <tr>
                                                            <td><input type="checkbox" class="selectcheck" id="select<?php echo $id2; ?>" data-id="<?php echo $id2; ?>" name="service[]" value="<?php echo $id2; ?>_<?php echo $unitcharge ?>" ></td>
                                                                <td><?php echo $room; ?></td>
                                                                <td><?php echo $medicalservice; ?></td>
                                                                <td><?php echo $unitcharge; ?></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                } else if ($type == "radiography") {
                                                    $getorder = mysqli_query($con, "SELECT * FROM radioorders WHERE radioorder_id='$bill_type_id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        // $paymethod = $rowo['paymentmethod'];
                                                        $serviceorder_id = $rowo['radioorder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM patientradios WHERE radioorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $id2 = $row['patientradio_id'];
                                                            $medicalservice_id = $row['radioinvestigationtype_id'];
                                                            $unitcharge = $row['charge'];
                                                            $total = $total + $unitcharge;
                                                            $getservice = mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1 AND radioinvestigationtype_id='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['investigationtype'];

                                                        ?>
                                                            <tr>
                                                                <td><input type="checkbox" class="selectcheck" id="select<?php echo $id2; ?>" data-id="<?php echo $id2; ?>" name="service[]" value="<?php echo $id2; ?>_<?php echo $unitcharge ?>" ></td>
                                                                <td><?php echo $room; ?></td>
                                                                <td><?php echo $medicalservice; ?></td>
                                                                <td><?php echo $unitcharge; ?></td>
                                                            </tr>
                                                <?php }
                                                    }
                                                } else if ($type == "unselective") {
                                                    $service = get_service_charge($pdo, $bill_type_id, $qpaymenttype, $insurance_id, 2);
                                                    $medicalservice_id= $service['id'];
                                                    $medicalservice = $service['name'];
                                                    $unitcharge = $service['charge'];
                                                    $qpaymenttype = $service['payment_type'];
                                                    $total = $total + $unitcharge;
                                                    // $paymethod = $qpaymenttype;
                                                ?>
                                                    <tr>
                                                    <td><input type="checkbox" class="selectcheck" id="select<?php echo $medicalservice_id; ?>" data-id="<?php echo $medicalservice_id; ?>" name="service[]" value="<?php echo $medicalservice_id; ?>_<?php echo $unitcharge ?>" ></td>
                                                        <td><?php echo $room; ?></td>
                                                        <td><?php echo $medicalservice; ?></td>
                                                        <td><?php echo $unitcharge; ?></td>
                                                    </tr>
                                                <?php 
                                                } else if ($type == "admission"){
                                                    // get admission details
                                                    $getorder = mysqli_query($con, "SELECT * FROM admitted WHERE admitted_id='$bill_type_id'");
                                                    if (mysqli_num_rows( $getorder) > 0){
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        // print_r($rowo);
                                                        $bed = $rowo['bed_id'];
                                                        $price =$rowo['price'];
                                                        $total = $total + $price;
                                                        $bed_name = mysqli_query($con, "SELECT * FROM beds WHERE bed_id='$bed'");
                                                        $row2 = mysqli_fetch_array($bed_name);
                                                        $bed_no = $row2['bedname'];
                                                        $ward_id = $row2['ward_id'];
                                                        $ward_name = mysqli_query($con, "SELECT * FROM wards WHERE ward_id='$ward_id'");
                                                        $row3 = mysqli_fetch_array($ward_name);
                                                        $ward_no = $row3['wardname'];
                                                    
                                                ?>
                                                    <tr>
                                                        <td><?php echo $room; ?></td>
                                                        <td><?php echo $ward_no ."Ward Bed Number".$bed_no; ?></td>
                                                        <td><?php echo $price; ?></td>
                                                    </tr>
                                                <?php
                                                }}
                                                else if ($type == "pharmacy") {
                                                    $getorder = mysqli_query($con, "SELECT * FROM pharmacyorders WHERE pharmacyorder_id='$bill_type_id'");
                                                    if (mysqli_num_rows($getorder) > 0) {
                                                        $rowo = mysqli_fetch_array($getorder);
                                                        $timestamp = $rowo['timestamp'];
                                                        // $paymethod = $rowo['paymentmethod'];
                                                        $serviceorder_id = $rowo['pharmacyorder_id'];
                                                        $getordered = mysqli_query($con, "SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($getordered)) {
                                                            $id2 = $row['pharmacyordereditem_id'];
                                                            $medicalservice_id = $row['item_id'];
                                                            $quantity = $row['quantity'];
                                                            $stotal =0; 
                                                            $getservice = mysqli_query($con, "SELECT * FROM inventoryitems WHERE status=1 AND inventoryitem_id ='$medicalservice_id'");
                                                            $row2 = mysqli_fetch_array($getservice);
                                                            $medicalservice = $row2['itemname'];
                                                            $unitcharge = $row2['unitprice'];
                                                            $stotal =intval($unitcharge) * intval($quantity);
                                                            $total += $stotal;

                                                        ?>
                                                            <tr>
                                                                <td><input type="checkbox" class="selectcheck" id="select<?php echo $id2; ?>" data-id="<?php echo $id2; ?>" name="service[]" value="<?php echo $id2; ?>_<?php echo $stotal ?>" ></td>
                                                                <td><?php echo $room; ?></td>
                                                                <td><?php echo $medicalservice; ?></td>
                                                                <td><?php echo $stotal; ?></td>
                                                            </tr>
                                                <?php }}}
                                            }
                                                ?>
                                                <tr>
                                                    <th colspan="3">TOTAL</th>
                                                    <th><?php echo number_format($total); ?></th>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Services</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $bill_ = 0;
                                    if (isset($_POST['submit'])) {
                                        $paymentmethod = $qpaymenttype; //$_POST['paymentmethod'];
                                        $insurancetype = $_POST['insurancetype'][0];
                                        $amount = $_POST['amount'];
                                        $available = $_POST['available'];
                                        $clientype = $_POST['clienttype'];
                                        // $creditclient = $_POST['creditclient'];
                                        if (isset($_POST['insurancecompany'], $_POST['membernumber'])) {
                                            $insurancecompany = $_POST['insurancecompany'];
                                            $membernumber = $_POST['membernumber'];
                                        }
                                        if (empty($paymentmethod)) {
                                            $errors[] = 'Select Payment Method';
                                        }
                                        if ($paymentmethod == 'credit') {
                                            $getclient = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 AND creditclient_id='$creditclient'") or die(mysqli_error($con));
                                            $row = mysqli_fetch_array($getclient);
                                            $creditclient_id = $row['creditclient_id'];
                                            $clientname = $row['clientname'];
                                            $clientype = $row['type'];
                                            $getcredit = mysqli_query($con, "SELECT SUM(amount) AS addedcredit FROM clientcredits WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                            $row = mysqli_fetch_array($getcredit);
                                            $addedcredit = $row['addedcredit'];
                                            $getused = mysqli_query($con, "SELECT SUM(amount) AS creditused FROM usedcredit WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                            $row2 = mysqli_fetch_array($getcredit);
                                            $creditused = $row2['creditused'];

                                            $creditavailable = $addedcredit - $creditused;
                                            if ($creditavailable < $total) {
                                                $errors[] = 'Credit available is less than total Bill';
                                            }
                                        }
                                        if ($paymentmethod == 'insurance') {
                                            $splittypes = explode('_', $insurancetype);
                                            $type_id = current($splittypes);
                                            $maxamount = end($splittypes);
                                            if ($maxamount > $total) {
                                                $errors[] = 'Total Bill is greator than Maximum insurance amount';
                                            }
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            $count_bills = count ($bill);
                                            if ($count_bills > 1){
                                                foreach ($bill as $bl){
                                                    mysqli_query($con, "UPDATE patientsque set payment='1', paymethod='$paymentmethod' WHERE patientsque_id='$bl[patientsque_id]'") or die(mysqli_error($con));
                                                }
                                            }else{
                                                if (!empty($patientsque_id))
                                                    mysqli_query($con, "UPDATE patientsque SET payment='1', paymethod='$paymentmethod' WHERE patientsque_id='$patientsque_id'") or die(mysqli_error($con));
                                            }
                                            if ($paymentmethod == 'credit') {
                                                if ($clientype == 'individual') {
                                                    $checkclient = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 AND type='individual' AND clientname='$patient_id'");
                                                    if (mysqli_num_rows($checkclient) == 0) {
                                                        mysqli_query($con, "INSERT INTO creditclients(clientname,location,credittype,contacts,email,details,type,status) VALUES('$patient_id','','prepaid','','','','individual',1)") or die(mysqli_error($con));
                                                        $creditclient_id = mysqli_insert_id($con);
                                                    } else {
                                                        $rowc = mysqli_fetch_array($checkclient);
                                                        $creditclient_id = $row['creditclient_id'];
                                                    }
                                                    if (!empty($amount)) {
                                                        mysqli_query($con, "INSERT INTO  clientcredits(creditclient_id,date,amount,status) VALUES('$creditclient_id','$timenow','$amount',1)") or die(mysqli_error($con));
                                                    }
                                                }
                                                // pay based on selected services 
                                                $totalservice=0;
                                                if (isset ($_SESSION['service'])){
                                                    foreach ($_SESSION['service'] as $service){
                                                        $totalservice += $service['amount'];
                                                    }

                                                }
                                                mysqli_query($con, "INSERT INTO  usedcredit(service_id,creditclient_id,date,amount,status) VALUES('$id','$creditclient_id','$timenow','$total',1)") or die(mysqli_error($con));
                                                $type_id = $creditclient_id;
                                            }
                                            $totalservice=0;
                                            if (isset ($_SESSION['service'])){
                                                foreach ($_SESSION['service'] as $service){
                                                    $totalservice += intval($service);
                                                }

                                            }                                            
                                            make_bill_payment($pdo, $bill_id, $total, $paymentmethod, $count_bills,$patient_id,$totalservice);                                            
                                            if ($type == "medical_service"){
                                                foreach($bill as $b) {
                                                    $type_id = $b['type_id'];
                                                    // update patient services which have been selected to be paid for 
                                                    foreach ($_SESSION['service'] as $key => $service ){
                                                        mysqli_query($con, "UPDATE patientservices SET status=2 where  patientservice_id='$key'") or die(mysqli_error($con));
                                                    }
                                                    mysqli_query($con, "UPDATE serviceorders SET payment='1',approvedby='" . $_SESSION['elcthospitaladmin'] . "',paymentmethod='$paymentmethod',payment_id='$type_id',status=1,timestamp='$timenow' WHERE serviceorder_id='$type_id'") or die(mysqli_error($con));
                                                }
                                            }
                                            else if ($type == "lab"){
                                                foreach($bill as $b) {
                                                    $type_id = $b['type_id'];
                                                    foreach ($_SESSION['service'] as $key => $service ){
                                                        mysqli_query($con, "UPDATE patientlabs SET status=2 where patientlab_id='$key'") or die(mysqli_error($con));
                                                    }
                                                    // mysqli_query($con, "UPDATE laborders SET payment='1',insurer='" . $_SESSION['elcthospitaladmin'] . "',percentage='$paymentmethod',status=1 WHERE laborder_id='$type_id'") or die(mysqli_error($con));
                                                }
                                            }
                                            else if ($type == "radiography"){
                                                foreach($bill as $b) {
                                                    $type_id = $b['type_id'];
                                                    foreach ($_SESSION['service'] as $key => $service ){
                                                        mysqli_query($con, "UPDATE patientradios SET status=2 where patientradio_id='$key'") or die(mysqli_error($con));
                                                    }
                                                    // mysqli_query($con, "UPDATE radiologyorders SET payment='1',insurer='" . $_SESSION['elcthospitaladmin'] . "',percentage='$paymentmethod',status=1 WHERE radiologyorder_id='$type_id'") or die(mysqli_error($con));
                                                }
                                            }

                                            else if ($type == "unselective" && $bill_type_id == REGISTRATION_SERVICE_ID)
                                                update_patient_status($pdo, $patient_id, 1);
                                                else if ($type == "pharmacy"){
                                                    foreach($bill as $b) {
                                                        $type_id = $b['type_id'];
                                                        foreach ($_SESSION['service'] as $key => $service ){
                                                            mysqli_query($con, "UPDATE pharmacyordereditems SET status=2 where pharmacyordereditem_id ='$key'") or die(mysqli_error($con));
                                                        }
                                                        mysqli_query($con, "UPDATE pharmacyorders SET payment='1',insurer='" . $_SESSION['elcthospitaladmin'] . "',percentage='$paymentmethod',status=1 WHERE pharmacyorder_id='$type_id'") or die(mysqli_error($con));
                                                    }
                                                }
                                            // else if ($type == "admission")
                                                // unset service session
                                                unset($_SESSION['service']);
                                            echo '<div class="alert alert-success">Payment Successfully Approved.Click <a href="paymentinvoice?id=' . $id . '" target="_blank"><strong>Here</strong></a> to Print Invoice</div>';
                                        }
                                    }

									if ($qpaymenttype == "insurance") {
                                        $paymstr = "Insurance - ";
										$getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE insurancecompany_id='$insurance_id'");
                                        $row1 =  mysqli_fetch_array($getcompany);
                                        $company = $row1['company'];
										$paymstr .= isset($company) ? $company : "N/A";
                                    } else if ($qpaymenttype == "credit") {
                                        $paymstr = "Credit - " . $clientname;
									} else {
										$paymstr = ucfirst($qpaymenttype);
									}
                                    ?>
                                    <form class="form" method="POST" action="">
                                        <div class="form-group"><label class="control-label">Payment Method</label>
                                            <input type="text" class="form-control" value="<?php echo $paymstr; ?>" disabled />
                                            <!--
                                            	<select class="form-control" name="paymentmethod" id="paymentmethod" disabled>
													<option value="" selected="selected">Select Method...</option>
													<option value="cash">Cash</option>
													<option value="credit" <?php //if ($paymethod == "credit") echo "selected"; ?>>Credit</option>
													<option value="insurance" <?php //if ($paymethod == "insurance") echo "selected"; ?>>Insurance</option>
												</select>
											-->
                                        </div>
                                        <div class="row forcredit" style="display: none">
                                            <div class="form-group col-lg-12">
                                                <label class="control-label">* Credit Client Type</label>
                                                <select name="clienttype" class="form-control" id="clienttype">
                                                    <option value="">select type...</option>
                                                    <option value="individual">Individual</option>
                                                    <option value="organisation">Organisation</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-12 forindividual" style="display: none">
                                                <?php
                                                $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 AND type='individual' AND clientname='$patient_id'");
                                                $row = mysqli_fetch_array($getclients);
                                                $creditclient_id = $row['creditclient_id'];
                                                $clientname = $row['clientname'];
                                                $getcredit = mysqli_query($con, "SELECT SUM(amount) AS addedcredit FROM clientcredits WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                                $rowa = mysqli_fetch_array($getcredit);
                                                $addedcredit = $rowa['addedcredit'];
                                                $getused = mysqli_query($con, "SELECT SUM(amount) AS creditused FROM usedcredit WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                                $row2 = mysqli_fetch_array($getused);
                                                $creditused = $row2['creditused'];
                                                $creditavailable = $addedcredit - $creditused;
                                                ?>
                                                <p class="text-info"><strong><i>Credit Available (<?php echo $creditavailable; ?>)</i></strong></p>
                                                <input name='available' class="form-control" value="<?php echo $creditavailable; ?>" style="display:none">
                                                <label class="control-label">Add More Credit (Optional)</label>
                                                <input type="number" name='amount' class="form-control" placeholder="Enter credit">
                                            </div>
                                            <div class="form-group col-lg-12 fororganisation" style="display: none">
                                                <label class="control-label">* Credit Client (Available)</label>
                                                <select name="creditclient" class="form-control">
                                                    <option value="">select client...</option>
                                                    <?php
                                                    $getclients = mysqli_query($con, "SELECT * FROM creditclients WHERE status=1 AND type='organisation'");
                                                    while ($row = mysqli_fetch_array($getclients)) {
                                                        $creditclient_id = $row['creditclient_id'];
                                                        $clientname = $row['clientname'];
                                                        $getcredit = mysqli_query($con, "SELECT SUM(amount) AS addedcredit FROM clientcredits WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                                        $row = mysqli_fetch_array($getcredit);
                                                        $addedcredit = $row['addedcredit'];
                                                        $getused = mysqli_query($con, "SELECT SUM(amount) AS creditused FROM usedcredit WHERE creditclient_id='$creditclient_id'") or die(mysqli_error($con));
                                                        $row2 = mysqli_fetch_array($getcredit);
                                                        $creditused = $row2['creditused'];
                                                        $creditavailable = $addedcredit - $creditused;
                                                    ?>
                                                        <option value="<?php echo  $creditclient_id . '_' . $creditavailable; ?>"><?php echo $clientname . ' (' . $creditavailable . ')'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="forinsurance" style="display:none">
                                            <?php
                                            if ($paymenttype != 'insurance') {
                                            ?>
                                                <div class="form-group">
                                                    <label class="control-label">* Insurance Company</label>
                                                    <select name="insurancecompany" class="form-control" id="insurancecompany">
                                                        <option value="">select company...</option>
                                                        <?php
                                                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                                            $insurancecompany_id = $row1['insurancecompany_id'];
                                                            $company = $row1['company'];
                                                        ?>
                                                            <option value="<?php echo  $insurancecompany_id; ?>"><?php echo $company; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Insurance Package</label>
                                                    <select name="" id="packagename" class="form-control">
                                                        <option value="" selected="">Select Package</option>
                                                    </select>
                                                    <?php
                                                    $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                    while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                                        $insurancecompany_id = $row1['insurancecompany_id'];
                                                        $company = $row1['company'];
                                                    ?>
                                                        <select name="insurancetype[]" id="package<?php echo $insurancecompany_id; ?>" style="display:none;" class="packages form-control">
                                                            <option value="">select package..</option>
                                                            <?php
                                                            $gettypes =  mysqli_query($con, "SELECT * FROM insurancetypes WHERE status=1 AND insurancecompany_id='$insurancecompany_id'");
                                                            while ($row1 =  mysqli_fetch_array($gettypes)) {
                                                                $insurancetype_id = $row1['insurancetype_id'];
                                                                $maxamount = $row1['maxamount'];
                                                                $insurancetype = $row1['insurancetype'];
                                                            ?>
                                                                <option value="<?php echo  $insurancetype_id . '_' . $maxamount; ?>"><?php echo $insurancetype . ' (' . $maxamount . ')'; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    <?php } ?>
                                                </div>
                                                <div class="form-group"><label class="control-label">Membership ID</label>
                                                    <input type="text" name="membernumber" class="form-control " placeholder="Enter M/Ship ID">
                                                </div>
                                            <?php } else { ?>
                                                <p class="text-info"><strong><i>Member ID (<?php echo $policyidnumber; ?>)</i></strong></p>
                                                <label class="control-label">Insurance Package (Max Amount)</label>
                                                <select name="insurancetype[]" class="form-control">
                                                    <option value="">select company...</option>
                                                    <?php
                                                    $gettypes =  mysqli_query($con, "SELECT * FROM insurancetypes WHERE status=1 AND insurancecompany_id='$insurance_id'");
                                                    while ($row1 =  mysqli_fetch_array($gettypes)) {
                                                        $insurancetype_id = $row1['insurancetype_id'];
                                                        $maxamount = $row1['maxamount'];
                                                        $insurancetype = $row1['insurancetype'];
                                                    ?>
                                                        <option value="<?php echo  $insurancetype_id . '_' . $maxamount; ?>"><?php echo $insurancetype . ' (' . $maxamount . ')'; ?></option>
                                                    <?php } ?>
                                                </select>

                                            <?php    } ?>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-sm btn-info" id="submitpay" name="submit" disabled >Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        include 'includes/footer.php';
        ?>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <script>
        $(document).on('click','.selectcheck',function(){
            // select all desired checkboxes to pay for 
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            // check if all checkboxes are selected
            var allChecked = true;
            // check if at list one checkbox is selected
            var oneChecked = false;
            for (var i=0; i<checkboxes.length; i++){
                if (checkboxes[i].checked){
                    oneChecked = true;
                }else{
                    allChecked = false;
                }
            }
            // if one is checked , enable the button
            if (oneChecked){
                $('#submitpay').prop('disabled', false);
            }else{
                $('#submitpay').prop('disabled', true);
            }
            // get value of checked box
            var checkedValue = document.querySelector('.selectcheck:checked').value;
            // split the value to get the serviceid and cost
            var splitValue = checkedValue.split('_');
            var serviceid = splitValue[0];
            var cost = splitValue[1];
            // remove selectcheck class from the checked box
            $(this).removeClass('selectcheck');
            // add other class to the checked box
            $(this).addClass('selectedcheck');
           
            $.ajax({
                url: 'getpackage.php',
                type: 'POST',
                data: {
                    serviceid: serviceid,
                    cost: cost
                },
                success: function(response) {
                    // $('#packagename').html(response);
                }
            });   

        })
        $(document).on('click','.selectedcheck',function(){
            // select all desired checkboxes to pay for 
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            // check if all checkboxes are selected
            var allChecked = true;
            // check if at list one checkbox is selected
            var oneChecked = false;
            for (var i=0; i<checkboxes.length; i++){
                if (checkboxes[i].checked){
                    oneChecked = true;
                }else{
                    allChecked = false;
                }
            }
            // if one is checked , enable the button
            if (oneChecked){
                $('#submitpay').prop('disabled', false);
            }else{
                $('#submitpay').prop('disabled', true);
            }
            // get value of checked box
            var checkedValue = $(this).attr('data-id')
            
            // remove selectcheck class from the checked box
            $(this).removeClass('selectedcheck');
            // add other class to the checked box
            $(this).addClass('selectcheck');
           
            $.ajax({
                url: 'getpackage.php',
                type: 'POST',
                data: {
                    removeid: checkedValue,
                },
                success: function(response) {
                    // $('#packagename').html(response);
                }
            });   

        })
        $('#paymentmethod').on('change', function() {
            var getselect = ""; //$(this).val();
            if ((getselect === 'insurance')) {
                $('.forinsurance').show();
                $('.forcredit').hide();
                $('#packagename').click(function() {
                    if ($('#insurancecompany').val() === '') {
                        alert("Please Select a Company First");
                    }
                });
                $('#insurancecompany').change(function() {
                    if ($(this).val() !== '') {
                        //       	 $(this).closest("form").attr('action',  $(this).val());
                        $("#packagename").hide();
                        $(".packages").each(function(index) {

                            // console.log(this.id);
                            $("#" + this.id).hide();


                        });
                        $("#package" + $('#insurancecompany').val()).show();
                        var townid = $("#package" + $('#insurancecompany').val());
                        //         $('.packages').change(function() {                               
                        //             	 $(this).closest("form").attr('action',  $(this).val());                  
                        //                    });
                    } else {

                        $("#packagename").show();
                        $(".packages").hide();
                    }
                });
            }
            if ((getselect === 'credit')) {
                $('.forinsurance').hide();
                $('.forcredit').show();
                $('#clienttype').on('change', function() {
                    var clienttype = $(this).val();
                    if ((clienttype === 'organisation')) {
                        $('.fororganisation').show();
                        $('.forindividual').hide();
                    } else {
                        $('.fororganisation').hide();
                        $('.forindividual').show();
                    }
                });
            }
            if ((getselect != 'credit') && (getselect != 'insurance')) {
                $('.forinsurance').hide();
                $('.forcredit').hide();
            }
        }).trigger('change');
    </script>
</body>

</html>