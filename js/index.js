let menu = document.querySelector(".menu-icon");
let nav = document.querySelector(".menu");

menu.onclick = () => {
    nav.classList.toggle("active");
    menu.classList.toggle("move");
}

// thông báo

let bell = document.querySelector(".nofication");

document.querySelector("#bell-icon").onclick = () => {
        bell.classList.toggle("active");
    }
    // tìm kiếm
let search = document.querySelector(".search");

document.querySelector("#search-icon").onclick = () => {
    search.classList.toggle("active");
}