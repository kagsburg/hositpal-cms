<?php
include 'includes/conn.php';
include 'utils/patients.php';
include 'utils/services.php';
if (!isset($_SESSION['elcthospitaladmin'])) {
    header('Location:login.php');
}
$id = $_GET['id'];
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
                                <li class="breadcrumb-item"><a href="registrationpending">Pending Registrations</a></li>
                                <li class="breadcrumb-item active"><a href="#">Add Payment</a></li>
                            </ol>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Bill Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        $getpatient = mysqli_query($con, "SELECT * FROM patients WHERE status='3' AND patient_id='$id'");
                                        $row2 = mysqli_fetch_array($getpatient);
                                        $patient_id = $row2['patient_id'];
                                        $firstname = $row2['firstname'];
                                        $secondname = $row2['secondname'];
                                        $thirdname = $row2['thirdname'];
                                        $gender = $row2['gender'];
                                        // $paymenttype = $row2['paymenttype'];
                                        $policyidnumber = $row2['policyidnumber'];
                                        $paymenttype = get_payment_method($pdo, $id);
                                        $insurance_id = $row2['insurancecompany'];
                                        if ($paymenttype == "insurance" && isset($insurance_id)) {
                                            $getinsurance = mysqli_query($con, "SELECT * FROM insurancecompanies WHERE insurancecompany_id='$insurance_id'") or die(mysqli_error($con));
                                            $insurance_row = mysqli_fetch_array($getinsurance);
                                            $insurancecompany = $insurance_row['company'];
                                        } else {
                                            $insurancecompany = "";
                                        }
                                        $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE staff_id='$attendant'") or die(mysqli_error($con));
                                        $rows = mysqli_fetch_array($getstaff);
                                        $fullname = isset($rows) ? $rows['fullname'] : "";

                                        if (strlen($patient_id) == 1) {
                                            $pin = '000' . $patient_id;
                                        }
                                        if (strlen($patient_id) == 2) {
                                            $pin = '00' . $patient_id;
                                        }
                                        if (strlen($patient_id) == 3) {
                                            $pin = '0' . $patient_id;
                                        }
                                        if (strlen($patient_id) >= 4) {
                                            $pin = $patient_id;
                                        }

                                        ?>


                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="bg-dark" style="color: #fff"><?php echo $firstname . ' ' . $secondname . ' ' . $thirdname . ' (' . $pin . ')'; ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Service</th>
                                                    <th>Unit Charge</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = get_registration_service($pdo);
                                                $medicalservice = $row['medicalservice'];
                                                $unitcharge = $row['charge'];
                                                $cashcharge = $unitcharge;
                                                $creditprice = $row['creditprice'];
                                                $service_charge = get_service_charge($pdo, $row["id"], $paymenttype, $insurance_id, '2');
                                                $paymenttype = $service_charge["payment_type"];
                                                
                                                $total = $service_charge["charge"];

                                                ?>
                                                <tr>
                                                    <td><?php echo $medicalservice; ?></td>
                                                    <td class="charge_el"><?php echo $unitcharge; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL</th>
                                                    <th class="charge_elf"><?php echo number_format($total); ?></th>
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
                                    <h4 class="card-title">Add Payment</h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $type_id = 0;
                                    if (isset($_POST['submit'])) {
                                        $paymentmethod = $_POST['paymentmethod'];
                                        $insurancetype = $_POST['insurancetype'][0];
                                        if ($paymentmethod == 'insurance') {
                                          $amount = $insurancecharge;
                                        } else if ($paymentmethod == 'credit') {
                                          $amount = $creditprice;
                                        } else {
                                          $amount = $cashcharge;
                                        }
                                        $available = $_POST['available'];
                                        $clientype = $_POST['clienttype'];
                                        $creditclient = $_POST['creditclient'];                                        
                                        if (empty($paymentmethod)) {
                                            $errors[] = 'Select Payment Method';
                                        }
                                        if ($paymentmethod == 'credit') {
                                            if ($clientype == 'organisation') {
                                                $splitclients = explode('_', $creditclient);
                                                $creditavailable = end($splitclients);
                                                $creditclient_id = current($splitclients);
                                                $type_id = $creditclient_id;
                                            }
                                            if ($clientype == 'individual') {
                                                $creditavailable = $available + $amount;
                                            }
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
                                            mysqli_query($con, "INSERT INTO serviceorders(patientsque_id,admin_id,timestamp,payment,paymentmethod,payment_id,source,approvedby,status) VALUES(0,'" . $_SESSION['elcthospitaladmin'] . "',UNIX_TIMESTAMP(),0,'$paymentmethod',0,'reception',0,1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);                                                        
                                            mysqli_query($con, "INSERT INTO patientservices(serviceorder_id,medicalservice_id,charge,status) VALUES('$last_id','$sid','$amount',1)") or die(mysqli_error($con));

                                            mysqli_query($con, "UPDATE patients SET status=1 WHERE patient_id='$patient_id'") or die(mysqli_error($con));
                                           
                                            echo '<div class="alert alert-success">Payment Successfully Approved.Click <a href="regpaymentinvoice?id=' . $id . '" target="_blank"><strong>Here</strong></a> to Print Invoice</div>';
                                        }
                                    }

                                    if ($paymenttype == "insurance") {
                                        $paymstr = "Insurance - ";
                                        $getcompany =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE insurancecompany_id='$insurance_id'");
                                        $row1 =  mysqli_fetch_array($getcompany);
                                        $company = $row1['company'];
                                        $paymstr .= isset($company) ? $company : "N/A";
                                    } else {
                                        $paymstr = ucfirst($paymenttype);
                                    }
                                    ?>
                                    <form class="form" method="POST" action="">
                                        <div class="form-group"><label class="control-label">Payment Method</label>
                                            <!-- <input type="text" class="form-control" value="<?php echo $paymstr; ?>" disabled /> -->                                            
                                            <select class="form-control" name="paymentmethod" id="paymentmethod">                                                
                                                <option value="cash">Cash</option>
                                                <?php if ($paymethod == "credit") { ?>
                                                    <option value="credit" selected>Credit</option>
                                                <?php } else if ($paymethod == "insurance") { ?>
                                                    <option value="insurance" selected>Insurance</option>
                                                <?php } ?>                                                
                                            </select>
											
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
                                            <button class="btn btn-sm btn-info" name="submit">Submit</button>
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
        $('#paymentmethod').on('change', function() {
            var getselect = ""; //$(this).val();
            if ((getselect === 'insurance')) {

                $('.charge_el').text('<?php echo $insurancecharge ?>');
                $('.charge_elf').text('<?php echo number_format($insurancecharge) ?>');

                $('.forinsurance').show();
                $('.forcredit').hide();
                $('#packagename').click(function() {
                    if ($('#insurancecompany').val() === '') {
                        alert("Please Select a Company First");
                    }
                });
                // $('#insurancecompany').change(function() {
                //     if ($(this).val() !== '') {
                //         //       	 $(this).closest("form").attr('action',  $(this).val());
                //         $("#packagename").hide();
                //         $(".packages").each(function(index) {

                //             // console.log(this.id);
                //             $("#" + this.id).hide();


                //         });
                //         $("#package" + $('#insurancecompany').val()).show();
                //         var townid = $("#package" + $('#insurancecompany').val());
                //         //         $('.packages').change(function() {                               
                //         //             	 $(this).closest("form").attr('action',  $(this).val());                  
                //         //                    });
                //     } else {

                //         $("#packagename").show();
                //         $(".packages").hide();
                //     }
                // });
            }
            if ((getselect === 'credit')) {

                $('.charge_el').text('<?php echo $creditprice ?>');
                $('.charge_elf').text('<?php echo number_format($creditprice) ?>');

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
                $('.charge_el').text('<?php echo $cashcharge ?>');
                $('.charge_elf').text('<?php echo number_format($cashcharge) ?>');

                $('.forinsurance').hide();
                $('.forcredit').hide();
            }
        }).trigger('change');
    </script>
</body>

</html>