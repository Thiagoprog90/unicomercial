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

// Receber os dados via POST
$id = $_POST['id'] ?? null;
$descricao = $_POST['descricao'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        // Excluir o registro
        $stmt = $link->prepare('DELETE FROM grupo_cadastro WHERE gc_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    } elseif ($id) {
        // Se ID estiver presente, atualizar o registro
        $stmt = $link->prepare('UPDATE grupo_cadastro SET gc_descricao = ? WHERE gc_id = ?');
        $stmt->bind_param('si', $descricao, $id);
        $stmt->execute();
    } else {
        // Caso contrário, adicionar um novo registro
        $stmt = $link->prepare('INSERT INTO grupo_cadastro (gc_descricao) VALUES (?)');
        $stmt->bind_param('s', $descricao);
        $stmt->execute();
    }

    // Redirecionar após a submissão do formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Buscar registros existentes
$sql = "SELECT * FROM grupo_cadastro";
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
    <title>Cadastro de Grupos</title>
    <!-- Incluindo Bootstrap CSS, DataTables CSS e jQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
   
</head>
<body>
    <div class="container">
        <h2>Cadastro de Grupos</h2>

        <!-- Abas de Navegação -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tabela</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Aba de Cadastro -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form method="POST" class="mt-4">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <input type="text" id="descricao" name="descricao" required>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>

            <!-- Aba de Tabela -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Tabela de Registros -->
                <table id="example" class="display mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['gc_id']) ?></td>
                                <td><?= htmlspecialchars($row['gc_descricao']) ?></td>
                                <td>
                                    <!-- Botão de Editar -->
                                    <button class="btn btn-primary" onclick="editRecord('<?= $row['gc_id'] ?>', '<?= htmlspecialchars($row['gc_descricao'], ENT_QUOTES) ?>')">Editar</button>
                                    <!-- Botão de Excluir -->
                                    <form method="POST" style="display:inline-block;">
                                        <input type="hidden" name="id" value="<?= $row['gc_id'] ?>">
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

    <!-- Incluindo Bootstrap JS, jQuery e DataTables JS -->
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

        function editRecord(id, descricao) {
            $('#id').val(id);
            $('#descricao').val(descricao);
            $('#myTab a[href="#home"]').tab('show'); // Show the "Cadastro" tab
        }
    </script>
</body>
</html>
