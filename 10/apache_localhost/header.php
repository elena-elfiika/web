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
        <?php
        if (isset($_GET['page'])) {
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
            switch ($page) {
                case 'about': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <p>О нас</p>';
                    break;
                case 'people': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'home': 
                    echo '<p>Главная</p> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_001': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_002': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_003': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'campus': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'birza': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'griv': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'kronv': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'lomonosov': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
            }
        } else  echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
        ?>
    </menu>
</header>