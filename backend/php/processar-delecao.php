<?php
    require_once("../config/inicia-sessao.php");
    require_once("../config/funcoes.php");

    if (!empty($_POST)) {
        $id = sanitizarValor($_POST["id"]);

        if (!validarID($id)) {
            redirecionar("../consulta.php", "O ID do produto é obrigatório e deve ser um número maior ou igual a 1.");
        }

        $id = intval($id);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=saborCaseiro", "root", "root");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (existeProdutoCadastrado($pdo, $id)) {
                $sql = "CALL procDeletarProduto(:id)";
                $sql = $pdo->prepare($sql);
                $sql->execute(["id" => $id]);

                redirecionar("../cadastro.php", "Produto deletado com sucesso!");
            }
        } catch (PDOException $e) {
            redirecionar("../consulta.php", "Erro: " . $e->getMessage());
        }
    }
?>