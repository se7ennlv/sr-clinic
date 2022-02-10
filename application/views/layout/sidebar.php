<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-clinic-medical"></i>
				</div>
				<div class="sidebar-brand-text mx-3">SR CLINIC</div>
			</a>

			<hr class="sidebar-divider my-2">

			<!-- 
			<?php foreach ($roles as $role) { ?>
                <li class="sidebar-heading"><a><i class="<?= $role->RoleIcons; ?>"></i> <?= $role->RoleName; ?></a></li>
                <?php foreach ($menus as $menu) { ?>
                    <?php if ($role->RoleID == $menu->MenuRoleID) { ?>
                        <li><a href="#" onclick="<?= $menu->MenuLinkFunction; ?>" id="<?= $menu->MenuLinkID; ?>"><i class="fa fa-chevron-right"></i> <span><?= $menu->MenuName; ?></span></a></li>
                    <?php } ?>
                <?php } ?>
            <?php } ?> -->

			<?php if ($this->session->userdata('emp_id') === 'admin') { ?>
				<div class="sidebar-heading">
					<i class="fas fa-user-lock"></i> Administrator
				</div>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#">
						<i class="fas fa-users"></i> <span>User Management</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link collapsed" href="#">
						<i class="fas fa-envelope"></i> <span>SMTP Configurations</span>
					</a>
				</li>

				<hr class="sidebar-divider">
			<?php } ?>

			<div class="sidebar-heading">
				<i class="fas fa-procedures"></i> Services
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="VisitRecord('add', null);">
					<i class="fas fa-user-plus"></i> <span>New Visit Record</span>
				</a>
			</li>
			<hr class="sidebar-divider">
			<?php if ($this->session->userdata('level') === 'admin') { ?>
			<div class="sidebar-heading">
				<i class="fas fa-laptop-medical"></i> Medical Manage
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="UnitsManage();"><i class="fas fa-th-list"></i> <span>Units</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="MedicinesManage();"><i class="fas fa-capsules"></i> <span>Medicines</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="DiseasesManage();"><i class="fas fa-th-large"></i> <span>Diseases</span></a>
			</li>
			<hr class="sidebar-divider">
			<?php } ?>
			
			<div class="sidebar-heading">
				<i class="fas fa-user-injured"></i> Patients Manage
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="PatientsManage();"><i class="fas fa-book-medical"></i> <span>Patient History</span></a>
			</li>
			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				<i class="fas fa-chart-pie"></i> Reports
			</div>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="VisitReport();">
					<i class="fas fa-chevron-right"></i> <span>Visit Records</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="VisitDetailReport();">
					<i class="fas fa-chevron-right"></i> <span>Medicine Records</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="DeptSummaryReport();">
					<i class="fas fa-chevron-right"></i> <span>Visit Summary by DEPT</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="GenderSummaryReport();">
					<i class="fas fa-chevron-right"></i> <span>Visit Summary by Gender</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="DrugSummaryByDept();">
					<i class="fas fa-chevron-right"></i> <span>Summary Medicine by Dept</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="MedicineSummaryDistributed();">
					<i class="fas fa-chevron-right"></i> <span>Summary Med Distributed</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" onclick="MonthlyReport();">
					<i class="fas fa-chevron-right"></i> <span>Monthly Report</span>
				</a>
			</li>


			<!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="">
                    <i class="fas fa-chevron-right"></i> <span>Summary of drugs distributed</span>
                </a>
            </li> -->

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow d-sm-none">
							<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-search fa-fw"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
								<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>

						<!-- Nav Item - Alerts -->
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell fa-fw"></i>
								<!-- Counter - Alerts -->
								<span class="badge badge-danger badge-counter"><?= $medtotal; ?></span>
							</a>
							<!-- Dropdown - Alerts -->
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
								<h6 class="dropdown-header">
									Medicine Alerts (low stock items)
								</h6>
								<?php
								foreach ($alerts as $alert) {
									$bgColor = '';

									if ($alert->Stock == $alert->QtyAlert) {
										$bgColor = 'bg-warning';
									} else if ($alert->Stock < $alert->QtyAlert) {
										$bgColor = 'bg-danger';
									}
								?>
									<a class="dropdown-item d-flex align-items-center" href="#">
										<div class="mr-3">
											<div class="icon-circle <?= $bgColor; ?>">
												<span class="text-white"><?= $alert->Stock; ?></span>
											</div>
										</div>
										<div>
											<div class="small text-gray-500"><?= $alert->Code; ?></div>
											<span class="text-secondary"><?= $alert->Name; ?></span>
										</div>
									</a>
								<?php }
								?>
								<a class="dropdown-item text-center small text-danger" href="#" onclick="ShowAllMedAlerts();">Show All Alerts</a>
							</div>
						</li>

						<!-- Nav Item - Body mass index -->
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="bmiInfo">
								<i class="fas fa-restroom"></i>
							</a>
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="bmiDropdown">
								<h6 class="dropdown-header">
									Body mass index
								</h6>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<div class="icon-circle bg-secondary">
											<i class="fas fa-male text-white"></i>
										</div>
									</div>
									<div class="font-weight-bold">
										<div class="text-truncate">Underweight</div>
										<div class="small text-gray-700">BMI of less than 18.5</div>
									</div>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<div class="icon-circle bg-success">
											<i class="fas fa-restroom text-white fa-2x"></i>
										</div>
									</div>
									<div class="font-weight-bold">
										<div class="text-truncate text-success">Healthy weight</div>
										<div class="small text-success">BMI of 18.5 - 25</div>
									</div>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<div class="icon-circle bg-warning">
											<i class="fas fa-walking text-white fa-3x"></i>
										</div>
									</div>
									<div class="font-weight-bold">
										<div class="text-truncate text-warning">Overweight</div>
										<div class="small text-warning">BMI of 25 - 30</div>
									</div>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="dropdown-list-image mr-3">
										<div class="icon-circle bg-danger">
											<i class="fas fa-child fa-3x text-white"></i>
										</div>
									</div>
									<div class="font-weight-bold">
										<div class="text-truncate text-danger">Heavily overweight</div>
										<div class="small text-danger">BMI of over 30</div>
									</div>
								</a>
							</div>
						</li>

						<div class="topbar-divider d-none d-sm-block"></div>

						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">
									<i class="fas fa-circle text-success"></i> User Online: <?= $this->session->userdata('username'); ?>
								</span>
								<?php if (!empty($this->session->userdata('user_pic'))) { ?>
									<img class="img-profile rounded-circle" src="http://172.16.98.81:8090/psa/files/<?= $this->session->userdata('user_pic'); ?>">
								<?php } else { ?>
									<img class="img-profile rounded-circle" src="<?= base_url(); ?>./assets/img/user.png">
								<?php } ?>

							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
									Activity Log
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= site_url('AppController/ExecuteLogout'); ?>">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid" id="mainApp">
