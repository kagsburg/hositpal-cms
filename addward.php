<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Ward</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css?<?php echo time(); ?>" rel="stylesheet">
    <link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

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
                            <h4>Add Ward</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="wards">Wards</a></li>
                            <li class="breadcrumb-item active"><a href="#">Wards</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Ward</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['wardtype'], $_POST['wardname'])) {
                                        $wardname = mysqli_real_escape_string($con, trim($_POST['wardname']));
                                        $wardtype = mysqli_real_escape_string($con, trim($_POST['wardtype']));
                                        $bedfee = mysqli_real_escape_string($con, trim($_POST['bedfee']));
                                        $creditfee = mysqli_real_escape_string($con, trim($_POST['creditfee']));
                                        $company = $_POST['company'];
                                        $insurancecharge = $_POST['insurancecharge'];
                                        if (empty($wardtype)) {
                                            $errors[] = 'Ward type Name Required';
                                        }
                                        $check =  mysqli_query($con, "SELECT * FROM wards WHERE wardname='$wardname' AND status=1");
                                        if (mysqli_num_rows($check) > 0) {
                                            $errors[] = 'Ward name Already Added';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO wards(wardname,wardtype_id,bedfee,creditfee,status) VALUES('$wardname','$wardtype','$bedfee','$creditfee',1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);
                                            $companies = sizeof($company);
                                            for ($i = 0; $i < $companies; $i++) {
                                                if (!empty($company[$i])) {
                                                    mysqli_query($con, "INSERT INTO insuredwards(ward_id,insurancecompany_id,charge,status) VALUES('$last_id','$company[$i]','$insurancecharge[$i]','1')") or die(mysqli_error($con));
                                                }
                                            }
                                            echo '<div class="alert alert-success">Ward Successfully Added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label>Ward Name</label>
                                            <input type="text" class="form-control" name="wardname" required="required">
                                        </div>
                                        <div class="form-group"><label class="control-label">* Ward Type</label>
                                            <select name="wardtype" class="form-control">
                                                <option value="">select type...</option>
                                                <?php
                                                $getcats =  mysqli_query($con, "SELECT * FROM wardtypes WHERE status=1");
                                                while ($row1 =  mysqli_fetch_array($getcats)) {
                                                    $wardtype_id = $row1['wardtype_id'];
                                                    $wardtype = $row1['wardtype'];
                                                ?>
                                                    <option value="<?php echo $wardtype_id; ?>"><?php echo $wardtype; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Bed Fee</label>
                                            <input type="text" class="form-control" name="bedfee" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Fee</label>
                                            <input type="text" class="form-control" name="creditfee">
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
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>


    <!-- Dashboard 1 -->
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->


    <!--<script src="js/styleSwitcher.js"></script>-->
    <script>
        
        $('.subobj_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6">                                 <label>Insurance company</label>   <select name="company[]" class="form-control"> <option value="">Select company...</option>  <?php $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                                                                                                                                                                                                                                                                                                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {                                                                                                                                                                                                                                                                                                                                               $insurancecompany_id = $row1['insurancecompany_id'];
                                                                                                                                                                                                                                                                                                                                                                            $company = $row1['company'];           ?>    <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>                       <?php } ?>                       </select>   </div><div class="form-group col-lg-6"><label class="control-label">Charge</label>                   <input type="number" name="insurancecharge[]" class="form-control" placeholder="Enter Service Price"></div></div></div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj').on("click", ".remove_subobj", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    </script>
</body>

</html>