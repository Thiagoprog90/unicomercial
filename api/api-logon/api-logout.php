<?php
session_start();

// Tente deslogar o usuário
try {
    unset($_SESSION["s_id"]);
    unset($_SESSION["s_nome"]);
    unset($_SESSION["s_idr"]);
    
    // Se tudo der certo, retorne sucesso
    echo json_encode(['success' => true, 'message' => 'Logout realizado com sucesso!']);
} catch (Exception $e) {
    // Em caso de erro, retorne a mensagem de erro
    echo json_encode(['success' => false, 'message' => 'Erro ao deslogar.']);
}