// Elementos DOM e variáveis globais
export const form = document.querySelector("#form");
export const id = document.querySelector("#id");
export const areaModal = document.querySelector("#area-modal");
const secaoModal = document.querySelector("#secao-modal");
const msgModal = document.querySelector("#msg-modal");

// Funções

// Função que alterna a exibição do modal
export const alternarModal = (msg) => {
  [areaModal, secaoModal].forEach((el) => el.classList.toggle("ativo"));

  if (msg) msgModal.innerText = msg;
};

// Função que valida o nome
export const validarNome = (nome, valorNome) =>
  nome.checkValidity() && valorNome && valorNome.length <= 30;

// Função que limpa um campo

export const limparCampo = (campo) => {
  campo.value = "";

  if (window.screen.width < 1024) campo.blur();
  else campo.focus();
};

// Função que valida o tipo
export const validarTipo = (tipo, valorTipo) =>
  tipo.checkValidity() && ["0", "1", "2"].includes(valorTipo);

// Função que valida o preço
export const validarPreco = (preco, valorPreco) =>
  (preco.checkValidity() &&
    valorPreco &&
    !isNaN(valorPreco) &&
    !valorPreco.includes(".") &&
    valorPreco >= 1) ||
  (valorPreco.includes(".") && valorPreco.split(".")[1].length <= 2);

// Função que valida o ID
export const validarID = (id, valorID) =>
  id.checkValidity() &&
  valorID &&
  !isNaN(valorID) &&
  !valorID.includes(".") &&
  valorID >= 1;
