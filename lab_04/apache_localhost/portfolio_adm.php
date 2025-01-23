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

// Обработка загрузки
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploadedFiles = $_FILES['photos'];
    $link = $_POST['link'];

    $pdo->beginTransaction();
    try {
        // Добавляем элемент в таблицу портфолио
        $stmt = $pdo->prepare("INSERT INTO portfolio (title, description, likes, link) VALUES (?, ?, 0, ?)");
        $stmt->execute([$title, $description, $link]);
        $portfolioId = $pdo->lastInsertId();

        // Создаем папку для фотографий
        $folderPath = "photobase/$portfolioId";
        if (!mkdir($folderPath, 0777, true)) {
            throw new Exception("Не удалось создать папку.");
        }

        // Сохраняем файлы и добавляем их в таблицу фотографий
foreach ($uploadedFiles['tmp_name'] as $index => $tmpName) {
    if ($uploadedFiles['error'][$index] === UPLOAD_ERR_OK) {
        // Сохраняем файл с оригинальным именем
        $filename = $uploadedFiles['name'][$index];
        $destination = "$folderPath/$filename"; // Добавляем имя файла в путь

        // Перемещаем файл в нужную папку
        if (move_uploaded_file($tmpName, $destination)) {
            // Добавляем запись в таблицу фотографий с именем файла
            $stmt = $pdo->prepare("INSERT INTO photos (portfolio_id, folder_id, filename) VALUES (?, ?, ?)");
            $stmt->execute([$portfolioId, $portfolioId, $filename]);
        } else {
            throw new Exception("Ошибка при сохранении файла: $filename");
        }
    }
}

        $pdo->commit();
        header("Location: admin.php?page=content");
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<main>
    <form class="form_ul" action="portfolio_adm.php" method="post" enctype="multipart/form-data">
        <h2 class="center">Портфолио</h2>
        <ul>
            <li>
                <label for="title">Название элемента портфолио:</label>
                <input type="text" name="title" required>
            </li>
            <li>
                <label for="link">Ссылка на публикацию:</label>
                <input type="text" name="link">
            </li>
            <li>
                <textarea name="description" placeholder="Описание" required></textarea>
            </li>
            <li>
                <label for="photos">Выберите файлы:</label>
                <input type="file" name="photos[]" multiple required>
            </li>
            <li>
                <button type="submit">Загрузить</button>
            </li>
        </ul>
    </form>
        
<?php
    if (isset($_GET['delete_id'])) {
    $deleteId = (int) $_GET['delete_id'];

    $pdo->beginTransaction();
    try {
        // Удаляем связанные фотографии из таблицы photos
        $stmt = $pdo->prepare("DELETE FROM photos WHERE portfolio_id = ?");
        $stmt->execute([$deleteId]);

        // Удаляем запись из таблицы portfolio
        $stmt = $pdo->prepare("DELETE FROM portfolio WHERE id = ?");
        $stmt->execute([$deleteId]);

        $pdo->commit();
        echo "Запись успешно удалена!";
    } catch (Exception $e) {
        
        $pdo->rollBack();
        echo "Ошибка при удалении: " . $e->getMessage();
    }
}

// Выводим таблицу с записями из таблицы portfolio
$stmt = $pdo->query("SELECT * FROM portfolio");
$portfolioItems = $stmt->fetchAll();
?>
    <div class="feedback_display">
    <h2 class="center">Управление портфолио</h2>
    <table class="admintable">
        <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Ссылка</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($portfolioItems as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                    <td><?php echo htmlspecialchars(isset($item['link']) ? htmlspecialchars($item['link']) : 'none'); ?></td>
                    <td>
                        <!-- Кнопка для удаления -->
                        <a href="?page=content&delete_id=<?php echo $item['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить этот элемент?')">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</main>
