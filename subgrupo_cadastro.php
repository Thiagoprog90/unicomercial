<?php
	
	require_once("templates/header.php");
	require_once("dao/UserDAO.php");
	require_once("dao/GrupoDAO.php");
    require_once("dao/SubgrupoDAO.php");


	$userDao = new UserDAO($conn, $BASE_URL);

	$grupoDao = new GrupoDAO($conn, $BASE_URL);
    $subgrupoDao = new SubgrupoDAO($conn, $BASE_URL);
    

	$id = filter_input(INPUT_GET, "id");
	$search = filter_input(INPUT_GET, "search");	

	
	
	//busca grupos para vincular no subgrupos
	$grupos = $grupoDao->findAll();

	if($search){
		$searchSubGrupos = $subgrupoDao->findByDescricao($search);
	}else{
		$searchSubGrupos = $subgrupoDao->findAll();
	}	
	$typeUpdade = false;

	if($id > 0){
		$typeUpdade = true;
	}
	
	

	$subgrupo = $subgrupoDao->findById($id);	


	
?>
		<!-- end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--page-content-wrapper-->
			<div class="page-content-wrapper" >
				<div class="page-content">	
					<div class="col-12 col-lg-12">
						<div class="card radius-15 border-lg-top-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">									
									<h4 class="mb-0 text-primary">Cadastro de subgrupos</h4>
								</div>
								<hr>
								<div class="form-body">
									<?php if($search): ?>
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item" role="presentation"> <a class="nav-link active" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="true">Consulta</a>
											</li>
											<li class="nav-item" role="presentation"> <a class="nav-link" id="create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="false">Cadastro</a>
											</li>										
										</ul>
									<?php else: ?>
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item" role="presentation"> <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">Consulta</a>
											</li>
											<li class="nav-item" role="presentation"> <a class="nav-link active" id="create-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="true">Cadastro</a>
											</li>										
										</ul>
									<?php endif; ?>
									<div class="tab-content p-3" id="myTabContent">
										<?php if($search): ?>
											<div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
												<form action="subgrupo_cadastro.php" method="GET">
												<!-- Consulta -->
													<div class="form-row"  id="form-busca-avancada">												
														<div class="form-group col-md-4">
															<label for="search">Busca:</label>
															<div class="input-group"  >
																<input type="text" class="form-control radius-40" id="search" name="search" value="" placeholder= "Pesquise aqui...">
															</div>
														</div>																								
													</div>
													<div class="form-row" >
														<div class="btn-group mt-3 w-40">
															<button type="submit" class="btn btn-primary radius-30 btn-block">Buscar
																<i class="lni lni-search-alt"></i>
															</button>
														</div>												
													</div>
												</form>
												<div class="form-row" >
													<hr><hr>
												</div>
												<div class="form-row">
													<div class="card col-md-12">
														<div class="card-body ">
															<hr>
															<div class="card-title">
																<h4 class="mb-0">Subgrupos Cadastrados</h4>
															</div>	
															<hr>
															<!-- tabela -->
															<div class="table-responsive ">
																<table id="example" class="table table-striped table-bordered" style="width:100%">
																	<thead>
																		<tr>
																			<th >Codigo</th>
																			<th >Grupo</th>
																			<th>Descrição</th>																	
																			<th>Editar</th>
																			<th>Excluir</th>
																		</tr>
																	</thead>
																	<tbody>																																		
																		<?php foreach($searchSubGrupos as $searchSubGrupo): ?>
																			<tr>
																				<td ><?= $searchSubGrupo->id ?></td>
                                                                                <td ><?= $searchSubGrupo->descricaoGrupo ?></td>
																				<td><?= $searchSubGrupo->descricao ?></td>														
																				
																				<td><a href="<?= $BASE_URL ?>subgrupo_cadastro.php?id=<?= $searchSubGrupo->id ?>">Editar</a></td>																		
																				<td>
																					<form action="<?= $BASE_URL ?>subgrupo_process.php" method="POST">
																						<input type="hidden" name="type" value="delete">
																						<input type="hidden" name="id" value="<?= $searchSubGrupo->id ?>">
																						<div class="form-row" >
																							<div class="btn-group mt-2 w-40">
																								<button type="submit" class="btn btn-primary radius-30 btn-block" >Excluir</button>
																							</div>												
																						</div>
																						</button>
																					</form>
																				</td>																		
																			</tr>
																		<?php endforeach; ?>																								
																	</tbody>																														
																</table>
																<?php if(count($searchSubGrupos) === 0): ?>
																	<p class="empty-list">Ainda não há Subgrupos cadastrados ou Subrupo(s) com a pesquisa realizada!</p>
																<?php endif; ?>		
															</div>
															<!-- fim da tabela -->
														</div>
													</div>
												</div>												
												
											</div>
										<?php else: ?>
											<div class="tab-pane fade" id="search" role="tabpanel" aria-labelledby="search-tab">
												<form action="subgrupo_cadastro.php" method="GET">
												<!-- Consulta -->
													<div class="form-row"  id="form-busca-avancada">												
														<div class="form-group col-md-4">
															<label for="search">Busca:</label>
															<div class="input-group"  >
																<input type="text" class="form-control radius-40" id="search" name="search" value="" placeholder= "Pesquise aqui...">
															</div>
														</div>				
																								
													</div>
													<div class="form-row" >
														<div class="btn-group mt-3 w-40">
															<button type="submit" class="btn btn-primary radius-30 btn-block">Buscar
																<i class="lni lni-search-alt"></i>
															</button>
														</div>												
													</div>
												</form>
												<div class="form-row" >
													<hr><hr>
												</div>
												<div class="form-row">
													<div class="card col-md-12">
														<div class="card-body ">
															<hr>
															<div class="card-title">
																<h4 class="mb-0">Subgrupos Cadastrados</h4>
															</div>	
															<hr>
															<!-- tabela -->
															<div class="table-responsive ">
																<table id="example" class="table table-striped table-bordered" style="width:100%">
																	<thead>
																		<tr>
																			<th >Codigo</th>
                                                                            <th >Grupos</th>
																			<th>Descrição</th>																	
																			<th>Editar</th>
																			<th>Excluir</th>
																		</tr>
																	</thead>
																	<tbody>		
																																
																		<?php foreach($searchSubGrupos as $searchSubGrupo): ?>
																			<tr>
																				<td ><?= $searchSubGrupo->id ?></td>
                                                                                <td ><?= $searchSubGrupo->descricaoGrupo ?></td>
																				<td><?= $searchSubGrupo->descricao ?></td>												
																				
																				<td><a href="<?= $BASE_URL ?>subgrupo_cadastro.php?id=<?= $searchSubGrupo->id ?>">Editar</a></td>																		
																				<td>
																					<form action="<?= $BASE_URL ?>subgrupo_process.php" method="POST">
																						<input type="hidden" name="type" value="delete">
																						<input type="hidden" name="id" value="<?= $searchSubGrupo->id ?>">
																						<div class="form-row" >
																							<div class="btn-group mt-2 w-40">
																								<button type="submit" class="btn btn-primary radius-30 btn-block" >Excluir</button>
																							</div>												
																						</div>
																						</button>
																					</form>
																				</td>																		
																			</tr>
																		<?php endforeach; ?>																								
																	</tbody>																														
																</table>
																<?php if(count($searchSubGrupos) === 0): ?>
																	<p class="empty-list">Ainda não há Subgrupos cadastrados ou Subgrupo(s) com a pesquisa realizada!</p>
																<?php endif; ?>		
															</div>
															<!-- fim da tabela -->
														</div>
													</div>
												</div>																					
											</div>
										<?php endif; ?>
										<?php if($search): ?>
											<div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
												<form action="subgrupo_process.php" method="POST">
													<?php if($typeUpdade): ?>
														<input type="hidden" name="type" value="update">
														<input type="hidden" name="id"  value="<?= $id ?>">
													<?php else: ?>
														<input type="hidden" name="type" value="include">
													<?php endif; ?>
													<div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label>Grupo:</label>
															<?php if($subgrupo ): ?>
																<select class="form-control radius-30" id="grupo" name="grupo" required="" value = "<?= $subgrupo->idgrupo ?>" >
																	<option value="">Selecione</option>
																	<?php foreach($grupos as $grupo): ?>                                                                
																		<option value="<?= $grupo->id ?>"><?= $grupo->descricao ?></option>
																	<?php endforeach; ?>
																</select>
															<?php else: ?>
																<select class="form-control radius-30" id="grupo" name="grupo" required="">
																	<option value="">Selecione</option>
																	<?php foreach($grupos as $grupo): ?>                                                                
																		<option value="<?= $grupo->id ?>"><?= $grupo->descricao ?></option>
																	<?php endforeach; ?>
																</select>
															<?php endif; ?>		
                                                        </div>														 
														
														<div class="form-group col-md-6">
															<label>Descrição</label>	
															<?php if($subgrupo ): ?>									
																<input type="text" class="form-control radius-30" id="descricao" name="descricao" value = "<?= $subgrupo->descricao ?>" />
															<?php else: ?>
																<input type="text" class="form-control radius-30" id="descricao" name="descricao"/>
															<?php endif; ?>	
														</div>																								
													</div>
													<div class="btn-group mt-3 w-40">
														<button type="submit" class="btn btn-primary radius-30 btn-block">Gravar
															<i class="lni lni-arrow-right"></i>
														</button>
													</div>
												</form>
											</div>
										<?php else: ?>
											<div class="tab-pane fade show active" id="create" role="tabpanel" aria-labelledby="create-tab">
												<form action="subgrupo_process.php" method="POST">
													<?php if($typeUpdade): ?>
														<input type="hidden" name="type" value="update">
														<input type="hidden" name="id"  value="<?= $id ?>">
													<?php else: ?>
														<input type="hidden" name="type" value="include">
													<?php endif; ?>
													<div class="form-row">
                                                        <div class="form-group col-md-2">
                                                            <label>Grupo:</label>
															<?php if($subgrupo ): ?>
																<select class="form-control radius-30" id="grupo" name="grupo" required="" disabled >
																	<option value="">Selecione</option>
																	<?php foreach($grupos as $grupo): ?>                                                                
																		<option value="<?= $grupo->id ?>"<?= $subgrupo->idgrupo ===  $grupo->id ? "selected" : "" ?> ><?= $grupo->descricao ?></option>
																	<?php endforeach; ?>
																</select>
															<?php else: ?>
																<select class="form-control radius-30" id="grupo" name="grupo" required="">
																	<option value="">Selecione</option>
																	<?php foreach($grupos as $grupo): ?>                                                                
																		<option value="<?= $grupo->id ?>"><?= $grupo->descricao ?></option>
																	<?php endforeach; ?>
																</select>
															<?php endif; ?>																
                                                        </div>	
														<div class="form-group col-md-6">
															<label>Descrição</label>	
															<?php if($subgrupo ): ?>									
																<input type="text" class="form-control radius-30" id="descricao" name="descricao" value = "<?= $subgrupo->descricao ?>" />
															<?php else: ?>
																<input type="text" class="form-control radius-30" id="descricao" name="descricao"/>
															<?php endif; ?>	
														</div>
																								
													</div>
													<div class="btn-group mt-3 w-40">
														<button type="submit" class="btn btn-primary radius-30 btn-block">Gravar
															<i class="lni lni-arrow-right"></i>
														</button>
													</div>
												</form>
											</div>		
										<?php endif; ?>								
									</div>
								</div> 
							</div>
						</div>					
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

