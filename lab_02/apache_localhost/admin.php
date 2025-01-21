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
        <title>Фотограф Джон Доу | Администрирование и модерация</title>
    </head>
    <body>
    <?php
        session_start();
        if(!empty($_GET["action"])&&$_GET["action"]=="logout"){
            session_destroy();
            header("Location: login.php");
            exit;
        }
        
        if(!empty($_GET["action"])&&$_GET["action"]=="login"&&!empty($_POST["log"])&&!empty($_POST["pass"])){
            if(($_POST["log"]=="admin"&&$_POST["pass"]=="test")){
                $_SESSION["user"]="admin";
            }
        }
        
        if(!empty($_SESSION["user"])&&$_SESSION["user"]=="admin"){

        } else {
            header("Location: login.php");
            exit;
        }
    ?>
<html>
<body>
        <?php
            $routes = [ 'comments' => 'feedback_adm.php','content' => 'portfolio_adm.php', 'messages' => 'messages_adm.php', 'orders' => 'orders_adm.php', 'start' => 'admin_start.php', 'login' => 'login.php'];
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'start';
        ?>
        <header>                
            <menu>
                <ul>
                    <li><a href="?page=orders">Заказы</a></li>
                    <li><a href="?page=messages">Сообщения</a></li>
                    <li><a href="?page=comments">Комментарии</a></li>
                    <li><a href="?page=content">Портфолио</a></li> 
                </ul>
            </menu>
        </header>
        <?php
            if (array_key_exists($page, $routes) && file_exists($routes[$page])) {
                include $routes[$page];
            } else {
                include '404.php';
            }
            ?>
        <footer>
            <p>Работает? Не трогай!</p>
            <p><a href="admin.php?action=logout">Выйти из системы администрирования</a></p>
        </footer>
    </body>
</html>

