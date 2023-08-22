  <?php
  $getstaff = mysqli_query($con, "SELECT * FROM staff WHERE status=1  AND staff_id='" . $_SESSION['elcthospitaladmin'] . "'");
  $row = mysqli_fetch_array($getstaff);
  $adminname = $row['fullname'];
  $adminrole = $row['role'];
  $adminext = $row['ext'];
  $admin_id = $row['staff_id'];
  ?>
  <div class="nav-header">
    <a href="index" class="brand-logo">
      <img class="logo-abbr" src="images/logo.png?dldldld" alt="">
      <!--                <img class="logo-compact" src="images/logo-text.png" alt="">
                <img class="brand-title" src="images/logo-text.png" alt="">-->
    </a>

    <div class="nav-control">
      <div class="hamburger">
        <span class="line"></span><span class="line"></span><span class="line"></span>
      </div>
    </div>
  </div>

  <div class="header">
    <div class="header-content">
      <nav class="navbar navbar-expand">
        <div class="collapse navbar-collapse justify-content-between">
          <div class="header-left">
            <div class="dashboard_bar">
              Nyakato Health Center
            </div>
          </div>

          <ul class="navbar-nav header-right">



            <li class="nav-item dropdown header-profile">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                <div class="header-info">
                  <span><?php echo $adminname; ?></span>
                  <small><?php echo $adminrole; ?></small>
                </div>
                <?php
                if (empty($adminext)) {
                ?>
                  <img src="images/avatar.png" width="20" alt="" />
                <?php } else { ?>
                  <img src="images/employees/thumbs/<?php echo md5($admin_id) . '.' . $adminext . '?' .  time(); ?>" width="20" alt="" />
                <?php } ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right">

                <a href="logout" class="dropdown-item ai-icon">

                  <span class="ml-2">Logout </span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="deznav">
    <div class="deznav-scroll">
      <ul class="metismenu" id="menu">
        <li>
          <a class="ai-icon" href="index" aria-expanded="false">
            <i class="fa fa-home"></i>
            <span class="nav-text">Home</span>
          </a>


        </li>
        <?php
        if (($_SESSION['elcthospitallevel'] == 'admin')) {
        ?>
          <li>
            <a class="ai-icon" href="departments" aria-expanded="false">
              <i class="fa fa-building"></i>
              <span class="nav-text">Departments</span>
            </a>

          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-user"></i>
              <span class="nav-text">Employees</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="qualifications">Qualifications</a></li>
              <li><a href="designations">Designations</a></li>
              <li><a href="addemployee">Add Employee</a></li>
              <li><a href="employees">Employees</a></li>
              <li><a href="salarylevels">Salary Levels</a></li>

            </ul>
          </li>
          <li>
            <a class="ai-icon" href="patients" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">All Patients</span>
            </a>
          </li>

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Payments</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pendingpayments">Pending Payments</a></li>
              <li><a href="fullypaid">Paid</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-file-1"></i>
              <span class="nav-text">Credit clients</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addcreditclient">Add Client</a></li>
              <li><a href="creditclients">View clients</a></li>
              <li><a href="pendingsubscribers">Pending Subscribers</a></li>
              <li><a href="subscribers">Subscribers</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Inventory</span>
            </a>
            <ul aria-expanded="false">
            <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <!-- <i class="flaticon-381-settings-2"></i> -->
              <span class="nav-text">Categories</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="itemscategories?cat=Medicine">Medicine Categories</a></li>
              <li><a href="itemscategories?cat=Medical items"> Medical Items Categories</a></li>
              <li><a href="itemscategories?cat=Non Medical items">Non Medical Items Categories</a></li>

            </ul>
          </li>
              <li><a href="items?ty=Medicine">Medicine</a></li>
              <li><a href="additem?ty=Medicine&sub=NULL">Add Medicine</a></li>
              <li><a href="items?ty=Medical">Medical Items</a></li>
              <li><a href="additem?ty=Medical&sub=NULL">Add Medical item</a></li>
              <li><a href="items?ty=Non Medical">Non Medical Items</a></li>
              <li><a href="additem?ty=Non Medical&sub=NULL">Add Non Medical item</a></li>
              <li><a href="measurements">Units of Measure</a></li>
              <li><a href="stores">Stores</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-settings-2"></i>
              <span class="nav-text">Purchases</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="stockorders?ty=1">Supplier Orders</a></li>
              <li><a href="stockorders?ty=0">Non Supplier Orders</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()">
              <i class="fa fa-book"></i> <span class="nav-text"> Orders</span>
            </a>
            <ul>
              <li><a href="viewpharstock">Stock Order</a></li>
              <li><a href="stockneworders">Requisition Order</a></li>
            </ul>
          </li>
         
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-user-circle"></i>
              <span class="nav-text">Suppliers</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addsupplier">Add Supplier</a></li>
              <li><a href="suppliers">View Suppliers</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-hospital-o"></i>
              <span class="nav-text">Wards</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addward">Add Ward</a></li>
              <li><a href="wards">View Wards</a></li>
              <li><a href="wardtypes">Ward Types</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-stethoscope"></i>
              <span class="nav-text">Medical Services</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addmedicalservice?id=NULL">Add Medical Service</a></li>
              <li><a href="medicalservices">Medical Services</a></li>
              <li><a href="unselectiveservices">Mandatory Services</a></li>
              <li><a href="medical_sections">Medical Sections</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-flask"></i>
              <span class="nav-text">Laboratory</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="measurementclassifications">Measurement Classifications</a></li>
              <li><a href=" measurementunits">Measurement Units</a></li>
              <li><a href="investigationtypes">Measurement Types</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-rss"></i>
              <span class="nav-text">Radiography</span>
            </a>
            <ul aria-expanded="false">

              <!-- <li><a href="radiographyunits">SI unit / Result</a></li> -->
              <li><a href="radiographyinvestigationtypes">Investigation Types</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-medkit"></i>
              <span class="nav-text">Diseases</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="diseases">View Diseases</a></li>
              <li><a href="adddisease">Add Disease</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-bar-chart"></i>
              <span class="nav-text">Reports</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="paymentreports">Payments reports</a></li>
              <li><a href="adddisease">Inventory reports</a></li>
              <li><a href="adddisease">Patient reports</a></li>
              <li><a href="adddisease">Employee reports</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-notepad"></i>
              <span class="nav-text">Insurance Companies</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="insurance">Insurance Companies</a></li>
              <li><a href="addinsurance">Add Company</a></li>

            </ul>
          </li>




        <?php }
        if (($_SESSION['elcthospitallevel'] == 'insurance officer')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-user"></i>
              <span class="nav-text">Patients</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="insurancepending">Pending Registrations</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="insuranceapproved" aria-expanded="false">
              <i class="flaticon-381-user"></i>
              <span class="nav-text">Insurance Patients</span>
            </a>
          </li>
         
          <li>
          <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="fa fa-reply"></i>
              <span class="nav-text">Requisition</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addissurequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="otherstockorders?section=insurance">View Requisitions</a></li>
              <!-- <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li> -->
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'head physician')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
            <li><a href="doctorwaiting?mode=2">Emergency List</a></li>
              <li><a href="doctorwaiting?mode=1">Waiting List</a></li>
              <li><a href="doctorcleared">Patient With Results</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-share"></i>
              <span class="nav-text">In Patients</span>
            </a>
            <ul aria-expanded="false">
              <!-- <li><a href="inpatients">Operated Patients</a></li> -->
              <li><a href="admitted">Admitted Patients</a></li>
              <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                  <span class="nav-text">Operations</span>
                </a>
                <ul aria-expanded="false">
                  <li><a href="operationswaiting">Awaiting Patients</a></li>
                  <li><a href="operationscleared">Operated Patients</a></li>
                </ul>
              </li>
            </ul>
          </li> 
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="adddoctorrequisition?ty=Medicine">Request Medicine </a></li>
              <li><a href="adddoctorrequisition?ty=Medical">Request Medical Items</a></li>
              <li><a href="adddoctorrequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="doctorstockorders">View Requisitions</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-stack-overflow"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pharstock">View Stock</a></li>
              <li><a href="viewpharstock">View Stock Requests</a></li>
                  <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false"> Request Stock</a>
                  <ul aria-expanded="false">
                  <li><a href="addpharstock?ty=Medicine">Request Medicine</a></li>
                  <li><a href="addpharstock?ty=Medical">Request Medical Items</a></li>
                  </ul>
                </li> -->
            </ul>
          </li>
          <!-- <li>
            <a href="viewpharstock">
              <i class="fa fa-book"></i> <span class="nav-text">Stock Orders</span>
            </a>
          </li> -->
          <li>
            <a  href="stockneworders" aria-expanded="false">
              <i class="fa fa-book"></i>
              <span class="nav-text">Requisition Orders</span>
            </a>
            <!-- <ul aria-expanded="false">
              <li><a href="stockneworders?ty=Medicine">Medicine Orders</a></li>
              <li><a href="stockneworders?ty=Medical">Medical Item Orders</a></li>
              <li><a href="stockneworders?ty=Non Medical">Non Medical Items Orders</a></li>
            </ul> -->
          </li>
          <li>
            <a class="ai-icon" href="reports" aria-expanded="false">
              <i class="fa fa-pie-chart"></i>
              <span class="nav-text">Reports</span>
            </a>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'receptionist')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Registration</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addpatient">Add Patient</a></li>
              <li><a href="registrationpending">Pending Registrations</a></li>
              <li><a href="cliniccli"> Clinic Clients </a></li>

            </ul>
          </li>

          <li>
            <a class="ai-icon" href="patients" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Patients</span>
            </a>
          </li>

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-user"></i>
              <span class="nav-text">Subscriptions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addpaymentmethod">Add Subscription</a></li>
              
                  
                  <li><a href="insurancepending">Pending Insurance</a></li>
                  <!-- <li><a href="insuranceapproved">Approved Insurance</a></li> -->
                
                  <li><a href="pendingsubscribers">Pending Credit</a></li>
                  <!-- <li><a href="insuranceapproved">Approved Insurance</a></li> -->
                
            </ul>
            <!-- <li><a href="">Method of payment</a></li>
              <li><a href="insurancepending">Insurance Payment Verifications</a></li>
              <li><a href="creditpending">Credit Payment Verifications</a></li>
              <li><a href="cashierpending">Registration Pending Clearance</a></li> -->
          </li>
          <li>
          <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="fa fa-reply"></i>
              <span class="nav-text">Requisition</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addresprequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="otherstockorders?section=reception">View Requisitions</a></li>
              <!-- <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li> -->
            </ul>
          </li>


          <li>
            <a class="ai-icon" href="inpatients" aria-expanded="false">
              <i class="fa fa-share"></i>
              <span class="nav-text">In Patients</span>
            </a>
          </li>
          <li>
            <a class="ai-icon" href="outpatients" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Out Patients</span>
            </a>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'cashier')) {
        ?>
          <li>
            <a class="ai-icon" href="pendingpayments" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Pending Payments</span>
            </a>
          </li>
          <li>
            <a class="ai-icon" href="fullypaid" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Paid</span>
            </a>
          </li>
          <li>
          <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="fa fa-reply"></i>
              <span class="nav-text">Requisition</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addcashrequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="otherstockorders?section=cashier">View Requisitions</a></li>
              <!-- <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li> -->
            </ul>
          </li>
          
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'accountant')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Outstanding Bills</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="outstanding?paymethod=insurance">Insurance</a></li>
              <li><a href="outstanding?paymethod=credit">Credit</a></li>
              <li><a href="outstanding?paymethod=cash">Cash</a></li> 
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Paid Bills</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="fullypaid?paymethod=insurance">Insurance</a></li>
              <li><a href="fullypaid?paymethod=credit">Credit</a></li>
              <li><a href="fullypaid?paymethod=cash">Cash</a></li>
            </ul>
          </li>
          
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-settings-2"></i>
              <span class="nav-text">Purchases</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="stockorders?ty=1">Supplier Orders</a></li>
              <li><a href="stockorders?ty=0">Non Supplier Orders</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <!-- <li><a href="stock">View Items</a></li> -->
              <li><a href="stock?ty=Medicine">Medicine</a></li>
                <li><a href="stock?ty=Medical">Medical Items</a></li>
                <li><a href="stock?ty=Non Medical">Non Medical Items</a></li>
              <!-- <li><a href="pharmacystock">Pharmacy Stock</a></li> -->
              <!-- <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li> -->
            </ul>
          </li>
          <li>
          <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
          <i class="fa fa-reply"></i>
              <span class="nav-text">Requisition</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="otherstockorders?section=accountant">View Requisitions</a></li>
              <!-- <li><a href="addaccstock?ty=Non Medical">Request Non Medical Items</a></li> -->
            </ul>
          </li>          
          
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Reports</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="getincomereport">Income Reports</a></li>
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'nurse')) {
        ?>

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
                   <li><a href="waitingpatients">Waiting List </a></li>
                  <li><a href="outpatients">Outpatients</a></li>
              <!-- <li><a href="registrationrequests">Triage</a></li> -->
            </ul>
          </li>
          <li><a class=" ai-icon" href="registrationrequests">
          <i class="fa fa-building"></i>Triage</a></li>
          <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                  <i class="fa fa-users"></i>
                  <span class="nav-text">Inpatients</span>
                </a>
                <ul aria-expanded="false">
                  <li><a href="admitted">Admitted</a></li>
                  <li><a href="operationscleared">Operated</a></li>
                </ul>
              </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-building"></i>
              <span class="nav-text">Clinic Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addclinicclient">Add Client</a></li>
              <li><a href="clinicclients">Registered List</a></li>
              <li><a href="clinicclients?ty=1">Waiting List</a></li>
              <li><a href="clinicwaiting?ty=medical_service">Attended List</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="ai-icon" href="doctorwaiting" aria-expanded="false">
              <i class="fa fa-snowflake-o"></i>
              <span class="nav-text">Refrigerator</span>
            </a>
          </li> -->
          <!-- <li>
            <a class="ai-icon" href="nursecommunication" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Communication</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addnurserequisition?ty=Medicine">Request Medicine </a></li>
              <li><a href="addnurserequisition?ty=Medical">Request Medical Items</a></li>
              <li><a href="addnurserequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="nursestockorders">View Requisitions</a></li>
            </ul>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'patron')) {
        ?>
         <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
                   <li><a href="waitingpatients">Waiting List </a></li>
                  <li><a href="outpatients">Outpatients</a></li>
            </ul>
          </li>         
          <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                  <i class="fa fa-users"></i>
                  <span class="nav-text">Inpatients</span>
                </a>
                <ul aria-expanded="false">
                  <li><a href="admitted">Admitted</a></li>
                  <li><a href="operationscleared">Operated</a></li>
                </ul>
              </li>
          <li>
            

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-building"></i>
              <span class="nav-text">Clinic Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addclinicclient">Add Client</a></li>
              <li><a href="clinicclients">Clients</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-tasks"></i>
              <span class="nav-text">Timetable Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addtimetable">Add Timetable</a></li>
              <li><a href="timetable">View Timetable</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="doctorwaiting" aria-expanded="false">
              <i class="fa fa-user-times"></i>
              <span class="nav-text">Medical Staff Management</span>
            </a>
          </li>
          <!-- <li>
            <a class="ai-icon" href="doctorwaiting" aria-expanded="false">
              <i class="fa fa-comment"></i>
              <span class="nav-text">Communication</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addnurserequisition?ty=Medicine">Request Medicine </a></li>
              <li><a href="addnurserequisition?ty=Medical">Request Medical Items</a></li>
              <li><a href="addnurserequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="nursestockorders">View Requisitions</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="reports" aria-expanded="false">
              <i class="fa fa-pie-chart"></i>
              <span class="nav-text">Reports</span>
            </a>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'doctor')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
            <li><a href="doctorwaiting?mode=2">Emergency List</a></li>
              <li><a href="doctorwaiting?mode=1">Waiting List</a></li>
              <li><a href="doctorcleared">Patient With Results</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-share"></i>
              <span class="nav-text">In Patients</span>
            </a>
            <ul aria-expanded="false">
              <!-- <li><a href="inpatients">Operated Patients</a></li> -->
              <li><a href="admitted">Admitted Patients</a></li>
              <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                  <i class="fa fa-wrench"></i>
                  <span class="nav-text">Operations</span>
                </a>
                <ul aria-expanded="false">
                  <li><a href="operationswaiting">Awaiting Patients</a></li>
                  <li><a href="operationscleared">Operated Patients</a></li>
                </ul>
              </li>
            </ul>
          </li> 
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="adddoctorrequisition?ty=Medicine">Request Medicine </a></li>
              <li><a href="adddoctorrequisition?ty=Medical">Request Medical Items</a></li>
              <li><a href="adddoctorrequisition?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="doctorstockorders">View Requisitions</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="reports" aria-expanded="false">
              <i class="fa fa-pie-chart"></i>
              <span class="nav-text">Reports</span>
            </a>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'lab technician')) {
        ?>
        <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
            <li><a href="labwaiting?mode=2">Emergency List</a></li>
              <li><a href="labwaiting?mode=1">Waiting List</a></li>
              <li><a href="labcleared">Patient With Results</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="ai-icon" href="labwaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>

          </li> -->
          <!-- <li>
            <a class="ai-icon" href="clinicwaiting?ty=lab" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Clinic Patients</span>
            </a>

          </li> -->
          
          <!-- <li>
            <a class="ai-icon" href="labcleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Lab Results</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addlabstock?ty=Medicine">Request Medicine </a></li>
              <li><a href="addlabstock?ty=Medical">Request Medical Items</a></li>
              <li><a href="addlabstock?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="labstockorders">View Requisitions</a></li>
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'lab technologist')) {
          ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
            <li><a href="labwaiting?mode=2">Emergency List</a></li>
              <li><a href="labwaiting?mode=1">Waiting List</a></li>
              <li><a href="labcleared">Patient With Results</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="ai-icon" href="labwaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>
          </li> -->
          <!-- <li>
            <a class="ai-icon" href="clinicwaiting?ty=lab" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Clinic Patients</span>
            </a>

          </li> -->
          <!-- <li>
            <a class="ai-icon" href="labcleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Lab Results</span>
            </a>
          </li> -->
          <!-- <li>
            <a class="ai-icon" href="labresults" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Lab Results</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addlabstock?ty=Medicine">Request Medicine Items</a></li>
              <li><a href="addlabstock?ty=Medical">Request Medical Items</a></li>
              <li><a href="addlabstock?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="labstockorders">View Requisitions</a></li>
            </ul>
          </li>

          <?php }
        if (($_SESSION['elcthospitallevel'] == 'radiographer')) {
        ?>
        <!-- <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Outpatients</span>
            </a>
            <ul aria-expanded="false">
            <li><a href="radiowaiting?mode=2">Emergency List</a></li>
              <li><a href="radiowaiting?mode=1">Waiting List</a></li>
              <li><a href="radiocleared">Patient With Results</a></li>
            </ul>
          </li> -->
          <li>
            <a class="ai-icon" href="radiowaiting?mode=2" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Emergency List</span>
            </a>

          </li>
          <li>
            <a class="ai-icon" href="radiowaiting?mode=1" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>

          </li>
          <li>
            <a class="ai-icon" href="radiocleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Patient With Results</span>
            </a>
          </li>
          <!-- <li>
            <a class="ai-icon" href="clinicwaiting?ty=radiography" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Clinic Patients</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addradiostock?ty=Medicine">Request Medicine </a></li>
              <li><a href="addradiostock?ty=Medical">Request Medical Items</a></li>
              <li><a href="addradiostock?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="radiostockorders">View Requisitions</a></li>
            </ul>
          </li>
          <!-- <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="labstock">View Stock</a></li>
              <li><a href="addlabstock">Request Stock</a></li>
              <li><a href="labstockorders">Stock Requests</a></li>
            </ul>
          </li> -->

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'pharmacist')) {
        ?>
        <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-list-ul"></i>
              <span class="nav-text">OutPatients</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pharmacywaiting">Waiting List</a></li>
              <li><a href="outpatients">Outpatients</a></li>
            </ul>
          </li>
         
          <li>
            <a class="ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Inpatients</span>
              <ul aria-expanded="false">
              <li><a href="admitted">Inpatients</a></li>
              <!-- <li><a href="labstockorders">Lab Stock Orders</a></li>
              <li><a href="nursestockorders">Nurse Stock Orders</a></li> -->
            </ul>
            </a>
          </li>
          <!-- <li>
            <a class="ai-icon" href="clinicwaiting?ty=pharmacy" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Clinic Patients</span>
            </a>
          </li> -->
          <li>
            <a class="ai-icon" href="pharmacycleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Cleared Patients</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-stack-overflow"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pharstock">View Stock</a></li>
              <li><a href="viewpharstock">View Stock Requests</a></li>
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false"> Request Stock</a>
                  <ul aria-expanded="false">
                  <li><a href="addpharstock?ty=Medicine">Request Medicine</a></li>
                  <li><a href="addpharstock?ty=Medical">Request Medical Items</a></li>
                  </ul>
                </li>
                  
              <!-- <li><a href="">Request Stock</a></li> -->
              <!-- <li><a href="pharmacyorders">Pending Orders</a></li> -->
              <!-- <li><a href="labstockorders">Lab Stock Orders</a></li>
              <li><a href="nursestockorders">Nurse Stock Orders</a></li> -->
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-archive"></i>
              <span class="nav-text">Requisition</span>
            </a>
            <ul aria-expanded="false">
              <li> <a href="pharmacystockorder?ty=Medicine">Request Medicine</a></li>
              <li> <a href="pharmacystockorder?ty=Medical">Request Medical Items</a></li>
              <li> <a href="pharmacystockorder?ty=Non Medical">Request Non Medical Items</a></li>
              <li> <a href="pharmacyorders?ty=phar&&phar=1">View Requisition</a> </li>
              <!-- <li><a href="pharmacystock">View Requisition</a></li> -->
              <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">Orders</a>
                <ul aria-expanded="false">
                  
                </ul>            
            </li> -->
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-book"></i>
              <span class="nav-text">Orders</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pharmacyorders?typ=Medicine"> Medicine Order</a></li>
                  <li><a href="pharmacyorders?typ=Medical"> Medical Items Orders</a></li>
              <!-- <li><a href="">Request Stock</a></li> -->
              <!-- <li><a href="pharmacyorders">Pending Orders</a></li> -->
              <!-- <li><a href="labstockorders">Lab Stock Orders</a></li>
              <li><a href="nursestockorders">Nurse Stock Orders</a></li> -->
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'store manager')) {
        ?>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-list-ul"></i>
              <span class="nav-text">Purchases</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addorder">Add Purchase Order</a></li>
              <li><a href="stockorders">View Purchase Orders</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">View Stock</a>
              <ul>
                <li><a href="stock?ty=Medicine">Medicine</a></li>
                <li><a href="stock?ty=Medical">Medical Items</a></li>
                <li><a href="stock?ty=Non Medical">Non Medical Items</a></li>
              </ul>
            </li>
              <li > <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">Add Stock</a>
                <ul aria-expanded="false">
                  <li><a href="addstock?ty=Medicine">Add Medicine</a></li>
                  <li><a href="addstock?ty=Medical">Add Medical Items</a></li>
                  <li><a href="addstock?ty=Non Medical">Add Non Medical Items</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a class=" has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa fa-book"></i>
              <span class="nav-text">Orders</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="viewpharstock">Dispensing Orders</a></li>
              <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">Dispensing Orders</a>
                  <ul aria-expanded="false">
                    <li><a href="stockneworders?ty=Medicine">Medicine Orders</a></li>
                    <li><a href="stockneworders?ty=Medical">Medical Item Orders</a></li>
                  </ul>
              </li> -->
              <li><a href="stockneworders?ty=Non Medical">Requisition Orders</a></li>
          </ul>
          </li>
          <li>
            <a class="ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul>
                <li><a href="stockrequisition?ty=Non Medical">Non Medical Items Requisitions</a></li>
              <li><a href="otherstockorders?section=store manager">View Requisitions</a></li> 
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'anesthesiologist')) {
        ?>
          <li>
            <a class="ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Patient Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="anaethwaiting">Waiting Patients</a></li>
              <li><a href="anaeoperated">Operated Patients</a></li>
            </ul>
          </li>
          
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addanaestock?ty=Medicine">Request Medicine </a></li>
              <li><a href="addanaestock?ty=Medical">Request Medical Items</a></li>
              <li><a href="addanaestock?ty=Non Medical">Request Non Medical Items</a></li>
              <li><a href="anaestockorders">View Requisitions</a></li>
            </ul>
          </li>
        <?php } ?>
      </ul>
      <div class="plus-box">
        <p>ELCT - ELVD HOSPITAL MGT SYSTEM</p>
      </div>

    </div>
  </div>