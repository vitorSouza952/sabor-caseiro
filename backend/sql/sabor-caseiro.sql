DROP DATABASE IF EXISTS saborCaseiro;
CREATE DATABASE saborCaseiro;
USE saborCaseiro;

DROP TABLE IF EXISTS tiposProduto;
CREATE TABLE tiposProduto(
	id INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL UNIQUE CHECK(nome <> ""),
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos(
	id INT UNSIGNED AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL CHECK(nome <> ""),
    preco DECIMAL(5, 2) NOT NULL CHECK(preco >= 1),
    idTipoProduto INT UNSIGNED NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idTipoProduto) REFERENCES tiposProduto(id)
    ON DELETE CASCADE
);

DROP VIEW IF EXISTS vwSelecionarTiposProduto;
CREATE VIEW vwSelecionarTiposProduto AS
SELECT id AS idTipoProduto, nome AS nomeTipoProduto
FROM tiposProduto;

DROP VIEW IF EXISTS vwSelecionarProdutos;
CREATE VIEW vwSelecionarProdutos AS
SELECT p.id AS idProduto, p.nome AS nomeProduto, t.nome AS nomeTipoProduto, p.preco AS precoProduto
FROM produtos AS p
INNER JOIN tiposProduto AS t
ON p.idTipoProduto = t.id;

DELIMITER $$

DROP PROCEDURE IF EXISTS procCadastrarTipoProduto$$
CREATE PROCEDURE procCadastrarTipoProduto(IN procNome VARCHAR(30))
BEGIN
    INSERT INTO tiposProduto(nome) VALUES(procNome);
END$$

DROP PROCEDURE IF EXISTS procEditarTipoProduto$$
CREATE PROCEDURE procEditarTipoProduto(IN procNome VARCHAR(30), IN procID INT)
BEGIN
    UPDATE tiposProduto
    SET nome = procNome
    WHERE id = procID;
END$$

DROP PROCEDURE IF EXISTS procDeletarTipoProduto$$
CREATE PROCEDURE procDeletarTipoProduto(IN procID INT)
BEGIN
    DELETE FROM tiposProduto WHERE id = procID;
END$$

DROP PROCEDURE IF EXISTS procExisteProdutoCadastro$$
CREATE PROCEDURE procExisteProdutoCadastro(IN procNome VARCHAR(50), IN procIDTipoProduto INT)
BEGIN
    SELECT COUNT(*) AS total
    FROM produtos
    WHERE nome = procNome AND idTipoProduto = procIDTipoProduto;
END$$

DROP PROCEDURE IF EXISTS procCadastrarProduto$$
CREATE PROCEDURE procCadastrarProduto(IN procNome VARCHAR(50), IN procPreco DECIMAL(5, 2), IN procIDTipoProduto INT)
BEGIN
    INSERT INTO produtos(nome, preco, idTipoProduto) VALUES(procNome, procPreco, procIDTipoProduto);
END$$

DROP PROCEDURE IF EXISTS procExisteProdutoCadastrado$$
CREATE PROCEDURE procExisteProdutoCadastrado(IN procID INT)
BEGIN
    SELECT COUNT(*) AS total
    FROM produtos
    WHERE id = procID;
END$$

DROP PROCEDURE IF EXISTS procExisteProdutoEdicao$$
CREATE PROCEDURE procExisteProdutoEdicao(IN procNome VARCHAR(50), IN procIDTipoProduto INT, IN procID INT)
BEGIN
    SELECT COUNT(*) AS total
    FROM produtos
    WHERE nome = procNome AND idTipoProduto = procIDTipoProduto AND id <> procID;
END$$

DROP PROCEDURE IF EXISTS procEditarProduto$$
CREATE PROCEDURE procEditarProduto(IN procNome VARCHAR(50), IN procPreco DECIMAL(5, 2), IN procIDTipoProduto INT, IN procID INT)
BEGIN
    UPDATE produtos
    SET nome = procNome, preco = procPreco, idTipoProduto = procIDTipoProduto
    WHERE id = procID;
END$$

DROP PROCEDURE IF EXISTS procDeletarProduto$$
CREATE PROCEDURE procDeletarProduto(IN procID INT)
BEGIN
    DELETE FROM produtos WHERE id = procID;
END$$

DELIMITER ;