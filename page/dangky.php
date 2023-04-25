<?php session_start();
include_once('database_connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dangky.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    if(isset( $_SESSION['dangkythanhcong']) &&  $_SESSION['dangkythanhcong'] == true){
        echo "<script>alert('Đăng ký thành công!!')</script>";
        unset($_SESSION['dangkythanhcong']);
    }
    ?>

    <form action="" method="post">
        <div class="register-form">
            <div class="register-title">
                ĐĂNG KÝ TÀI KHOẢN
                <script>let listTK = [];</script>
                <?php
                $query = mysqli_query($cn, "SELECT * FROM taikhoan");
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                    <script>
                        listTK.push("<?php echo $row['tk_taikhoan']; ?>")
                    </script>
                <?php }
                ?>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="hoten" placeholder=" " name="hoten">
                <span class="register-lable">Họ tên</span>
                <p class="loi" id="loihoten"></p>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="sdt" name="sdt" placeholder=" ">
                <span class="register-lable">Số điện thoại</span>
                <div class="loi" id="loisdt"></div>
            </div>
            <div class="register-item">
                <input type="email" class="register-input" id="email" name="email" placeholder=" ">
                <span class="register-lable">Email</span>
                <div class="loi" id="loiemail"></div>
            </div>
            <div class="register-item">
                <input type="text" class="register-input" id="tk" placeholder=" " name="taikhoan">
                <span class="register-lable">Tài khoản</span>
                <div class="loi" id="loitk"></div>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass" placeholder=" " id="mk" name="matkhau">
                <span class="register-lable">Mật khẩu</span>
                <div class="loi" id="loimk"></div>
                <ion-icon name="eye-off-outline" class="eye eye-close"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open hidden"></ion-icon>
            </div>
            <div class="register-item">
                <input type="password" class="register-input input-pass-again" placeholder=" " id="nlmk"
                    name="matkhau_again">
                <span class="register-lable">Nhập lại mật khẩu</span>
                <div class="loi" id="loinlmk"></div>
                <ion-icon name="eye-off-outline" class="eye eye-close-again"></ion-icon>
                <ion-icon name="eye-outline" class="eye eye-open-again hidden"></ion-icon>
            </div>
            <div class="register-item register-btn">
                <button onclick="kiemtraloi()" type="button">Đăng ký</button>
                <button type="reset">Hủy</button>
            </div>
        </div>
    </form>

</body>
<!-- Javascript files-->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery-3.0.0.min.js"></script>
<script>
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
                matkhau1: mk
            }, function (data) {
                $('body').html(data);
            })

        }

    }
</script>

<script>
    const input = document.querySelector(".input-pass");
    const openeye = document.querySelector(".eye-open");
    const closeeye = document.querySelector(".eye-close");

    closeeye.addEventListener("click", function () {
        closeeye.classList.add("hidden");
        openeye.classList.remove("hidden");
        input.setAttribute("type", "text");
    });
    openeye.addEventListener("click", function () {
        openeye.classList.add("hidden");
        closeeye.classList.remove("hidden");
        input.setAttribute("type", "password");
    });
</script>

<script>
    const input_again = document.querySelector(".input-pass-again");
    const openeye_again = document.querySelector(".eye-open-again");
    const closeeye_again = document.querySelector(".eye-close-again");

    closeeye_again.addEventListener("click", function () {
        closeeye_again.classList.add("hidden");
        openeye_again.classList.remove("hidden");
        input_again.setAttribute("type", "text");
    });
    openeye_again.addEventListener("click", function () {
        openeye_again.classList.add("hidden");
        closeeye_again.classList.remove("hidden");
        input_again.setAttribute("type", "password");
    });
</script>

</html>