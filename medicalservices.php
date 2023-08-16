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
    <title>Medical Services </title>
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
                            <h4>Medical Services</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="medicalservices">Medical services</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Medical Services</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" class="table table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Medical Service</th>
                                            <th>Normal Charge</th>
                                            <th>Credit Price</th>
                                            <th>Section</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getmedicalservices =  mysqli_query($con, "SELECT * FROM medicalservices WHERE status=1");
                                        while ($row1 =  mysqli_fetch_array($getmedicalservices)) {
                                            $medicalservice_id = $row1['medicalservice_id'];
                                            $medicalservice = $row1['medicalservice'];
                                            $charge = $row1['charge'];
                                            $creditprice = $row1['creditprice'];
                                            $section_id = $row1['section_id'];
                                            $clinic = $row1['clinic'];
                                            $clinictype = $row1['clinictype'];
                                            $getsection =  mysqli_query($con, "SELECT * FROM sections WHERE status=1 AND section_id='$section_id'");
                                            $row1 =  mysqli_fetch_array($getsection);
                                            $section = $row1['section'];
                                        ?>
                                            <tr>
                                                <td><?php echo $medicalservice; ?></td>
                                                <td><?php echo $charge; ?></td>
                                                <td><?php echo $creditprice; ?></td>
                                                <td><?php echo $section; ?></td>

                                                <td>
                                                    <button data-toggle="modal" data-target="#basicModal<?php echo $medicalservice_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                    <a href="removemedicalservice?id=<?php echo $medicalservice_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $medicalservice_id; ?>()">Remove</a>
                                                    <a href="insuranceservicecharges?id=<?php echo $medicalservice_id; ?>" class="btn btn-xs btn-primary">Insurance Prices</a>

                                                    <script type="text/javascript">
                                                        function confirm_delete<?php echo $medicalservice_id; ?>() {
                                                            return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                        }
                                                    </script>

                                                </td>
                                            </tr>
                                            <div class="modal fade" id="basicModal<?php echo $medicalservice_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Medical Service</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="editmedicalservice?id=<?php echo $medicalservice_id; ?>" method="POST">

                                                                <div class="form-group">
                                                                    <label>Medical Service</label>
                                                                    <input type="text" class="form-control" name="medicalservice" required="required" value="<?php echo $medicalservice; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Medical Section</label>
                                                                    <select class="form-control" name="section" required="required">
                                                                        <option value="">Select Section</option>
                                                                        <?php
                                                                        $getsections =  mysqli_query($con, "SELECT * FROM sections WHERE status=1");
                                                                        while ($row1 =  mysqli_fetch_array($getsections)) {
                                                                            $csection_id = $row1['section_id'];
                                                                            $csection = $row1['section'];
                                                                        ?>
                                                                            <option value="<?php echo $csection_id; ?>" <?php if ($csection_id == $section_id) echo "selected"; ?>>
                                                                                <?php echo $csection; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Price Per Unit</label>
                                                                    <input type="text" class="form-control" name="charge" required="required" value="<?php echo $charge; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Credit Price</label>
                                                                    <input type="text" class="form-control" name="creditprice" required="required" value="<?php echo $creditprice; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Clinic Service</label>
                                                                    <select name="clinic" class="clinic form-control" required>
                                                                        <option value="">Select Section</option>
                                                                        <option value="1" <?php if ($clinic == '1'){ ?> selected <?php } ?>>True</option>
                                                                        <option value="0" <?php if ($clinic == '0'){ ?> selected <?php } ?>>False</option>                                              
                                                                    </select>                                            
                                                                </div>
                                                                <div class="form-group forclinic ">
                                                                    <label class="control-label">Clinic Type</label>
                                                                    <select name="clinictype" class="clitype form-control" id="clitype" >
                                                                        <option value="">Select Type</option>
                                                                        <option value="1" <?php if ($clinictype == '1'){ ?> selected <?php } ?>>Free</option>
                                                                        <option value="0" <?php if ($clinictype == '0'){ ?> selected <?php } ?>>Paid</option>                                              
                                                                    </select>                                            
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="submit">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
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



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
</body>

</html>