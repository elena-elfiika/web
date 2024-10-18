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
            <div class="person">
                <a href="person_001.php">
                    <h2>Васильев Владимир Николаевич</h2>
                </a>
                <a href="person_001.php"><img src="https://itmo.ru/images/person/small/p1.jpg" class="img_person"></a>
                <p class="about_person">
                    Ректор
                    <br />
                    Председатель президиума Ученого совета
                </p>
                <a href="person_001.php">Подробнее</a>
                <?php
                // Чтение текущих данных из файла
                $file = 'data.json';
                if (file_exists($file)) {
                    $current_data = json_decode(file_get_contents($file), true);
                    // Вывод всех комментариев
                    echo '<h3>Комментарии</h3>';
                    echo '<div class="comments-container" id="comm3">';
                    foreach ($current_data as $entry) {echo '<p class="feedback_name">'.htmlspecialchars($entry['name']).'</p>'.'   '.'<p class="feedback_date">'.$entry['timestamp'] .'</p>'.'<p class="feedback_text">'.htmlspecialchars($entry['comment']) .'</p>';
                    }
                    echo '</div>';
                } else {
                    $current_data = [];
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_id'] == 1) {
                    $name = $_POST['name'];
                    $comment = $_POST['comment'];
                    // запись с данными и временной меткой
                    $data = [
                        'name' => $name,
                        'comment' => $comment,
                        'timestamp' => date('Y-m-d H:i:s')
                    ];
                    $current_data[] = $data;
                    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    }
                    ?>
                <h3>Оставить комментарий</h3>
                <form id="form1" method="post">
                    <input type="hidden" name="form_id" value="1">
                    <label for="name">Ваше имя:</label>
                    <input type="text" id="name" name="name" required><br><br>
                    <label for="comment">Ваш комментарий:</label>
                    <textarea id="comment" name="comment" rows="3" required></textarea><br><br>
                    <input type='submit' value='Отправить'>
                </form>
            </div>
            <div class="person">
                <a href="person_002.php">
                    <h2>Бобцов Алексей Алексеевич</h2>
                </a>
                <a href="person_002.php"><img src="https://itmo.ru/images/person/small/p322.jpg"></a>
                <p class="about_person">
                    Директор мегафакультета компьютерных технологий и управления
                    <br />
                    Профессор факультета систем управления и робототехники
                    <br />
                    Руководитель Международного научного центра «Нелинейные и адаптивные системы управления»
                </p>
                <a href="person_002.php">Подробнее</a>

                <?php
                // Чтение текущих данных из файла
                $file2 = 'data2.json';
                if (file_exists($file2)) {
                    $current_data2 = json_decode(file_get_contents($file2), true);
                    echo '<h3>Комментарии</h3>';
                    
                    echo '<div class="comments-container" id="comm2">';
                    foreach ($current_data2 as $entry2) {
                        echo '<p class="feedback_name">'.htmlspecialchars($entry2['name2']).'</p>'.'   '.'<p class="feedback_date">'.$entry2['timestamp2'] .'</p>'.'<p class="feedback_text">'.htmlspecialchars($entry2['comment2']) .'</p>';
                    }
                    echo '</div>';
                    } else {
                        $current_data2 = [];
                }
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_id'] == 2) {
                    $name2 = $_POST['name2'];
                    $comment2 = $_POST['comment2'];            
                    
                    // запись с данными и временной меткой
                    $data2 = [
                        'name2' => $name2,
                        'comment2' => $comment2,
                        'timestamp2' => date('Y-m-d H:i:s')
                    ];
                    
                    $current_data2[] = $data2;
                    file_put_contents($file2, json_encode($current_data2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
                }

                ?>

                <h3>Оставить комментарий</h3>
                <form id="form2" method="post">
                    <input type="hidden" name="form_id" value="2">
                    <label for="name2">Ваше имя:</label>
                    <input type="text" id="name2" name="name2" required><br><br>
                    <label for="comment2">Ваш комментарий:</label>
                    <textarea id="comment2" name="comment2" rows="3" required></textarea><br><br>
                    <input type='submit' value='Отправить'>
                </form>

            </div>
            <div class="person">
                <a href="person_003.php">
                    <h2>Кустарев Павел Валерьевич</h2>
                </a>
                <a href="person_003.php"><img src="https://itmo.ru/images/person/small/p971.jpg"></a>
                <p class="about_person">
                    Декан, доцент факультета программной инженерии и компьютерной техники
                    <br />
                    Главный конструктор научно-исследовательского центра оборонных и двойных технологий
                    <br />
                    Старший научный сотрудник национального центра когнитивных разработок
                </p>
                <a href="person_003.php">Подробнее</a>


                <?php
                // Чтение текущих данных из файла
                $file3 = 'data3.json';
                if (file_exists($file3)) {
                    $current_data3 = json_decode(file_get_contents($file3), true);
                    // Вывод всех комментариев
                
                echo '<h3>Комментарии</h3>';
                echo '<div class="comments-container" id="comm3">';
                foreach ($current_data3 as $entry3) {
                    echo '<p class="feedback_name">'.htmlspecialchars($entry3['name3']).'</p>'.'   '.'<p class="feedback_date">'.$entry3['timestamp3'] .'</p>'.'<p class="feedback_text">'.htmlspecialchars($entry3['comment3']) .'</p>';
                } 
                echo '</div>';
                } else {
                    $current_data3 = [];
                }
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form_id'] == 3) {
                    $name3 = $_POST['name3'];
                    $comment3 = $_POST['comment3'];            
                    
                    // запись с данными и временной меткой
                    $data3 = [
                        'name3' => $name3,
                        'comment3' => $comment3,
                        'timestamp3' => date('Y-m-d H:i:s')
                    ];
                    
                    $current_data3[] = $data3;
                    file_put_contents($file3, json_encode($current_data3, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    }
                ?>

                <h3>Оставить комментарий</h3>

                <form id="form3" method="post">
                    <input type="hidden" name="form_id" value="3">
                    <label for="name3">Ваше имя:</label>
                    <input type="text" id="name3" name="name3" required><br><br>
                    <label for="comment3">Ваш комментарий:</label>
                    <textarea id="comment3" name="comment3" rows="3" required></textarea><br><br>
                    <input type='submit' value='Отправить'>
                </form>

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

        <script src="form_solver.js"></script>
    </body>

    </html>