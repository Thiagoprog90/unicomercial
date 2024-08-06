<?php

    require_once("models/Grupo.php");
    require_once("models/Message.php");
    require_once("dao/GrupoDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $grupoDao = new GrupoDAO($conn, $BASE_URL);

    // Verifica Formulario

    $type = filter_input(INPUT_POST,"type");

    if($type === "include"){
        $descricao = filter_input(INPUT_POST, "descricao");
        if($descricao  ){
            $grupo = new Grupo();
            $grupo->descricao = $descricao;
            $grupoDao->create($grupo);
        
        }else{
           //Enviar msg erro, de dados faltantes 
           $message->setMessage("Por favor preencha todos os campos","error","back");
        }

    }else if($type === "update"){
        $id = filter_input(INPUT_POST, "id");
        $descricao = filter_input(INPUT_POST, "descricao");

        $grupoData = $grupoDao->findById($id);
        if($grupoData){
            if($descricao ){
                $grupoData->descricao = $descricao;
                $grupoDao->update($grupoData);

            } else {

                $message->setMessage("Informações inválidas!", "error", "back");

            }

        } else {

            $message->setMessage("Informações inválidas!", "error", "back");

        }
        

    } else if($type === "delete") {
        
        
        $id = filter_input(INPUT_POST, "id");
        $grupo = $grupoDao->findById($id);
		if($grupo) {
		 	$grupoDao->deleteGrupo($id);     	

		} else {
			$message->setMessage("Informações inválidas!", "error", "index.php");
		}
    }