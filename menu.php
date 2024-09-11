<?php


if($_SESSION['s_regra'] == 1)
{
?>
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
								<li> <a href="lista-grupo.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de grupos</a>
								</li>
								<li> <a href="subgrupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de subgrupos</a>
								</li>
								<li> <a href="unidade_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de unidade</a>
								</li>
							</ul>
						</li>
						<li>							
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon icon-color-12"><i class="lni lni-service"></i>
								</div>
								<div class="service-title">Servi&ccedil;os</div>
							</a>
							<ul>
								<li> <a href="grupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de Servi&ccedil;os</a>
								</li>
								<li> <a href="subgrupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Cadastro de veiculos</a>
								</li>
							</ul>

						</li>
					</ul>
				</li>	
					<li>
					<a href="https://themeforest.net/user/codervent" target="_blank">
						<div class="parent-icon">
							<i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
			</ul>
			<?php
}
?>
<?php
if($_SESSION['s_regra'] == 2)
{
?>
<ul class="metismenu" id="menu">
				
			
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon icon-color-10"><i class="bx bx-clipboard"></i>
						</div>
						<div class="menu-title">Administrativo</div>
					</a>
					<ul>
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon icon-color-11"><i class="lni lni-shopping-basket"></i>
								</div>
								<div class="products-title">Admin</div>
							</a>
							<ul>
								<li> <a href="lista-grupo.php"><i class="bx bx-right-arrow-alt"></i>Lista de Empresa</a>
								</li>
								<li> <a href="subgrupo_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Lista de Contratos</a>
								</li>
								<li> <a href="unidade_cadastro.php"><i class="bx bx-right-arrow-alt"></i>Lista de Administradores</a>
								</li>
							</ul>
						</li>
				
					</ul>
				</li>	
					<li>
					<a href="https://themeforest.net/user/codervent" target="_blank">
						<div class="parent-icon">
							<i class="bx bx-support"></i>
						</div>
						<div class="menu-title">Support</div>
					</a>
				</li>
			</ul>
			<?php
}
?>