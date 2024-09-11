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


					 <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="POST" class="needs-validation" novalidate="" onsubmit="return validarFormulario();">
                                        <input type="hidden" id="id" name="id">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="descricao">Descri&ccedil;&atilde;o:</label>
                                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-12">
                                                        <button type="submit" class="btn btn-primary px-5 radius-30">Salvar</button>
                                                        <button type="button" class="btn btn-secondary px-5 radius-30" onclick="cancelar();">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>