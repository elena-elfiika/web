<header>
<menu>
    <ul>
        <li>
            <a href="?page=home" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'home') {echo 'class="active_menu"';} ?>>Главная</a>
        </li>
        <li>
            <a href="?page=about" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'about') {echo 'class="active_menu"';} ?>>Обо мне</a>
        </li>
        <li>
            <a href="?page=portfolio" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'portfolio') {echo 'class="active_menu"';} ?>>Портфолио</a>
        </li>
        <li>
            <a href="?page=prices" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'prices') {echo 'class="active_menu"';} ?>>Цены</a>
        </li>
        <li>
            <a href="?page=order" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'order') {echo 'class="active_menu"';} ?>>Заказать съемку</a>
        </li>
        <li>
            <a href="?page=feedback" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'feedback') {echo 'class="active_menu"';} ?>>Отзывы</a>
        </li>
        <li>
            <a href="?page=contacts" <?php if (array_key_exists($page, $routes) && file_exists($routes[$page])  && $page === 'contacts') {echo 'class="active_menu"';} ?>>Контакты</a>
        </li>
    </ul>
</menu>

</header>