// Tăng giảm số lượng
var valu = document.getElementById("val");
var count = valu.value;

let giamsl = () => {
    if (count > 1) {
        count--;
        render(count);

    } else {
        count = 1;
    }
};

let tangsl = () => {
    count++;
    render(count);
};

let render = (count) => {
    valu.value = count;
}