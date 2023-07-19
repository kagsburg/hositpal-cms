<?php
include 'includes/conn.php';
 $getdrugs= mysqli_query($con,"SELECT * FROM table_name") or die(mysqli_error($con));
  while($row= mysqli_fetch_array($getdrugs)){
                                             $genericname=$row['Generic_name'];
                                          $commercialname=$row['Commercial_name'];
                                          $pharmacologicalclass=$row['Pharmacological_class'];
                                          $pharmaceuticalform=$row['pharmaceutical_form'];
                                          $dosage=$row['Dosage'];
                                           $measurement_unit=$row['Measurement_unit'];
                                           $minimum=$row['Minimum_reorder_point'];
                                           $unitprice=$row['Prix'];  
                               $checkforms=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE  pharmaceuticalform='$pharmaceuticalform' AND status=1");
                               if(mysqli_num_rows($checkforms)==0){
                          mysqli_query($con, "INSERT INTO pharmaceuticalforms(pharmaceuticalform,status) VALUES('$pharmaceuticalform',1)") or die(mysqli_error($con));                      
  }
      
  $checkclasses=  mysqli_query($con,"SELECT * FROM pharmacologicalclasses WHERE  pharmacologicalclass='$pharmacologicalclass' AND status=1");
                               if(mysqli_num_rows($checkclasses)==0){
                          mysqli_query($con, "INSERT INTO pharmacologicalclasses(pharmacologicalclass,status) VALUES('$pharmacologicalclass',1)") or die(mysqli_error($con));                      
  }
    $checkunit=  mysqli_query($con,"SELECT * FROM unitmeasurements WHERE  measurement='$measurement_unit' AND status=1");
                               if(mysqli_num_rows($checkunit)==0){
                          mysqli_query($con, "INSERT INTO unitmeasurements(measurement,status) VALUES('$measurement_unit',1)") or die(mysqli_error($con));                      
  }
    $getform=  mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND  pharmaceuticalform='$pharmaceuticalform'");
                            $row1=  mysqli_fetch_array($getform);
                        $pharmaceuticalform_id=$row1['pharmaceuticalform_id'];
      $getclass=  mysqli_query($con,"SELECT * FROM pharmacologicalclasses WHERE status=1 AND pharmacologicalclass='$pharmacologicalclass'");
        $row2=  mysqli_fetch_array($getclass);
      $pharmacologicalclass_id=$row2['pharmacologicalclass_id'];
         $getunits=  mysqli_query($con,"SELECT * FROM unitmeasurements WHERE status=1 AND measurement='$measurement_unit'");
           $row3=  mysqli_fetch_array($getunits);
     $measurement_id=$row3['measurement_id'];
     $generic=mysqli_real_escape_string($con,$genericname);
     $commercial=mysqli_real_escape_string($con,$commercialname);
     $status=1;
//    mysqli_query($con, "DELETE FROM pharmacyitems WHERE pharmacyitem_id!=12");
  $checkitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 AND genericname='$generic'") or die(mysqli_error($con)); 
  // SQL with parameters
//$stmt = $con->prepare("SELECT * FROM pharmacyitems WHERE genericname=? AND status=?"); 
//$stmt->bind_param("si",$genericname,$status);
//$stmt->execute(); 
//$stmt->get_result();
if (mysqli_num_rows($checkitems)==0) {
echo $generic.' Name Not  Added';
 //$admin_id=9;   
$additem=  mysqli_query($con,"INSERT INTO pharmacyitems(genericname,commercialname,pharmacologicalclass_id,pharmaceuticalform_id,dosage,measurement_id,minimum,unitprice,admin_id,timestamp,status) VALUES('$generic','$commercial','$pharmacologicalclass_id','$pharmaceuticalform_id','$dosage','$measurement_id','$minimum','$unitprice','9','$timenow','1')") or die(mysqli_error($con));
//$stmt2 = $con->prepare("INSERT INTO pharmacyitems(genericname,commercialname,pharmacologicalclass_id,pharmaceuticalform_id,dosage,measurement_id,minimum,unitprice,admin_id,timestamp,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
//$stmt2->bind_param("ssssssssiii",$genericname,$commercialname,$pharmacologicalclass_id,$pharmaceuticalform_id,$dosage,$measurement_id,$minimum,$unitprice,$admin_id,$timenow,$status); 
//$stmt2->execute();
}
 }
?>