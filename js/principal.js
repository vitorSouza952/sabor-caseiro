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

const alternarNavbarLateral = (exibir) => {
  alternarEls(exibir, [fundoNavbarLateral, navbarLateral]);
};

const alternarEls = (exibir, els) => {
  els.forEach((el) => {
    if (exibir) {
      el.classList.remove("esconder");
    } else {
      el.classList.add("esconder");
    }
  });
};

const alternarModalMsg = (exibir, msg) => {
  alternarEls(exibir, [fundoModalMsg, modalMsg]);
  txtModalMsg.textContent = msg;
};

window.addEventListener("pageshow", () => {
  alternarNavbarLateral(false);
});

window.addEventListener("resize", () => {
  if (window.innerWidth >= 576) {
    alternarNavbarLateral(false);
  }
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    alternarNavbarLateral(false);
    alternarModalMsg(false, "");
  }
});

botaoAbrirNavbarLateral.addEventListener("click", () => {
  alternarNavbarLateral(true);
});

[fundoNavbarLateral, botaoFecharNavbarLateral].forEach((el) => {
  el.addEventListener("click", () => {
    alternarNavbarLateral(false);
  });
});

[fundoModalMsg, botaoFecharModalMsg].forEach((el) => {
  el.addEventListener("click", () => {
    alternarModalMsg(false, "");
  });
});
