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
    <title>Radiography Investigation Types</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                            <h4>Radiography Investigation Types</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Radiography Investigation Types</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Investigation Type</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['typename'], $_POST['unit'])) {
                                        $typename = mysqli_real_escape_string($con, trim($_POST['typename']));                                       
                                        // $unit = $_POST['unit'];
                                        $unitprice = $_POST['unitprice'];
                                        $creditprice = $_POST['creditprice'];
                                       //  $subtype = $_POST['subtype'];
                                       //  $subtypeunit = $_POST['subtypeunit'];
                                        $company = $_POST['company'];
                                        $insurancecharge = $_POST['insurancecharge'];

                                        if ((empty($typename)) || (empty($unit))) {
                                            echo '<div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                        } else {

                                            mysqli_query($con, "INSERT INTO radioinvestigationtypes(investigationtype,unitprice,creditprice,unit_id,status) VALUES('$typename','$unitprice','$creditprice','$unit',1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);                                            
                                            $companies = sizeof($company);
                                            for ($i = 0; $i < $companies; $i++) {
                                                if (!empty($company[$i])) {
                                                    mysqli_query($con, "INSERT INTO insuredradiotypes(investigationtype_id,insurancecompany_id,charge,status) VALUES('$last_id','$company[$i]','$insurancecharge[$i]','1')") or die(mysqli_error($con));
                                                }
                                            }
                                          //   if (isset($_POST['hassubtypes'])) {
                                          //       $allsubtypes = sizeof($subtype);
                                          //       for ($i = 0; $i < $allsubtypes; $i++) {
                                          //           mysqli_query($con, "INSERT INTO investigationsubtypes(investigationtype_id,subtype,unit_id,status) VALUES('$last_id','$subtype[$i]','$subtypeunit[$i]',1)") or die(mysqli_error($con));
                                          //       }
                                          //   } else {
                                          //       mysqli_query($con, "INSERT INTO investigationsubtypes(investigationtype_id,subtype,unit_id,status) VALUES('$last_id','$typename','$unit',1)") or die(mysqli_error($con));
                                          //   }
                                            echo '<div class="alert alert-success"><i class="fa fa-check"></i>Investigation successfully added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label>Investigation Type</label>
                                                <input type="text" class="form-control" name="typename" required="required">
                                            </div>
                                            <!-- <div class="form-group col-lg-4 measurementunit">
                                                <label class="control-label">SI Unit / Result</label>
                                                <div class="controls">
                                                    <select name="unit" class="form-control" id="category">
                                                        <option value="">select unit...</option>
                                                        <?php
                                                        $getunits =  mysqli_query($con, "SELECT * FROM siunits WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getunits)) {
                                                            $measurement_id = $row1['siunit_id'];
                                                            $measurement = $row1['name'];
                                                        ?>
                                                            <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div> -->

                                            <div class="form-group col-lg-4 unitprice">
                                                <label>Unit Price</label>
                                                <input type="text" class="form-control" name="unitprice">
                                            </div>

                                            <div class="form-group col-lg-4 creditprice">
                                                <label>Credit Price</label>
                                                <input type="text" class="form-control" name="creditprice">
                                            </div>
                                        <div class="col-sm-12"></div>    
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
                                            
                                        </div>
                                        <!-- <div class="form-check mb-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="yes" id="subtypes" name="hassubtypes">Does it have sub types?
                                            </label>
                                        </div>
                                        <div class='subobj1 subtypes' style="display:none">
                                            <h4>Add Sub Types</h4>
                                            <div class='row'>
                                                <div class="form-group col-lg-4">
                                                    <label>Sub Type</label>
                                                    <input type="text" class="form-control" name="subtype[]">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="control-label">Measurement Unit</label>
                                                    <select name="subtypeunit[]" class="form-control" id="category">
                                                        <option value="">select unit...</option>
                                                        <?php
                                                        $getunits =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getunits)) {
                                                            $measurement_id = $row1['measurement_id'];
                                                            $measurement = $row1['measurement'];
                                                        ?>
                                                            <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Investigation Types</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" style="min-width: 600px">
                                    <thead>
                                        <tr>
                                            <th>Type Name</th>
                                            <!-- <th>SI Unit/Result</th> -->
                                            <th>Unit price</th>
                                            <th>Credit Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $gettypes =  mysqli_query($con, "SELECT * FROM radioinvestigationtypes WHERE status=1");
                                        while ($row =  mysqli_fetch_array($gettypes)) {
                                            $investigationtype_id = $row['radioinvestigationtype_id'];
                                            $investigationtype = $row['investigationtype'];                                            
                                            $unit_id = $row['unit_id'];
                                            $unitprice = $row['unitprice'];
                                            $creditprice = $row['creditprice'];

                                            $getunit =  mysqli_query($con, "SELECT * FROM siunits WHERE status=1 AND siunit_id='$unit_id'");
                                            $row1 =  mysqli_fetch_array($getunit);
                                            $measurement_id = $row1['siunit_id'];
                                            $measurement = $row1['name'];
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $investigationtype; ?></td>                                                
                                                <!-- <td><?php echo $measurement; ?></td> -->
                                                <td><?php echo $unitprice; ?></td>
                                                <td><?php echo $creditprice; ?></td>

                                                <td>
                                                    <!-- <button data-toggle="modal" data-target="#basicModal<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-info">Sub Types</button> -->
                                                    <a href="editradioinvestigationtype?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-primary">Edit</a>
                                                    <a href="removeradioinvestigationtype?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $investigationtype_id; ?>()">Remove</a>
                                                    <script type="text/javascript">
                                                        function confirm_delete<?php echo $investigationtype_id; ?>() {
                                                            return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                        }
                                                    </script>
                                                    <a href="insuranceradioinvestigationcharges?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-primary">Insurance Prices</a>
                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php
                                $gettypes =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1");
                                while ($row =  mysqli_fetch_array($gettypes)) {
                                    $investigationtype_id = $row['investigationtype_id'];
                                ?>
                                    <div class="modal fade" id="basicModal<?php echo $investigationtype_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Investigation Sub Types</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Sub type</th>
                                                                <th>Unit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $getsubtypes =  mysqli_query($con, "SELECT * FROM investigationsubtypes WHERE status=1 AND investigationtype_id='$investigationtype_id'");
                                                            while ($row =  mysqli_fetch_array($getsubtypes)) {
                                                                $investigationsubtype_id = $row['investigationsubtype_id'];
                                                                $subtype = $row['subtype'];
                                                                $unit_id = $row['unit_id'];

                                                                $getunit =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit_id'");
                                                                $row1 =  mysqli_fetch_array($getunit);
                                                                $measurement_id = $row1['measurement_id'];
                                                                $measurement = $row1['measurement'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $subtype; ?></td>
                                                                    <td><?php echo $measurement; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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

    <!-- Datatable -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>
    <!-- Dashboard 1 -->
    <!-- <script src="js/dashboard/dashboard-1.js"></script> -->
    <script>
        $('#subtypes').click(function() {
            if ($(this).prop("checked") === true) {
                $('.subtypes').show();
                $('.measurementunit').hide();
            } else {
                $('.subtypes').hide();

                $('.measurementunit').show();
            }
        });
        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj1').append('<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-8"><div class="row">  <div class="form-group col-lg-6"><label>Sub Type</label><input type="text" class="form-control" name="subtype[]" required="required"> </div>      <div class="form-group col-lg-6">   <label class="control-label">Measurement Unit</label> <select name="subtypeunit[]" class="form-control" id="category">     <option value="">select unit...</option>	<?php $getunits =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1");
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    while ($row1 =  mysqli_fetch_array($getunits)) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $measurement_id = $row1['measurement_id'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $measurement = $row1['measurement']; ?>             <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>                  <?php } ?>                                </select>       </div></div> </div> <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>'); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

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

    <!--<script src="js/styleSwitcher.js"></script>-->
</body>

</html>