<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Университет ИТМО | Персоналии</title>
    <link rel="stylesheet" href="style/main.css">
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
            <a href="index.php">Главная</a>
            <p>Персоналии</p>
            <a href="campus.php">Кампус</a>
            <a href="about.php">О нас</a>
        </menu>
    </header>
    <main>
        <div>
            <h1>
                Персоналии
            </h1>
        </div>
        <div class="campus">
            <a href="people.php" class="back_link">Назад</a>
            <a href="person_003.php">
                <h2>Кустарев Павел Валерьевич</h2>
            </a>
            <a href="person_003.php"><img src="https://itmo.ru/images/person/small/p971.jpg"></a>
            <p>
                Павел Валерьевич Кустарев - к.т.н., декан и доцент факультета программной инженерии и компьютерной
                техники, зам. председателя научно-технического совета "Автоматическое управление, робототехника,
                электропривод", сотрудник Международной лаборатории «Архитектура и методы проектирования встраиваемых
                систем и систем на кристалле», член Ученого совета Университета ИТМО.



                Образование

                Родился в 1971 г. в г. Ленинград. По окончании средней школы с 1989г. по 1995г.обучался на кафедре
                вычислительной техники Ленинградского института точной механики и оптики (ЛИТМО, СПб ГУИТМО(ТУ), сегодня
                - Университет ИТМО) по специальности "Вычислительные машины, комплексы. системы и сети". С 1995 г. по
                1998 г. обучался в аспирантуре, в 1999 г. защитил диссертацию с присвоением ученой степени кандидата
                технических наук.



                Трудовой путь

                С 1998 г. и по настоящее время работал на кафедре вычислительной техники в должности ассистента, позже -
                доцента. Подготовил и преподавал более 10 различных дисциплин по тематикам встроенные вычислительные
                системы, системы на кристалле, вычислительные сети. Являлся научным руководителем в сумме нескольких
                десятков специалистов, бакалавров, магистрантов, аспирантов.



                Научно-исследовательская деятельность

                Участвовал в реализации нескольких НИР (по программам Минобрнауки и в рамках хоздоговорных работ) по
                направлению методов архитектурного и функционального проектирования встраиваемых систем. Участвовал в
                реализации нескольких десятков практических проектов по разработке и производству встраиваемых систем
                различного назначения, в том числе в качестве руководителя проектов. Личная специализация - электроника,
                системотехника встраиваемых систем.
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