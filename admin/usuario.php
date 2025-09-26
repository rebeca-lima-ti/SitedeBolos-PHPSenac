<?php
include_once("./layout/validacao.php");
$sql = "SELECT * FROM usuarios ORDER BY nome_usuario";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();
$total = $resultado->num_rows;
?>

<!doctype html>
<html lang="pt-BR" data-bs-theme="auto">

<head>
    <title>Sistema - Sweet Bliss Cakes</title>
    <?php include_once("./layout/head.php"); ?>
</head>

<body>
    <?php
    include_once("./layout/botao-tema.php");
    include_once("./layout/menu-principal.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("./layout/menu-lateral.php"); ?>

            <!-- Conteudo principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <!-- Titulo principal -->
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Usuários - Principal</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                Botão 1
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                Botão 2
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Conteudo principal -->
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 2.7rem;">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col" style="width: 10rem;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0;
                                    while($linha = $resultado->fetch_object()) {
                                        $i++;
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $linha -> nome_usuario ?></td>
                                    <td><?= $linha -> email_usuario ?></td>
                                    <td>
                                        <a href="./cad-usuario.php" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger me-2">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("./layout/script-js.php"); ?>
</body>

</html>