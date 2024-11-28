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
            $routes = [ 'comments' => 'comments_moderation.php','content' => 'content.php', 'start' => 'admin_start.php'];
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'start';
        ?>
        <header>
            <a href="index.php?page=home"><img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_chernyy.png" class="logo_img" alt="Логотип Университета ИТМО"></a>
            <?php
                // Часовой пояс
                date_default_timezone_set("Europe/Moscow");
                //Дата
                $date = new DateTime();
                //Форматирование
                $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                $intlFormatter->setPattern('MMMM YYYY');
                $weekform = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                $weekform->setPattern('EEEE');
                $year =  date('Y');
                $vis = date("L", mktime(0,0,0, 7,7, $year));
                $timestamp = strtotime('02.09.2024 00:00');
                $week = date('W') - date('W', $timestamp) + 1;
                if ($week % 2 != 0){
                    $wch = 'нечетная';
                } else {
                    $wch = 'четная';
                }
                $day = date('d');
                $nFormat = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
                $nFormat->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal-neuter");
                $nFormat_2 = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
                $nFormat_2->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal-feminine");
                if ($vis == 1){
                    echo '<p class="header_time">'.'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('високосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'.   '.'На часах '.date('H:i').'</p>';
                } else {
                    echo '<p class="header_time">'.'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('невисокосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'.   '.'На часах '.date('H:i').'</p>';
                }
                ?>
            <menu>
                <ul>
                    <li><a <?php if ($page === 'comments'){echo 'class="active_page"';}?> href=admin.php?page=comments>Модерация комментариев</a></li>
                    <li><a <?php if ($page === 'content'){echo 'class="active_page"';}?> href=admin.php?page=content>Модерация контента</a></li>
                </ul>
            </menu>
        </header>
        <main>
            <?php
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

