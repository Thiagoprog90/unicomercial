<?php
session_start();
require_once('verificarlogin.php');
require_once('conexao/conexao.php');
$s_foto = $_SESSION["s_foto"];
$s_nome = $_SESSION["s_nome"];
$titulo = 'Unicomercial';
$s_id = $_SESSION["s_id"];
?>
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
                            <h4 class="mb-0">Listagem de Administradores</h4>
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="true">Listagem de Administradores</a>
                                </li>
                            </ul>
                        </div>
                        <hr/>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                 aria-labelledby="profile-tab">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nome da Empresa</th>
                                            <th style="text-align: center;font-size: 12px;width: 60px;">Novo</th>
                                            <th style="text-align: center;font-size: 12px;width: 60px;">Alterar</th>
                                            <th style="text-align: center;font-size: 12px;width: 60px;">Excluir</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query_lista = "SELECT id, nome, nome_curto, empr_ativo FROM empresa WHERE empr_ativo = 1";
                                        if ($stmt_cntrts = mysqli_prepare($link, $query_lista)) {
                                            if (mysqli_stmt_execute($stmt_cntrts)) {
                                                mysqli_stmt_bind_result($stmt_cntrts, $id, $nome, $nome_curto, $empr_ativo);
                                                mysqli_stmt_store_result($stmt_cntrts);
                                                $num_rows_cntrts = mysqli_stmt_num_rows($stmt_cntrts);
                                                if ($num_rows_cntrts > 0) {
                                                    while (mysqli_stmt_fetch($stmt_cntrts)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $id; ?></td>
                                                            <td><?php echo strtoupper($nome); ?></td>
                                                            <td style="text-align: center;/* vertical-align: middle; */">
                                                                <a href="novo_registro.php">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                         stroke-width="2" stroke-linecap="round"
                                                                         stroke-linejoin="round" class="feather feather-file-plus text-primary">
                                                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                                        <line x1="12" y1="18" x2="12" y2="12"></line>
                                                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;/* vertical-align: middle; */">
                                                                <a href="javascript:void(0);" onclick="editRecord(<?php echo $id; ?>, '<?php echo $nome; ?>')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                         stroke-width="2" stroke-linecap="round"
                                                                         stroke-linejoin="round" class="feather feather-edit text-primary">
                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                            <td style="text-align: center;/* vertical-align: middle; */">
                                                                <form method="POST" action="excluir_registro.php" onsubmit="confirmarExclusao(event)">
                                                                    <input type="hidden" name="id" value="2">
                                                                    <button type="submit" style="border: none; background: none;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-primary">
                                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "<td colspan='5' style='text-align: center;'>Nenhuma empresa encontrada</td>";
                                                }
                                            }
                                            mysqli_stmt_close($stmt_cntrts);
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
