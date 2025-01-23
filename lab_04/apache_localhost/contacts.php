<main>
    <div class="contacts_main">
        <h2 class="center">Как меня найти</h2>
        <ul>
            <li>bechance — <a href="https://www.behance.net/" target="_blank">Джон Доу</a></li>
            <li>flicr — <a href="https://www.flickr.com/" target="_blank">Джон Доу</a></li>
            <li>Организация лекций и мастер-классов: <a href="mailto:education@jdoy.com?subject=Образовательное сотрудничество">education@jdoy.com</a></li>
            <li>Для рекламы и коммерческого сотрудничества, e-mail: <a href="mailto:marketing@jdoy.com?subject=Коммерческое сотрудничество">marketing@jdoy.com</a></li>
            <li>Студия в Сеуле расположена по адресу 03789 75, Синчон-ро, Содемун-гу, Сеул (서울 서대문구 신촌로 75 (창천동). <br /> Она открыта для свободного посещения с четверга по субботу с 10 до 18 часов. Телефон студии: <a href="tel:02-323-9284">02-323-9284</a>.</li>
            <li>Также мои альбомы и книги можно найти на <a href="https://www.amazon.com/">Amazon</a>. Для заказа отдельных фотографий в печати пишите на почту рекламы и сотрудничества.</li>
        </ul>
    </div>
    <div class="main_form">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Подключение к базе данных
            $dsn = "mysql:host=localhost;dbname=test;charset=utf8";
            $username = "Lena";
            $password = "Password1!";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                $pdo = new PDO($dsn, $username, $password, $options);

                // Получение данных из формы
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $contact = htmlspecialchars(strip_tags($_POST['contact']));
                $message = htmlspecialchars(strip_tags($_POST['message']));
                $status = 'new'; // Устанавливаем статус сообщения как "новое"

                // Подготовка SQL-запроса
                $stmt = $pdo->prepare("INSERT INTO messages (name, contact, text, status, data) 
            VALUES (:name, :contact, :message, :status, NOW())");

                // Привязка параметров и выполнение запроса
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':status', $status);

                // Выполнение запроса
                if ($stmt->execute()) {
                } else {
                    echo "<p>Ошибка при отправке сообщения.</p>";
                }
            } catch (PDOException $e) {
                echo "Ошибка подключения к базе данных: " . $e->getMessage();
            }
        }
        ?>

        <form method="POST" id="messageform">
            <h2>Связаться</h2>
            <ul class="form_ul">
                <li>
                    <label for="main_name">Ваше имя</label>
                    <input type="text" id="main_name" name="name" placeholder="Как к вам обращаться" required>
                </li>
                <li>
                    <label for="main_contact">Контакт для связи</label>
                    <input type="text" id="main_contact" name="contact" placeholder="Телефон/Почта" required>
                </li>
                <li>
                    <textarea id="main_message" name="message" rows="4" cols="50" placeholder="Текст вашего сообщения." required></textarea>
                </li>
                <li class="center">
                    <input type="submit" value="Написать">
                </li>
            </ul>
        </form>
        <script src="scripts/forms.js"></script>
    </div>
</main>