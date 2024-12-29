// Elementos DOM e variáveis globais
import { areaModal, alternarModal } from "./utils.js";
const botaoAbrirSidebar = document.querySelector("#botao-abrir-sidebar");
const sidebar = document.querySelector("#sidebar");
const botaoFecharSidebar = document.querySelector("#botao-fechar-sidebar");
const botaoFecharModal = document.querySelector("#botao-fechar-modal");

// Eventos DOM

// Evento de clique no documento
document.addEventListener("click", (e) => {
  if (e.target === areaModal) alternarModal(null);
});

// Evento de tecla pressionada no documento
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && areaModal.classList.contains("ativo"))
    alternarModal(null);
});

// Evento de clique nos botões relacionados a sidebar
[botaoAbrirSidebar, botaoFecharSidebar].forEach((el) =>
  el.addEventListener("click", () => sidebar.classList.toggle("ativo"))
);

// Evento de clique no botão de fechar o modal
botaoFecharModal.addEventListener("click", () => alternarModal(null));
