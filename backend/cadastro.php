<?php
    require_once("config/inicia-sessao.php");
    require_once("config/funcoes.php");

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=saborCaseiro", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $res = existemTiposProduto($pdo);
    } catch (PDOException $e) {
        redirecionar("index.php", "Erro: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor Caseiro - Cadastro de produto</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/principal.css"> -->
    <!-- <link rel="stylesheet" href="css/cadastro.css"> -->
    <link rel="stylesheet" href="css/principal.min.css">
    <link rel="stylesheet" href="css/cadastro.min.css">
    <!-- <script src="js/principal.js" defer></script> -->
    <!-- <script src="js/cadastro.js" defer></script> -->
    <script src="js/principal.min.js" defer></script>
    <script src="js/cadastro.min.js" defer></script>
</head>
<body>

    <?php
        require_once("templates/cabecalho.html");
    ?>

    <main class="conteudo-principal">
        <h2 class="titulo-conteudo-principal">
            Cadastro de produto <i class="bi bi-plus-square"></i>
        </h2>
        <form action="php/processar-cadastro.php" method="POST" id="form-cadastro" class="form">
            <label for="nome">
                Nome: <sup class="campo-obrigatorio">*</sup>
            </label>
            <input type="text" name="nome" id="nome" class="campo" placeholder="Nome do produto" value="<?= $_SESSION["nome"] ?? "" ?>" maxlength="50" required>
            <label for="tipo">
                Tipo: <sup class="campo-obrigatorio">*</sup>
            </label>
            <select name="tipo" id="tipo" class="campo" required>
                <option value="">Selecione uma opção</option>
                
                <?php
                    foreach ($res as $col) :
                ?>

                        <option value="<?= $col["idTipoProduto"] ?>" <?= isset($_SESSION["tipo"]) && intval($_SESSION["tipo"]) === $col["idTipoProduto"] ? "selected" : "" ?>><?= $col["nomeTipoProduto"] ?></option>

                <?php
                    endforeach;
                ?>

            </select>
            <label for="preco">
                Preço: <sup class="campo-obrigatorio">*</sup>
            </label>
            <input type="number" name="preco" id="preco" class="campo" placeholder="Preço do produto" value="<?= $_SESSION["preco"] ?? "" ?>" min="1" max="999.99" step=".01" required>
            <button type="submit" class="botao botao-enviar">
                Cadastrar <i class="bi bi-plus-square"></i>
            </button>
        </form>
    </main>

    <?php
        require_once("templates/navbar-lateral.html");
        require_once("templates/modal-msg.html");
        require_once("templates/rodape.html");
        require_once("templates/exibir-msg.php");
    ?>
    
</body>
</html>