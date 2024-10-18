<?php
$file_l = 'likes.json';
if (file_exists($file_l)) {
    $current_data = json_decode(file_get_contents($file_l), true);
} else {
    $current_data[0] = [[
        'like1' => 0,
        'like2' => 0,
        'like3' => 0,
    ]]; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $like_id = $_POST['like_id'];

    switch($like_id){
        case ('like1'): $current_data[0]['like1']++; break;
        case ('like2'): $current_data[0]['like2']++; break;
        case ('like3'): $current_data[0]['like3']++; break;
    }

    file_put_contents($file_l, json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

exit;
?>
