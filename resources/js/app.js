import "./bootstrap";


let myDocument = document.documentElement;
/* Función para expandir el navegador */
let btn = document.getElementById("btn-expand");
btn.addEventListener("click", () => {
    if (btn.classList.contains("fa-maximize")) {
        btn.classList.remove("fa-maximize");
        btn.classList.add("fa-minimize");
        if (myDocument.requestFullscreen) {
            myDocument.requestFullscreen();
        } else if (myDocument.msrequestFullscreen) {
            myDocument.msrequestFullscreen();
        } else if (myDocument.mozrequestFullscreen) {
            myDocument.mozrequestFullscreen();
        } else if (myDocument.webkitrequestFullscreen) {
            myDocument.webkitrequestFullscreen();
        }
    } else {
        btn.classList.remove("fa-minimize");
        btn.classList.add("fa-maximize");
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
});

/* ----------------------------------- */
/* ----------------------------------- */
/* Función para abrir y cerrar la sección de la vista nav */
var state = "open";
let btn_showHide = document.getElementById("menu-icon");

btn_showHide.addEventListener("click", () => {
    state === "open" ? close() : open();
});

function open() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("head-content").style.marginLeft = "250px";
    document.getElementById("main-content").style.marginLeft = "250px";
    document.getElementById("section-perfiles").style.marginRight = "250px";

    state = "open";
}
function close() {
    document.getElementById("mySidenav").style.width = "0px";
    document.getElementById("head-content").style.marginLeft = "0px";
    document.getElementById("main-content").style.marginLeft = "0px";
    document.getElementById("section-perfiles").style.marginRight = "0px";
    state = "close";
}
// ----------------------------------------------------------------
/* Botones colapsables */
// ----------------------------------------------------------------
/* Colapsables en javascript */
document.addEventListener("DOMContentLoaded", function () {
    const collapsibleItems = document.querySelectorAll(
        ".icon-text-chevron-container"
    );
    collapsibleItems.forEach(function (item) {
        item.addEventListener("click", function () {
            const sublist = this.nextElementSibling;
            /* Función toggle es para alternar un estado */
            sublist.classList.toggle("hidden");
            this.closest("li").classList.toggle("selected");
            this.querySelector(".chevron").classList.toggle("rotate");
        });
    });
});
