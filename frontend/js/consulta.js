const fundoModalEdicao = document.querySelector("#fundo-modal-edicao");
const modalEdicao = document.querySelector("#modal-edicao");
const formEdicao = document.querySelector("#form-edicao");
const idEdicao = document.querySelector("#id-edicao");
const nome = document.querySelector("#nome");
const tipo = document.querySelector("#tipo");
const opcoesTipo = document.querySelectorAll("option");
const preco = document.querySelector("#preco");
const botaoCancelarEdicao = document.querySelector("#botao-cancelar-edicao");
const fundoModalConfirmacao = document.querySelector("#fundo-modal-confirmacao");
const modalConfirmacao = document.querySelector("#modal-confirmacao");
const idDelecao = document.querySelector("#id-delecao");
const botaoCancelarDelecao = document.querySelector("#botao-cancelar-delecao");

function prepararEdicao(botaoEditar) {
    const linhaTabelaProdutos = botaoEditar.closest(".linha-tabela-produtos");
    const celulaID = linhaTabelaProdutos.querySelectorAll(".celula-tabela-produtos")[0];
    const celulaNome = linhaTabelaProdutos.querySelectorAll(".celula-tabela-produtos")[1];
    const celulaTipo = linhaTabelaProdutos.querySelectorAll(".celula-tabela-produtos")[2];
    const celulaPreco = linhaTabelaProdutos.querySelectorAll(".celula-tabela-produtos")[3];

    idEdicao.value = celulaID.textContent;
    nome.value = celulaNome.textContent;
    
    opcoesTipo.forEach(function (el) {
        const txtOpcaoTipo = el.textContent.toLowerCase();
        const txtCelulaTipo = celulaTipo.textContent.toLowerCase();

        if (txtOpcaoTipo === txtCelulaTipo) {
            el.selected = true;
        }
    });

    preco.value = formatarPreco(celulaPreco.textContent);
    alternarModal(fundoModalEdicao, modalEdicao);
}

function formatarPreco(preco) {
    preco = preco.replace("R$ ", "");
    preco = preco.replace(/\./g, "");
    preco = preco.replace(",", ".");
    return preco;
}

function alternarModal(fundoModal, modal) {
    [fundoModal, modal].forEach(function (el) {
        el.classList.toggle("esconder");
    });
}

function prepararDelecao(botaoDeletar) {
    const linhaTabelaProdutos = botaoDeletar.closest(".linha-tabela-produtos");
    const celulaID = linhaTabelaProdutos.querySelectorAll(".celula-tabela-produtos")[0];

    idDelecao.value = celulaID.textContent;
    alternarModal(fundoModalConfirmacao, modalConfirmacao);
}

function exibirErro(msg) {
    alternarModal(fundoModalEdicao, modalEdicao);
    idEdicao.value = "";
    resetarFormEdicao();
    alternarModalMsg(msg);
}

function resetarFormEdicao() {
    formEdicao.reset();
}

document.addEventListener("click", function (e) {
    const elAlvo = e.target;

    if (elAlvo.classList.contains("botao-editar")) {
        prepararEdicao(elAlvo);
    }

    if (elAlvo.classList.contains("botao-deletar")) {
        prepararDelecao(elAlvo);
    }
});

formEdicao.addEventListener("submit", function (e) {
    e.preventDefault();

    const valNome = nome.value.trim();
    const opTipo = tipo.selectedIndex;
    const valPreco = Number.parseFloat(preco.value.trim());

    if (valNome === "" || valNome.length > 50) {
        exibirErro("Erro: O nome do produto é obrigatório e deve conter até 50 caracteres.");
        return;
    }

    if (opTipo === 0) {
        exibirErro("Erro: O tipo do produto é obrigatório.");
        return;
    }

    if (Number.isNaN(valPreco) || valPreco < 1 || valPreco > 999.99) {
        exibirErro("Erro: O preço do produto é obrigatório e deve ser um número entre 1 e 999,99.");
        return;
    }

    this.submit();
});

botaoCancelarEdicao.addEventListener("click", function () {
    alternarModal(fundoModalEdicao, modalEdicao);
    resetarFormEdicao();
});

[fundoModalConfirmacao, botaoCancelarDelecao].forEach(function (el) {
    el.addEventListener("click", function () {
        alternarModal(fundoModalConfirmacao, modalConfirmacao);
        idDelecao.value = "";
    });
});