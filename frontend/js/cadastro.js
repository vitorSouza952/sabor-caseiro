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
  const valTipo = parseInt(tipo.value.trim());
  const valPreco = parseFloat(preco.value.trim());

  if (!valNome || valNome.length > 50) {
    alternarModalMsg(
      true,
      "Erro: O nome é obrigatório e deve conter até 50 caracteres."
    );

    limparCampo(nome);
    return;
  }

  if (isNaN(valTipo) || valTipo < 1) {
    alternarModalMsg(true, "Erro: Tipo inválido.");
    limparCampo(tipo);
    return;
  }

  if (isNaN(valPreco) || valPreco < 1 || valPreco > 999.99) {
    alternarModalMsg(
      true,
      "Erro: O preço é obrigatório e deve ser um número entre 1 e 999,99."
    );

    limparCampo(preco);
    return;
  }

  this.submit();
});
