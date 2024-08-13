<?php
    require_once("globals.php");
    require_once("db.php");
	require_once("models/Message.php");
	require_once("dao/UserDAO.php");
	$message = new Message($BASE_URL);

	$flashMessage = $message->getMessage();

	if(!empty($flashMessage["msg"])) {
		// Limpar a mensagem
		$message->clearMessage();
	}

	$userDao = new UserDAO($conn, $BASE_URL);

	$userData = $userDao->verifyToken(true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Unicomercial</title>
	<!--favicon-->
	<link rel="icon" href="<?= $BASE_URL ?>img/favicon-32x32.png" type="image/png" />
    
	<!-- Vector CSS -->
	<link href="<?= $BASE_URL ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="<?= $BASE_URL ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?= $BASE_URL ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?= $BASE_URL ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?= $BASE_URL ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?= $BASE_URL ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/app.css" />
	<link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/dark-sidebar.css" />
	<link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/dark-theme.css" />
	<link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div class="">
					<img src="<?= $BASE_URL ?>assets/images/logo-icon.png" class="logo-icon-2" alt="" />
				</div>
				<div>
					<h4 class="logo-text">Unicomercial</h4>
				</div>
				<a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
				</a>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">			
				
				
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-10"><i class="bx bx-clipboard"></i>
						</div>
						<div class="menu-title">Cadastros</div>
					</a>
					<ul>
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon icon-color-11"><i class="lni lni-shopping-basket"></i>
								</div>
								<div class="products-title">produtos</div>
							</a>
							<ul>
								<li> <a href="<?= $BASE_URL ?>grupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de grupos</a>
								</li>
								<li> <a href="<?= $BASE_URL ?>subgrupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de subgrupos</a>
								</li>
								<li> <a href="<?= $BASE_URL ?>unidade_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de unidade</a>
								</li>
							</ul>
						</li>
						<li>							
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon icon-color-12"><i class="lni lni-service"></i>
								</div>
								<div class="service-title">Serviços</div>
							</a>
							<ul>
								<li> <a href="<?= $BASE_URL ?>grupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de Serviços</a>
								</li>
								<li> <a href="<?= $BASE_URL ?>subgrupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de veiculos</a>
								</li>
							</ul>

						</li>
					</ul>
				</li>				
				
				<li class="menu-label">Forms & Tables</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-1"> <i class="bx bx-comment-edit"></i>
						</div>
						<div class="menu-title">Forms</div>
					</a>
					<ul>
						<li> <a href="form-elements.html"><i class="bx bx-right-arrow-alt"></i>Form Elements</a>
						</li>
						<li> <a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Input Groups</a>
						</li>
						<li> <a href="form-layouts.html"><i class="bx bx-right-arrow-alt"></i>Forms Layouts</a>
						</li>
						<li> <a href="form-validations.html"><i class="bx bx-right-arrow-alt"></i>Form Validation</a>
						</li>
						<li> <a href="form-wizard.html"><i class="bx bx-right-arrow-alt"></i>Form Wizard</a>
						</li>
						<li> <a href="form-text-editor.html"><i class="bx bx-right-arrow-alt"></i>Text Editor</a>
						</li>
						<li> <a href="form-file-upload.html"><i class="bx bx-right-arrow-alt"></i>File Upload</a>
						</li>
						<li> <a href="form-date-time-pickes.html"><i class="bx bx-right-arrow-alt"></i>Date Pickers</a>
						</li>
						<li> <a href="form-select2.html"><i class="bx bx-right-arrow-alt"></i>Select2</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-2"><i class="bx bx-grid-alt"></i>
						</div>
						<div class="menu-title">Tables</div>
					</a>
					<ul>
						<li> <a href="table-basic-table.html"><i class="bx bx-right-arrow-alt"></i>Basic Table</a>
						</li>
						<li> <a href="table-datatable.html"><i class="bx bx-right-arrow-alt"></i>Data Table</a>
						</li>
						<li> <a href="table-editable.html"><i class="bx bx-right-arrow-alt"></i>Editable Table</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Pages</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-3"><i class="bx bx-lock"></i>
						</div>
						<div class="menu-title">Authentication</div>
					</a>
					<ul>
						<li> <a href="authentication-login.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Login</a>
						</li>
						<li> <a href="authentication-register.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Register</a>
						</li>
						<li> <a href="authentication-forgot-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Forgot Password</a>
						</li>
						<li> <a href="authentication-reset-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Reset Password</a>
						</li>
						<li> <a href="authentication-lock-screen.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Lock Screen</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="user-profile.html">
						<div class="parent-icon icon-color-4"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">User Profile</div>
					</a>
				</li>
				<li>
					<a href="timeline.html">
						<div class="parent-icon icon-color-5"> <i class="bx bx-video-recording"></i>
						</div>
						<div class="menu-title">Timeline</div>
					</a>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-6"><i class="bx bx-error"></i>
						</div>
						<div class="menu-title">Errors</div>
					</a>
					<ul>
						<li> <a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404 Error</a>
						</li>
						<li> <a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500 Error</a>
						</li>
						<li> <a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming Soon</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="faq.html">
						<div class="parent-icon icon-color-7"><i class="bx bx-help-circle"></i>
						</div>
						<div class="menu-title">FAQ</div>
					</a>
				</li>
				<li>
					<a href="pricing-table.html">
						<div class="parent-icon icon-color-8"><i class="bx bx-diamond"></i>
						</div>
						<div class="menu-title">Pricing</div>
					</a>
				</li>
				<li class="menu-label">Charts & Maps</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-9"><i class="bx bx-line-chart"></i>
						</div>
						<div class="menu-title">Charts</div>
					</a>
					<ul>
						<li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
						</li>
						<li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
						</li>
						<li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-10"><i class="bx bx-map-alt"></i>
						</div>
						<div class="menu-title">Maps</div>
					</a>
					<ul>
						<li> <a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>Google Maps</a>
						</li>
						<li> <a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Vector Maps</a>
						</li>
					</ul>
				</li>
				<li class="menu-label">Others</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-11"><i class="bx bx-menu"></i>
						</div>
						<div class="menu-title">Menu Levels</div>
					</a>
					<ul>
						<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
							<ul>
								<li> <a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
									<ul>
										<li> <a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li>
					<a href="https://codervent.com/syndash/documentation/index.html" target="_blank">
						<div class="parent-icon icon-color-12"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Documentation</div>
					</a>
				</li>
				<li>
					<a href="https://themeforest.net/user/codervent" target="_blank">
						<div class="parent-icon"><i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="left-topbar d-flex align-items-center">
					<a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
					</a>
				</div>
				<div class="flex-grow-1 search-bar">
					<div class="input-group">
						<h1>Unisystem Sistemas</h1>
					</div>
				</div>
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;">	<i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>						
						
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?= $userData->name ?></p>
										<!-- <p class="designattion mb-0"><?= $userData->funcao ?></p>									 -->
										
									</div>
									<img src="<?= $BASE_URL ?>img/users/userthiago.jpeg" class="user-img" alt="user avatar">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">	
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-tachometer"></i><span>Nivel: <?= $userData->nivel?></span></a>
								<div class="dropdown-divider mb-0"></div>
								<!-- <a class="dropdown-item" href="javascript:;"><i
										class="bx bx-user"></i><span>Profile</span></a>
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-cog"></i><span>Settings</span></a>
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-tachometer"></i><span>Dashboard</span></a>
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-wallet"></i><span>Earnings</span></a>
								<a class="dropdown-item" href="javascript:;"><i
										class="bx bx-cloud-download"></i><span>Downloads</span></a> 
								<div class="dropdown-divider mb-0"></div>-->	
								<a class="dropdown-item" href="<?= $BASE_URL ?>logout.php"><i
										class="bx bx-power-off"></i><span>Logout</span></a>
								<div class="dropdown-divider mb-0"></div>
							</div>
							
						</li>
						
					</ul>
				</div>
			</nav>
			<?php if(!empty($flashMessage["msg"])): ?>
				<?php if($flashMessage["type"]==="error"): ?>
						<div class="alert bg-warning text-white alert-dismissible fade show" role="alert"><?= $flashMessage["msg"] ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">				
							</button>
						</div>
					<?php endif; ?>		
					<?php if($flashMessage["type"]==="warning"): ?>
						<div class="alert bg-warning text-white alert-dismissible fade show" role="alert"><?= $flashMessage["msg"] ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">				
							</button>
						</div>
					<?php endif; ?>	
					<?php if($flashMessage["type"]==="success"): ?>
						<div class="alert bg-success text-white alert-dismissible fade show" role="alert"><?= $flashMessage["msg"] ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">	
							</button>
						</div>
					<?php endif; ?>			
			<?php endif; ?>
			
			<!-- <div class="alert bg-success text-white alert-dismissible fade show" role="alert">Login realizado com sucesso!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">	
				</button>
			</div> -->
		</header>
		
		