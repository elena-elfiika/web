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
        <link rel="stylesheet" href="style/admin.css">
        <title>Университет ИТМО | Администрирование и модерация</title>
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
            $routes = [ 'comments' => 'comments_moderation.php','content' => 'content.php', 'start' => 'admin_start.php', 'login' => 'login.php'];
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'start';
        ?>
        <header>
            <a href="index.php?page=home"><img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_chernyy.png" class="logo_img" alt="Логотип Университета ИТМО"></a>
            <?php include('scripts/time.php');?>
            <a href="admin.php?action=logout">logout</a>
            <menu>
                <ul>
                    <li><a <?php if ($page === 'comments'){echo 'class="active_page"';}?> href=admin.php?page=comments>Модерация комментариев</a></li>
                    <li><a <?php if ($page === 'content'){echo 'class="active_page"';}?> href=admin.php?page=content>Модерация контента</a></li>
                </ul>
            </menu>
        </header>
        <main>
            <?php
                // if(){
                //     include('login.php');
                // }

                if ($page === 'start') {
                    include 'admin_start.php';
                } elseif (array_key_exists($page, $routes) && file_exists($routes[$page])) {
                    include $routes[$page];
                } else {
                    include '404.php';
                }
            ?>
        </main>
        <footer>
            <p>Работает? Не трогай!</p>
        </footer>
    </body>
</html>

