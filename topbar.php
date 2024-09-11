<?php

?>

<div class="left-topbar d-flex align-items-center">
					<a href="javascript:;" class="toggle-btn">
						<i class="bx bx-menu"></i>
					</a>
				</div>
				<div class="flex-grow-1 search-bar">
					<div class="input-group">
						<div class="input-group-prepend search-arrow-back">
							<button class="btn btn-search-back" type="button">
								<i class="bx bx-arrow-back"></i>
							</button>
						</div>
						<input type="text" class="form-control" placeholder="search" />
						<div class="input-group-append">
							<button class="btn btn-search" type="button">
								<i class="lni lni-search-alt"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;">
								<i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?php echo $s_nome;?></p>
										<p class="designattion mb-0">Online</p>
									</div>
									  <?php if(!empty($s_foto))
              {
              ?>
                <img src="arquivos\usuario-foto/<?php echo $s_foto; ?>"
                class="user-img" alt="user avatar">
               <?php
              }	
              ?>
									
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-user"></i><span>Profile</span>
								</a>
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-cog"></i><span>Settings</span>
								</a>
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-tachometer"></i><span>Dashboard</span>
								</a>
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-wallet"></i><span>Earnings</span>
								</a>
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-cloud-download"></i><span>Downloads</span>
								</a>
								<div class="dropdown-divider mb-0"></div>	<a class="dropdown-item" href="javascript:void(0);" id="logoutButton"> <!-- Atribua o ID ao elemento 'a' -->
    <i class="bx bx-power-off"></i><span>Logout</span>
</a>
							</div>
						</li>
					
					</ul>
				</div>