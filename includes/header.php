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
              <li><a href="items?ty=Medical">Medical items</a></li>
              <li><a href="additem?ty=Medical&sub=NULL">Add Medical item</a></li>
              <li><a href="items?ty=Non Medical">Non Medical Items</a></li>
              <li><a href="additem?ty=Non Medical&sub=NULL">Add Non Medical item</a></li>
              <li><a href="measurements">Units of Measure</a></li>
              <li><a href="stores">Stores</a></li>
              <li><a href="stockorders">Stock Orders</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="flaticon-381-settings-2"></i>
              <span class="nav-text">Categories</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="itemscategories?cat=Medical items">Medical Items Categories</a></li>
              <li><a href="itemscategories?cat=Non Medical items">Non Medical Items Categories</a></li>

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
              <li><a href="unselectiveservices">Unselective Services</a></li>
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
              <li><a href="investigationtypes">Investigation Types</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-rss"></i>
              <span class="nav-text">Radiography</span>
            </a>
            <ul aria-expanded="false">

              <li><a href="radiographyunits">SI unit / Result</a></li>
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
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'head physician')) {
        ?>
          <li>
            <a class="ai-icon" href="insurancepending" aria-expanded="false">
              <i class="flaticon-381-user"></i>
              <span class="nav-text">Pending Registrations</span>
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
          <!-- <li>
            <a class="ai-icon" href="registrationpending" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Pending Registrations</span>
            </a>
          </li> -->
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Clearance</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="clearance">Pending Bills</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="fullypaid" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Paid</span>
            </a>
          </li>
          <li>
            <a class="ai-icon" href="paymentstatus" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Payment Status</span>
            </a>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'accountant')) {
        ?>
          <li>
            <a class="ai-icon" href="fullypaid" aria-expanded="false">
              <i class="fa fa-money"></i>
              <span class="nav-text">Payments</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="stock">View Items</a></li>
              <li><a href="pharmacystock">Pharmacy Stock</a></li>
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
              <span class="nav-text">Patient Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="waitingpatients">Waiting List </a></li>
              <li><a href="admitted">Admission</a></li>
              <li><a href="outpatients">Outpatient</a></li>
              <li><a href="inpatients">Inpatients</a></li>
              <li><a href="registrationrequests">Pending Registrations</a></li>
            </ul>
          </li>

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
            <a class="ai-icon" href="doctorwaiting" aria-expanded="false">
              <i class="fa fa-snowflake-o"></i>
              <span class="nav-text">Refrigerator</span>
            </a>
          </li>
          <li>
            <a class="ai-icon" href="nursecommunication" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Communication</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addnurserequisition">Add Requisition</a></li>
              <li><a href="nursestockorders">View Requisitions</a></li>
            </ul>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'patron')) {
        ?>

          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Patient Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="waitingpatients">Outpatients</a></li>
              <li><a href="admitted">Admission</a></li>
              <li><a href="inpatients">Inpatients</a></li>
            </ul>
          </li>

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
          <li>
            <a class="ai-icon" href="doctorwaiting" aria-expanded="false">
              <i class="fa fa-comment"></i>
              <span class="nav-text">Communication</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addnurserequisition">Add Requisition</a></li>
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
              <span class="nav-text">Patient Management</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="doctorwaiting">Awaiting Patients</a></li>
              <li><a href="doctorcleared">Patient With Results</a></li>
              <li><a href="admitted">Admitted Patients</a></li>
            </ul>
          </li>

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
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="adddoctorrequisition">Add Requisition</a></li>
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
            <a class="ai-icon" href="labwaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>

          </li>
          <li>
            <a class="ai-icon" href="labcleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Cleared Patients</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addlabstock">Add Requisition</a></li>
              <li><a href="labstockorders">View Requisitions</a></li>
            </ul>
          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'radiographer')) {
        ?>
          <li>
            <a class="ai-icon" href="radiowaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>

          </li>
          <li>
            <a class="ai-icon" href="labcleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Cleared Patients</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="labstock">View Stock</a></li>
              <li><a href="addlabstock">Request Stock</a></li>
              <li><a href="labstockorders">Stock Requests</a></li>
            </ul>
          </li>

        <?php }
        if (($_SESSION['elcthospitallevel'] == 'pharmacist')) {
        ?>
          <li>
            <a class="ai-icon" href="pharmacywaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Waiting Patients</span>
            </a>

          </li>
          <li>
            <a class="ai-icon" href="pharmacycleared" aria-expanded="false">
              <i class="fa fa-users"></i>
              <span class="nav-text">Cleared Patients</span>
            </a>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="pharmacystock">View Stock</a></li>
              <li><a href="pharmacystockorder">Request Stock</a></li>
              <li><a href="pharmacyorders">Pending Orders</a></li>
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
              <span class="nav-text">Orders</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="addorder">Add Order</a></li>
              <li><a href="stockorders">View Orders</a></li>

            </ul>
          </li>
          <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
              <i class="fa fa-archive"></i>
              <span class="nav-text">Stock</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="stock">View Items</a></li>
              <li><a href="addstock">Add Stock</a></li>
            </ul>
          </li>
          <li>
            <a class="ai-icon" href="pharmacyorders" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>


          </li>
        <?php }
        if (($_SESSION['elcthospitallevel'] == 'anesthesiologist')) {
        ?>
          <li>
            <a class="ai-icon" href="labwaiting" aria-expanded="false">
              <i class="fa fa-user-plus"></i>
              <span class="nav-text">Patient Management</span>
            </a>
          </li>
          <li>
            <a class="ai-icon" href="pharmacyorders" aria-expanded="false">
              <i class="fa fa-reply"></i>
              <span class="nav-text">Requisitions</span>
            </a>
          </li>
        <?php } ?>
      </ul>
      <div class="plus-box">
        <p>ELCT - ELVD HOSPITAL MGT SYSTEM</p>
      </div>

    </div>
  </div>