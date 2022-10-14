let menu_icon_white = document.querySelector(".menu_icon_white");
let menu_icon_black = document.querySelector(".menu_icon_black");
let sidebar = document.querySelector(".sidebar");

menu_icon_white.addEventListener("click", () => {
    sidebar.style.left = "0";
});

menu_icon_black.addEventListener("click", () => {
    sidebar.style.left = "-12em";
});