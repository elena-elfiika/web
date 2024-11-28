<?php
    $pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=test', 'site_connection', 'Class_data1.', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
    ]);

    
    // Отправка формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['feedback'])) {
    $name = htmlspecialchars(strip_tags($_POST['name'] ?? ''));
    $feedback = htmlspecialchars(strip_tags($_POST['feedback'] ?? ''));
    $stmt = $pdo->prepare("INSERT INTO feedback_university (user, date, text) VALUES (:name, NOW(), :feedback)");
    $stmt->execute(['name' => $name, 'feedback' => $feedback]);

    // Перенаправление на ту же страницу после обработки данных
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
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

    $stmt = $pdo->prepare("SELECT id_feedback_university, user, date, text, status FROM feedback_university ORDER BY $order $direction LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPages = ceil($pdo->query("SELECT COUNT(*) FROM feedback_university")->fetchColumn() / $limit);
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'about';
    $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 0;

    // Действия с комментариями
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['feedback_id'])) {
        $feedbackId = (int)$_POST['feedback_id'];
        $action = $_POST['action'];

    if ($action === 'approve') {
        $pdo->prepare("UPDATE feedback_university SET status = 'approve' WHERE id_feedback_university = :id")
            ->execute(['id' => $feedbackId]);
        } elseif ($action === 'hide') {
        $pdo->prepare("UPDATE feedback_university SET status = 'hidden' WHERE id_feedback_university = :id")
            ->execute(['id' => $feedbackId]);
        } elseif ($action === 'delete') {
        $pdo->prepare("DELETE FROM feedback_university WHERE id_feedback_university = :id")
            ->execute(['id' => $feedbackId]);
        } elseif ($action === 'edit' && isset($_POST['new_text'])) {
        $newText = htmlspecialchars(strip_tags($_POST['new_text']));
        $pdo->prepare("UPDATE feedback_university SET text = :text WHERE id_feedback_university = :id")
            ->execute(['id' => $feedbackId, 'text' => $newText]);
        }

        // Перенаправление на ту же страницу после обработки данных
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
?>


<?php foreach ($feedbacks as $feedback): ?>
<div class="feedback">
    <p class="feedback_name"><?= htmlspecialchars($feedback['user']) ?></p>
    <p class="feedback_date"><?= htmlspecialchars($feedback['date']) ?></p>
    <p class="feedback_text"><?= htmlspecialchars($feedback['text']) ?></p>
    <p class="feedback_status">Статус: <?= htmlspecialchars($feedback['status']) ?></p>

    <form method="POST">
        <input type="hidden" name="feedback_id" value="<?= $feedback['id_feedback_university'] ?>">
        <button type="submit" name="action" value="approve">Одобрить</button>
        <button type="submit" name="action" value="hide">Скрыть</button>
        <button type="submit" name="action" value="delete">Удалить</button>
    </form>

    <form method="POST">
        <input type="hidden" name="feedback_id" value="<?= $feedback['id_feedback_university'] ?>">
        <textarea name="new_text"><?= htmlspecialchars($feedback['text']) ?></textarea>
        <button type="submit" name="action" value="edit">Изменить комментарий</button>
    </form>
</div>
<?php endforeach; ?>