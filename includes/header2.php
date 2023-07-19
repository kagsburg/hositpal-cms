<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                               Tanganyika Polyclinic
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
	          <li class="nav-item dropdown notification_dropdown">
                      <a class="nav-link  btn btn-sm btn-danger" style="color: #fff;border: none;background: #000000;" href="#" role="button" data-toggle="dropdown">
                         Langue
                                </a>
                      <div class="dropdown-menu dropdown-menu-right" style="min-width: auto; padding: 0px; top: 73%;">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:auto;">
			<ul class="timeline">
			<li>
			<div class="dropdown-list-content dropdown-list-message">
                <a href="switchlanguage?lan=en" class="dropdown-item"> English </a>
                <a href="switchlanguage?lan=fr" class="dropdown-item"> Francais </a>
              
              </div>
											</li>
									
										</ul>
									</div>
                                                                    </div>
                            </li>						
							
         
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
									<div class="header-info">
										<span><?php echo $adminname; ?></span>
										<small><?php echo $adminrole; ?></small>
									</div>
                                   <?php
                                   if(empty($adminext)){
                                   ?>
                                    <img src="images/avatar.png" width="20" alt=""/>
                                   <?php }else{?>
                                    <img src="images/employees/thumbs/<?php echo md5($admin_id).'.'.$adminext.'?'.  time(); ?>" width="20" alt=""/>
                                   <?php }?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
<!--                                    <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>-->
  <a href="changepassword" class="dropdown-item ai-icon">
                                      
                                        <span class="ml-2">Changer le mot de passe</span>
                                    </a>
                                    <a href="logout" class="dropdown-item ai-icon">
                                      
                                        <span class="ml-2">Se déconnecter</span>
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
                    <li><a class="ai-icon" href="index" aria-expanded="false">
							<i class="fa fa-home"></i>
							<span class="nav-text">Accueil</span>
						</a>
            

                    </li>
                             <?php
                       if(($_SESSION['elcthospitallevel']!='admin')&&(($_SESSION['elcthospitallevel']!='receptionist'))&&($_SESSION['elcthospitallevel']!='cashier')&&($_SESSION['elcthospitallevel']!='store manager')){
                             $forpharmacy= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id=17 AND status=1");
                   if(mysqli_num_rows($forpharmacy)==0){
                           ?>
                      <li><a class="ai-icon" href="waitingpatients" aria-expanded="false">
						<i class="fa fa-user-plus"></i>
							<span class="nav-text">Patients en attente</span>
						</a>
                    
                    </li>
                      <li><a class="ai-icon" href="clearedpatients" aria-expanded="false">
						<i class="fa fa-users"></i>
							<span class="nav-text">Patients autorisés</span>
						</a>
                    
                    </li>
                          <?php
                   }
                      $formaternity= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id IN(9,18,3,22,21,26) AND status=1");
                   if(mysqli_num_rows($formaternity)>0){
                  ?>
                       <li><a class="ai-icon" href="examinations" aria-expanded="false">
						<i class="fa fa-eyedropper"></i>
					<span class="nav-text">Examens</span>
				</a>
                  </li>
                     <li><a class="ai-icon" href="operations" aria-expanded="false">
						<i class="fa fa-cut"></i>
							<span class="nav-text">Opérations</span>
						</a>
                  </li>
                     <li><a class="ai-icon" href="transfusions" aria-expanded="false">
						<i class="fa fa-exchange"></i>
							<span class="nav-text">Transfusions</span>
						</a>
                  </li>
                  <?php
                   }
                      $formaternity= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id='3' AND status=1");
                   if(mysqli_num_rows($formaternity)>0){
                  ?>
                     <li><a class="ai-icon" href="childbirths" aria-expanded="false">
						<i class="fa fa-child"></i>
							<span class="nav-text">Accouchements</span>
						</a>
                  </li>
                                     
                    <?php
                         }
                                 }
                    if(($_SESSION['elcthospitallevel']=='admin')){
                    ?>
                    <li><a class="ai-icon" href="departments" aria-expanded="false">
						<i class="fa fa-building"></i>
							<span class="nav-text">Départements</span>
						</a>
                    
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-user"></i>
							<span class="nav-text">Employés</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="designations">Désignations</a></li>
                            <li><a href="addemployee">Ajouter un employé</a></li>
                            <li><a href="employees">Employés</a></li>
                            <li><a href="salaries">Les salaires</a></li>
                          
                        </ul>
                    </li>
                     <li><a class="ai-icon" href="patients" aria-expanded="false">
							<i class="fa fa-users"></i>
		<span class="nav-text">Tous les patients</span>
						</a>
                  </li>
                
                       <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-money"></i>
		<span class="nav-text">Paiements</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="pendingpayments">Paiements en attente</a></li>
                            <li><a href="fullypaid">Payé</a></li>
                        
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-archive"></i>
							<span class="nav-text">Inventaire</span>
						</a>
                        <ul aria-expanded="false">
                                  <li><a href="additem">Ajouter un item</a></li>
                            <li><a href="items">Voir les articles</a></li>
                            <li><a href="measurements">Unités de mesure</a></li>
                             <li><a href="pharmacologicalclasses">Cours pharmacologiques</a></li>
                            <li><a href="pharmaceuticalforms">Formes pharmaceutiques</a></li>
                        </ul>
                    </li>
                       <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-hospital-o"></i>
							<span class="nav-text">Quartiers</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="addward">Ajouter un quartier</a></li>
                            <li><a href="wards">Voir les quartiers</a></li>
                            <li><a href="wardtypes">Types de quartiers</a></li>
                        </ul>
                    </li>
                       <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-stethoscope"></i>
							<span class="nav-text">Services médicaux</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="servicecategories">Catégories de services</a></li>
                                           </ul>
                    </li>
                 
                      <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-medkit"></i>
							<span class="nav-text">Maladies</span>
						</a>
                        <ul aria-expanded="false">
                                 <li><a href="diseases">Voir les maladies</a></li>
                            <li><a href="adddisease">Ajouter une maladie</a></li>
                                               
                        </ul>
                    </li>
                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notepad"></i>
							<span class="nav-text">Les compagnies d'assurance</span>
						</a>
                        <ul aria-expanded="false">
                             <li><a href="insurance">Les compagnies d'assurance</a></li>
                                 <li><a href="addinsurance">Add  Company</a></li>
                                                                         
                        </ul>
                    </li>
                    <!-- 
                  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-money"></i>
							<span class="nav-text">Des prix</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="addserviceprice">Ajouter un prix de service</a></li>
                            <li><a href="serviceprices">Prix des services</a></li>
                            <li><a href="bedprices">Prix des lits</a></li>
                        </ul>
                    </li>
                    
                   <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-settings-2"></i>
							<span class="nav-text">Paramètres</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="itemscategories?cat=Medical items">Catégories d'articles médicaux</a></li>
                            <li><a href="itemscategories?cat=Non Medical items">Catégories d'articles non médicaux</a></li>
                        
                        </ul>
                    </li>-->
                    
                    <?php }
                    if(($_SESSION['elcthospitallevel']=='receptionist')){
                    ?>
                        <li><a class="ai-icon" href="addpatient" aria-expanded="false">
							<i class="fa fa-user-plus"></i>
							<span class="nav-text">Ajouter un patient</span>
						</a>
                  </li>
                      <li><a class="ai-icon" href="patients" aria-expanded="false">
							<i class="fa fa-users"></i>
							<span class="nav-text">Tous les patients</span>
						</a>
                  </li>
                      <li><a class="ai-icon" href="inpatients" aria-expanded="false">
							<i class="fa fa-share"></i>
		<span class="nav-text">Chez les patients</span>
						</a>
                  </li>
                      <li><a class="ai-icon" href="outpatients" aria-expanded="false">
							<i class="fa fa-reply"></i>
		<span class="nav-text">Patients externes</span>
						</a>
                  </li>
                  <?php
                    }
                         $forpharmacy= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id=17 AND status=1");
                   if(mysqli_num_rows($forpharmacy)>0){
                  ?>
                          <li><a class="ai-icon" href="pharmacywaiting" aria-expanded="false">
						<i class="fa fa-user-plus"></i>
							<span class="nav-text">Paiements en attente</span>
						</a>
                 </li>
                   
                      <li><a class="ai-icon" href="pharmacycleared" aria-expanded="false">
						<i class="fa fa-users"></i>
							<span class="nav-text">Patients autorisés</span>
						</a>
                  </li>
                          <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
	<i class="fa fa-user"></i>
	<span class="nav-text">Ambulant Patients</span>
	</a>
                        <ul aria-expanded="false">
                            <li><a href="addambulantorder">Ajouter une Ordre</a></li>
                                <li><a href="ambulantorders">Commandes payées</a></li>
                            <li><a href="pendingambulantorders">En attente de paiement</a></li>
                        </ul>
                        </li>
                       
                                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
		<i class="fa fa-archive"></i>
		<span class="nav-text">Inventaire</span>
		</a>
                        <ul aria-expanded="false">
                            <li><a href="additem">Ajouter un item</a></li>
                            <li><a href="items">Voir les articles</a></li>
                            <li><a href="measurements">Des mesures</a></li>
                               <li><a href="addstock">Ajouter des actions</a></li>
                                 <li><a href="pharmacyorders">Demandes de stock</a></li>
                       </ul>
                    </li>
               
                    <?php } ?>
                       <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-reply"></i>
							<span class="nav-text">Demandes d'articles</span>
						</a>
                        <ul aria-expanded="false">
                    <?php
                      $notpharmacy= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id!=17 AND status=1");
                   if(mysqli_num_rows($notpharmacy)>0){
                    ?>
                            <li><a href="addstockrequest">Ajouter une demande</a></li>
                   <?php }?>
                            <li><a href="pendingstockrequests">Requêtes en cours</a></li>
                            <li><a href="approvedstockrequests">Demandes approuvées</a></li>
                      </ul>
                    </li> 
              <?php            $forcashier= mysqli_query($con,"SELECT * FROM staffdepts WHERE staff_id='".$_SESSION['elcthospitaladmin']."' AND servicecategory_id=27 AND status=1");
                   if(mysqli_num_rows($forcashier)>0){
                    ?>
                      <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa fa-money"></i>
		<span class="nav-text">Paiements</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="pendingpayments">Paiements en attente</a></li>
                            <li><a href="fullypaid">Payé</a></li>
                        
                        </ul>
                    </li>
                       <li><a class="ai-icon" href="getincomereport" aria-expanded="false">
						<i class="fa fa-edit"></i>
							<span class="nav-text">Rapport de revenu</span>
						</a>
                  </li>   
                     <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
	<i class="fa fa-user"></i>
	<span class="nav-text">Ambulant Patients</span>
	</a>
                        <ul aria-expanded="false">
                             <li><a href="ambulantorders">Commandes payées</a></li>
                            <li><a href="pendingambulantorders">En attente de paiement</a></li>
                        </ul>
                        </li>     
                         <?php }?>
                </ul>
            
				<div class="plus-box">
					<p>TANGANYIKA CARE POLYCLINIC</p>
				</div>
				
			</div>
        </div>