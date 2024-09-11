<?php
$titulo = 'Unicomercial';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<?php include('head.php');?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-login">
	
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
									<form id="loginForm">	
										<div class="form-group mt-4">
											<label>Matricula</label>
											<input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite Sua Matricula" />
										</div>
										<div class="form-group">
											<label>Senha</label>
											<input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua Senha" />
										</div>
										<div class="btn-group mt-3 w-100">
											<button type="submit" class="btn btn-primary btn-block">Entrar
												<i class="lni lni-arrow-right"></i>
											</button>
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

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Prevenir o comportamento padrão do formulário

            const cpf = $('#cpf').val();
            const senha = $('#senha').val();

            if (!cpf || !senha) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção',
                    text: 'Por favor, preencha todos os campos.'
                });
                return;
            }

            $.ajax({
                url: 'api/api-logon/api-login.php', // Substitua pela URL correta da API
                type: 'POST',
                dataType: 'json',
                data: {
                    cpf: cpf,
                    senha: senha
                },
                success: function(response) {
                    if (response.sucesso) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: response.msg
                        }).then(() => {
                            window.location.href = 'login-home.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: response.msg
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Não foi possível conectar à API. Tente novamente mais tarde.'
                    });
                    console.error('Erro na requisição:', xhr.responseText);
                }
            });
        });
    });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
