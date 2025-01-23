
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
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Получение параметра portph_el из URL
$portph_el = isset($_GET['portph_el']) ? (int) $_GET['portph_el'] : 0;

// Получение информации о конкретном элементе портфолио
$stmt = $pdo->prepare("SELECT * FROM portfolio WHERE id = :id");
$stmt->bindParam(':id', $portph_el, PDO::PARAM_INT);
$stmt->execute();
$portfolioItem = $stmt->fetch();

if ($portfolioItem) {
    // Получение фотографий, ассоциированных с этим элементом портфолио
    $stmt = $pdo->prepare("SELECT * FROM photos WHERE portfolio_id = :portfolio_id");
    $stmt->bindParam(':portfolio_id', $portph_el, PDO::PARAM_INT);
    $stmt->execute();
    $photos = $stmt->fetchAll();

    // Обработка формы лайка
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like_id'])) {
        $like_id = (int) $_POST['like_id'];
        // Обновление количества лайков
        $stmt = $pdo->prepare("UPDATE portfolio SET likes = likes + 1 WHERE id = :id");
        $stmt->bindParam(':id', $like_id, PDO::PARAM_INT);
        $stmt->execute();
        exit;
    }
} else {
    echo "Элемент портфолио не найден.";
    exit;
}
?>

<main>
    <div class="portf_view">
    <div class="portf_descrip">
        <h2 class="center">Портфолио</h2>
        <div class="portf_el_h3">
            <a class="back_portfolio" href="?page=portfolio">Назад</a>
            <h3 class="center"><?php echo htmlspecialchars($portfolioItem['title']); ?></h3>
            <div class="like-button">
                <p><?php echo htmlspecialchars($portfolioItem['likes']); ?></p>
                <form class="like-form" method="POST" id="messageform">
                    <input type="hidden" name="like_id" value="<?php echo $portfolioItem['id']; ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="black" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <p id="descript"><?php echo htmlspecialchars($portfolioItem['description']); ?></p>
        <div class="back_portfolio_center">
            <?php if (!empty($portfolioItem['link'])): ?>
                <a class="back_portfolio" href="<?php echo htmlspecialchars($portfolioItem['link']); ?>">Ссылка на публикацию</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="gallery_all">
        <?php foreach ($photos as $photo): ?>
            <img class="gallery_item" src="photobase/<?php echo htmlspecialchars($photo['folder_id']); ?>/<?php echo htmlspecialchars($photo['filename']); ?>" alt="<?php echo htmlspecialchars($portfolioItem['title']); ?>">
        <?php endforeach; ?>
    </div>
    </div>
</main>
<script src="scripts/forms.js"></script>