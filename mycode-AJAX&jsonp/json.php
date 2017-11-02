<?php
$zhangsan = array('name' => '张三', 'age' => 18);
header('Content-Type: application/json');
echo json_encode($zhangsan);