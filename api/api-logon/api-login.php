<?php
session_start();
require_once('../../conexao/conexao.php');

header("Content-Type: application/json; charset=utf-8");

// Configurações para o CORS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache por 1 dia
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
}

// Variáveis de controle
$sucesso = false;
$msg = 'Erro desconhecido'; // Mensagem padrão
$usu = ['id' => 0, 'nome' => null, 'cpf' => null, 'foto' => null, 'contrato' => null, 'regra' => null];

// Parâmetros recebidos via POST
$cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

// Validar se CPF e senha foram informados
if (!empty($cpf) && !empty($senha)) {
    $query_login = "SELECT u.id, u.nome, u.cpf, u.foto, ue.id_contrato as contrato, ue.id_role as regra
                    FROM usuario u
                    INNER JOIN usuario_empresa ue ON u.id = ue.id_usuario
                    WHERE u.cpf = ? AND u.senha = SHA2(?, 512)";
                    
    if ($stmt_lgn = mysqli_prepare($link, $query_login)) {
        mysqli_stmt_bind_param($stmt_lgn, "ss", $cpf, $senha);

        if (mysqli_stmt_execute($stmt_lgn)) {
            mysqli_stmt_bind_result($stmt_lgn, $usu['id'], $usu['nome'], $usu['cpf'], $usu['foto'], $usu['contrato'], $usu['regra']);
            mysqli_stmt_store_result($stmt_lgn);
            mysqli_stmt_fetch($stmt_lgn);

            if (mysqli_stmt_num_rows($stmt_lgn) > 0) {
                // Login bem-sucedido
                $sucesso = true;
                $msg = 'Login efetuado com sucesso';
                $_SESSION["s_id"] = $usu['id'];
                $_SESSION["s_nome"] = $usu['nome'];
                $_SESSION["s_foto"] = $usu['foto'];
                $_SESSION["s_contrato"] = $usu['contrato'];
                $_SESSION["s_regra"] = $usu['regra'];
            } else {
                $msg = 'CPF ou senha incorretos';
            }
        } else {
            $msg = 'Erro ao executar consulta: ' . mysqli_error($link);
        }
        mysqli_stmt_close($stmt_lgn);
    } else {
        $msg = 'Erro ao preparar consulta: ' . mysqli_error($link);
    }
} else {
    $msg = 'CPF e senha são obrigatórios';
}

// Preparando a resposta em JSON
$response = [
    'sucesso' => $sucesso,
    'msg' => $msg,
    'usu' => $usu
];

// Enviando a resposta
echo json_encode($response);

// Fechando a conexão com o banco de dados
mysqli_close($link);
?>
