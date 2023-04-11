<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <?php
        // $con = mysqli_connect('localhost', 'root', '', 'nienluan');
        // mysqli_set_charset($con, "utf8");
        ?>
        <?php
        include_once('database_connection.php');

        $Thongtin = mysqli_query($cn, "SELECT * FROM taikhoan");
        if (isset($_POST['timkiem'])) {
            $search = $_POST['timkiem'];
            $Thongtin = mysqli_query($cn, "SELECT * FROM taikhoan WHERE tk_taikhoan LIKE '%$search%' ORDER BY tk_taikhoan");
        }

        //Tim kiem tat ca
        if (isset($_POST['tatca']))
        $Thongtin = mysqli_query($cn, "SELECT * FROM taikhoan ORDER BY tk_taikhoan");

        //xoa nhieu tai khoan cung luc
        if (isset($_POST['xoacheckbox']) && isset($_POST['checkbox'])) {
            for ($i = 0; $i < count($_POST['checkbox']); $i++) {
                $dachon = $_POST['checkbox'][$i];
                mysqli_query($con, "DELETE FROM taikhoan WHERE tk_id=$dachon");
                header("location:quanlytk.php");
            }
        }

        ?>


        <section>
            <div class="container-fluid">
                <div class="timkiem">
                    <input type="text" name="timkiem">
                    <button type="submit" class=" ">Tìm kiếm</button>
                    <button type="submit" name="tatca" class="">Tất cả</button>
                </div>
            </div>

            <div class="themsanpham">
                <a href="dangky.php"><i class="" aria-hidden="true"></i>Thêm mới</a>
            </div>

            <table class="table table-bordered">
                <colgroup>
                    <col width="50" span="1">
                    <col width="50" span="1">
                    <col width="120" span="1">
                    <col width="120" span="1">
                    <col width="50" span="2">

                </colgroup>
                <tr class="table-danger">
                    <th colspan="6">Thông tin loại sản phẩm</th>
                </tr>
                <tr class="table-info">
                    <th>Chọn</th>
                    <th>Số thứ tự</th>
                    <th>Tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Cập nhật</th>
                    <th>Xóa</th>
                </tr>
                <?php
                $STT = 1;
                while ($cot = mysqli_fetch_array($Thongtin, MYSQLI_ASSOC)) {
                ?>
                    <tr class="table-info">
                        <td align="center"><input type="checkbox" name="checkbox[]" value="<?php echo $cot['tk_id']; ?>"></td>
                        <td align="center"><?php echo $STT ?></td>
                        <td><?php echo $cot['tk_taikhoan'] ?> </td>
                        <td><?php echo md5($cot['tk_matkhau']) ?> </td>
                        <td><?php echo $cot['tk_loaitaikhoan'] ?> </td>
                        <td align="center"><a href="Loaisp_capnhat.php?id=<?php echo $cot['tk_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td align="center"><button type="button" onclick="deletetk('<?php echo $cot['tk_id']; ?>');" class="btn-trash"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                    </tr>
                <?php
                    $STT++;
                }
                ?>
            </table>
            <div class="xoamucchon">
                <button type="button" onclick="deletenhieu('<?php echo $cot['tk_id']; ?>');" name="xoacheckbox" class="btn btn-css ">Xóa mục chọn</button>
            </div>
        </section>
    </form>
    <form name="formXoa">
        <input type="hidden" name="hdIdXoa" />
    </form>
</body>

</html>
<script language="javascript">
    function deletetk(id) {
        if (confirm("Bạn có muốn xóa!")) {
            document.formXoa.hdIdXoa.value = id;
            document.formXoa.action = "quanlytk_xoa.php";
            document.formXoa.submit();
        } else {
            return false;
        }
    }
</script>