let menu = document.querySelector("#menu_icon");
let navbar = document.querySelector(".navbar");

menu.addEventListener("click", function () {
    navbar.classList.toggle("active");
});

window.onscroll = () => {
    navbar.classList.remove("active");
};

document.getElementById('menu_icon').addEventListener('click', function () {
    var navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});
