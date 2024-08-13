<?php
    require_once("globals.php");
    require_once("db.php");
	require_once("DbCreater.php");
	require_once("DbCreaterUni.php");
	require_once("models/Message.php");

	$message = new Message($BASE_URL);

	$flashMessage = $message->getMessage();

	if(!empty($flashMessage["msg"])){
		//limpar a msg
		$message->clearMessage();
	}

	$dbCreator = new DbCreater($BASE_URL,$conn);
	$dbCreatorUni = new DbCreaterUni($BASE_URL,$connUni);
	$dbCreator->createDB();
	$dbCreatorUni->createDB();

	

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Unicomercial - login</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
</head>

<body class="bg-login">
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
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="assets/images/logo-icon.png" width="80" alt="">
										<h3 class="mt-4 font-weight-bold">Bem vindo!</h3>
									</div>							
									<form method="POST" action="<?= $BASE_URL ?>auth_process.php">	
										<input type="hidden" name="type" value="login">
										<div class="form-group mt-4">
											<label>Email</label>
											<input type="text" class="form-control"  id="email" name="email" placeholder="Digite seu Email" />
										</div>
										<div class="form-group">
											<label>Senha</label>
											<input type="password" class="form-control" id="password" name="password" placeholder="Digite sua Senha" />
										</div>
										<div class="form-row">
											<div class="form-group col">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
													<label class="custom-control-label" for="customSwitch1">Remember Me</label>
												</div>
											</div>
											<div class="form-group col text-right"> <a href="authentication-forgot-password.html"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
											</div>
										</div>
										<div class="btn-group mt-3 w-100">
											<button type="submit" class="btn btn-primary btn-block">Entrar
											<i class="lni lni-arrow-right"></i>
											</button>
										</div>
										
										<hr>
										<div class="text-center">
											<p class="mb-0">Don't have an account? <a href="auth_register.php">Sign up</a>
											</p>
										</div>
									</form>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>