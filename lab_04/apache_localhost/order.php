<main>
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

                // Получаем данные из формы
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $contact = htmlspecialchars(strip_tags($_POST['contact']));
                $shooting_type = htmlspecialchars(strip_tags($_POST['type']));
                $pref_date = htmlspecialchars(strip_tags($_POST['pref_date']));
                $message = htmlspecialchars(strip_tags($_POST['message']));
                $status = 'new'; // Устанавливаем статус заказа как "новый"

                // Подготовка SQL-запроса
                $stmt = $pdo->prepare("INSERT INTO orders (name, contact, type, pref_date, description, status, date) 
            VALUES (:name, :contact, :type, :pref_date, :description, :status, NOW())");

                // Привязываем параметры
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':contact', $contact);
                $stmt->bindParam(':type', $shooting_type);
                $stmt->bindParam(':pref_date', $pref_date);
                $stmt->bindParam(':description', $message);
                $stmt->bindParam(':status', $status);

                // Выполняем запрос
                if ($stmt->execute()) {
                    // echo "<p>Ваш заказ успешно отправлен!</p>";
                } else {
                    echo "<p>Ошибка при отправке заказа.</p>";
                }
            } catch (PDOException $e) {
                echo "Ошибка подключения к базе данных: " . $e->getMessage();
            }
        }
        ?>

        <form method="POST" id="messageform">
            <h2 class="center">Заказать съемку</h2>
            <ul class="form_ul">
                <li>
                    <label for="name">Ваше имя</label>
                    <input type="text" id="name" name="name" placeholder="Ваше имя" required>
                </li>
                <li>
                    <label for="contact">Контакт для связи</label>
                    <input type="text" id="contact" name="contact" placeholder="Телефон/Почта" required>
                </li>
                <li>
                    <label for="type">Тип съемки</label>
                    <select id="type" name="type" required>
                        <option value="">Тип съемки</option>
                        <option value="Портретная фотосъемка">Портретная фотосъемка</option>
                        <option value="Свадебная фотосессия">Свадебная фотосессия</option>
                        <option value="Корпоративная съемка">Корпоративная съемка</option>
                        <option value="Фотосессия на открытом воздухе">Фотосессия на открытом воздухе</option>
                        <option value="Тематическая студийная съемка">Тематическая студийная съемка</option>
                    </select>
                </li>
                <li>
                    <label for="pref_date">Желаемая дата</label>
                    <input type="date" id="pref_date" name="pref_date" placeholder="дд.мм.гггг" required>
                </li>
                <li>
                    <textarea id="message" name="message" rows="4" cols="50" placeholder="Любые дополнительные данные, которые вы хотите сообщить о себе и съемке"></textarea>
                </li>
                <li class="center">
                    <input type="submit" value="Написать">
                </li>
            </ul>
        </form>
        
        <div class="price_container">
        <h3 class="center">Цены на пакетные предложения</h3>
        <ul class="price-list">
            <li>Портретная фотосъемка (за час): <span class="price">50,000 ₩ / $40</span></li>
            <li>Свадебная фотосессия (за час): <span class="price">200,000 ₩ / $160</span></li>
            <li>Корпоративная съемка (за час): <span class="price">133,333 ₩ / $107</span></li>
            <li>Фотосессия на открытом воздухе (за час): <span class="price">125,000 ₩ / $100</span></li>
            <li>Тематическая студийная съемка (за час): <span class="price">175,000 ₩ / $140</span></li>
            <li>Пакет "День со съемкой": <span class="price">1,500,000 ₩ / $1,200</span></li>
            <li>Редактирование и ретушь (за 10 фото): <span class="price">100,000 ₩ / $80</span></li>
            <li>Печать фотографий (набор из 20): <span class="price">50,000 ₩ / $40</span></li>
        </ul>
        <p class="price-note">
            Обратите внимание:<br>
            - Цены для фотосессий указаны за один час съемки, кроме пакета "День со съемкой".<br>
            - Цены указаны без учета транспортных расходов для съемок за пределами Сеула.<br>
            - Печать фотографий возможна только на территории Кореи.<br>
            - Все услуги могут быть адаптированы под ваши потребности. Свяжитесь для уточнения деталей.
        </p>
    </div>
    </div>
    
</main>
<script src="scripts/forms.js"></script>
<script>
    // Форматируем дату в нужный формат (гггг.мм.дд)
    window.onload = function() {
        var today = new Date();
        var year = today.getFullYear();
        var month = ("0" + (today.getMonth() + 1)).slice(-2); // Добавляем ведущий 0 если месяц однозначный
        var day = ("0" + today.getDate()).slice(-2); // Добавляем ведущий 0 если день однозначный

        var formattedDate = year + "." + month + "." + day;

        // Вставляем отформатированную дату в поле формы
        document.getElementById('pref_date').value = formattedDate;
    };
</script>