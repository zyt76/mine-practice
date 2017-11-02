<?php
$connection = mysqli_connect('localhost', 'root', '12345678', 'demo');
$query = mysqli_query($connection, 'select * from users');
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}


if (empty($_GET['callback'])) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// 如果客户端采用的是 script 标记对我发送的请求
// 一定要返回一段 Javascript

header('Content-Type: application/javascript');
$result = json_encode($data);
echo "typeof {$_GET['callback']} === 'function' && {$_GET['callback']}({$result})";
