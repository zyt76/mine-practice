<?php
require_once '../function.php';
baixiu_get_current_user();
/**
 * 根据客户端传递的 ID 删除对应数据
 */
if (empty($_GET['id'])) exit('缺少必要参数');
$id = (int)$_GET['id'];

$rows = xiu_execute("delete from categories where id = {$id}");
header('Location: /admin/categories.php');