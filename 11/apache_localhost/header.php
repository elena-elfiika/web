<header>
    <a href="index.php?page=home"><img src="https://itmo.ru/file/pages/213/logo_osnovnoy_russkiy_chernyy.png" class="logo_img" alt="Логотип Университета ИТМО"></a>
    <?php include('scripts/time.php');?>
    <menu>
        <?php
        if (isset($_GET['page'])) {
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
            switch ($page) {
                case 'about': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <p>О нас</p>';
                    break;
                case 'people': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'home': 
                    echo '<p>Главная</p> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_001': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_002': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'person_003': 
                    echo '<a href="index.php?page=home">Главная</a> <p>Персоналии</p> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'campus': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'birza': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'griv': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'kronv': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
                case 'lomonosov': 
                    echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <p>Кампус</p> <a href="index.php?page=about">О нас</a>';
                    break;
            }
        } else  echo '<a href="index.php?page=home">Главная</a> <a href="index.php?page=people">Персоналии</a> <a href="index.php?page=campus">Кампус</a> <a href="index.php?page=about">О нас</a>';
        ?>
    </menu>
</header>