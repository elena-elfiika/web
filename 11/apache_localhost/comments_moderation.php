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

    if (isset($_GET['comment_status'])) {
        $statusFilter = htmlspecialchars(strip_tags($_GET['comment_status']));
    }

    // Параметры сортировки
    $order = $_GET['order'] ?? 'date';
    $direction = $_GET['direction'] ?? 'DESC';
    $limit = (int)($_GET['limit'] ?? 10);
    $offset = (int)($_GET['page_num'] ?? 0) * $limit;
    $statusFilter = $_GET['comment_status'] ?? null;
    $allowedStatuses = ['new', 'approve', 'hidden'];
    $statusFilter = in_array($statusFilter, $allowedStatuses) ? $statusFilter : null;

    $allowedColumns = ['user', 'date', 'text'];
    $allowedDirections = ['ASC', 'DESC'];

    $order = in_array($order, $allowedColumns) ? $order : 'date';
    $direction = in_array($direction, $allowedDirections) ? $direction : 'DESC';
    $limit = in_array($limit, [10, 20, 50, 100]) ? $limit : 10;

    if ($statusFilter) {
        $stmt = $pdo->prepare("SELECT id_feedback_university, user, date, text, status 
            FROM feedback_university WHERE status = :statusFilter 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':statusFilter', $statusFilter, PDO::PARAM_STR);
    } else {
        $stmt = $pdo->prepare("SELECT id_feedback_university, user, date, text, status 
            FROM feedback_university 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
    }
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

    <div class="pagination">            
        <form method="GET">
            <label for="comment_status">Статус</label>
            <select name="comment_status" id="comment_status">
                <option value="new" <?= $statusFilter == 'new' ? 'selected' : '' ?>>Новые</option>
                <option value="approve" <?= $statusFilter == 'approve' ? 'selected' : '' ?>>Одобренные</option>
                <option value="hidden" <?= $statusFilter == 'hidden' ? 'selected' : '' ?>>Скрытые</option>
            </select>
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
                <input type="hidden" name="page_num" value="<?= $currentPageNum ?>">
            <input type="hidden" name="page" value="comments">
            <button type="submit">Применить</button>
        </form>
        <p>
            <?php
            if ($statusFilter) {
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM feedback_university WHERE status = :statusFilter");
                $stmt->execute(['statusFilter' => $statusFilter]);
                $totalFeedbacks = $stmt->fetchColumn();
            } else {
                $totalFeedbacks = $pdo->query("SELECT COUNT(*) FROM feedback_university")->fetchColumn();
            }
            $totalPages = ceil($totalFeedbacks / $limit);
            $currentPage = $_GET['page'] ?? 'about';
            $currentPageNum = (int)($_GET['page_num'] ?? 0);
            
            for ($i = 0; $i < $totalPages; $i++):
                $isCurrentPage = ($i == $currentPageNum);
                ?>
            <a href="?page=<?= $currentPage ?>&page_num=<?= $i ?>&limit=<?= $limit ?>&order=<?= $order ?>&direction=<?= $direction ?>&comment_status=<?= htmlspecialchars($statusFilter) ?>" class="<?= $isCurrentPage ? 'current_p' : '' ?>">
                <?= $i + 1 ?>
            </a>
            <?php endfor; ?>
        </p>
    </div>
    

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