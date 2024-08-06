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
        $grupo = filter_input(INPUT_POST, "grupo");
        $descricao = filter_input(INPUT_POST, "descricao");

        if($descricao && $grupo ){
            $subgrupo = new Subgrupo();
            $subgrupo->grupo = $grupo;
            $subgrupo->descricao = $descricao;
            $subgrupoDao->create($subgrupo);
        
        }else{
           //Enviar msg erro, de dados faltantes 
           $message->setMessage("Por favor preencha todos os campos","error","back");
        }

    }