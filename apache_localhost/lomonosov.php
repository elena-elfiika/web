<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Университет ИТМО | Кампус | Ломоносова</title>
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
    <header>
        <img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_chernyy.png" class="logo_img" alt="Логотип Университета ИТМО">
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
            <a href="index.php">Главная</a>
            <a href="people.php">Персоналии</a>
            <p>Кампус</p>
            <a href="about.php">О нас</a>
        </menu>
    </header>
    <main class="map">
        <div>
            <h1>
                Корпуса Университета ИТМО
            </h1>
        </div>
        <div class="campus">
            <img class="campus" src="https://itmo.ru/images/buildings_map/small/p5.jpg">
            <h2>ул. Ломоносова, д.9</h2>
            <a href="campus.php" class="back_link">Назад</a>
            <p>
                Адрес корпуса Университета ИТМО:
                <br/>
                191002, г. Санкт-Петербург, улица Ломоносова, д.9
            </p>
        </div>
    </main>
    <footer>
        <hr />
        <div class="adress_footer">
            197101, г. Санкт-Петербург, Кронверкский проспект, д.49, литер А.
            (Вход со стороны Сытнинской ул.)
        </div>
        <div class="other_footer">
            <p>
                КАНЦЕЛЯРИЯ
                +7 (812) 480-00-00
                Факс: +7 (812) 232-23-07
                od@itmo.ru
            </p>
            <p>ПРИЁМНАЯ КОМИССИЯ
                +7 (812) 480-04-80
                abit@itmo.ru
            </p>
            <p>
                ЦЕНТР РЕКРУТИНГА
                job@itmo.ru
            </p>
            <p>
                СТУДЕНЧЕСКИЙ ОФИС
                +7 (812) 607-04-74
                so@itmo.ru
            </p>
            <p>
                ОФИС ПОДДЕРЖКИ сотрудников
                +7 (812) 607-02-50
                faculty@itmo.ru
            </p>
            <p>
                ПРЕСС-СЛУЖБА
                +7 (900) 630-00-10
                pressa@itmo.ru
            </p>
        </div>
    </footer>
</body>

</html>