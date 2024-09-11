<?php

// Configurações do banco de dados
$hostname_1 = "localhost";
$username_1 = "root";
$password_1 = "";
$database_1 = "unisystem";

// Conectar ao banco de dados
$link = mysqli_connect($hostname_1, $username_1, $password_1, $database_1);
mysqli_set_charset($link, 'utf8mb4');

if (!$link) {
    die("Error: Unable to connect to MySQL. Debugging errno: " . mysqli_connect_errno() . " Debugging error: " . mysqli_connect_error());
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sc_id = $_POST['sc_id'] ?? null;
    $gc_id = $_POST['gc_id'] ?? null;
    $sc_descricao = $_POST['sc_descricao'] ?? null;

    if (isset($_POST['delete'])) {
        // Excluir o registro
        $stmt = $link->prepare('DELETE FROM subgrupo_cadastro WHERE sc_id = ?');
        $stmt->bind_param('i', $sc_id);
        if ($stmt->execute()) {
            $message = 'Registro excluído com sucesso.';
        } else {
            $message = 'Erro ao excluir o registro.';
        }
    } elseif ($sc_descricao) {
        if ($sc_id) {
            // Se sc_id estiver presente, atualizar o registro
            $stmt = $link->prepare('UPDATE subgrupo_cadastro SET gc_id = ?, sc_descricao = ? WHERE sc_id = ?');
            $stmt->bind_param('isi', $gc_id, $sc_descricao, $sc_id);
            if ($stmt->execute()) {
                $message = 'Registro atualizado com sucesso.';
            } else {
                $message = 'Erro ao atualizar o registro.';
            }
        } else {
            // Caso contrário, adicionar um novo registro
            $stmt = $link->prepare('INSERT INTO subgrupo_cadastro (gc_id, sc_descricao) VALUES (?, ?)');
            $stmt->bind_param('is', $gc_id, $sc_descricao);
            if ($stmt->execute()) {
                $message = 'Novo registro adicionado com sucesso.';
            } else {
                $message = 'Erro ao adicionar o registro.';
            }
        }
    } else {
        $message = 'Descrição é obrigatória.';
    }

    // Redirecionar após a submissão do formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Buscar registros existentes
$sql = "SELECT * FROM subgrupo_cadastro";
$result = $link->query($sql);

if (!$result) {
    die("Erro na consulta SQL: " . $link->error);
}

// Fechar a conexão após a consulta
$link->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Subgrupos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Subgrupos</h2>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tabela</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form method="POST" class="mt-4">
                    <input type="hidden" id="sc_id" name="sc_id">
                    <div class="form-group">
                        <label for="gc_id">Grupo ID:</label>
                        <input type="number" id="gc_id" name="gc_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sc_descricao">Descrição:</label>
                        <input type="text" id="sc_descricao" name="sc_descricao" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table id="example" class="display mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Grupo ID</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['sc_id']) ?></td>
                                <td><?= htmlspecialchars($row['gc_id']) ?></td>
                                <td><?= htmlspecialchars($row['sc_descricao']) ?></td>
                                <td>
                                    <button class="btn btn-primary" onclick="editRecord('<?= $row['sc_id'] ?>', '<?= $row['gc_id'] ?>', '<?= htmlspecialchars($row['sc_descricao'], ENT_QUOTES) ?>')">Editar</button>
                                    <form method="POST" style="display:inline-block;">
                                        <input type="hidden" name="sc_id" value="<?= $row['sc_id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este registro?');">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json"
                }
            });
        });

        function editRecord(sc_id, gc_id, descricao) {
            $('#sc_id').val(sc_id);
            $('#gc_id').val(gc_id);
            $('#sc_descricao').val(descricao);
            $('#myTab a[href="#home"]').tab('show'); // Show the "Cadastro" tab
        }
    </script>
</body>
</html>
