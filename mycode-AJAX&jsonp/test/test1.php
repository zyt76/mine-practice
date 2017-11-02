<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #box {
            width: 100px;
            height: 100px;
            background-color: red;
        }
    </style>
</head>
<body>
    <div id="box"></div>
</body>
<script>
    var oBox = document.getElementById("box");
    // oBox.onclick = function () {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'test.php?get1=value1');
        // xhr.open('GET', 'test.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('key1=value1&key2=value2');
        console.log(xhr);
    // }
</script>
</html>