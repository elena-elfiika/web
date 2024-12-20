<?php
        session_start();

        if (!isset($_SESSION['num']) || isset($_GET['action']) && $_GET['action'] == 'new_game') {
            $_SESSION['num'] = rand(1, 100);
            $_SESSION['attempts_left'] = 7;
            header("Location: index.php?page=game");
            exit;
        }

        if(!empty($_GET["action"])&&$_GET["action"]=="new_game"){
            session_destroy();
            header("Location: index.php?page=game");
            exit;
        }
        
        $message = "";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_answer = (int)$_POST['input_number']; // Ответ пользователя
            $correct_answer = $_SESSION['num']; // Правильный ответ
            
            $_SESSION['attempts_left']--;
            if ($user_answer < $correct_answer) {
                $message = "Загаданное число больше $user_answer.";
            } elseif ($user_answer > $correct_answer) {
                $message = "Загаданное число меньше $user_answer.";
            } else {
                $message = "Поздравляем! Вы угадали число $correct_answer.";
                session_destroy(); // Завершаем игру
                }
            
            if ($_SESSION['attempts_left'] <= 0 && $user_answer != $correct_answer) {
                $message = "Игра окончена. Загаданное число было $correct_answer. Начните новую игру.";
                session_destroy(); // Завершаем игру
                }
        }
    ?>

<main>

<h1>Угадай число</h1>
<p>Вам нужно угадать число за 7 попыток. Число от 1 до 100</p>

<?php if (!empty($message)): ?>
            <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <p>Осталось попыток: <?php echo $_SESSION['attempts_left']; ?></p>
        <form method="POST">
            <label for="input_number">Ваше число: </label>
            <input type="number" name="input_number" id="input_number" placeholder="Введите число" min="1" max="100" required>
            <button type="submit">Отправить</button>
        </form>

    <!-- <?php echo '<p>'.$_SESSION['num'].'</p>';?> -->

<div class="game_buttons">
    <a href="index.php?page=game&action=new_game">Начать новую игру</a>
    <a href="index.php?page=home">На главную</a>
</div>

</main>