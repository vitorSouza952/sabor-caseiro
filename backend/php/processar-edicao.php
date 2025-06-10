<?php
    require_once("../config/inicia-sessao.php");
    require_once("../config/funcoes.php");

    if (!empty($_POST)) {
        $id = sanitizarValor($_POST["id"]);
        $nome = sanitizarValor($_POST["nome"]);
        $tipo = sanitizarValor($_POST["tipo"]);
        $preco = sanitizarValor($_POST["preco"]);

        if (!validarID($id)) {
            redirecionar("../consulta.php", "O ID do produto é obrigatório e deve ser um número maior ou igual a 1.");
        }

        if (!validarNome($nome)) {
            redirecionar("../consulta.php", "Erro: O nome do produto é obrigatório e deve conter até 50 caracteres.");
        }

        if (!validarID($tipo)) {
            redirecionar("../consulta.php", "Erro: Tipo de produto inválido.");
        }

        if (!validarPreco($preco)) {
            redirecionar("../consulta.php", "Erro: O preço do produto é obrigatório e deve ser um número entre 1 e 999,99.");
        }

        $id = intval($id);
        $tipo = intval($tipo);
        $preco = floatval($preco);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=saborCaseiro", "root", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (existeProdutoCadastrado($pdo, $id)) {
                $sql = "CALL procExisteProdutoEdicao(:nome, :idTipoProduto, :id)";
                $sql = $pdo->prepare($sql);
                $sql->execute(["nome" => $nome, "idTipoProduto" => $tipo, "id" => $id]);
                $res = $sql->fetch(PDO::FETCH_ASSOC);

                if ($res["total"] > 0) {
                    redirecionar("../consulta.php", "Erro: Produto já cadastrado.");
                }

                $sql = "CALL procEditarProduto(:nome, :preco, :idTipoProduto, :id)";
                $sql = $pdo->prepare($sql);
                $sql->execute(["nome" => $nome, "preco" => $preco, "idTipoProduto" => $tipo, "id" => $id]);

                redirecionar("../consulta.php", "Produto editado com sucesso!");
            }
        } catch (PDOException $e) {
            header("../consulta.php", "Erro: " . $e->getMessage());
        }
    }
?>