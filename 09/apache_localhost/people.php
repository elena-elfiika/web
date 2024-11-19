<?php

// Карточки
function display_person_cards($json_file) {
    if (file_exists($json_file)) {
        $person_data = json_decode(file_get_contents($json_file), true);
        foreach ($person_data as $person) {
            $name = $person['name'];
            $title = $person['title'];
            $role = $person['role'];
            $img = $person['img'];
            $like_id = $person['like_id'];
            $form_id = $person['form_id'];
            $comments_file = $person['comments_file'];
            $personal_link = $person['personal_link'];

            // Подсчет лайков
            $like_count = get_like_count($like_id); // Функция, которая возвращает количество лайков

            // Генерация HTML-карточки
            echo '<div class="person">';
            echo '  <a href="index.php?page='.$personal_link.'"><h2>' . htmlspecialchars($name) . '</h2></a>';
            echo '  <a href="index.php?page='.$personal_link.'"><img src="' . htmlspecialchars($img) . '" class="img_person"></a>';
            echo '  <p class="about_person">' . htmlspecialchars($title) . '<br />' . htmlspecialchars($role) . '</p>';
            echo '  <div class="a_person_like_more">';
            echo '      <div class="like-button">';
            echo '          <form class="like-form" method="POST" action="scripts/like.php" id="like-form-' . htmlspecialchars($like_id) . '">';
            echo '              <input type="hidden" name="like_id" value="' . htmlspecialchars($like_id) . '">';
            echo '              <button type="submit">';
            echo '                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" viewBox="0 0 24 24">';
            echo '                      <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />';
            echo '                  </svg>';
            echo '              </button>';
            echo '          </form>';
            echo '          <p>' . $like_count . '</p>';
            echo '      </div>';
            echo '      <a href="#">Подробнее</a>';
            echo '  </div>';

            // Вывод комментариев
            display_comments($comments_file);

            // Форма для комментариев
            display_comment_form($form_id);

            echo '</div>';
        }
    } else {
        echo "Файл с данными не найден.";
    }
}

// Функция для подсчета лайков
function get_like_count($like_id) {
    $likes_data_file = 'data/likes.json'; // Файл с данными о лайках
    if (file_exists($likes_data_file)) {
        $likes_data = json_decode(file_get_contents($likes_data_file), true);
        return isset($likes_data[$like_id]) ? $likes_data[$like_id] : 0;
    }
    return 0;
}

// Функция для вывода комментариев
function display_comments($comments_file) {
    if (file_exists($comments_file)) {
        $current_data = json_decode(file_get_contents($comments_file), true);
        echo '<h3>Комментарии</h3>';
        echo '<div class="comments-container">';
        foreach ($current_data as $entry) {
            echo '<p class="feedback_name">'.htmlspecialchars($entry['name']).'</p>'.'   '.'<p class="feedback_date">'.$entry['timestamp'] .'</p>'.'<p class="feedback_text">'.htmlspecialchars($entry['comment']) .'</p>';
            }
        } else {
            echo '<h3>Комментарии</h3>';
            echo '<div class="comments-container">';
            echo '<p>Комментариев пока никто не оставил.</p>';
        }
        echo '</div>';
    }

// Форма комментариев
function display_comment_form($form_id) {
    echo '<h3>Оставить комментарий</h3>';
    echo '<form action="scripts/person_feedback.php" method="post">';
    echo '<input type="hidden" name="form_id" value="' . $form_id . '">';
    echo '<label for="name">Ваше имя:</label>';
    echo '<input type="text" id="name" name="name" required><br><br>';
    echo '<label for="comment">Ваш комментарий:</label>';
    echo '<textarea id="comment" name="comment" rows="3" required></textarea><br><br>';
    echo '<input type="submit" value="Отправить">';
    echo '</form>';
}
?>

<main>
    <div>
        <h1>Персоналии</h1>
    </div>
<?php display_person_cards('data/persons.json');?>
</main>