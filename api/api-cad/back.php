<?php
require_once('../../conexao/conexao.php');

// Cria a conexão
$link = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($link->connect_error) {
    die("Falha na conexão: " . $link->connect_error);
}

// Define o charset como utf8
$link->set_charset("utf8");
?>
