<?php
require_once('../../conexao/conexao.php');

// Cria a conex�o
$link = new mysqli($servername, $username, $password, $dbname);

// Verifica a conex�o
if ($link->connect_error) {
    die("Falha na conex�o: " . $link->connect_error);
}

// Define o charset como utf8
$link->set_charset("utf8");
?>
