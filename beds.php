<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
$id = $_GET['id'];
$getwards =  mysqli_query($con, "SELECT * FROM wards WHERE status=1 AND ward_id='$id'");
$row = mysqli_fetch_array($getwards);
$wardname = $row['wardname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $wardname; ?> Beds</title>
    <!-- Favicon icon -->
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
                            <h4><?php echo $wardname; ?> Beds</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item"><a href="wards">Wards</a></li>
                            <li class="breadcrumb-item active"><a href="#">Beds</a></li>
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
                                    if (isset($_POST['bedfee'], $_POST['bedname'])) {
                                        $bedname = mysqli_real_escape_string($con, trim($_POST['bedname']));
                                        $bedfee = mysqli_real_escape_string($con, trim($_POST['bedfee']));

                                        if ((empty($bedfee)) || (empty($bedname))) {
                                            $errors[] = 'All Fields Required';
                                        }
                                        $check =  mysqli_query($con, "SELECT * FROM beds WHERE bedname='$bedname' AND ward_id='$id' AND status=1");
                                        if (mysqli_num_rows($check) > 0) {
                                            $errors[] = 'Bed name Already Added';
                                        }
                                        if (!empty($errors)) {
                                            foreach ($errors as $error) {
                                                echo '<div class="alert alert-danger">' . $error . '</div>';
                                            }
                                        } else {
                                            mysqli_query($con, "INSERT INTO beds(bedname,ward_id,status) VALUES('$bedname','$id',1)") or die(mysqli_error($con));
                                            echo '<div class="alert alert-success">Bed Successfully Added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label>Bed Name</label>
                                                <input type="text" class="form-control" name="bedname" required="required">
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $wardname; ?> Beds</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display" class="table table-striped" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Bed Name</th>                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getbeds = mysqli_query($con, "SELECT * FROM beds WHERE status=1 AND ward_id='$id'");
                                            while ($row = mysqli_fetch_array($getbeds)) {
                                                $bed_id = $row['bed_id'];                                                
                                                $bedname = $row['bedname'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $bedname; ?></td>                                                    
                                                    <td>
                                                        <button data-toggle="modal" data-target="#basicModal<?php echo $bed_id; ?>" class="btn btn-xs btn-info">Edit</button>
                                                        <a href="removebed?id=<?php echo $bed_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $bed_id; ?>()">Remove</a>
                                                        <script type="text/javascript">
                                                            function confirm_delete<?php echo $bed_id; ?>() {
                                                                return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                            }
                                                        </script>

                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="basicModal<?php echo $bed_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Bed</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="editbed?id=<?php echo $bed_id; ?>" method="POST">
                                                                    <div class="form-group">
                                                                        <label>Bed Name</label>
                                                                        <input type="text" class="form-control" name="bedname" required="required" value="<?php echo $bedname; ?>">
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
    <script src="vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/deznav-init.js"></script>
    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>



    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>


    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>