<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");

	$message = new Message($BASE_URL);

	$flashMessage = $message->getMessage();

	if(!empty($flashMessage["msg"])){
		//limpar a msg
		$message->clearMessage();
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Unicomercial - Registro</title>
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

<body class="bg-register">
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
			<div class="alert bg-success text-white alert-dismissible fade show" role="alert">Login realizado com sucesso!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">	
				</button>
			</div>
		<?php endif; ?>			
	<?php endif; ?>
	
	
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication-register d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="assets/images/logo-icon.png" width="80" alt="">
										<h3 class="mt-4 font-weight-bold">Criar Conta</h3>
									</div>
									<form method="POST" action="<?= $BASE_URL ?>auth_process.php">
										<div class="form-row">
											<input type="hidden" name="type" value="register">
											<div class="form-group col-md-6">
												<label for="name">Nome</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="João" />
											</div>
											<div class="form-group col-md-6">
												<label for="lastname">Sobrenome</label>
												<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Pereira" />
											</div>
										</div>		
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="function">Funçao</label>
												<input type="text" class="form-control" id="funcao" name="funcao" placeholder="Administrador" />
											</div>
											<div class="form-group col-md-6">
												<label>Nivel</label>
												<select class="form-control" id="nivel" name="nivel" value = "1">													
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
												</select>
											</div>
										</div>		
										
										<div class="form-group">
											<div class="form-group">
												<label for="email">E-mail:</label>
												<input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
											</div>
										</div>
										
										<div class="form-group">
											<label for="password">Senha:</label>
											<div class="input-group" id="show_hide_password">
												<input class="form-control border-right-0" type="password" id="password" name="password" >
												<div class="input-group-append">	<a href="javascript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<label for="confirm-password">Confirmação de Senha:</label>
											<div class="input-group" id="show_hide_password">
												<input class="form-control border-right-0" type="password" id="confirmpassword" name="confirmpassword">
												<div class="input-group-append">	<a href="javascript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											


										</div>
										
										<div class="btn-group mt-3 w-100">
											<button type="submit" class="btn btn-primary btn-block">Registrar
											<i class="lni lni-arrow-right"></i>
											</button>
										</div>
									</form>
									<hr/>
									<div class="text-center mt-4">
										<p class="mb-0">Ja esta Cadastrado? <a href="auth.php">Login</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/register-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="assets/js/jquery.min.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
</body>

</html>