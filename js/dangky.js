// thông báo lỗi

function Huy() {
    var hoten = $('#hoten').val()
    var sdt = $('#sdt').val()
    var email = $('#email').val()
    var tk = $('#tk').val()
    var mk = $('#mk').val()
    var nlmk = $('#nlmk').val()
    document.getElementById('hoten').value = "";
    document.getElementById('sdt').value = "";
    document.getElementById('email').value = "";
    document.getElementById('tk').value = "";
    document.getElementById('mk').value = "";
    document.getElementById('nlmk').value = "";
    document.getElementById('nlmk').value = "";
    $('#hoten').removeClass('is-invalid')
    $('#loihoten').html("")
    $('#sdt').removeClass('is-invalid')
    $('#loisdt').html("")
    $('#email').removeClass('is-invalid')
    $('#loiemail').html("")
    $('#tk').removeClass('is-invalid')
    $('#loitk').html("")
    $('#mk').removeClass('is-invalid')
    $('#loimk').html("")
    $('#nlmk').removeClass('is-invalid')
    $('#loinlmk').html("")

}

function kiemtraloi() {
    var check = 0
    var hoten = $('#hoten').val()
    const testHoTen = new RegExp('^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*')
    var sdt = $('#sdt').val()
    const testSdt = new RegExp("^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$")
    var email = $('#email').val()
    const testEmail = new RegExp("^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$")
    var tk = $('#tk').val()
    var mk = $('#mk').val()
    var nlmk = $('#nlmk').val()


    if (testHoTen.test(hoten) != true) {
        check -= 1
        $('#hoten').addClass('is-invalid');
        $('#loihoten').html("Họ tên phải là chữ có ít nhất 4 đến 20 kí tự")
    } else {
        $('#hoten').removeClass('is-invalid')
        $('#loihoten').html("")
        check += 1
    }

    if (testSdt.test(sdt) != true) {
        check -= 1
        $('#sdt').addClass('is-invalid');
        $('#loisdt').html("Số điện thoại không hợp lệ")
    } else {
        $('#sdt').removeClass('is-invalid')
        $('#loisdt').html("")
        check += 1
    }

    if (testEmail.test(email) != true) {
        check -= 1
        $('#email').addClass('is-invalid');
        $('#loiemail').html("Email không hợp lệ")
    } else {
        $('#email').removeClass('is-invalid')
        $('#loiemail').html("")
        check += 1
    }

    if (mk.length < 5 || mk.length > 15) {
        check -= 1
        $('#mk').addClass('is-invalid');
        $('#loimk').html("Mật khẩu không đủ mạnh")
    } else {
        $('#mk').removeClass('is-invalid')
        $('#loimk').html("")
        check += 1
    }
    if (nlmk != mk || nlmk.length == 0) {
        check -= 1
        $('#nlmk').addClass('is-invalid');
        $('#loinlmk').html("Hãy nhập lại mật khẩu")
    } else {
        $('#nlmk').removeClass('is-invalid')
        $('#loinlmk').html("")
        check += 1
    }

    let checkTK = true
    for (let i = 0; i < listTK.length; i++) {
        if (tk == listTK[i]) {
            checkTK = false
            break
        }
    }

    if (tk.length < 5 || tk.length > 15 || tk.indexOf("admin") != -1) {
        check -= 1
        $('#tk').addClass('is-invalid');
        $('#loitk').html("Tài khoản không hợp lệ")
    } else {
        if (checkTK == false) {
            check -= 1
            $('#tk').addClass('is-invalid');
            $('#loitk').html("Tài khoản bị trùng")
        } else {
            $('#tk').removeClass('is-invalid')
            $('#loitk').html("")
            check += 1
        }
    }

    if (check == 6) {
        $.post('xulydangky.php', {
            hoten1: hoten,
            sdt1: sdt,
            email1: email,
            taikhoan1: tk,
            matkhau1: mk,
            page: "dangky"
        }, function(data) {
            $('body').html(data);
        })

    }

}

// ẩn hiện mật khẩu của mật khẩu

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

// ẩn hiện mật khẩu của nhập lại mật khẩu

const input_again = document.querySelector(".input-pass-again");
const openeye_again = document.querySelector(".eye-open-again");
const closeeye_again = document.querySelector(".eye-close-again");

closeeye_again.addEventListener("click", function() {
    closeeye_again.classList.add("hidden");
    openeye_again.classList.remove("hidden");
    input_again.setAttribute("type", "text");
});
openeye_again.addEventListener("click", function() {
    openeye_again.classList.add("hidden");
    closeeye_again.classList.remove("hidden");
    input_again.setAttribute("type", "password");
});