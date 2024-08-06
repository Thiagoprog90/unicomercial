<?php
	require_once("templates/header.php");
	require_once("dao/UserDAO.php");
	$userDao = new UserDAO($conn, $BASE_URL);

	//$userData = $userDao->verifyToken(true);
?>
		<!-- end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper" >
				<div class="page-content">	
					<div class="carousel-item active">
						<img src="img/Back.jpg" class="d-block w-100" alt="...">
					</div>			
				</div>	
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
		<!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->

<?php
	require_once("templates/footer.php");

?>

