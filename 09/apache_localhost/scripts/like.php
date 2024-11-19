<?php
$file_l = '../data/likes.json';

// Чтение текущих данных из файла likes.json
if (file_exists($file_l)) {
    $current_data = json_decode(file_get_contents($file_l), true);
} else {
    $current_data = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $like_id = $_POST['like_id'];

    if (isset($current_data[$like_id])) {
        $current_data[$like_id]++;
    } else {
        $current_data[$like_id] = 1; // Инициализируем лайки
    }

    // Сохранение обновленных данных в файл
    file_put_contents($file_l, json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>


