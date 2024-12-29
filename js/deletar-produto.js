// Elementos DOM e variáveis
import { form, id, validarID, alternarModal, limparCampo } from "./utils.js";

// Eventos DOM

// Evento de envio no formulário
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const valorID = id.value.trim();

  if (!validarID(id, valorID)) {
    alternarModal(
      "Erro: O ID (#) é obrigatório e deve ser um número inteiro maior ou igual a 1!"
    );

    limparCampo(id);

    return;
  }

  form.submit();
});
