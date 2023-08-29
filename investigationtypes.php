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
    <title>Measurement Types</title>
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
                            <h4>Measurement Types</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Measurement Types</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Measurement Type</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <?php
                                    if (isset($_POST['typename'], $_POST['classification'], $_POST['unit'])) {
                                        $typename = mysqli_real_escape_string($con, trim($_POST['typename']));
                                        $classification = $_POST['classification'];
                                        $unit = $_POST['unit'];
                                        $unitprice = $_POST['unitprice'];
                                        $creditprice = $_POST['creditprice'];
                                        $subtype = $_POST['subtype'];
                                        $subtypeunit = $_POST['subtypeunit'];
                                        $company = $_POST['company'];
                                        $insurancecharge = $_POST['insurancecharge'];
                                       
                                       
                                        if ((empty($typename)) || (empty($classification))) {
                                            echo '<div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                        } else {

                                            mysqli_query($con, "INSERT INTO investigationtypes(investigationtype,unitprice,creditprice,classification_id,unit_id,status) 
                                            VALUES('$typename','$unitprice','$creditprice','$classification','$unit',1)") or die(mysqli_error($con));
                                            $last_id = mysqli_insert_id($con);                                            
                                            $companies = sizeof($company);
                                            if (isset($_POST['hasrange'])){
                                                $hasrange = $_POST['hasrange'];
                                                $normalX =  mysqli_real_escape_string($con, trim($_POST['normalX']));
                                                $normalY =  mysqli_real_escape_string($con, trim($_POST['normalY']));
                                               
                                                mysqli_query($con, "INSERT INTO investigationtypesrange(investigationtype_id,normalx,normaly,timestamp,status,admin_id) 
                                                VALUES('$last_id','$normalX','$normalY',UNIX_TIMESTAMP(),1,'".$_SESSION['elcthospitaladmin']."')") or die(mysqli_error($con));

                                                mysqli_query($con, "UPDATE investigationtypes SET range_type = 1 WHERE investigationtype_id = '$last_id'") or die(mysqli_error($con));

                                            }
                                            for ($i = 0; $i < $companies; $i++) {
                                                if (!empty($company[$i])) {
                                                    mysqli_query($con, "INSERT INTO insuredinvestigationtypes(investigationtype_id,insurancecompany_id,charge,status) VALUES('$last_id','$company[$i]','$insurancecharge[$i]','1')") or die(mysqli_error($con));
                                                }
                                            }
                                            if (isset($_POST['hasanswers'])){
                                                $hasanswers = $_POST['hasanswers'];
                                                $answers = $_POST['answers'];
                                                $answer = sizeof($answers);
                                                for ($i = 0; $i < $answer; $i++) {
                                                    mysqli_query($con, "INSERT INTO investigationselect (investigationtype_id,answer,timestamp,status,admin_id) VALUES('$last_id','$answers[$i]',UNIX_TIMESTAMP(),1,'".$_SESSION['elcthospitaladmin']."')") or die(mysqli_error($con));
                                                }
                                                mysqli_query($con, "UPDATE investigationtypes SET has_answers = 1 WHERE investigationtype_id = '$last_id'") or die(mysqli_error($con));

                                            }
                                            if (isset($_POST['hassubtypes'])) {
                                                $allsubtypes = sizeof($subtype);
                                                for ($i = 0; $i < $allsubtypes; $i++) {
                                                    mysqli_query($con, "INSERT INTO investigationsubtypes(investigationtype_id,subtype,unit_id,status) VALUES('$last_id','$subtype[$i]','$subtypeunit[$i]',1)") or die(mysqli_error($con));
                                                    $sub_id = mysqli_insert_id($con);
                                                    if (isset($_POST['hassubtyperange'])){
                                                        $hasrange = $_POST['hassubtyperange'];
                                                        $normalX =  $_POST['normalX1'];
                                                        $normalY =  $_POST['normalY1'];
                                                        mysqli_query($con, "INSERT INTO investigationtypesrange(investigationtype_id,normalx,normaly,timestamp,status,admin_id) 
                                                        VALUES('$sub_id','$normalX[$i]','$normalY[$i]',UNIX_TIMESTAMP(),1,'".$_SESSION['elcthospitaladmin']."')") or die(mysqli_error($con));
                                                    }
                                                }
                                                if (isset($_POST['hassubtyperange'])){
                                                    mysqli_query($con, "UPDATE investigationtypes SET range_type = 1 WHERE investigationtype_id = '$last_id'") or die(mysqli_error($con));
                                                }
                                            } else {
                                                mysqli_query($con, "INSERT INTO investigationsubtypes(investigationtype_id,subtype,unit_id,status) VALUES('$last_id','$typename','$unit',1)") or die(mysqli_error($con));
                                            }
                                            echo '<div class="alert alert-success"><i class="fa fa-check"></i>Measurement type successfully added</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label>Measurement Type</label>
                                                <input type="text" class="form-control" name="typename" required="required">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="control-label">Measurement Classification</label>
                                                <div class="controls">
                                                    <select name="classification" class="form-control" id="category">
                                                        <option value="">select classification...</option>
                                                        <?php
                                                        $getclassifications =  mysqli_query($con, "SELECT * FROM classifications WHERE status=1");
                                                        while ($row1 =  mysqli_fetch_array($getclassifications)) {
                                                            $classification_id = $row1['classification_id'];
                                                            $classification = $row1['classification'];
                                                        ?>
                                                            <option value="<?php echo $classification_id; ?>"><?php echo $classification; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 measurementunit">
                                                <label class="control-label">Measurement Unit</label>
                                                <div class="controls">
                                                    <select name="unit" class="form-control" id="category">
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
                                            </div>

                                            <div class="form-group col-lg-4 unitprice">
                                                <label>Unit Price</label>
                                                <input type="number" class="form-control" name="unitprice">
                                            </div>

                                            <div class="form-group col-lg-4 creditprice">
                                                <label>Credit Price</label>
                                                <input type="number" class="form-control" name="creditprice">
                                            </div>
                                        <div class="col-sm-12"></div>    
                                        <h5><strong>Add Insurance Charges</strong></h5>
                                        <div class="col-sm-12"></div>
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
                                        <div class="form-check mb-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="yes" id="subtypes" name="hassubtypes">Does it have sub types?
                                            </label>
                                        </div>
                                       
                                        <div class='subobj1 subtypes' style="display:none">
                                            <h4>Add Sub Types</h4>
                                            <div class="form-check mb-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input subtyperange" value="yes" id="subtyperange" name="hassubtyperange">Does it have Range?
                                            </label>
                                        </div>
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
                                                <div class="forsubtyperange" style="display:none">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="normalX">Normal Range X:</label>
                                                        <input type="number" step="0.01" class="form-control" id="normalX" name="normalX1[]">
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="normalY">Normal Range Y:</label>
                                                        <input type="number"  step="0.01" class="form-control" id="normalY" name="normalY1[]">
                                                    </div>
                                                    </div>
                                                </div>

                                                </div>
                                                

                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj1_button btn btn-success" style="margin-top:30px">+</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-2 forrange">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="yes" id="subrange" name="hasrange">Does it have Range?
                                            </label>
                                        </div>
                                        <div class="subrange" style="display:none">
                                        <div class="row">
                                            <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="normalX">Normal Range X:</label>
                                                <input type="number"  step="0.01" class="form-control" id="normalX" name="normalX">
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="normalY">Normal Range Y:</label>
                                                <input type="number"   step="0.01" class="form-control" id="normalY" name="normalY">
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-check mb-2">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="yes" id="subanswer" name="hasanswers">Does it have Selective Answers?
                                            </label>
                                        </div>
                                        <div class='subobj23' style="display: none;">
                                            <div class='row'>
                                                
                                                <div class="form-group col-lg-5"><label class="control-label">Results</label>
                                                    <input type="text" name='answers[]' class="form-control" placeholder="Enter Measurement Type Answers">
                                                </div>

                                                <div class="form-group col-lg-1">
                                                    <a href='#' class="subobj_button2 btn btn-success" style="margin-top:30px">+</a>
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

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Measurement Type</h4>
                            </div>
                            <div class="card-body">
                                <table id="example5" class="display" style="min-width: 600px">
                                    <thead>
                                        <tr>
                                            <th>Type Name</th>
                                            <th>Classification</th>
                                            <th>Unit</th>
                                            <th>Unit price</th>
                                            <th>Credit Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $gettypes =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1");
                                        while ($row =  mysqli_fetch_array($gettypes)) {
                                            $investigationtype_id = $row['investigationtype_id'];
                                            $investigationtype = $row['investigationtype'];
                                            $classification_id = $row['classification_id'];
                                            $unit_id = $row['unit_id'];
                                            $unitprice = $row['unitprice'];
                                            $creditprice = $row['creditprice'];
                                            $range = $row['range_type'];
                                            $has_answers = $row['has_answers'];
                                            $getunit =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1 AND measurement_id='$unit_id'");
                                            if (mysqli_num_rows($getunit) == 0) {
                                                $measurement = "";
                                            }else{

                                                $row1 =  mysqli_fetch_array($getunit);
                                                $measurement_id = $row1['measurement_id'];
                                                $measurement = $row1['measurement'];
                                            }
                                            $getclassification =  mysqli_query($con, "SELECT * FROM classifications WHERE status=1 AND classification_id='$classification_id'");
                                            $row2 =  mysqli_fetch_array($getclassification);
                                            $classification = $row2['classification'];
                                        ?>
                                            <tr>
                                                <td><?php echo $investigationtype; ?></td>
                                                <td><?php echo $classification; ?></td>
                                                <td><?php echo $measurement; ?></td>
                                                <td><?php echo $unitprice; ?></td>
                                                <td><?php echo $creditprice; ?></td>

                                                <td>
                                                    <button data-toggle="modal" data-target="#basicModal<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-info">Sub Types</button>
                                                    <a href="editinvestigation?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-primary">Edit</a>
                                                    <a href="removeinvestigationtype?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-danger" onclick="return confirm_delete<?php echo $investigationtype_id; ?>()">Remove</a>
                                                    <script type="text/javascript">
                                                        function confirm_delete<?php echo $investigationtype_id; ?>() {
                                                            return confirm('You are about To Remove this item. Are you sure you want to proceed?');
                                                        }
                                                    </script>
                                                    <a href="insuranceinvestigationcharges?id=<?php echo $investigationtype_id; ?>" target="_blank" class="btn btn-xs btn-primary">Insurance Prices</a>
                                                    <?php if ($range == 1) { ?>
                                                        <a href="rangeinvest?id=<?php echo $investigationtype_id; ?>" target="_blank" class="btn btn-xs btn-info">Range Value</a>
                                                    <?php } ?>
                                                    <?php if ($has_answers == 1) { ?>
                                                        <a href="investigationanswers?id=<?php echo $investigationtype_id; ?>" target="_blank" class="btn btn-xs btn-info">Answers</a>
                                                    <?php } ?>
                                                    <!-- <a href="rangeinvest?id=<?php echo $investigationtype_id; ?>" class="btn btn-xs btn-info">Range Value</a> -->
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
        $(document).on('click','#subanswer',function(){
            if ($(this).prop("checked")===true){
                $('.subobj23').show();
            }else{
                $('.subobj23').hide();

            }
        })
        $(document).on('click','.subtyperange',function(){
            if ($(this).prop("checked") === true) {
                $('.forsubtyperange').show();
                $('.forrange').hide();
                $('#subrange').prop('checked',false);
                $('.subrange').hide();
            } else {
                $('.forsubtyperange').hide();
                

                $('.forrange').show();
            }
        })
        $('#subrange').click(function() {
            if ($(this).prop("checked") === true) {
                $('.subrange').show();
                // $('.measurementunit').hide();
            } else {
                $('.subrange').hide();

                // $('.measurementunit').show();
            }
        });

        $('.subobj1_button').click(function(e) { //on add input button click
            e.preventDefault();
            if ($("#subtyperange").prop("checked")=== true){
                var sty = 'block';
            }else{
                var sty = 'none';
            }
            $(`.subobj1`).append(`<div class="row">
            <div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div>
            <div class="col-lg-8">
            <div class="row">  
            <div class="form-group col-lg-6"><label>Sub Type</label>
            <input type="text" class="form-control" name="subtype[]" required="required"> </div>      
            <div class="form-group col-lg-6">   
            <label class="control-label">Measurement Unit</label> 
            <select name="subtypeunit[]" class="form-control" id="category">     
            <option value="">select unit...</option>	
            <?php $getunits =  mysqli_query($con, "SELECT * FROM labunits WHERE status=1");   
            while ($row1 =  mysqli_fetch_array($getunits)) {
                                                                $measurement_id = $row1['measurement_id'];
                                                                                            $measurement = $row1['measurement']; ?>             
                                                                                            <option value="<?php echo $measurement_id; ?>"><?php echo $measurement; ?></option>                  
                                                                                            <?php } ?>                                
                                                                                            </select>       
                                                                                            </div>
                                                                                            <div class="forsubtyperange" style="display:`+sty+`;" >
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="normalX"> Normal Range X:</label>
                                                        <input type="number"  step="0.01" class="form-control" id="normalX" name="normalX1[]">
                                                    </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="normalY">Normal Range Y:</label>
                                                        <input type="number"  step="0.01" class="form-control" id="normalY" name="normalY1[]">
                                                    </div>
                                                    </div>
                                                </div>

                                                </div>
                                                                                            </div> 
                                                                                            </div> 
            <button class="remove_subobj1  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>`
            ); //add input box
        });
        $('.subobj1').on("click", ".remove_subobj1", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
        $('.subobj_button2').click(function(e){
            e.preventDefault();
            $('.subobj23').append(`<div class="row">
            
            <div class="col-lg-8">
            <div class="row">  <div class="form-group col-lg-6"><label> Answers</label>
            <input type="text" class="form-control" placeholder="Enter Measurement Type Answers" name="answers[]" required="required"> </div>
            <button class="remove_subobj23  btn btn-danger" style="height:30px;margin-top:22px;padding-top:5px;"><i class="fa fa-minus"></i></button></div>`
            );

        })
        $('.subobj23').on("click", ".remove_subobj23", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        $('.subobj_button').click(function(e) { //on add input button click
            e.preventDefault();
            $('.subobj').append(`<div class="row"><div class="col-lg-12"><hr style="border-top: dashed 1px #b7b9cc;"></div><div class="col-lg-11"><div class="row">  <div class="form-group col-lg-6">                                 <label>Insurance company</label>   <select name="company[]" class="form-control"> <option value="">Select company...</option>  <?php $getcompanies =  mysqli_query($con, "SELECT * FROM insurancecompanies WHERE status=1");
                                                                                                                                                                                                                                                                                                                                                                        while ($row1 =  mysqli_fetch_array($getcompanies)) {                                                                                                                                                                                                                                                                                                                                               $insurancecompany_id = $row1['insurancecompany_id'];
                                                                                                                                                                                                                                                                                                                                                                            $company = $row1['company'];           ?>    <option value="<?php echo $insurancecompany_id; ?>"><?php echo $company; ?></option>                       <?php } ?>                       </select>   </div><div class="form-group col-lg-6"><label class="control-label">Charge</label>                   <input type="number" name="insurancecharge[]" class="form-control" placeholder="Enter Service Price"></div></div></div> <button class="remove_subobj  btn btn-danger" style="height:30px;margin-top:22px"><i class="fa fa-minus"></i></button></div>`); //add input box
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