var sidenav = document.querySelector("#mySidenav");
var openBtn = document.querySelector("#openBtn");

function openNav() {
  sidenav.classList.toggle("active");
}

openBtn.addEventListener('click', openNav);