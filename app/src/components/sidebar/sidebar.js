let cerrar_sidebar = document.querySelector(".cerrar_sidebar");
let usuario_img_navbar = document.querySelector(".usuario_img_navbar");
let sidebar = document.querySelector(".sidebar");

usuario_img_navbar.addEventListener("click", () => {
    sidebar.style.right = "0";
});

cerrar_sidebar.addEventListener("click", () => {
    sidebar.style.right = "-18em";
});
