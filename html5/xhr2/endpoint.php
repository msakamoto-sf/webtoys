<?php
$root = array(
    'SERVER' => $_SERVER,
    'COOKIE' => $_COOKIE,
    'GET' => $_GET,
    'POST' => $_POST,
    'FILES' => $_FILES,
    'BODY' => file_get_contents('php://input'),
);

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
echo json_encode($root);

