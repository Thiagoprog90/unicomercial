

<?php
require_once('../../conexao/conexao.php');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
   



    if ($id) {
        // Atualizar registro existente
        $sql = "DELETE FROM grupo_cadastro WHERE gc_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Grupo excluido com sucesso.';
        } else {
            $response['message'] = 'Erro ao atualizar o grupo.';
        }
    } else {
        // Inserir novo registro
        $sql = "DELETE FROM grupo_cadastro WHERE gc_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Grupo excluido com sucesso.';
        } else {
            $response['message'] = 'Erro ao cadastrar o grupo.';
        }
    }

    $stmt->close();
    $link->close();
}

echo json_encode($response);
