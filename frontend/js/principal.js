const botaoAbrirNavbarLateral = document.querySelector(
  "#botao-abrir-navbar-lateral"
);

const fundoNavbarLateral = document.querySelector("#fundo-navbar-lateral");
const navbarLateral = document.querySelector("#navbar-lateral");

const botaoFecharNavbarLateral = document.querySelector(
  "#botao-fechar-navbar-lateral"
);

const fundoModalMsg = document.querySelector("#fundo-modal-msg");
const modalMsg = document.querySelector("#modal-msg");
const txtModalMsg = document.querySelector("#txt-modal-msg");
const botaoFecharModalMsg = document.querySelector("#botao-fechar-modal-msg");

function alternarNavbarLateral(exibir) {
  [fundoNavbarLateral, navbarLateral].forEach(function (el) {
    if (exibir) {
      el.classList.remove("esconder");
    } else {
      el.classList.add("esconder");
    }
  });
}

function alternarModalMsg(exibir, msg) {
  [fundoModalMsg, modalMsg].forEach(function (el) {
    if (exibir) {
      el.classList.remove("esconder");
    } else {
      el.classList.add("esconder");
    }
  });

  txtModalMsg.textContent = msg;
}

window.addEventListener("pageshow", function () {
  alternarNavbarLateral(false);
  alternarModalMsg(false, "");
});

window.addEventListener("resize", function () {
  if (this.innerWidth >= 576) {
    alternarNavbarLateral(false);
  }
});

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    alternarNavbarLateral(false);
    alternarModalMsg(false, "");
  }
});

botaoAbrirNavbarLateral.addEventListener("click", function () {
  alternarNavbarLateral(true);
});

[fundoNavbarLateral, botaoFecharNavbarLateral].forEach(function (el) {
  el.addEventListener("click", function () {
    alternarNavbarLateral(false);
  });
});

[fundoModalMsg, botaoFecharModalMsg].forEach(function (el) {
  el.addEventListener("click", function () {
    alternarModalMsg(false, "");
  });
});
