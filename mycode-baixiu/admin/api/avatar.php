<?php

/**
 * 根据用户邮箱获取用户头像
 */
require_once '../../config.php';
// 1. 接收传递过来的邮箱
if (empty($_GET['email'])) {
    exit('缺少必要参数');
}
$email = $_GET['email'];
// 2. 查询对应的头像地址
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    exit('链接数据库失败');
}
$query = mysqli_query($connection, "select avatar from users where email='{$email}' limit 1;");
if (!$query) {
    exit('查询失败');
}
$row = mysqli_fetch_assoc($query);
// 3. echo
echo $row['avatar'];

 $connection = mysqli_connect('localhost', 'root', '12345678', 'baixiu-dev');
mysqli_set_charset($connection, 'utf8');
if (!$connection) {
    die('<h1>Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error() . '</h1>');
}