<?php
    require_once("globals.php");
    require_once("db.php");
	require_once("models/Message.php");
    require_once("dao/UserDAO.php");
	require_once("dao/GrupoDAO.php");

   $searchTable = filter_input(INPUT_GET, "search");
   $userDao = new UserDAO($conn, $BASE_URL);

	$grupoDao = new GrupoDAO($conn, $BASE_URL);

	$GruposCadastrados = $grupoDao->findAll();

	$id = filter_input(INPUT_GET, "id");
	$searchTable = filter_input(INPUT_GET, "search");
	$grupo = $grupoDao->findByDescricao($searchTable);
   echo $grupo;
    