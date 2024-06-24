<?php
// Включение вывода ошибок (рекомендуется для разработки)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Разрешаем CORS (для тестирования, в продакшене используйте более строгие настройки)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

// Проверка наличия необходимых параметров в запросе
if (!isset($_GET['week'])) {
    http_response_code(400);
    echo json_encode(array("error" => "Не указан параметр: week"));
    exit;
}

// URL вашего удалённого сервера и параметры
$url = 'http://hdsseils.dnshome.de/api/get_assigned_addresses.php';
$week = $_GET['week'];

// Формируем полный URL для запроса
$fullUrl = $url . '?week=' . urlencode($week);

// Выполняем запрос к удалённому серверу
$response = file_get_contents($fullUrl);

// Проверяем ответ и возвращаем его клиенту
if ($response === false) {
    http_response_code(500);
    echo json_encode(array("error" => "Ошибка при выполнении запроса к удалённому серверу"));
} else {
    // Возвращаем ответ как есть
    echo $response;
}
