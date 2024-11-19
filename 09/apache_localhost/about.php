<main>
    <h1>Об университете</h1>
    <div class="history">
        <h2>История Университета</h2>
        <p>
            Университет ИТМО (в советское время — ЛИТМО, Ленинградский институт точной механики и оптики) —
            российское федеральное государственное автономное учебное заведение высшего и послевузовского
            образования, с 2009 года — национальный исследовательский университет (НИУ). Основан в 1900 году в
            Санкт-Петербурге. Приоритетные направления вуза — информационные технологии, искусственный интеллект,
            фотоника, робототехника, квантовые коммуникации, трансляционная медицина, науки о жизни (Life Sciences),
            научная коммуникация. Команда ИТМО по спортивному программированию — единственный в мире семикратный
            чемпион крупнейшей международной студенческой олимпиады ICPC.
        </p>
        <p>
            Вуз входит в топ-5 российских вузов по качеству бюджетного приёма, один из лидеров по уровню зарплат
            IT-выпускников. Лидер федеральных инициатив развития конкурентоспособности российских вузов — «Проекта
            5—100» (2013—2020) и «Приоритет 2030» (с 2021 года). Входит в национальные и глобальные (ARWU, QS и THE)
            академические рейтинги. Так, с 2019 года представлен в первой сотне Шанхайского предметного рейтинга
            (ARWU) «Автоматизация и управление», с 2022-го — лидирует среди российских вузов в области «Nanoscience
            & Nanotechnology».
        </p>
        <h2>
            Университет сейчас
        </h2>
        <p>
            В 2013 году Университет ИТМО на конкурсной основе вошёл в программу повышения конкурентоспособности
            российских вузов среди ведущих мировых научно-образовательных центров «Проект 5—100», запущенный
            Министерством образования и науки. Вплоть до завершения проекта в 2020-м, университет входил в
            лидирующую группу, что гарантировало ему повышенное финансирование. Хотя российские вузы не
            попали в глобальную сотню Academic Ranking of World Universities (ARWU), QS World University Rankings
            (QS) и THE World University Rankings (THE), они значительно продвинулись в их отраслевых
            рейтингах, что Минобрнауки признало успешным результатом. Так, в сентябре 2016 года Университет ИТМО
            стал дебютантом мирового рейтинга THE в группе 350—400, в предметном рейтинге по компьютерным наукам
            занял 56 место и с тех пор держится в первой сотне. В июне 2017-го вуз впервые вошёл в мировой
            рейтинг QS на позиции 601—650, а в июне 2019 года поднялся в топ-500 (436 место). В августе
            2018-го Университет ИТМО впервые дебютировал в Шанхайском рейтинге ARWU в группе 801—900. В июне
            2019 года вошёл в топ-100 предметного рейтинга ARWU «Автоматизация и управление». К началу 2020-го ИТМО
            был представлен уже в 21 предметном рейтинге THE, QS и ARWU. В сентябре 2021 года
            университет впервые вошёл в группу 301—500 рейтинга QS по трудоустройству выпускников.
        </p>
        <p>
            С 2021 года преемником «Проекта 5—100» стала новая федеральная программа по поддержке и развитию
            университетов «Приоритет 2030». Она также включает около сотни вузов, каждый из которых получил базовый
            годовой грант в размере 100 млн рублей. Дополнительные гранты распределены между 46 участниками по двум
            категориям — «Исследовательское лидерство» и «Отраслевое (территориальное) лидерство». Университет ИТМО
            входит в десятку вузов первой группы, которым полагается дополнительное финансирование на
            научно-технические разработки из федерального бюджета в размере 1 млрд рублей. По итогам 2022 года
            вуз занимает первое место в группе «исследовательское лидерство», на работу будет выделено 820 млн
            рублей. ИТМО заявляло направить эти средства на развитие квантовой сети, технологий диагностики
            здоровья, мониторинга технического состояния железных дорог.
        </p>
    </div>
    <div class="history">
        <h2>Отзывы</h2>
        <?php
            $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=test', 'site_connection', 'Class_data1.', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
            ]);
            // Отправка формы
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $feedback = htmlspecialchars(strip_tags($_POST['feedback']));
                $stmt = $pdo->prepare("INSERT INTO feedback_university (user, date, text) VALUES (:name, NOW(), :feedback)");
                $stmt->execute(['name' => $name, 'feedback' => $feedback]);
            }

            // Параметры сортировки
            $order = $_GET['order'] ?? 'date';
            $direction = $_GET['direction'] ?? 'DESC';
            $limit = (int)($_GET['limit'] ?? 10);
            $offset = (int)($_GET['page_num'] ?? 0) * $limit;

            $allowedColumns = ['user', 'date', 'text'];
            $allowedDirections = ['ASC', 'DESC'];

            $order = in_array($order, $allowedColumns) ? $order : 'date';
            $direction = in_array($direction, $allowedDirections) ? $direction : 'DESC';
            $limit = in_array($limit, [10, 20, 50, 100]) ? $limit : 10;

            $stmt = $pdo->prepare("SELECT user, date, text FROM feedback_university ORDER BY $order $direction LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
            <!-- Пагинация -->
            <!-- Пагинация — это процесс разделения больших объемов данных на более мелкие части (страницы) и отображение этих частей по очереди, чтобы облегчить восприятие и улучшить производительность на веб-страницах. -->
        <div class="pagination">            
            <form method="GET">
                <label for="limit">Отзывы на странице:</label>
                <select name="limit" id="limit">
                    <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                    <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                </select>
                <label for="order">Сортировка по:</label>
                <select name="order" id="order">
                    <option value="date" <?= $order == 'date' ? 'selected' : '' ?>>Дате</option>
                    <option value="user" <?= $order == 'user' ? 'selected' : '' ?>>Имени</option>
                    <option value="text" <?= $order == 'text' ? 'selected' : '' ?>>Сообщению</option>
                </select>
                <label for="direction">Направление сортировки:</label>
                <select name="direction" id="direction">
                    <option value="ASC" <?= $direction == 'ASC' ? 'selected' : '' ?>>По возрастанию</option>
                    <option value="DESC" <?= $direction == 'DESC' ? 'selected' : '' ?>>По убыванию</option>
                </select>
                <input type="hidden" name="page" value="about">
                <input type="hidden" name="page_num" value="<?= $currentPageNum ?>">
                <button type="submit">Применить</button>
            </form>
            <p>
                <?php
                $totalPages = ceil($pdo->query("SELECT COUNT(*) FROM feedback_university")->fetchColumn() / $limit);
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 'about';
                $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 0;
                
                for ($i = 0; $i < $totalPages; $i++):
                    $isCurrentPage = ($i == $currentPageNum);
                ?>
                    <a href="?page=<?= $currentPage ?>&page_num=<?= $i ?>&limit=<?= $limit ?>&order=<?= $order ?>&direction=<?= $direction ?>" class="<?= $isCurrentPage ? 'current_p' : '' ?>">
                    <?= $i + 1 ?>
                </a>
                <?php endfor; ?>
            </p>
        </div>

        <!-- Вывод отзывов -->
        <?php foreach ($feedbacks as $feedback): ?>
        <div class="feedback">
            <p class="feedback_name">
                <?= htmlspecialchars($feedback['user']) ?>
            </p>
            <p class="feedback_date">
                <?= htmlspecialchars($feedback['date']) ?>
            </p>
            <p class="feedback_text">
                <?= htmlspecialchars($feedback['text']) ?>
            </p>
        </div>
        <?php endforeach; ?>

        <form method="POST" id="feedbackForm">
            <h2>Оставьте свой отзыв!</h2>
            <label for='name'>Ваше имя:</label>
            <br />
            <input type='text' id='name' name='name'>
            <br />
            <label for='feedback'>Ваш отзыв:</label>
            <br />
            <textarea id='feedback' name='feedback' rows='4' cols='50'></textarea>
            <br />
            <input type='submit' value='Отправить'>
        </form>
        <script src="scripts/forms.js"></script>
    </div>
</main>