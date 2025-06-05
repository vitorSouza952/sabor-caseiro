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
    const opTipo = tipo.selectedIndex;
    const valPreco = Number.parseFloat(preco.value.trim());

    if (valNome === "" || valNome.length > 50) {
        alternarModalMsg("Erro: O nome do produto é obrigatório e deve conter até 50 caracteres.");
        limparCampo(nome);
        return;
    }

    if (opTipo === 0) {
        alternarModalMsg("Erro: O tipo do produto é obrigatório.");
        return;
    }

    if (Number.isNaN(valPreco) || valPreco < 1 || valPreco > 999.99) {
        alternarModalMsg("Erro: O preço do produto é obrigatório e deve ser um número entre 1 e 999,99.");
        limparCampo(preco);
        return;
    }

    this.submit();
});