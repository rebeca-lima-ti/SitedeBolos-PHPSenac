<?php
include_once("./layout/validacao.php");
$id = $_GET["id"] ?? "";
$titulo = "Novo";
$nome_usuario = $_POST["nome_usuario"] ?? "";
$email_usuario = $_POST["email_usuario"] ?? "";
$senha_usuario = $_POST["senha_usuario"] ?? "";
$foto_usuario = $_FILES["foto_usuario"] ?? "";

if (is_numeric($id)) {
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    // i = número inteiro
    // s = string (texto)
    // d = número decimal
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $total = $resultado->num_rows;
    while ($linha = $resultado->fetch_object()) {
        $nome_usuario = $linha->nome_usuario;
        $email_usuario = $linha->email_usuario;
        $senha_usuario = $linha->senha_usuario;
        $foto_usuario = $linha->foto_usuario;
        $titulo = "Alterar";
        // Criar pasta
        $caminho = __DIR__."/img";
        $pasta = str_pad($id,4,"0", STR_PAD_LEFT);
        if (!is_dir ("$caminho/$pasta")) {
            mkdir("$caminho/$pasta", 0733);
        }
        else {
            $arquivos = scandir("$caminho/$pasta");
            foreach ($arquivos as $arq) {
                if ($arq != "." && $arq != "..") {
                    $imagem = "$pasta/$arq";
                }
            }
        }
    }
}
// Mover foto para a pasta
if (is_numeric($id)) {
    if (isset($_FILES["foto_usuario"]["name"])) {
        if ($_FILES["foto_usuario"]["error"] == 0) {
            $arq_temp = $_FILES["foto_usuario"]["tmp_name"];
            $arq_final = "$caminho/$pasta/".$_FILES["foto_usuario"]["name"];
            move_uploaded_file($arq_temp, $arq_final);
        }
    }
}
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
                    <h1 class="h2">Usuário - <?= $titulo ?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="./cad-usuario.php" class="btn btn-primary">
                                Novo
                            </a>
                            <a href="./usuario.php" class="btn btn-warning">
                                Pesquisa
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Conteudo principal -->
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row p-2">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="id_usuario" class="form-label">ID</label>
                                            <input id="id_usuario" name="id_usuario" value="<?= $id ?>" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="nome_usuario" class="form-label">Nome</label>
                                            <input id="nome_usuario" type="text" name="nome_usuario" value="<?= $nome_usuario ?>" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="email_usuario" class="form-label">E-mail</label>
                                            <input id="email_usuario" type="email" name="email_usuario" value="<?= $email_usuario ?>" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="senha_usuario" class="form-label">Senha</label>
                                            <input id="senha_usuario" type="password" name="senha_usuario" value="<?= $senha_usuario ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="foto_usuario" class="form-label">Foto</label>
                                    <input type="file" id="foto_usuario" name="foto_usuario" class="form-control" accept="image/png, image/jpeg">
                                    <?php 
                                        if (isset($imagem)) {
                                    ?>
                                    <img src="./img/<?= $imagem ?>" class="img-fluid">
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="col-6 m-2">
                                <button type="submit" class="btn btn-success">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("./layout/script-js.php"); ?>
</body>

</html>