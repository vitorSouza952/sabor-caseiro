<?php
    function existeSessao($sessao) {
        if (isset($_SESSION[$sessao])) {
            return true;
        }

        return false;
    }

    function desabilitarSessao($sessao) {
        unset($_SESSION[$sessao]);
    }

    function existemTiposProduto($pdo) {
        $sql = "SELECT * FROM vwSelecionarTiposProduto";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (empty($res)) {
            redirecionar("index.php", "Erro: Não existem tipos de produto cadastrados.");
        }

        return $res;
    }

    function redirecionar($url, $msg) {
        $_SESSION["msg"] = $msg;

        header("Location: $url");
        exit();
    }

    function sanitizarValor($valor) {
        $valor = trim($valor);
        $valor = htmlspecialchars($valor);
        $valor = stripslashes($valor);

        return $valor;
    }

    function validarID($id) {
        if ($id === null || !is_numeric($id) || intval($id) < 1) {
            return false;
        }

        return true;
    }

    function validarNome($nome) {
        if ($nome === null || empty($nome) || strlen($nome) > 50) {
            return false;
        }

        return true;
    }

    function validarPreco($preco) {
        if ($preco === null || !is_numeric($preco) || floatval($preco) < 1 || floatval($preco) > 999.99) {
            return false;
        }

        return true;
    }

    function existeProdutoCadastrado($pdo, $id) {
        $sql = "CALL procExisteProdutoCadastrado(:id)";
        $sql = $pdo->prepare($sql);
        $sql->execute(["id" => $id]);
        $res = $sql->fetch(PDO::FETCH_ASSOC);

        if ($res["total"] > 0) {
            return true;
        }

        redirecionar("../consulta.php", "Erro: Produto inexistente.");
    }
?>