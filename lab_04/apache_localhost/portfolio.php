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

    // Определяем количество элементов на странице
    $itemsPerPage = 12;
    $currentPageNum = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $offset = ($currentPageNum - 1) * $itemsPerPage;

    // Получаем 12 элементов из таблицы portfolio
    $stmt = $pdo->prepare("SELECT * FROM portfolio LIMIT :offset, :itemsPerPage");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $portfolioItems = $stmt->fetchAll();

    // Подсчитываем общее количество записей в таблице portfolio для пагинации
    $stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM portfolio");
    $stmtTotal->execute();
    $totalItems = $stmtTotal->fetchColumn();
    $totalPages = ceil($totalItems / $itemsPerPage);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?>

<main>
    <div class="portf_view">
        <div class="portf_descrip">
            <h2 class="center">Мои работы</h2>
            <p>Добро пожаловать в мой творческий мир, где каждая фотография — это рассказ о жизни, эмоциях и красоте в самых неожиданных её проявлениях. Здесь собраны мгновения, которые я запечатлел на улицах Японии и Южной Кореи, от оживленных проспектов Токио до уединенных тропинок среди цветущих сакур.</p>
            <p>В этом портфолио вы найдете как динамичные стрит-фотографии, передающие ритм мегаполиса, так и проникновенные портреты, в которых живут искренность и характер. Моя цель — показать гармонию контрастов: современного и традиционного, светлого и теневого, городского и природного.</p>
        </div>
        <!-- <div class="portf_pagin">
            <a>Все</a>
            <a>Городской пейзаж</a>
            <a>Портреты</a>
            <a>События</a>
    </div> -->
        <div class="portf_all">
            <?php foreach ($portfolioItems as $item): ?>
                <?php
                // Получаем первую фотографию для каждого элемента портфолио
                $stmtImage = $pdo->prepare("SELECT * FROM photos WHERE portfolio_id = :portfolio_id LIMIT 1");
                $stmtImage->bindParam(':portfolio_id', $item['id'], PDO::PARAM_INT);
                $stmtImage->execute();
                $image = $stmtImage->fetch();
                ?>
                <a href="?page=portfolio_element&portph_el=<?= $item['id'] ?>">
                    <div class="portf_item">
                        <img class="portf_gallery" src="photobase/<?= $image['folder_id'] ?>/<?= $image['filename'] ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="portf_caption"><?= htmlspecialchars($item['title']) ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Пагинация -->
        <ol class="carousel__navigation-list center_nav">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="carousel__navigation-item">
                    <a href="?page=portfolio&page_num=<?= $i ?>" class="carousel__navigation-button"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ol>
    </div>
</main>