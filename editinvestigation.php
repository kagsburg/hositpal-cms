<?php
include 'includes/conn.php';
if (($_SESSION['elcthospitallevel'] != 'admin')) {
    header('Location:login.php');
}
$invest_id = $_GET['id'];
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
                                <h4 class="card-title">Edit Measurement Type</h4>
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
                                        if ((empty($typename)) || (empty($classification))) {
                                            echo '<div class="alert alert-danger"><i class="fa fa-warning"></i>Fill The Field To Proceed</div>';
                                        } else {

                                            mysqli_query($con, "UPDATE investigationtypes set investigationtype='$typename',unitprice='$unitprice',creditprice='$creditprice',classification_id='$classification',unit_id='$unit' WHERE investigationtype_id='$invest_id'") or die(mysqli_error($con));                                      
                                            
                                            echo '<div class="alert alert-success"><i class="fa fa-check"></i>Measurement Type Successfully Updated</div>';
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <?php 
                                        $gettypes =  mysqli_query($con, "SELECT * FROM investigationtypes WHERE status=1 and investigationtype_id ='$invest_id'");
                                        $row =  mysqli_fetch_array($gettypes);
                                        $investigationtype_id = $row['investigationtype_id'];
                                        $investigationtype = $row['investigationtype'];
                                        $classification_id2 = $row['classification_id'];
                                        $unit_id = $row['unit_id'];
                                        $unitprice = $row['unitprice'];
                                        $creditprice = $row['creditprice'];
                                        $range = $row['range_type'];
                                        $has_answers = $row['has_answers'];

                                        
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-4">
                                            <?php if ($range == 1) { ?>
                                                        <a href="rangeinvest?id=<?php echo $investigationtype_id; ?>" target="_blank" class="btn btn-xs btn-info">Edit Range Value</a>
                                                    <?php } ?>
                                                    <?php if ($has_answers == 1) { ?>
                                                        <a href="investigationanswers?id=<?php echo $investigationtype_id; ?>" target="_blank" class="btn btn-xs btn-info">Edit Answers</a>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label>Measurement Type</label>
                                                <input type="text" class="form-control" name="typename" value="<?php echo $investigationtype  ?>" required="required">
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
                                                            <option value="<?php echo $classification_id; ?>" <?php if ($classification_id2 == $classification_id){?> selected <?php }?>><?php echo $classification; ?></option>
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
                                                            <option value="<?php echo $measurement_id; ?>"<?php if ($unit_id == $measurement_id){?> selected <?php }?>><?php echo $measurement; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4 unitprice">
                                                <label>Unit Price</label>
                                                <input type="number" class="form-control" name="unitprice" value="<?php echo $unitprice ?>">
                                            </div>

                                            <div class="form-group col-lg-4 creditprice">
                                                <label>Credit Price</label>
                                                <input type="number" class="form-control" name="creditprice" value="<?php echo $creditprice ?>">
                                            </div>
                                        <div class="col-sm-12"></div>    
                                        <!-- <h5><strong>Add Insurance Charges</strong></h5>
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
                                        </div> -->
                                            
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
                                                    <div class="col">
                                                    <label class="form-check-label">Low Range</label>
                                                    <div class="mb-3">
                                                        <label for="lowX">X: <span id="low"></span></label>
                                                        <input type="number"  value="" class="form-control" id="lowX" name="lowX1[]">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lowY">Y:</label>
                                                        <input type="number" class="form-control" id="lowY" name="lowY1[]">
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                    <label class="form-check-label">Normal Range</label>
                                                    <div class="mb-3">
                                                        <label for="normalX">X:</label>
                                                        <input type="number" class="form-control" id="normalX" name="normalX1[]">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="normalY">Y:</label>
                                                        <input type="number" class="form-control" id="normalY" name="normalY1[]">
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                    <label class="form-check-label">High Range</label>
                                                    <div class="mb-3">
                                                        <label for="highX">X:</label>
                                                        <input type="number" class="form-control"  id="highX" name="highX1[]">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="highY">Y:</label>
                                                        <input type="number" class="form-control" id="highY" name="highY1[]">
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