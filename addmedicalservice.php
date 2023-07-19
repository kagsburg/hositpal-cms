<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
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
    <title>Add Medical Service</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">

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
        ?>

        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Add Medical Service</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="medicalservices">Medical Services</a></li>
                            <li class="breadcrumb-item active"><a href="addmedicalservice">Add service</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Medical service</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['medicalservice'])) {
                                        $medicalservice =  mysqli_real_escape_string($con, trim($_POST['medicalservice']));
                                        $charge =  mysqli_real_escape_string($con, trim($_POST['charge']));
                                        $creditprice =  mysqli_real_escape_string($con, trim($_POST['creditprice']));
                                        $company = $_POST['company'];
                                        $insurancecharge = $_POST['insurancecharge'];
                                        if (empty($medicalservice)) {
                                            $errors[] = 'Medical service Name Required';
                                        }

                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO medicalservices(medicalservice,charge,creditprice,section_id,status) VALUES('$medicalservice','$charge','$creditprice','$id',1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);
                                            $companies = sizeof($company);
                                            for ($i = 0; $i < $companies; $i++) {
                                                if (!empty($company[$i])) {
                                                    mysqli_query($con, "INSERT INTO insuredservices(medicalservice_id,insurancecompany_id,charge,status) VALUES('$last_id','$company[$i]','$insurancecharge[$i]','1')") or die(mysqli_error($con));
                                                }
                                            }
                                            echo '<div class="alert alert-success">Service Successfully Added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">

                                        <div class="form-group">
                                            <label>Medical Service</label>
                                            <input type="text" class="form-control" name="medicalservice" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Section</label>
                                            <select name="section" class="sections form-control" required>
                                                <option value="">Select Section</option>
                                                <?php
                                                $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getsections)) {
                                                    $section_id = $row1['section_id'];
                                                    $section = $row1['section'];
                                                ?>
                                                    <option value="addmedicalservice?id=<?php echo $section_id; ?>"><?php echo $section; ?></option>
                                                <?php } ?>
                                            </select>                                            
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Price Per Unit</label>
                                            <input type="text" class="form-control" name="charge" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Credit Price</label>
                                            <input type="text" class="form-control" name="creditprice">
                                        </div>

                                        <p><strong>Add Insurance Charges</strong></p>

                                        <div class='subobj'>
                                            <div class='row'>
                                                <div class="form-group col-lg-6">
                                                    <label>Insurance company</label>
                                                    <select name="company[]" class="form-control">
                                                        <option value="">Select company...</option>
                                                        <?php
                                                        $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                                            $insurancecompany_id = $row1['insurancecompany_id'];
                                                            $company = $row1['company'];
                                                        ?>
                                                            <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-5"><label class="control-label">Charge</label>
                                                    <input type="number" name='insurancecharge[]' class="form-control" placeholder="Enter Service Price">
                                                </div>

                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    <?php
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

    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
</body>

</html>
<script>
   $('.sections').on('change', function() {
            var getselect = $(this).val();
            if ((getselect != '')) {
                $(this).closest("form").attr('action', $(this).val());
                // $('#servicename').hide();
                // $('.services').hide();
                // $('#service' + getselect).show();
            } else {
                // $('#servicename').show();
                // $('.services').hide();
            }
        });

    
    $('.subobj_button').click(function(e) { //on add input button click
        e.preventDefault();
        $('.subobj').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6">                                 <label>Insurance company</label>   <select name="company[]" class="form-control"> <option value="">Select company...</option>  <?php $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                                                                                                                                                                                                                                                                                                                                    while ($row1 =  mysqli_fetch_array($getcompanies)) {
                                                                                                                                                                                                                                                                                                                                                                        $insurancecompany_id = $row1['insurancecompany_id'];
                                                                                                                                                                                                                                                                                                                                                                        $company = $row1['company'];           ?>    <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>                       <?php } ?>                       </select>   </div><div class="form-group col-lg-6"><label class="control-label">Charge</label>                   <input type="number" name="insurancecharge[]" class="form-control" placeholder="Enter Service Price"></div></div></div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>'); //add input box
    });
    $('.subobj').on("click", ".remove_subobj", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
</script>