<?php
session_start();
require_once('verificarlogin.php');
require_once('conexao/conexao.php');
$s_foto = $_SESSION["s_foto"];
$s_nome = $_SESSION["s_nome"];
$titulo = 'Unicomercial';
$s_id = $_SESSION["s_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head_admin.php'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Inclui SweetAlert -->
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
                                <h4 class="mb-0">Cadastro de Grupo</h4>
                                <br>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                           aria-controls="home" aria-selected="true">Cadastro</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                           aria-controls="profile" aria-selected="false">Tabela</a>
                                    </li>
                                </ul>
                            </div>
                            <hr/>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <!-- Formulário de Cadastro -->
                                    <form id="formCadastro" class="needs-validation" novalidate="">
                                        <input type="hidden" id="id" name="id">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="descricao">Descri&ccedil;&atilde;o:</label>
                                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-12">
                                                        <button type="submit" class="btn btn-primary px-5 radius-30">Salvar</button>
                                                        <button type="button" class="btn btn-secondary px-5 radius-30" onclick="cancelar();">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Tabela -->
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Descri&ccedil;&atilde;o:</th>
                                                <th style="text-align: center;">Alterar</th>
                                                <th style="text-align: center;">Excluir</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM grupo_cadastro";
                                            $result = $link->query($sql);
                                            while ($row = $result->fetch_assoc()):
                                                ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['gc_id']) ?></td>
                                                    <td><?= htmlspecialchars($row['gc_descricao']) ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="javascript:void(0);" onclick="editRecord(<?= $row['gc_id'] ?>, '<?= $row['gc_descricao'] ?>')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-edit text-primary">
                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <button type="button" onclick="excluirRegistro(<?= $row['gc_id'] ?>);" style="border: none; background: none;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-trash-2 text-primary">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <?php include('footer.php'); ?>
        </div>
    </div>

    <?php include('header_js.php'); ?>

<script>
   $(document).ready(function () {
    var table = $('#example').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json"
        }
    });

    // Manipular o envio do formulário de cadastro/edição
    $('#formCadastro').on('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('api/api-cad/cad_grupo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Verifica se o status HTTP é 200 (OK)
            if (!response.ok) {
                throw new Error('Erro ao processar a requisição');
            }
            return response.json();  // Converte a resposta para JSON
        })
        .then(data => {
            if (data.success) {
                // Se sucesso, exibe o SweetAlert de sucesso
                Swal.fire({
                    title: 'Sucesso!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#formCadastro')[0].reset(); // Resetar o formulário
                    $('#myTab a[href="#profile"]').tab('show'); // Mudar para a aba "Tabela"
                    location.reload(); // Recarregar a página para atualizar a tabela
                });
            } else {
                // Se erro, exibe o SweetAlert de erro
                Swal.fire({
                    title: 'Erro!',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            // Caso ocorra um erro no processamento ou na requisição
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao processar a solicitação.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });

    // Função para cancelar a edição
    function cancelar() {
        $('#formCadastro')[0].reset(); // Resetar o formulário
        $('#myTab a[href="#profile"]').tab('show'); // Ir para a aba "Tabela"
    }

    // Função para editar registro
    function editRecord(id, descricao) {
        $('#id').val(id);
        $('#descricao').val(descricao);
        $('#myTab a[href="#home"]').tab('show'); // Ir para a aba "Cadastro"
    }

    // Função para excluir registro com confirmação via SweetAlert
    function excluirRegistro(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Deseja excluir o grupo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('api/api-delete/del-grupo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao processar a requisição');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Exclu&iacute;do!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Recarregar a página para atualizar a tabela
                        });
                    } else {
                        Swal.fire({
                            title: 'Erro!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Ocorreu um erro ao processar a solicitação.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    }

    // Expor funções para o escopo global (HTML)
    window.cancelar = cancelar;
    window.editRecord = editRecord;
    window.excluirRegistro = excluirRegistro;
});

</script>
</body>
</html>
