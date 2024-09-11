<?php
session_start();
require_once('verificarlogin.php');
require_once('conexao/conexao.php');
$s_foto = $_SESSION["s_foto"];
$s_nome = $_SESSION["s_nome"];
$titulo = 'Unicomercial';
$s_id = $_SESSION["s_id"];

$titulo = 'Cadastro de Empresa';
$id_usuario_insert = $_SESSION["s_id"];
$p_id = (isset($_GET["p_id"]) && !empty($_GET["p_id"])) ? $_GET["p_id"] : 0;

$row_atu = array(
    'id' => 0,
    'razao_social' => null,
    'nome' => null,
    'cnpj' => null,
    'insc_estadual' => null,
    'insc_municipal' => null,
    'empr_ativo' => 1,
    'empr_telefone' => null,
    'empr_email' => null,
    'empr_end_cep' => null,
    'empr_end_bairro' => null,
    'empr_endereco' => null,
    'empr_end_numero' => null,
    'empr_end_complemento' => null,
    'id_cidade' => null,
    'id_est' => null,
    'empr_logo' => null
);

if ($p_id > 0) {
    $query_atualiza = "SELECT * FROM empresa WHERE id = ?";
    if ($stmt_atu = mysqli_prepare($link, $query_atualiza)) {
        mysqli_stmt_bind_param($stmt_atu, "i", $p_id);
        if (mysqli_stmt_execute($stmt_atu)) {
            mysqli_stmt_bind_result($stmt_atu, $row_atu['id'], $row_atu['razao_social'], $row_atu['nome'], $row_atu['cnpj'], $row_atu['insc_estadual'], $row_atu['insc_municipal'], $row_atu['empr_ativo'], $row_atu['empr_telefone'], $row_atu['empr_email'], $row_atu['empr_end_cep'], $row_atu['empr_end_bairro'], $row_atu['empr_endereco'], $row_atu['empr_end_numero'], $row_atu['empr_end_complemento'], $row_atu['id_cidade'], $row_atu['id_est'], $row_atu['empr_logo']);
            mysqli_stmt_fetch($stmt_atu);
        }
        mysqli_stmt_close($stmt_atu);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('head_admin.php'); ?>
</head>
<body>
<div class="wrapper">
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <?php include('sidebar.php'); ?>
        </div>
        <?php include('menu.php'); ?>
    </div>
    <header class="top-header">
        <nav class="navbar navbar-expand">
            <?php include('topbar.php'); ?>
        </nav>
    </header>
    <div class="page-wrapper">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="card radius-15 border-lg-top-primary">
                    <div class="card-body">
                        <div class="card-title">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dados da Empresa</h3>
                    </div>

                    <!-- Formulário -->
                    <form method="POST" action="processa_empresa.php" enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Razão Social -->
                            <div class="form-group">
                                <label for="razao_social">Razão Social</label>
                                <input type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo $row_atu['razao_social']; ?>" required>
                            </div>

                            <!-- Nome Fantasia -->
                            <div class="form-group">
                                <label for="nome">Nome Fantasia</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row_atu['nome']; ?>" required>
                            </div>

                            <!-- CNPJ -->
                            <div class="form-group">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $row_atu['cnpj']; ?>" required>
                            </div>

                            <!-- Inscrição Estadual -->
                            <div class="form-group">
                                <label for="insc_estadual">Inscrição Estadual</label>
                                <input type="text" class="form-control" id="insc_estadual" name="insc_estadual" value="<?php echo $row_atu['insc_estadual']; ?>">
                            </div>

                            <!-- Inscrição Municipal -->
                            <div class="form-group">
                                <label for="insc_municipal">Inscrição Municipal</label>
                                <input type="text" class="form-control" id="insc_municipal" name="insc_municipal" value="<?php echo $row_atu['insc_municipal']; ?>">
                            </div>

                            <!-- Telefone -->
                            <div class="form-group">
                                <label for="empr_telefone">Telefone</label>
                                <input type="text" class="form-control" id="empr_telefone" name="empr_telefone" value="<?php echo $row_atu['empr_telefone']; ?>" required>
                            </div>

                            <!-- E-mail -->
                            <div class="form-group">
                                <label for="empr_email">E-mail</label>
                                <input type="email" class="form-control" id="empr_email" name="empr_email" value="<?php echo $row_atu['empr_email']; ?>" required>
                            </div>

                            <!-- Endereço -->
                            <div class="form-group">
                                <label for="empr_endereco">Endereço</label>
                                <input type="text" class="form-control" id="empr_endereco" name="empr_endereco" value="<?php echo $row_atu['empr_endereco']; ?>" required>
                            </div>

                            <!-- Número -->
                            <div class="form-group">
                                <label for="empr_end_numero">Número</label>
                                <input type="text" class="form-control" id="empr_end_numero" name="empr_end_numero" value="<?php echo $row_atu['empr_end_numero']; ?>">
                            </div>

                            <!-- Complemento -->
                            <div class="form-group">
                                <label for="empr_end_complemento">Complemento</label>
                                <input type="text" class="form-control" id="empr_end_complemento" name="empr_end_complemento" value="<?php echo $row_atu['empr_end_complemento']; ?>">
                            </div>

                            <!-- CEP -->
                            <div class="form-group">
                                <label for="empr_end_cep">CEP</label>
                                <input type="text" class="form-control" id="empr_end_cep" name="empr_end_cep" value="<?php echo $row_atu['empr_end_cep']; ?>" required>
                            </div>

                            <!-- Estado -->
                            <div class="form-group">
                                <label for="id_est">Estado</label>
                                <select class="form-control" id="id_est" name="id_est" required>
                                    <!-- Gerar opções de estados -->
                                    <?php
                                    $query_estados = "SELECT id, nome FROM estados ORDER BY nome";
                                    $result = mysqli_query($link, $query_estados);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($row['id'] == $row_atu['id_est']) ? 'selected' : '';
                                        echo "<option value='{$row['id']}' $selected>{$row['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Cidade -->
                            <div class="form-group">
                                <label for="id_cidade">Cidade</label>
                                <select class="form-control" id="id_cidade" name="id_cidade" required>
                                    <?php
                                    if ($row_atu['id_est']) {
                                        $query_cidades = "SELECT id, nome FROM cidade WHERE id_estado = " . $row_atu['id_est'];
                                        $result = mysqli_query($link, $query_cidades);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['id'] == $row_atu['id_cidade']) ? 'selected' : '';
                                            echo "<option value='{$row['id']}' $selected>{$row['nome']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Logo da Empresa -->
                            <div class="form-group">
                                <label for="empr_logo">Logo da Empresa</label>
                                <input type="file" class="form-control-file" id="empr_logo" name="empr_logo">
                                <?php if ($row_atu['empr_logo']) { ?>
                                    <img src="uploads/<?php echo $row_atu['empr_logo']; ?>" alt="Logo" class="img-thumbnail mt-2" style="max-width: 150px;">
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Botões de ação -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a href="empresas.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
   </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay toggle-btn-mobile"></div>
                <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                <div class="footer">
                    <?php include('footer.php'); ?>
                </div>
            </div>
            <div class="switcher-wrapper">
                <div class="switcher-btn">
                    <i class='bx bx-cog bx-spin'></i>
                </div>
                <div class="switcher-body"></div>
            </div>
        </div>
    </div>

    <?php include('header_js.php'); ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json"
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            const mensagem = urlParams.get('mensagem');
            if (mensagem === 'editado') {
                Swal.fire('Sucesso', 'Registro editado com sucesso!', 'success');
            } else if (mensagem === 'inserido') {
                Swal.fire('Sucesso', 'Registro inserido com sucesso!', 'success');
            } else if (mensagem === 'excluido') {
                Swal.fire('Sucesso', 'Registro excluído com sucesso!', 'success');
            } else if (mensagem === 'erro') {
                Swal.fire('Erro', 'Ocorreu um problema na operação!', 'error');
            }
        });

        function confirmarExclusao(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        function editRecord(id, nome) {
            Swal.fire({
                title: 'Editar Empresa',
                html: `
                    <form method="POST" action="editar_registro.php" id="editForm">
                        <input type="hidden" name="id" value="${id}">
                        <input type="text" id="nome" name="nome" class="swal2-input" value="${nome}">
                    </form>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    document.getElementById('editForm').submit();
                }
            });
        }
    </script>
</body>
</html>
