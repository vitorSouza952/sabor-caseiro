// Elementos DOM e variáveis globais
import { form, alternarModal, limparCampo } from "./utils.js";
const pesquisa = document.querySelector("#pesquisa");
const linhasTabela = document.querySelectorAll("#corpo-tabela tr");

// Funções

// Função que reseta as linhas da tabela
const resetarLinhas = () => {
  if (linhasTabela.length > 0) {
    linhasTabela.forEach((el) => {
      el.classList.remove("inativo");
    });
  }
};

// Eventos DOM

// Evento de envio no formulário
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const valorPesquisa = pesquisa.value.trim();

  let temPesquisa = false;

  if (!valorPesquisa || valorPesquisa > 30) {
    alternarModal(
      "Erro: A pesquisa é obrigatória e deve conter até 30 caracteres!"
    );

    limparCampo(pesquisa);

    resetarLinhas();

    return;
  }

  if (linhasTabela.length > 0) {
    linhasTabela.forEach((el) => {
      const textoEl = el.innerText;

      if (!textoEl.toLowerCase().includes(valorPesquisa.toLowerCase())) {
        el.classList.add("inativo");
      } else {
        el.classList.remove("inativo");

        temPesquisa = true;
      }
    });

    if (!temPesquisa) {
      alternarModal("Não foi possível encontrar sua pesquisa!");

      resetarLinhas();
    }

    limparCampo(pesquisa);
  }
});
