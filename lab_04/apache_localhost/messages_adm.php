<main>
    <div class="feddbackadm">
        <h2 class="center">Модерация сообщений</h2>

        <?php
        // Подключение к базе данных
        $dsn = "mysql:host=localhost;dbname=test;charset=utf8";
        $username = "Lena";
        $password = "Password1!";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $pdo = new PDO($dsn, $username, $password, $options);

        // Фильтрация по статусу
        if (isset($_GET['message_status'])) {
            $statusFilter = htmlspecialchars(strip_tags($_GET['message_status']));
        }

        // Параметры сортировки
        $order = $_GET['order'] ?? 'data';
        $direction = $_GET['direction'] ?? 'DESC';
        $limit = (int)($_GET['limit'] ?? 10);
        $offset = (int)($_GET['page_num'] ?? 0) * $limit;
        $statusFilter = $_GET['message_status'] ?? null;
        $allowedStatuses = ['new', 'readed'];
        $statusFilter = in_array($statusFilter, $allowedStatuses) ? $statusFilter : null;

        $allowedColumns = ['name', 'data', 'status'];
        $allowedDirections = ['ASC', 'DESC'];

        $order = in_array($order, $allowedColumns) ? $order : 'data';
        $direction = in_array($direction, $allowedDirections) ? $direction : 'DESC';
        $limit = in_array($limit, [10, 20, 50, 100]) ? $limit : 10;

        // Запрос с фильтрацией по статусу, если задан фильтр
        if ($statusFilter) {
            $stmt = $pdo->prepare("SELECT id_message, name, contact, data, text, status 
            FROM messages WHERE status = :statusFilter 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':statusFilter', $statusFilter, PDO::PARAM_STR);
        } else {
            $stmt = $pdo->prepare("SELECT id_message, name, contact, data, text, status 
            FROM messages 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Общее количество сообщений
        $totalMessages = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
        $totalPages = ceil($totalMessages / $limit);
        $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 0;

        // Действия с сообщениями
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['message_id'])) {
            $messageId = (int)$_POST['message_id'];
            $action = $_POST['action'];

            if ($action === 'readed') {
                $pdo->prepare("UPDATE messages SET status = 'readed' WHERE id_message = :id")
                    ->execute(['id' => $messageId]);
            } elseif ($action === 'delete') {
                $pdo->prepare("DELETE FROM messages WHERE id_message = :id")
                    ->execute(['id' => $messageId]);
            }

            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        ?>

        <!-- Фильтр по статусу сообщений -->
        <div class="pagination">
            <form method="GET">
                <label for="message_status">Статус</label>
                <select name="message_status" id="message_status">
                    <option value="">Все</option>
                    <option value="new" <?= $statusFilter == 'new' ? 'selected' : '' ?>>Новое</option>
                    <option value="readed" <?= $statusFilter == 'readed' ? 'selected' : '' ?>>Прочитано</option>
                </select>
                <label for="limit">Сообщений на странице:</label>
                <select name="limit" id="limit">
                    <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                    <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                </select>
                <label for="order">Сортировка по:</label>
                <select name="order" id="order">
                    <option value="data" <?= $order == 'data' ? 'selected' : '' ?>>Дате</option>
                    <option value="name" <?= $order == 'name' ? 'selected' : '' ?>>Имени</option>
                    <option value="status" <?= $order == 'status' ? 'selected' : '' ?>>Статусу</option>
                </select>
                <label for="direction">Направление сортировки:</label>
                <select name="direction" id="direction">
                    <option value="ASC" <?= $direction == 'ASC' ? 'selected' : '' ?>>По возрастанию</option>
                    <option value="DESC" <?= $direction == 'DESC' ? 'selected' : '' ?>>По убыванию</option>
                </select>
                <input type="hidden" name="page_num" value="<?= $currentPageNum ?>">
                <input type="hidden" name="page" value="messages">
                <button type="submit">Применить</button>
            </form>
        </div>

        <!-- Пагинация -->
        <div class="pagination">
            <p>
                <?php
                for ($i = 0; $i < $totalPages; $i++):
                    $isCurrentPage = ($i == $currentPageNum);
                ?>
                    <a href="?page_num=<?= $i ?>&limit=<?= $limit ?>&order=<?= $order ?>&direction=<?= $direction ?>&message_status=<?= htmlspecialchars($statusFilter) ?>" class="<?= $isCurrentPage ? 'current_p' : '' ?>">
                        <?= $i + 1 ?>
                    </a>
                <?php endfor; ?>
            </p>
        </div>

        <!-- Вывод всех сообщений -->
        <div class="messages">
            <?php foreach ($messages as $message): ?>
                <div class="message">
                    <p class="message_name"><?= htmlspecialchars($message['name']) ?></p>
                    <p class="message_contact"><?= htmlspecialchars($message['contact']) ?></p>
                    <p class="message_dat">Дата: <?= htmlspecialchars($message['data']) ?></p>
                    <p class="message_text">Текст: <?= htmlspecialchars($message['text']) ?></p>
                    <p class="message_status">Статус: <?= htmlspecialchars($message['status']) ?></p>
                    <!-- Формы для изменения статуса -->
                    <form method="POST">
                        <input type="hidden" name="message_id" value="<?= $message['id_message'] ?>">
                        <button type="submit" name="action" value="readed">Прочитано</button>
                        <button type="submit" name="action" value="delete">Удалить</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>