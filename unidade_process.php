<?php

    require_once("models/Unidade.php");
    require_once("models/Message.php");
    require_once("dao/UnidadeDAO.php");
    require_once("globals.php");
    require_once("db.php");

    $message = new Message($BASE_URL);
    $unidadeDao = new UnidadeDAO($conn, $BASE_URL);

    // Verifica Formulario

    $type = filter_input(INPUT_POST,"type");

    if($type === "include"){
        $descricao = filter_input(INPUT_POST, "descricao");
        $sigla = filter_input(INPUT_POST, "sigla");

        if($descricao && $sigla ){
            $unidade = new Unidade();
            $unidade->descricao = $descricao;
            $unidade->sigla = $sigla;
            $unidadeDao->create($unidade);
        
        }else{
           //Enviar msg erro, de dados faltantes 
           $message->setMessage("Por favor preencha todos os campos","error","back");
        }
    }else if($type === "update"){
        $id = filter_input(INPUT_POST, "id");
        $descricao = filter_input(INPUT_POST, "descricao");
        $sigla = filter_input(INPUT_POST, "sigla");

        $unidadedata = $unidadeDao->findById($id);
        if($unidadedata){            
            if($descricao && $sigla){
                $unidadedata->descricao = $descricao;
                $unidadedata->sigla = $sigla;


                $unidadeDao->update($unidadedata);

            } else {

                $message->setMessage("Informações inválidas!", "error", "back");

            }

        } else {

            $message->setMessage("Informações inválidas!", "error", "back");

        }
        

    } else if($type === "delete") {
        
        
        $id = filter_input(INPUT_POST, "id");
        $unidade = $unidadeDao->findById($id);
		if($unidade) {
		 	$unidadeDao->deleteUnidade($id);     	

		} else {
			$message->setMessage("Informações inválidas!", "error", "index.php");
		}
    }