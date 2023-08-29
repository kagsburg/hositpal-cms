<?php
    include 'includes/conn.php';
    if (isset($_POST['submit'])){
       
        $investigationtype_id=mysqli_real_escape_string($con,trim($_POST['investigationtype_id']));
        $patientlab_id=mysqli_real_escape_string($con,trim($_POST['patientlab_id']));
        $has_answer=mysqli_real_escape_string($con,trim($_POST['has_answer']));
        $sampe_id=$_POST['sample'];
        $test=$_POST['test'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $result=$_POST['result'];
        $admission_id = $_POST['admission_id'];
        $patientque_id = $_POST['patientque_id'];
        $title=$_POST['title'];
        $unit=$_POST['unit'];
        $details=mysqli_real_escape_string($con,trim($_POST['details']));

        
    
       mysqli_query($con,"INSERT INTO labreports(title,sample_id,test,siunit,admission_id,start,end,result,patientsque_id, details,status,timestamp,admin_id,approved) 
       VALUES('$title[$investigationtype_id]','$sampe_id[$investigationtype_id]','$investigationtype_id','$unit[$investigationtype_id]','$admission_id','$start[$investigationtype_id]','$end[$investigationtype_id]','$result[$investigationtype_id]','$patientque_id','$details',1,UNIX_TIMESTAMP(),'".$_SESSION['elcthospitaladmin']."',0)") or die(mysqli_error($con));
        $last_id = mysqli_insert_id($con);
        $count = $_POST['count'];
       mysqli_query($con,"UPDATE patientlabs SET status='3' WHERE patientlab_id ='$patientlab_id'") or die(mysqli_error($con));

       if ($count == '1'){
        $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
           $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
           $prev_id = $row_prev_admin_id['prev_id'];
        // update conclusion
               $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='lab technician' and prev_id ='$prev_id'") or die(mysqli_error($con));
               if(mysqli_num_rows($checkpending)>0){
                     $row_id=mysqli_fetch_array($checkpending);
                     $patientque2_id=$row_id['patientsque_id'];
                     mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque2_id'") or die(mysqli_error($con));
                     mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                     $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
                     // redirect to radiowaiting
                     echo '<script>window.location.href = "labwaiting";</script>';exit();
               }else{
               
                  $prev_admin_id=$row_prev_admin_id['admin_id'];
                  $admission_id = $row_prev_admin_id['admission_id'];
                  mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                  $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
                  mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','lab technician',UNIX_TIMESTAMP(),1,'$prev_id')") or die(mysqli_error($con));
                           // redirect to labwaiting
                           echo '<script>window.location.href = "labwaiting";</script>';exit();
            }
      }else{
         $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
            $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
            $prev_id = $row_prev_admin_id['prev_id'];
         // status 8 is for radiology report but all tests are not done
         $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='lab technician' and prev_id ='$prev_id'") or die(mysqli_error($con));
         if(mysqli_num_rows($checkpending)>0){
            
               // redirect to labwaiting
               echo '<script>window.location.href = "labreportlist?id='.$patientque_id.'";</script>';exit();
         }else{
            $prev_admin_id=$row_prev_admin_id['admin_id'];
            $admission_id = $row_prev_admin_id['admission_id'];
         //    mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
            $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
            mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','lab technician',UNIX_TIMESTAMP(),8,'$prev_id')") or die(mysqli_error($con));
                     // redirect to labwaiting
                     echo '<script>window.location.href = "labreportlist?id='.$patientque_id.'";</script>';exit();
      }      
      }


    }
    if (isset($_POST['submitspecial'])){
      // print_r($_POST);
      $investigationtype_id=mysqli_real_escape_string($con,trim($_POST['investigationtype_id']));
        $patientlab_id=mysqli_real_escape_string($con,trim($_POST['patientlab_id']));
        $has_answer=mysqli_real_escape_string($con,trim($_POST['has_answer']));
        $sampe_id=$_POST['sample'];
        $test=$_POST['test'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $result=$_POST['result'];
        $admission_id = $_POST['admission_id'];
        $patientque_id = $_POST['patientque_id'];
        $title=$_POST['title'];
        $unit=$_POST['unit'];
        $subtype=$_POST['subtype'];
        $details=mysqli_real_escape_string($con,trim($_POST['details']));
      mysqli_query($con,"INSERT INTO labreports(title,sample_id,test,siunit,subtype,admission_id,start,end,result,patientsque_id, details,status,timestamp,admin_id,approved) 
      VALUES('$title[$investigationtype_id]','$sampe_id[$investigationtype_id]','$investigationtype_id','',1,'$admission_id','$start[$investigationtype_id]','$end[$investigationtype_id]','$result[$investigationtype_id]','$patientque_id','$details',1,UNIX_TIMESTAMP(),'".$_SESSION['elcthospitaladmin']."',0)") or die(mysqli_error($con));
       $last_id = mysqli_insert_id($con);
         $count = $_POST['count'];
         $countn= count($subtype);
         for ($i=0; $i < $countn; $i++) { 
            $sub = $subtype[$i];
            $subtest = $test[$sub];
            $subresult = $result[$sub];
            $subunit = $unit[$sub];
            mysqli_query($con,"INSERT INTO labreportsubtype(labreport_id,subtype_id,unit_id,results) 
            VALUES('$last_id','$sub','$subunit','$subresult')") or die(mysqli_error($con));
         }
      mysqli_query($con,"UPDATE patientlabs SET status='3' WHERE patientlab_id ='$patientlab_id'") or die(mysqli_error($con));
      if ($count == '1'){
         $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
            $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
            $prev_id = $row_prev_admin_id['prev_id'];
         // update conclusion
                $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='lab technician' and prev_id ='$prev_id'") or die(mysqli_error($con));
                if(mysqli_num_rows($checkpending)>0){
                      $row_id=mysqli_fetch_array($checkpending);
                      $patientque2_id=$row_id['patientsque_id'];
                      mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque2_id'") or die(mysqli_error($con));
                      mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                      $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
                      // redirect to radiowaiting
                      echo '<script>window.location.href = "labwaiting";</script>';exit();
                }else{
                
                   $prev_admin_id=$row_prev_admin_id['admin_id'];
                   $admission_id = $row_prev_admin_id['admission_id'];
                   mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
                   $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
                   mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','lab technician',UNIX_TIMESTAMP(),1,'$prev_id')") or die(mysqli_error($con));
                            // redirect to labwaiting
                            echo '<script>window.location.href = "labwaiting";</script>';exit();
             }
       }else{
          $get_prev_admin_id=mysqli_query($con,"SELECT * FROM patientsque WHERE patientsque_id='$patientque_id'") or die(mysqli_error($con));
             $row_prev_admin_id=mysqli_fetch_array($get_prev_admin_id);
             $prev_id = $row_prev_admin_id['prev_id'];
          // status 8 is for radiology report but all tests are not done
          $checkpending=mysqli_query($con,"SELECT * FROM patientsque WHERE status='8' and admintype='lab technician' and prev_id ='$prev_id'") or die(mysqli_error($con));
          if(mysqli_num_rows($checkpending)>0){
             
                // redirect to labwaiting
                echo '<script>window.location.href = "labreportlist?id='.$patientque_id.'";</script>';exit();
          }else{
             $prev_admin_id=$row_prev_admin_id['admin_id'];
             $admission_id = $row_prev_admin_id['admission_id'];
          //    mysqli_query($con,"UPDATE patientsque SET status='1' WHERE patientsque_id='$id'") or die(mysqli_error($con));
             $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Added</div>';
             mysqli_query($con,"INSERT INTO patientsque(admission_id,room,attendant,payment,admin_id,admintype,timestamp,status,prev_id) VALUES('$admission_id','doctor','$prev_admin_id','1','".$_SESSION['elcthospitaladmin']."','lab technician',UNIX_TIMESTAMP(),8,'$prev_id')") or die(mysqli_error($con));
                      // redirect to labwaiting
                      echo '<script>window.location.href = "labreportlist?id='.$patientque_id.'";</script>';exit();
       }      
       }

    }
    if(isset($_POST['submitspecialupdate'])){
      $investigationtype_id=mysqli_real_escape_string($con,trim($_POST['investigationtype_id']));
        $patientlab_id=mysqli_real_escape_string($con,trim($_POST['patientlab_id']));
        $has_answer=mysqli_real_escape_string($con,trim($_POST['has_answer']));
        $sampe_id=$_POST['sample'];
        $test=$_POST['test'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $labreport_id= mysqli_real_escape_string($con,trim($_POST['labreport_id']));
        $result=$_POST['result'];
        $admission_id = $_POST['admission_id'];
        $patientque_id = $_POST['patientque_id'];
        $title=$_POST['title'];
        $unit=$_POST['unit'];
        $subtype=$_POST['subtype'];
        $labrep=$_POST['labrep'];
        $details=mysqli_real_escape_string($con,trim($_POST['details']));
      mysqli_query($con,"UPDATE labreports set title='$title[$investigationtype_id]',sample_id='$sampe_id[$investigationtype_id]',start='$start[$investigationtype_id]',end='$end[$investigationtype_id]', details='$details' WHERE labreport_id='$labreport_id'") or die(mysqli_error($con));
      $countn = count($labrep);
      for ($i=0; $i < $countn; $i++) { 
         $labrep_id = $labrep[$i];
         $subresult = $result[$labrep_id];
         mysqli_query($con,"UPDATE labreportsubtype set results='$subresult' WHERE labsubtype_id ='$labrep_id'") or die(mysqli_error($con));
      }
      $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Updated</div>';
      
      // redirect to editlabreport
      header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if (isset($_POST['updatelabreport'])){
      $investigationtype_id=mysqli_real_escape_string($con,trim($_POST['investigationtype_id']));
      $patientlab_id=mysqli_real_escape_string($con,trim($_POST['patientlab_id']));
      $has_answer=mysqli_real_escape_string($con,trim($_POST['has_answer']));
      $labreport_id=mysqli_real_escape_string($con,trim($_POST['labreport_id']));
      $test=$_POST['test'];
      $sampe_id=$_POST['sample'];
      $start=$_POST['start'];
      $end=$_POST['end'];
      $result=$_POST['result'];
      $admission_id = $_POST['admission_id'];
      $patientque_id = $_POST['patientque_id'];
      $title=$_POST['title'];
      $unit=$_POST['unit'];
      $details=mysqli_real_escape_string($con,trim($_POST['details']));
      mysqli_query($con,"UPDATE labreports set title='$title[$investigationtype_id]',sample_id='$sampe_id[$investigationtype_id]',start='$start[$investigationtype_id]',end='$end[$investigationtype_id]',result='$result[$investigationtype_id]', details='$details' WHERE labreport_id='$labreport_id'") or die(mysqli_error($con));
      $_SESSION['success'] = '<div class="alert alert-success">Laboratory Report Successfully Updated</div>';
      // redirect to editlabreport
      header('Location:'.$_SERVER['HTTP_REFERER']);
       
    }
      ?> 