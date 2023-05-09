let up = document.querySelector(".right");
document.querySelector("#update").onclick = () => {
    up.classList.toggle("active");
}

function huy() {
    var mk1 = $('#mk1').val()
    var mk2 = $('#mk2').val()
    var nlmk = $('#nlmk').val()
    document.getElementById('mk1').value = "";
    document.getElementById('mk2').value = "";
    document.getElementById('nlmk').value = "";
    $('#mk1').removeClass('is-invalid')
    $('#loimkcu').html("")
    $('#mk2').removeClass('is-invalid')
    $('#loimkmoi').html("")
    $('#nlmk').removeClass('is-invalid')
    $('#loinlmk').html("")
}

function capnhat() {
    var check = 0
    var mk1 = $('#mk1').val()
    var mk2 = $('#mk2').val()
    var nlmk = $('#nlmk').val()
    var mk_old = $('#mk_old').val()
    var id_tk = $('#id_tk').val()
    if (mk1 != mk_old) {
        check -= 1
        $('#mk').addClass('is-invalid');
        $('#loimkcu').html("Mật khẩu không đúng")
    } else {
        $('#mk').removeClass('is-invalid')
        $('#loimkcu').html("")
        check += 1
    }
    if (mk2.length == 0) {
        check -= 1
        $('#mk').addClass('is-invalid');
        $('#loimkmoi').html("Mật khẩu không được rỗng")
    } else {
        $('#mk').removeClass('is-invalid')
        $('#loimkmoi').html("")
        check += 1
    }
    if (mk2 != nlmk) {
        check -= 1
        $('#tk').addClass('is-invalid');
        $('#loinlmk').html("Mật khẩu không giống")
    } else {
        $('#tk').removeClass('is-invalid')
        $('#loinlmk').html("")
        check += 1
    }
    if (check == 3) {

        $.post('xulydoimatkhau.php', {
            mknew: mk2,
            idtk: id_tk
        }, function(data) {
            $('#thongbao').html(data);
        })

    }
}