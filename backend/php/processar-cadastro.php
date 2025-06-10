<?php
    require_once("../config/inicia-sessao.php");
    require_once("../config/funcoes.php");

    if (!empty($_POST)) {
        $nome = sanitizarValor($_POST["nome"]);
        $tipo = sanitizarValor($_POST["tipo"]);
        $preco = sanitizarValor($_POST["preco"]);
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;
        $_SESSION["preco"] = $preco;

        if (!validarNome($nome)) {
            desabilitarSessao("nome");

            redirecionar("../cadastro.php", "Erro: O nome do produto é obrigatório e deve conter até 50 caracteres.");
        }

        if (!validarID($tipo)) {
            desabilitarSessao("tipo");   
            redirecionar("../cadastro.php", "Erro: Tipo de produto inválido.");
        }

        if (!validarPreco($preco)) {
            desabilitarSessao("preco");

            redirecionar("../cadastro.php", "Erro: O preço do produto é obrigatório e deve ser um número entre 1 e 999,99.");
        }

        unset($_SESSION["nome"], $_SESSION["tipo"], $_SESSION["preco"]);

        $tipo = intval($tipo);
        $preco = floatval($preco);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=saborCaseiro", "root", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CALL procExisteProdutoCadastro(:nome, :idTipoProduto)";
            $sql = $pdo->prepare($sql);
            $sql->execute(["nome" => $nome, "idTipoProduto" => $tipo]);
            $res = $sql->fetch(PDO::FETCH_ASSOC);

            if ($res["total"] > 0) {
                redirecionar("../cadastro.php", "Erro: Produto já cadastrado.");
            }

            $sql = "CALL procCadastrarProduto(:nome, :preco, :idTipoProduto)";
            $sql = $pdo->prepare($sql);
            $sql->execute(["nome" => $nome, "preco" => $preco, "idTipoProduto" => $tipo]);

            redirecionar("../consulta.php", "Produto cadastrado com sucesso!");
        } catch (PDOException $e) {
            redirecionar("../cadastro.php", "Erro: " . $e->getMessage());
        }
    }
?>