<?php
$data = array(
    'name' => 'zs',
    'age' => 12
);
$data = json_encode($data);
header('Content-Type: application/json');
echo "fn({$data});";