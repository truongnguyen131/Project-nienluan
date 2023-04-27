// Tăng giảm số lượng
var giamsl = document.getElementById("giam");
var tangsl = document.getElementById("tang");
var valu = document.getElementById("val");
giamsl.addEventListener("click", function() {
    if (valu.value == 1) {
        valu.value == 1;
    } else {
        valu.value--;
    }
});
tangsl.addEventListener("click", function() {
    valu.value++;
});