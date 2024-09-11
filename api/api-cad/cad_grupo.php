<?php
require_once('../../conexao/conexao.php');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $descricao = $_POST['descricao'];

    if (empty($descricao)) {
        $response['message'] = 'A descrição não pode estar vazia.';
        echo json_encode($response);
        exit;
    }

    if ($id) {
        // Atualizar registro existente
        $sql = "UPDATE grupo_cadastro SET gc_descricao = ? WHERE gc_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('si', $descricao, $id);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Grupo atualizado com sucesso.';
        } else {
            $response['message'] = 'Erro ao atualizar o grupo.';
        }
    } else {
        // Inserir novo registro
        $sql = "INSERT INTO grupo_cadastro (gc_descricao) VALUES (?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('s', $descricao);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Grupo cadastrado com sucesso.';
        } else {
            $response['message'] = 'Erro ao cadastrar o grupo.';
        }
    }

    $stmt->close();
    $link->close();
}

echo json_encode($response);
