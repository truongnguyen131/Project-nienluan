<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" id="a">
    <button name="b" onclick="tot()">Rut tien</button>

</body>
<script>
    var a = document.getElementById("a");
    var tien = [500, 200, 100, 50, 20, 10,5,2,1];
    var count = 0;
    function tot() {
        console.log(a.value);
        for (var i = 0; i < tien.length; i++) {
            count += Math.floor(a.value/tien[i])
            a.value %= tien[i]
            console.log(tien[i] + ":" + count);
            count = 0;
        }
        console.log(count);
    }
</script>

</html>