<?php
    $db_name = "unicomercial";
    $db_host = "localhost";
    $db_user =  "root";
    $db_pass = "";

    $db_name_unisystem = "unisystem";
    $db_host_unisystem = "localhost";
    $db_user_unisystem =  "root";
    $db_pass_unisystem = "";

    

    $conn = new PDO("mysql:dbname=". $db_name .";host=". $db_host, $db_user, $db_pass);
    $connUni = new PDO("mysql:dbname=". $db_name_unisystem .";host=". $db_host_unisystem, $db_user_unisystem, $db_pass_unisystem);

    // Habilitar erros PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $connUni->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connUni->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    