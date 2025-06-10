<?php
    require_once("config/inicia-sessao.php");
    require_once("config/funcoes.php");

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=saborCaseiro", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resTiposProduto = existemTiposProduto($pdo);
        $sql = "SELECT * FROM vwSelecionarProdutos";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $resProdutos = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (empty($resProdutos)) {
            redirecionar("cadastro.php", "Erro: Não há produtos cadastrados.");
        }
    } catch (PDOException $e) {
        redirecionar("index.php", "Erro: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor Caseiro - Consulta de produtos</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="css/principal.css"> -->
    <!-- <link rel="stylesheet" href="css/consulta.css"> -->
    <link rel="stylesheet" href="css/principal.min.css">
    <link rel="stylesheet" href="css/consulta.min.css">
    <!-- <script src="js/principal.js" defer></script> -->
    <!-- <script src="js/consulta.js" defer></script> -->
    <script src="js/principal.min.js" defer></script>
    <script src="js/consulta.min.js" defer></script>
</head>
<body>
    
    <?php
        require_once("templates/cabecalho.html");
    ?>

    <main class="conteudo-principal">
        <h2 class="titulo-conteudo-principal">
            Consulta de produtos <i class="bi bi-eye"></i>
        </h2>
        <div class="area-tabela-produtos">
            <table class="tabela-produtos">
                <tr>
                    <th class="titulo-tabela-produtos">#</th>
                    <th class="titulo-tabela-produtos">Nome</th>
                    <th class="titulo-tabela-produtos">Tipo</th>
                    <th class="titulo-tabela-produtos">Preço</th>
                    <th class="titulo-tabela-produtos">Ações</th>
                </tr>

                <?php
                    foreach ($resProdutos as $col) :
                ?>

                        <tr class="linha-tabela-produtos">
                            <td class="celula-tabela-produtos"><?= $col["idProduto"] ?></td>
                            <td class="celula-tabela-produtos"><?= $col["nomeProduto"] ?></td>
                            <td class="celula-tabela-produtos"><?= $col["nomeTipoProduto"] ?></td>
                            <td class="celula-tabela-produtos"><?= "R$ " . number_format($col["precoProduto"], 2, ",") ?></td>
                            <td class="celula-tabela-produtos">
                                <div class="area-acoes-produto">
                                    <button type="button" class="botao botao-acao-produto botao-editar">
                                        Editar <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="button" class="botao botao-acao-produto botao-deletar">
                                        Deletar <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                <?php
                    endforeach;
                ?>
            </table>
        </div>
    </main>

    <?php
        require_once("templates/navbar-lateral.html");
    ?>

    <div id="fundo-modal-edicao" class="fundo esconder"></div>
    <div id="modal-edicao" class="modal esconder">
        <h3 class="titulo-modal">
            Edição de produto <i class="bi bi-pencil-square"></i>
        </h3>
        <form action="php/processar-edicao.php" method="POST" id="form-edicao" class="form-edicao">
            <input type="hidden" name="id" id="id-edicao">
            <label for="nome">
                Nome: <sup class="campo-obrigatorio">*</sup>
            </label>
            <input type="text" name="nome" id="nome" class="campo" placeholder="Nome do produto" maxlength="50" required>
            <label for="tipo">
                Tipo: <sup class="campo-obrigatorio">*</sup>
            </label>
            <select name="tipo" id="tipo" class="campo" required>
                <option value="">Selecione uma opção</option>
                
                <?php
                    foreach ($resTiposProduto as $col) :
                ?>

                        <option value="<?= $col["idTipoProduto"] ?>"><?= $col["nomeTipoProduto"] ?></option>

                <?php
                    endforeach;
                ?>

            </select>
            <label for="preco">
                Preço: <sup class="campo-obrigatorio">*</sup>
            </label>
            <input type="number" name="preco" id="preco" class="campo" placeholder="Preço do produto" min="1" max="999.99" step=".01" required>
            <div class="area-botoes-form-edicao">
                <button type="submit" class="botao botao-form-edicao botao-enviar">
                    Editar <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" id="botao-cancelar-edicao" class="botao botao-form-edicao botao-cancelar">
                    Cancelar <i class="bi bi-x-square"></i>
                </button>
            </div>
        </form>
    </div>

    <div id="fundo-modal-confirmacao" class="fundo esconder"></div>
    <div id="modal-confirmacao" class="modal esconder">
        <h3 class="titulo-modal">
            Atenção <i class="bi bi-exclamation-triangle"></i>
        </h3>
        <p class="txt-modal">Tem certeza?</p>
        <form action="php/processar-delecao.php" method="POST" id="form-delecao" class="form-delecao">
            <input type="hidden" name="id" id="id-delecao">
            <button type="submit" class="botao botao-form-delecao botao-enviar">
                Sim <i class="bi bi-check-square"></i>
            </button>
            <button type="button" id="botao-cancelar-delecao" class="botao botao-form-delecao botao-cancelar">
                Não <i class="bi bi-x-square"></i>
            </button>
        </form>
    </div>

    <?php
        require_once("templates/modal-msg.html");
        require_once("templates/rodape.html");
        require_once("templates/exibir-msg.php");
    ?>

</body>
</html>
