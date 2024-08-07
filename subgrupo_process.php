<?php

    require_once("models/Subgrupo.php");
    require_once("models/Message.php");
    require_once("dao/SubgrupoDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $subgrupoDao = new SubgrupoDAO($conn, $BASE_URL);

    // Verifica Formulario

    $type = filter_input(INPUT_POST,"type");

    if($type === "include"){
        $idgrupo = filter_input(INPUT_POST, "grupo");
        $descricao = filter_input(INPUT_POST, "descricao");

        if($descricao && $idgrupo ){
            $subgrupo = new Subgrupo();
            $subgrupo->idgrupo = $idgrupo;
            $subgrupo->descricao = $descricao;
            $subgrupoDao->create($subgrupo);
        
        }else{
           //Enviar msg erro, de dados faltantes 
           $message->setMessage("Por favor preencha todos os campos","error","back");
        }

    }else if($type === "update"){
        $id = filter_input(INPUT_POST, "id");
        $descricao = filter_input(INPUT_POST, "descricao");
        $idgrupo = filter_input(INPUT_POST, "grupo");


        $subgrupoData = $subgrupoDao->findById($id);
        if($subgrupoData){            
            if($descricao ){
                $subgrupoData->descricao = $descricao;
                $subgrupoDao->update($subgrupoData);

            } else {

                $message->setMessage("Informações inválidas!", "error", "back");

            }

        } else {

            $message->setMessage("Informações inválidas!", "error", "back");

        }
        

    } else if($type === "delete") {
        
        
        $id = filter_input(INPUT_POST, "id");
        $subgrupo = $subgrupoDao->findById($id);
		if($subgrupo) {
		 	$subgrupoDao->deleteSubGrupo($id);     	

		} else {
			$message->setMessage("Informações inválidas!", "error", "index.php");
		}
    }