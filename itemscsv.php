<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }else{
                
   $delimiter = ",";
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/itemscsv.php';                     
                                       }else{
    $filename ="Stock items as of ".date('d/M/Y',$timenow).".csv";    

    $f = fopen('php://memory', 'w');                          
               
      $fields = array('Id Number','Generic Name','Commercial Name','Unit of Measure','Pharmacological class','Pharmaceutical form','Dosage','Minimum Unit','Unit Price','In Stock');
                                       }
       fputcsv($f, $fields, $delimiter);
   $totaldisbursed=0;
                            $getitems=mysqli_query($con,"SELECT * FROM pharmacyitems WHERE status=1 ORDER BY commercialname");  
                                     while ($row = mysqli_fetch_array($getitems)) {
                                      $pharmacyitem_id=$row['pharmacyitem_id'];
                                          $genericname=$row['genericname'];
                                          $commercialname=$row['commercialname'];
                                          $pharmacologicalclass_id=$row['pharmacologicalclass_id'];
                                          $pharmaceuticalform_id=$row['pharmaceuticalform_id'];
                                          $dosage=$row['dosage'];
                                           $measurement_id=$row['measurement_id'];
                                           $minimum=$row['minimum'];
                                           $unitprice=$row['unitprice'];
                                          $getclass=  mysqli_query($con,"SELECT * FROM pharmacologicalclasses WHERE status=1 AND pharmacologicalclass_id='$pharmacologicalclass_id'");
                                           $row1=  mysqli_fetch_array($getclass);
                                           $pharmacologicalclass=$row1['pharmacologicalclass'];
                                  $getforms=mysqli_query($con,"SELECT * FROM pharmaceuticalforms WHERE status=1 AND pharmaceuticalform_id='$pharmaceuticalform_id'");
                                    $row3=  mysqli_fetch_array($getforms);
                                    $pharmaceuticalform=$row3['pharmaceuticalform'];
                                       $getunit=  mysqli_query($con,"SELECT * FROM unitmeasurements WHERE status=1 AND measurement_id='$measurement_id'");
                            $row2=  mysqli_fetch_array($getunit);
                                 $measurement=$row2['measurement'];
                                   $getstock= mysqli_query($con, "SELECT SUM(quantity) as totalstock FROM stockitems WHERE product_id='$pharmacyitem_id'") or die(mysqli_error($con));
                     $row4= mysqli_fetch_array($getstock);
                     $totalstock=$row4['totalstock'];     
                     $totalordered=0;
                      $getordered= mysqli_query($con, "SELECT * FROM ordereditems WHERE item_id='$pharmacyitem_id'") or die(mysqli_error($con));
                      while($row5= mysqli_fetch_array($getordered)){
                          $stockorder_id=$row5['stockorder_id'];
                          $quantity=$row5['quantity'];
                        $totalordered=$totalordered+$quantity;
                       }
                       $instock=$totalstock-$totalordered;
             
   $lineData = array( '#'.$pharmacyitem_id,$genericname,$commercialname,$measurement,$pharmacologicalclass,$pharmaceuticalform,$dosage,$minimum,$unitprice,$instock);

        fputcsv($f, $lineData, $delimiter);
                                     }
                fseek($f, 0);    

    header('Content-Type: text/xls');

    header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
   }
?>