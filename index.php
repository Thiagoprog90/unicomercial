<?php
session_start();
require_once( 'verificarlogin.php');
$s_foto = $_SESSION["s_foto"];
$s_nome = $_SESSION["s_nome"];
$titulo = 'Unicomercial';
$s_id = $_SESSION["s_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('head_admin.php');?>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--sidebar-wrapper-->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<?php include('sidebar.php');?>
			</div>
			<!--navigation-->
		<?php include('menu.php');?>
			<!--end navigation-->
		</div>
		<!--end sidebar-wrapper-->
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<?php include('topbar.php');?>
			</nav>
		</header>
		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="row">
						
					<!--Conteudo das paginas-->
						
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
			<!--end page-content-wrapper-->
		
		<!--end page-wrapper-->
		<!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->
		<div class="footer">
			<?php include('footer.php');?>
		</div>
		<!-- end footer -->
	</div>
	<!-- end wrapper -->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn">
			<i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
			<hr />
			<h6 class="mb-0">Theme Styles</h6>
			<hr />
			<div class="d-flex align-items-center justify-content-between">
				<div class="custom-control custom-radio">
					<input type="radio" id="darkmode" name="customRadio" class="custom-control-input">
					<label class="custom-control-label" for="darkmode">Dark Mode</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="lightmode" name="customRadio" checked class="custom-control-input">
					<label class="custom-control-label" for="lightmode">Light Mode</label>
				</div>
			</div>
			<hr />
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="DarkSidebar">
				<label class="custom-control-label" for="DarkSidebar">Dark Sidebar</label>
			</div>
			<hr />
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="ColorLessIcons">
				<label class="custom-control-label" for="ColorLessIcons">Color Less Icons</label>
			</div>
		</div>
	</div>
	<?php include('header_js.php');?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
       document.getElementById('logoutButton').addEventListener('click', function() {
    fetch('api/api-logon/api-logout.php')
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data); // Verifique se os dados estão corretos

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    console.log("Antes de redirecionar"); // Verifique se chega até aqui
                    window.location.href = 'auth.php';
                    console.log("Depois de redirecionar"); // Este não deve aparecer se o redirecionamento funcionar
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error("Erro na requisição:", error);
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Erro ao processar a solicitação.'
            });
        });
});
</script>
</body>

</html>