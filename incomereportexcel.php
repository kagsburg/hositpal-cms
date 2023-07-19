<?php
include 'includes/conn.php';
 if(!isset($_SESSION['elcthospitaladmin'])){
header('Location:login.php');
   }else{
     $startdate=$_GET['st'];
   $enddate=$_GET['en'];
      $sec=$_GET['sec'];
          $getcategories=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$sec'");
                            $row1=  mysqli_fetch_array($getcategories);
                                              $servicecategory_id=$row1['servicecategory_id'];
                                              $servicecategory=$row1['servicecategory'];            
   $delimiter = ",";
if((isset($_SESSION['lan']))&&($_SESSION['lan']=='fr')){ 
                                           include 'fr/incomereportexcel.php';                     
                                       }else{
  $filename =$servicecategory." Income Report  between ".date('d/M/Y',$startdate)." and ".date('d/M/Y',$enddate).".csv";    
    $f = fopen('php://memory', 'w');                          
    $fields = array('Date','Section','Income');
                                       }
       fputcsv($f, $fields, $delimiter);
          $total=0;
                                        if($sec=='all'){
      $getorder= mysqli_query($con,"SELECT * FROM serviceorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
      while ($rowo= mysqli_fetch_array($getorder)){
  $timestamp=$rowo['timestamp'];   
     $patientsque_id=$rowo['patientsque_id'];
   $serviceorder_id=$rowo['serviceorder_id'];
    $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE  payment=1 AND patientsque_id='$patientsque_id'");  
                                    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                          $admin_id=$row['admin_id'];
                                          $attendant=$row['attendant']; 
                   $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$room'");
                             $row4=  mysqli_fetch_array($getcategory);
                           $servicecategory=$row4['servicecategory'];
       $getordered= mysqli_query($con,"SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                    $totalcharge=0;      
       while($row= mysqli_fetch_array($getordered)){
                                $medicalservice_id=$row['medicalservice_id'];
                                  $unitcharge=$row['charge'];
                               $totalcharge=$totalcharge+$unitcharge;
                              $getservice=mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");  
                              $row2 = mysqli_fetch_array($getservice);
                                   $medicalservice=$row2['medicalservice'];
  }
  $total=$totalcharge+$total;
             
   $lineData = array(date('d/M/Y',$timestamp),$servicecategory,$totalcharge);
   fputcsv($f, $lineData, $delimiter);
                                     }
       $pharmacytotal=0;
           $getorder= mysqli_query($con,"SELECT * FROM pharmacyorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
      while($rowo= mysqli_fetch_array($getorder)){
  $timestamp=$rowo['timestamp'];   
   $pharmacyorder_id=$rowo['pharmacyorder_id'];
      $patientsque_id=$rowo['patientsque_id'];
     $ordertotal=0;
    $getordered= mysqli_query($con,"SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id' AND status=1") or die(mysqli_error($con));
                            while($row= mysqli_fetch_array($getordered)){
                                $item=$row['item_id'];
                                $prescription=$row['prescription'];
                                $quantity=$row['quantity'];
                               $split= explode('_', $item);
                               $item_id= current($split);
                               $unitprice=end($split);
                               $ordertotal=$ordertotal+($unitprice*$quantity);
                            }
                        $pharmacytotal=$pharmacytotal+$ordertotal;
          $lineData = array(date('d/M/Y',$timestamp),'PHARMACIE',$ordertotal);
   fputcsv($f, $lineData, $delimiter);
      }
       $ambulanttotal=0;
                           $getambulantorders= mysqli_query($con,"SELECT * FROM ambulantorders WHERE status=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'") or die(mysqli_error($con));
                       while ($rowa = mysqli_fetch_array($getambulantorders)) {
                   $ambulantorder_id=$rowa['ambulantorder_id'];
                          $ambulantsubtotal=0;
                        $getproducts= mysqli_query($con,"SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$ambulantorder_id' AND status=1");
                   while($row1= mysqli_fetch_array($getproducts)){
                   $ambulantordereditem_id=$row1['ambulantordereditem_id'];
                   $item_id=$row1['item_id'];
                   $quantity=$row1['quantity'];
                   $cpfigure=$row1['cpfigure'];
                   $unitprice=$row1['unitprice']; 
                  $subtotal=$quantity*$unitprice;
                  $ambulantsubtotal=$subtotal+$ambulantsubtotal;
                   }
                   $ambulanttotal=$ambulanttotal+$ambulantsubtotal;
                        $lineData = array(date('d/M/Y',$timestamp),'PHARMACIE',$ambulantsubtotal);
   fputcsv($f, $lineData, $delimiter);
                       }
                   } else{ 
           $getorder= mysqli_query($con,"SELECT * FROM serviceorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
      while ($rowo= mysqli_fetch_array($getorder)){
  $timestamp=$rowo['timestamp'];   
     $patientsque_id=$rowo['patientsque_id'];
   $serviceorder_id=$rowo['serviceorder_id'];
    $getque=mysqli_query($con,"SELECT * FROM patientsque WHERE  payment=1 AND patientsque_id='$patientsque_id' AND room='$sec'");  
    if(mysqli_num_rows($getque)>0){                          
    $row = mysqli_fetch_array($getque);
                                          $patientsque_id=$row['patientsque_id'];
                                          $admission_id=$row['admission_id'];
                                          $room=$row['room'];
                                          $admin_id=$row['admin_id'];
                                          $attendant=$row['attendant']; 
                   $getcategory=  mysqli_query($con,"SELECT * FROM servicecategories WHERE status=1 AND servicecategory_id='$room'");
                             $row4=  mysqli_fetch_array($getcategory);
                           $servicecategory=$row4['servicecategory'];
       $getordered= mysqli_query($con,"SELECT * FROM patientservices WHERE serviceorder_id='$serviceorder_id' AND status=1") or die(mysqli_error($con));
                                    $totalcharge=0;      
       while($row= mysqli_fetch_array($getordered)){
                                $medicalservice_id=$row['medicalservice_id'];
                                  $unitcharge=$row['charge'];
                               $totalcharge=$totalcharge+$unitcharge;
                              $getservice=mysqli_query($con,"SELECT * FROM medicalservices WHERE status=1 AND medicalservice_id='$medicalservice_id'");  
                              $row2 = mysqli_fetch_array($getservice);
                                   $medicalservice=$row2['medicalservice'];
  }
  $total=$totalcharge+$total;
      $lineData = array(date('d/M/Y',$timestamp),$servicecategory,$totalcharge);
   fputcsv($f, $lineData, $delimiter);
      } }
       $pharmacytotal=0;
       $ambulanttotal=0;
       if($sec==17){
           $getorder= mysqli_query($con,"SELECT * FROM pharmacyorders WHERE  payment=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'");
      while($rowo= mysqli_fetch_array($getorder)){
  $timestamp=$rowo['timestamp'];   
   $pharmacyorder_id=$rowo['pharmacyorder_id'];
      $patientsque_id=$rowo['patientsque_id'];
     $ordertotal=0;
    $getordered= mysqli_query($con,"SELECT * FROM pharmacyordereditems WHERE pharmacyorder_id='$pharmacyorder_id' AND status=1") or die(mysqli_error($con));
                            while($row= mysqli_fetch_array($getordered)){
                                $item=$row['item_id'];
                                $prescription=$row['prescription'];
                                $quantity=$row['quantity'];
                               $split= explode('_', $item);
                               $item_id= current($split);
                               $unitprice=end($split);
                               $ordertotal=$ordertotal+($unitprice*$quantity);
                            }
                        $pharmacytotal=$pharmacytotal+$ordertotal;
                           $lineData = array(date('d/M/Y',$timestamp),'PHARMACIE',$ordertotal);
   fputcsv($f, $lineData, $delimiter);
      }
         $getambulantorders= mysqli_query($con,"SELECT * FROM ambulantorders WHERE status=1 AND  timestamp>='$startdate' AND timestamp<='$enddate'") or die(mysqli_error($con));
                  while ($rowa = mysqli_fetch_array($getambulantorders)) {
                   $ambulantorder_id=$rowa['ambulantorder_id'];
                    $ambulantsubtotal=0;
                        $getproducts= mysqli_query($con,"SELECT * FROM ambulantordereditems WHERE ambulantorder_id='$ambulantorder_id' AND status=1");
                   while($row1= mysqli_fetch_array($getproducts)){
                   $ambulantordereditem_id=$row1['ambulantordereditem_id'];
                   $item_id=$row1['item_id'];
                   $quantity=$row1['quantity'];
                   $cpfigure=$row1['cpfigure'];
                   $unitprice=$row1['unitprice']; 
                  $subtotal=$quantity*$unitprice;
                  $ambulantsubtotal=$subtotal+$ambulantsubtotal;
                   }
                   $ambulanttotal=$ambulanttotal+$ambulantsubtotal;
         $lineData = array(date('d/M/Y',$timestamp),'PHARMACIE',$ambulantsubtotal);
   fputcsv($f, $lineData, $delimiter);
     }       
                          }   }
                       $totalincome=$total+$pharmacytotal+$ambulanttotal;
               $lineData = array('TOTAL','',$totalincome);
   fputcsv($f, $lineData, $delimiter);
                fseek($f, 0);    

    header('Content-Type: text/xls');

    header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
   }
?>