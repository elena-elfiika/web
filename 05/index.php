<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://itmo.ru/pic/favicon.ico">
    <link rel="apple-touch-icon" href="https://itmo.ru/pic/speeddials/apple_touch.png">
    <link rel="icon" type="image/x-icon" href="https://itmo.ru/pic/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/main.css">

    <title>Университет ИТМО</title>
</head>

<body>
    <header>
        <img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_chernyy.png" class="logo_img"
            alt="Логотип Университета ИТМО">
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
            <p>Главная</p>
            <a href="people.php">Персоналии</a>
            <a href="campus.php">Кампус</a>
            <a href="about.php">О нас</a>
        </menu>
    </header>
    <main>
        <h1>
            Добро пожаловать в Университет ИТМО!
        </h1>
        <img src="https://news.itmo.ru/images/news/big/p12677.jpg" class="main_img" alt="">
        <p>
            Университет ИТМО (Санкт-Петербург) ― национальный исследовательский университет, ведущий вуз России в
            области информационных и фотонных технологий. Один из лидеров глобального и национального академического
            сообщества.
        </p>
        <p>
            ИТМО ― это более 12 500 студентов из порядка 90 стран и свыше 4000 ученых, преподавателей и сотрудников.
        </p>
        <p>
            В структуре университета ― 4 мегафакультета и 15 факультетов. Приоритетные направления: IT, фотоника,
            робототехника, квантовые коммуникации, информационная безопасность, трансляционная медицина, умные
            материалы, химия, биотехнологии, урбанистика, Art&Science, Science Communication.
        </p>
        <p>
            ИТМО ― альма-матер победителей международных соревнований по программированию: ICPC (единственный в мире
            семикратный чемпион), Google Code Jam, Facebook Hacker Cup, Яндекс.Алгоритм, Russian Code Cup, Topcoder Open
            и др.
        </p>
        <p>
            Университет ИТМО с 2016 г. входит в ТОП-100 лучших вузов мира в области компьютерных наук (Computer Science)
            по версии предметного рейтинга Times Higher Education, а с 2019 г. ― в сотню лучших университетов мира в
            предметной области «Автоматизация и управление» (Automation & Control) Шанхайского рейтинга (ARWU). Вуз
            также представлен в ТОП-250 лучших вузов мира по инженерным наукам (Engineering and Technology) в рейтинге
            Times Higher Education и в ТОП-250 по физическим наукам (Physics & Astronomy) по версии предметного рейтинга
            Quaquarelly Symonds (QS).
        </p>
        <p>
            На 2020 год ИТМО входит в ТОП-500 мирового институционального рейтинга THE и в ТОП-400 рейтинга QS, а также
            в 17 предметных рейтингов THE, QS и ARWU.
        </p>
        <p>
            В 2019 году журнал Forbes назвал Университет ИТМО лучшим российским вузом по качеству образования, а портал
            SuperJob включил его в тройку лучших технических вузов страны по уровню зарплат выпускников.
        </p>
        <p>
            Добро пожаловать в первый неклассический университет!
        </p>
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