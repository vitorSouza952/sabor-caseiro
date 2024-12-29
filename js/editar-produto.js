// Elementos DOM e variáveis
import {
  form,
  id,
  validarID,
  validarNome,
  alternarModal,
  limparCampo,
  validarTipo,
  validarPreco,
} from "./utils.js";
const novoNome = document.querySelector("#novo-nome");
const novoTipo = document.querySelector("#novo-tipo");
const novoPreco = document.querySelector("#novo-preco");

// Eventos DOM

// Evento de envio no formulário
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const valorID = id.value.trim();
  const valorNovoNome = novoNome.value.trim();
  const valorNovoTipo = novoTipo.value.trim();
  const valorNovoPreco = novoPreco.value.trim();

  if (!validarID(id, valorID)) {
    alternarModal(
      "Erro: O ID (#) é obrigatório e deve ser um número inteiro maior ou igual a 1!"
    );

    limparCampo(id);

    return;
  }

  if (!validarNome(novoNome, valorNovoNome)) {
    alternarModal(
      "Erro: O novo nome é obrigatório e deve conter até 30 caracteres!"
    );

    limparCampo(novoNome);

    return;
  }

  if (!validarTipo(novoTipo, valorNovoTipo)) {
    alternarModal(
      'Erro: O novo tipo é obrigatório e deve ser "Aperitivo", "Prato Principal" ou "Sobremesa"!'
    );

    limparCampo(novoTipo);

    return;
  }

  if (!validarPreco(novoPreco, valorNovoPreco)) {
    alternarModal(
      "Erro: O novo preço é obrigatório, deve ser um número, deve conter até duas casas decimais e ser maior ou igual a 1!"
    );

    limparCampo(novoPreco);

    return;
  }

  form.submit();
});
