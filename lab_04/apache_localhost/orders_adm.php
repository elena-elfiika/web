<main>
    <div class="feddbackadm">
        <h2 class="center">Модерация заказов</h2>

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
        if (isset($_GET['order_status'])) {
            $statusFilter = htmlspecialchars(strip_tags($_GET['order_status']));
        }

        // Параметры сортировки
        $order = $_GET['order'] ?? 'date';
        $direction = $_GET['direction'] ?? 'DESC';
        $limit = (int)($_GET['limit'] ?? 10);
        $offset = (int)($_GET['page_num'] ?? 0) * $limit;
        $statusFilter = $_GET['order_status'] ?? null;
        $allowedStatuses = ['new', 'in_progress', 'completed', 'canceled'];
        $statusFilter = in_array($statusFilter, $allowedStatuses) ? $statusFilter : null;

        $allowedColumns = ['name', 'date', 'status', 'type'];
        $allowedDirections = ['ASC', 'DESC'];

        $order = in_array($order, $allowedColumns) ? $order : 'date';
        $direction = in_array($direction, $allowedDirections) ? $direction : 'DESC';
        $limit = in_array($limit, [10, 20, 50, 100]) ? $limit : 10;

        // Запрос с фильтрацией по статусу, если задан фильтр
        if ($statusFilter) {
            $stmt = $pdo->prepare("SELECT id_order, name, contact, date, pref_date, type, description, status 
            FROM orders WHERE status = :statusFilter 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':statusFilter', $statusFilter, PDO::PARAM_STR);
        } else {
            $stmt = $pdo->prepare("SELECT id_order, name, contact, date, pref_date, type, description, status 
            FROM orders 
            ORDER BY $order $direction LIMIT :limit OFFSET :offset");
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Общее количество заказов
        $totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
        $totalPages = ceil($totalOrders / $limit);
        $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 0;

        // Обновление статуса заказа
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idOrder = $_POST['id_order'] ?? null;
            $newStatus = $_POST['status'] ?? null;

            if ($idOrder && $newStatus) {
                $stmt = $pdo->prepare("UPDATE orders SET status = :status WHERE id_order = :id_order");
                $stmt->bindValue(':status', $newStatus, PDO::PARAM_STR);
                $stmt->bindValue(':id_order', $idOrder, PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        ?>

        <!-- Фильтр по статусу заказов -->
        <div class="pagination">
            <form method="GET">
                <label for="order_status">Статус</label>
                <select name="order_status" id="order_status">
                    <option value="">Все</option>
                    <option value="new" <?= $statusFilter == 'new' ? 'selected' : '' ?>>Новый</option>
                    <option value="in_progress" <?= $statusFilter == 'in_progress' ? 'selected' : '' ?>>В процессе</option>
                    <option value="completed" <?= $statusFilter == 'completed' ? 'selected' : '' ?>>Завершен</option>
                    <option value="canceled" <?= $statusFilter == 'canceled' ? 'selected' : '' ?>>Отменен</option>
                </select>
                <label for="limit">Заказов на странице:</label>
                <select name="limit" id="limit">
                    <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                    <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                </select>
                <label for="order">Сортировка по:</label>
                <select name="order" id="order">
                    <option value="date" <?= $order == 'date' ? 'selected' : '' ?>>Дате</option>
                    <option value="name" <?= $order == 'name' ? 'selected' : '' ?>>Имени</option>
                    <option value="status" <?= $order == 'status' ? 'selected' : '' ?>>Статусу</option>
                </select>
                <label for="direction">Направление сортировки:</label>
                <select name="direction" id="direction">
                    <option value="ASC" <?= $direction == 'ASC' ? 'selected' : '' ?>>По возрастанию</option>
                    <option value="DESC" <?= $direction == 'DESC' ? 'selected' : '' ?>>По убыванию</option>
                </select>
                <input type="hidden" name="page_num" value="<?= $currentPageNum ?>">
                <input type="hidden" name="page" value="orders">
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
                    <a href="?page_num=<?= $i ?>&limit=<?= $limit ?>&order=<?= $order ?>&direction=<?= $direction ?>&order_status=<?= htmlspecialchars($statusFilter) ?>" class="<?= $isCurrentPage ? 'current_p' : '' ?>">
                        <?= $i + 1 ?>
                    </a>
                <?php endfor; ?>
            </p>
        </div>

        <!-- Вывод всех заказов -->
        <?php foreach ($orders as $order): ?>
            <div class="order">
                <p class="order_name"><?= htmlspecialchars($order['name']) ?></p>
                <p class="order_contact"><?= htmlspecialchars($order['contact']) ?></p>
                <p class="order_date">Дата отправки: <?= htmlspecialchars($order['date']) ?></p>
                <p class="order_pref_date">Предпочтительная дата: <?= htmlspecialchars($order['pref_date']) ?></p>
                <p class="order_type">Тип заказа: <?= htmlspecialchars($order['type']) ?></p>
                <p class="order_description">Описание: <?= htmlspecialchars($order['description']) ?></p>
                <p class="order_status">Статус: <?= htmlspecialchars($order['status']) ?></p>

                <!-- Форма для изменения статуса -->
                <form method="POST"  class="status-form">
                    <input type="hidden" name="id_order" value="<?= htmlspecialchars($order['id_order']) ?>">
                    <input type="hidden" name="page" value="orders">
                    <p>Изменить статус:</p>
                    <button type="submit" name="status" value="new" <?= $order['status'] === 'new' ? 'disabled' : '' ?>>Новый</button>
                    <button type="submit" name="status" value="in_progress" <?= $order['status'] === 'in_progress' ? 'disabled' : '' ?>>В процессе</button>
                    <button type="submit" name="status" value="completed" <?= $order['status'] === 'completed' ? 'disabled' : '' ?>>Завершен</button>
                    <button type="submit" name="status" value="canceled" <?= $order['status'] === 'canceled' ? 'disabled' : '' ?>>Отменен</button>
                </form>
            </div>
        <?php endforeach; ?>


    </div>
</main>