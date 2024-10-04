<HTML>

<head>
    <title>PHP script "Dollars"</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
    <main>
    <a href="index.php"> Назад </a>
    <p>
        <?php
    function generateSymbol($count) {
        return str_repeat('$', $count);
    }    
    function printDollar($n, $a) {
        switch ($a) {
            case 1: // В строку
                echo '<p class="generated_dollars">';
                echo generateSymbol($n).'<br/>';
                echo '</p>';
                break;
            case 2: // В столбик
                echo '<p class="generated_dollars">';
                for ($i = 0; $i < $n; $i++) {
                    echo generateSymbol(1) . "<br/>";
                }
                echo '</p>';
                break;
            case 3: // Лесенка
                echo '<p class="generated_dollars">';
                for ($i = 1; $i <= $n; $i++) {
                    echo generateSymbol($i) . "<br/>";
                }
                echo '</p>';
                break;
            case 4: // Обратная лесенка
                echo '<p class= "generated_dollars">';
                for ($i = $n; $i >= 1; $i--) {
                    echo generateSymbol($i) . "<br/>";
                }
                echo '</p>';
                break;
            case 5: // Перевернутая кучка
                echo '<p class = "generated_dollars center">';
                for ($i = 1; $i <= $n; $i++) {
                    $dollars = generateSymbol(2 * ($n - $i) + 1);
                    echo $dollars."<br/>";
                }
                echo '</p>';
                break;
            case 6: // Кучка
                echo '<p class="generated_dollars center">';
                for ($i = 1; $i <= $n; $i++) {
                    $dollars = generateSymbol(2 * $i - 1);
                    echo $dollars.'<br/>';
                }
                echo '</p>';
                break;
            default:
                echo "Что-то пошло не так, проверьте себя и повторите.\n";
            }
    }

// Вывод:

if (isset($_GET['n']) && isset($_GET['a'])) {
    $n = (int)$_GET['n'];
    $a = (int)$_GET['a'];

    // Валидация данных
    if ($n > 0 && $a > 0 && $a <= 6) {
        
    } else {
        echo "n и a должны быть положительными, a должно быть от 1 до 6.\n";
    }
} else {
    echo "Пожалуйста, укажите n и a в GET.\n";
}

printDollar($n, $a);
?>
</p>
    </main>
</body>

</HTML>