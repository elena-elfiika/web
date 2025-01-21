<?php
    $routes = ['home' => 'home.php', 'about' => 'about.php', 'portfolio' => 'portfolio.php', 'order' => 'order.php', 'prices' => 'prices.php', 'contacts' => 'contacts.php', 'feedback' => 'feedback.php', 'portfolio_element' => 'portfolio_element.php'];
    $titles = ['home' => 'Главная', 'about' => 'Обо мне', 'portfolio' => 'Портфолио', 'order' => 'Заказать', 'prices' => 'Цены', 'contacts' => 'Контакты', 'feedback' => 'Отзывы', 'portfolio_element' => 'Портфолио'];
    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
    ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <!-- Шрифты -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <!-- Стили -->
    <link rel="stylesheet" href="style/main.css">
    <title>
        <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])) { echo $titles[$page].' | ';} ?> Фотограф Джон Доу 
    </title>
</head>

<body>
    <div class="main">
    <?php

        include 'header.php';
        
        if (array_key_exists($page, $routes) && file_exists($routes[$page])) {
            include $routes[$page];
        } else {
            include '404.php';
        }

        include 'footer.php';
        
        ?>
    </div>
</body>

</html>