<!-- добавьте на главной странице вывод следующей информации в заданном формате: «Сегодня третье сентября 2024 года
(високосный год), вторник, первая неделя нечетная» -->
<!DOCTYPE html>
<html>
    <head>
        <title>Тестируем PHP</title>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body>
        <main>
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
            echo 'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('високосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'<br/>';
        } else {
            echo 'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('невисокосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'<br/>';
        }
        echo  '<hr class="line">'.'На часах '.date('H:i');
        ?>
        </main>
    </body>
</html>