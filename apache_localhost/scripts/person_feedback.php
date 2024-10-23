<?php
date_default_timezone_set("Europe/Moscow");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id'])) {
    $form_id = $_POST['form_id'];
    $file = "../data/" . htmlspecialchars($form_id) . ".json";

    if (file_exists($file)) {
        $current_data = json_decode(file_get_contents($file), true);
    } else {
        $current_data = [];
    }

    if (isset($_POST['name']) && isset($_POST['comment'])) {
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        
        $data = [
            'name' => $name,
            'comment' => $comment,
            'timestamp' => date('Y-m-d H:i')
        ];
        $current_data[] = $data;

        file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

?>
