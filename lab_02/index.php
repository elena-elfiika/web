    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/main.css">
        <title>Фотограф Джон Доу</title>
    </head>

    <body>
        <?php
        include 'header.php';
        
        $routes = [ 'about' => 'about.php','people' => 'people.php','campus' => 'campus.php','person_001' => 'person_001.php','person_002' => 'person_002.php','person_003' => 'person_003.php', 'birza' => 'birza.php', 'griv' => 'griv.php', 'lomonosov' => 'lomonosov.php', 'kronv' => 'kronv.php', ];
        
        $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
        
        if (array_key_exists($page, $routes) && file_exists($routes[$page])) {
            include $routes[$page];
        } else {
            include '404.php';
        }

        include_once('footer.php');
        ?>
    </body>

    </html>