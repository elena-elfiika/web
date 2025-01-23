<?php

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

    // Определяем количество отзывов на странице
    $reviewsPerPage = 4;
    $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $offset = ($currentPageNum - 1) * $reviewsPerPage;

    // Подготовка SQL-запроса с пагинацией и фильтрацией по статусу
    $stmt = $pdo->prepare("SELECT * FROM feedback WHERE status = 'approve' ORDER BY RAND() LIMIT :offset, :reviewsPerPage");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':reviewsPerPage', $reviewsPerPage, PDO::PARAM_INT);

    // Выполнение запроса
    $stmt->execute();
    $reviews = $stmt->fetchAll();

    // Подсчитываем общее количество страниц
    $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM feedback WHERE status = 'approve'");
    $stmtTotal->execute();
    $totalReviews = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalReviews / $reviewsPerPage);

    // Обработка формы отправки отзыва
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получаем данные из формы
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $contact = htmlspecialchars(strip_tags($_POST['contact']));
        $text = htmlspecialchars(strip_tags($_POST['text']));
        $status = 'new'; // Статус отзыва — новый

        // Подготовка SQL-запроса для вставки отзыва в базу данных
        $stmt = $pdo->prepare("INSERT INTO feedback (name, contact, text, status, data) 
            VALUES (:name, :contact, :text, :status, NOW())");

        // Привязываем параметры
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status);

        // Выполняем запрос
        if ($stmt->execute()) {
            // Отзыв успешно добавлен, можно вывести сообщение об успехе
            echo "<p>Ваш отзыв успешно отправлен!</p>";
        } else {
            echo "<p>Ошибка при отправке отзыва.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?>

<main>
    <div class="feedback_display">
        <h2 class="center">Отзывы</h2>
        <div class="feedbacks_list">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="feedback">
                        <p class="feedback_name"><?= htmlspecialchars($review['name']); ?></p>
                        <p class="feedback_date"><?= date('d.m.Y', strtotime($review['data'])); ?></p>
                        <p class="feedback_text"><?= htmlspecialchars($review['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Нет отзывов для отображения.</p>
            <?php endif; ?>
        </div>

        <!-- Пагинация -->
        <ol class="carousel__navigation-list center_nav">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="carousel__navigation-item">
                    <a href="?page=feedback&page_num=<?= $i ?>" class="carousel__navigation-button"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ol>

        <div class="feedback_form" id="feedbackForm">
            <form method="post" id="messageform">
                <h2 class="center">Оставить отзыв</h2>
                <ul class="form_ul">
                    <li>
                        <label>Ваше имя:</label>
                        <input type="text" name="name" placeholder="Ваше имя" required>
                    </li>
                    <li>
                        <label>Контакт для связи:</label>
                        <input type="text" name="contact" placeholder="Телефон/Почта">
                    </li>
                    <li>
                        <textarea id="text" name="text" rows="4" cols="50" placeholder="Ваш отзыв" required></textarea>
                    </li>
                    <li class="center">
                        <input type="submit" value="Оставить">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</main>
<script src="scripts/forms.js"></script>