<?php
require_once 'config.php';
/**
 * 封装大家公用的函数
 */

session_start();
/**
 * 获取当前登陆用户信息, 如果没有获取到则自动跳转到登陆页面
 * 定义函数时一定要注意：函数名与内置函数冲突问题
 */
function baixiu_get_current_user() {
    if (empty($_SESSION['current_login_user'])) {
        header('Location: /admin/login.php');
        exit();
    }
    return $_SESSION['current_login_user'];
}



/**
 * 通过一个数据库查询获取数据
 */
function xiu_fetch_all ($sql) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($conn, 'utf8');
    if (!$conn) {
        exit('链接失败');
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        // 查询失败;
        return false;
    }
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
    mysqli_free_result($query);
    mysqli_close($conn);
    return $result;
}

function xiu_fetch_one ($sql) {
    $res = xiu_fetch_all($sql);
    return isset($res[0]) ? $res[0] : null;
}

/**
 * 执行一个增删改语句
 */
function xiu_execute ($sql) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($conn, 'utf8');
    if (!$conn) {
        exit('链接失败');
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        // 查询失败;
        return false;
    }
    // 对于增删改类的查询语句操作, 都是获取受影响行数
    $affected_rows = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $affected_rows;
}