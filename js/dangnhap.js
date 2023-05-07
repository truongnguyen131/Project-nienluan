// thông báo lỗi
function Huy() {
    var tk = $('#tk').val()
    var mk = $('#mk').val()
    document.getElementById('tk').value = "";
    document.getElementById('mk').value = "";
    $('#tk').removeClass('is-invalid')
    $('#loitk').html("")
    $('#mk').removeClass('is-invalid')
    $('#loimk').html("")

}

function kiemtraloi() {
   
    var check = 0
    var tk = $('#tk').val()
    var mk = $('#mk').val()
    var ntk = "unchecked"
    if (mk.length == 0) {
        check -= 1
        $('#mk').addClass('is-invalid');
        $('#loimk').html("Mật khẩu không được rỗng")
    } else {
        $('#mk').removeClass('is-invalid')
        $('#loimk').html("")
        check += 1
    }
    if (tk.length == 0) {
        check -= 1
        $('#tk').addClass('is-invalid');
        $('#loitk').html("Tài khoản không được rỗng")
    } else {
        $('#tk').removeClass('is-invalid')
        $('#loitk').html("")
        check += 1
    }

    if (document.getElementById('ntk').checked) {
        ntk = "checked";
    }

    if (check == 2) {
        $.post('xulydangnhap.php', {
            ntk1: ntk,
            taikhoan1: tk,
            matkhau1: mk
        }, function(data) {
            $('body').html(data);
        })

    }

}


// ẩn hiện mật khẩu

const input = document.querySelector(".input-pass");
const openeye = document.querySelector(".eye-open");
const closeeye = document.querySelector(".eye-close");

closeeye.addEventListener("click", function() {
    closeeye.classList.add("hidden");
    openeye.classList.remove("hidden");
    input.setAttribute("type", "text");
});
openeye.addEventListener("click", function() {
    openeye.classList.add("hidden");
    closeeye.classList.remove("hidden");
    input.setAttribute("type", "password");
});