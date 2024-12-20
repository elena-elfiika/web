    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="https://itmo.ru/pic/favicon.ico">
        <link rel="apple-touch-icon" href="https://itmo.ru/pic/speeddials/apple_touch.png">
        <link rel="icon" type="image/x-icon" href="https://itmo.ru/pic/favicon.ico">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/main.css">

        <title>Университет ИТМО</title>
    </head>

    <body>
        <?php
        
        $routes = [ 'game' => 'game.php', 'home' => 'home.php'];
        
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
        
        if ($page === 'home') {
            include 'home.php'; 
        } elseif (array_key_exists($page, $routes) && file_exists($routes[$page])) {
            include $routes[$page];
        } else {
            include '404.php';
        }
        
        ?>
    </body>

    </html>