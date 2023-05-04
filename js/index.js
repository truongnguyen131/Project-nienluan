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
    // Đăng xuất
let logout = document.querySelector(".log_out");
document.querySelector("#logout-icon").onclick = () => {
    logout.classList.toggle("active");
}



// custom scroll bar
window.onscroll = function() { mufuntion() };

function mufuntion() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById('scroll-bar').style.width = scrolled + "%";
}