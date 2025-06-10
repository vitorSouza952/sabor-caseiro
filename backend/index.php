<?php
    require_once("config/inicia-sessao.php");
    require_once("config/funcoes.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor Caseiro - Início</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/principal.css"> -->
    <!-- <link rel="stylesheet" href="css/index.css"> -->
    <link rel="stylesheet" href="css/principal.min.css">
    <link rel="stylesheet" href="css/index.min.css">
    <!-- <script src="js/principal.js" defer></script> -->
    <script src="js/principal.min.js" defer></script>
</head>
<body>
    
    <?php
        require_once("templates/cabecalho.html");
    ?>

    <main class="conteudo-principal">
        <h2 class="titulo-conteudo-principal">Seja bem-vindo ao Sabor Caseiro!</h2>
        <div class="area-botoes-chamada-acao">
            <a href="cadastro.php" class="botao botao-chamada-acao">
                Cadastrar produto <i class="bi bi-plus-square"></i>
            </a>
            <a href="consulta.php" class="botao botao-chamada-acao">
                Consultar produtos <i class="bi bi-eye"></i>
            </a>
        </div>
    </main>

    <?php
        require_once("templates/navbar-lateral.html");
        require_once("templates/modal-msg.html");
        require_once("templates/rodape.html");
        require_once("templates/exibir-msg.php");
    ?>

</body>
</html>