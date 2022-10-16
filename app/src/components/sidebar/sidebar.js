let cerrar_sidebar = document.querySelector(".cerrar_sidebar");
let cerrar_sidebar_modificar = document.querySelector(".cerrar_sidebar_modificar");
let usuario_img_navbar = document.querySelector(".usuario_img_navbar");
let sidebar = document.querySelector(".sidebar");
let sidebar_modificar = document.querySelector(".sidebar_modificar");
let cerrar_sesion = document.querySelector(".cerrar_sesion");
let iniciar_sesion = document.querySelector(".iniciar_sesion");
let modificar_datos = document.querySelector(".modificar_datos");
let cancelar_modificacion = document.querySelector(".cancelar_modificacion");
let aceptar_modificacion = document.querySelector(".aceptar_modificacion");

usuario_img_navbar.addEventListener("click", () => {
    if (window.getComputedStyle(sidebar).getPropertyValue('display') == "flex") {
        sidebar.style.right = "0";
    } else {
        sidebar_modificar.style.right = "0";
    }
});

cerrar_sidebar.addEventListener("click", () => {
    if (window.getComputedStyle(sidebar).getPropertyValue('display') == "flex") {
        sidebar.style.right = "-20em";
    } else {
        sidebar_modificar.style.right = "-20em";
    }
});

cerrar_sidebar_modificar.addEventListener("click", () => {
    if (window.getComputedStyle(sidebar).getPropertyValue('display') == "flex") {
        sidebar.style.right = "-20em";
    } else {
        sidebar_modificar.style.right = "-20em";
    }
});

cerrar_sesion.addEventListener("click", () => {
    window.location.replace("http://localhost:81/server/close_session.php");
});

iniciar_sesion.addEventListener("click", () => {
    window.location.replace("http://localhost:81/src/pages/login/login.php");
});

modificar_datos.addEventListener("click", () => {
    document.querySelector('.sidebar').style.display = "none";
    document.querySelector('.sidebar_modificar').style.display = "flex";
    document.querySelector('.sidebar_modificar').style.right = "0";
});

cancelar_modificacion.addEventListener("click", () => {
    document.querySelector('.sidebar').style.display = "flex";
    document.querySelector('.sidebar_modificar').style.display = "none";
    //falta llamada al servidor con los datos (o con el form y la redireccion sufiifiente?)
});

aceptar_modificacion.addEventListener("click", () => {
    document.querySelector('.sidebar').style.display = "none";
    document.querySelector('.sidebar_modificar').style.display = "flex";
});
