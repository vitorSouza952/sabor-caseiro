const formCadastro = document.querySelector("#form-cadastro");
const nome = document.querySelector("#nome");
const tipo = document.querySelector("#tipo");
const preco = document.querySelector("#preco");

function limparCampo(campo) {
    campo.value = "";
}

formCadastro.addEventListener("submit", function (e) {
    e.preventDefault();

    const valNome = nome.value.trim();
    const valTipo = Number.parseInt(tipo.value);
    const valPreco = Number.parseFloat(preco.value.trim());

    if (valNome === null || valNome === "" || valNome.length > 50) {
        alternarModalMsg("Erro: O nome do produto é obrigatório e deve conter até 50 caracteres.");
        limparCampo(nome);
        return;
    }

    if (valTipo === null || Number.isNaN(valTipo) || valTipo < 1) {
        alternarModalMsg("Erro: Tipo de produto inválido.");
        return;
    }

    if (valPreco === null || Number.isNaN(valPreco) || valPreco < 1 || valPreco > 999.99) {
        alternarModalMsg("Erro: O preço do produto é obrigatório e deve ser um número entre 1 e 999,99.");
        limparCampo(preco);
        return;
    }

    this.submit();
});