<?php
header('Content-Type: application/json');

// Проверка параметра id
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode([
        "error" => "Missing id"
    ]);
    exit;
}

$id = intval($_GET['id']);

// Имитация работы с БД (10–50 мс)
usleep(200 * 1000);

// Ответ
echo json_encode([
    "status" => "success",
    "id" => $id,
    "timestamp" => microtime(true)
]);