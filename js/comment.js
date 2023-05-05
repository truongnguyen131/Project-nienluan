function kiemtraloi() {
    var check = 0
    var cmt = $('#cmt').val()
    var id_sp = $('#sp__id').val()
    var tk_id = $('#id_tk').val()
    var checkbox = document.getElementsByName('star');
    var result = 0;
    for (var i = 0; i < checkbox.length; i++) {
        if (checkbox[i].checked === true) {
            result = checkbox[i].value;
        }
    }
    if (cmt == "") {
        check -= 1
        $('#loicmt').html("Vui lòng nhập bình luận")
    } else {
        $('#cmt').removeClass('is-invalid')
        $('#loicmt').html("")
        check += 1
    }

    if (check == 1) {

        $.post('xulydanhgia.php', {
            cmt1: cmt,
            id1: id_sp,
            tk1: tk_id,
            star1: result,
            page: "chitietsp"
        }, function(data) {
            $('body').html(data);
        })

    }
}