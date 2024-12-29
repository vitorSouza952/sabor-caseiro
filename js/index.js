// Elementos DOM e variáveis
import {
  form,
  validarNome,
  alternarModal,
  limparCampo,
  validarTipo,
  validarPreco,
} from "./utils.js";
const nome = document.querySelector("#nome");
const tipo = document.querySelector("#tipo");
const preco = document.querySelector("#preco");

// Eventos DOM

// Evento de envio no formulário
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const valorNome = nome.value.trim();
  const valorTipo = tipo.value.trim();
  const valorPreco = preco.value.trim();

  if (!validarNome(nome, valorNome)) {
    alternarModal(
      "Erro: O nome é obrigatório e deve conter até 30 caracteres!"
    );

    limparCampo(nome);

    return;
  }

  if (!validarTipo(tipo, valorTipo)) {
    alternarModal(
      'Erro: O tipo é obrigatório e deve ser "Aperitivo", "Prato Principal" ou "Sobremesa"!'
    );

    limparCampo(tipo);

    return;
  }

  if (!validarPreco(preco, valorPreco)) {
    alternarModal(
      "Erro: O preço é obrigatório, deve ser um número, deve conter até duas casas decimais e ser maior ou igual a 1!"
    );

    limparCampo(preco);

    return;
  }

  form.submit();
});
