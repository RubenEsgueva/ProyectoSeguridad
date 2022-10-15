let cerrar_sidebar = document.querySelector(".cerrar_sidebar");
let usuario_img_navbar = document.querySelector(".usuario_img_navbar");
let sidebar = document.querySelector(".sidebar");
let cerrar_sesion = document.querySelector(".cerrar_sesion");
let iniciar_sesion = document.querySelector(".iniciar_sesion");

usuario_img_navbar.addEventListener("click", () => {
    sidebar.style.right = "0";
});

cerrar_sidebar.addEventListener("click", () => {
    sidebar.style.right = "-18em";
});

cerrar_sesion.addEventListener("click", () => {
    window.location.replace("http://localhost:81/server/close_session.php");
});

iniciar_sesion.addEventListener("click", () => {
    window.location.replace("http://localhost:81/src/pages/login/login.php");
});
