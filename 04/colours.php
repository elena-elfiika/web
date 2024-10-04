<HTML>
    <head>
        <title>PHP script "Colours"</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style/main.css">
    </head>
    <body>
        <main>
        <a href="index.php"> Назад </a>
        <?php
        // Input
        $startColor = $_GET['start'];
        $endColor = $_GET['end'];
        $step = $_GET['step'];
        $columns = (int)$_GET['columns'];

        //Проверка

        if(!$startColor || !$endColor || !$step || !$columns){
            echo 'Отсутствуют значения, проверьте свой запрос и повторите его.';
        }

        function proverka($startColor, $endColor, $step, $columns) {
            if (!preg_match('/^[0-9A-Fa-f]{6}$/', $startColor) || !preg_match('/^[0-9A-Fa-f]{6}$/', $endColor)) {
                return "Некорректный начальный или конечный цвет. Проверьте значение и повторите запрос.";
            }
        
            if (!preg_match('/^[0-9A-Fa-f]{1,6}$/', $step)) {
                return "Ошибочный шаг. Шаг должен быть шестнадцатеричным. Проверьте значение и повторите запрос.";
            }
        
            if (!is_numeric($columns) || $columns <= 0) {
                return "Количество колонок должно быть положительным числом.";
            }
        }

        proverka($startColor, $endColor, $step, $columns);
        
        //в HEX
        function tohexcolor ($currcolour){
            $a = dechex($currcolour);
            return str_pad($a, 6, '0', STR_PAD_LEFT);
        }
    
        
        $startdec = hexdec($startColor);
        $enddec = hexdec($endColor);
        $stepdec = hexdec($step);
        
        // Определяем количество шагов
        $totalSteps = ($enddec-$startdec)/$stepdec;
        // echo $totalSteps/$columns;   
        
        // Начинаем вывод HTML таблицы
        
        $currstep = 0;
        $currstep_a = 0;
        $t = 0;

        echo '<table style="generated_colour">';
        for ($i = 0; $i < $totalSteps/$columns; $i++) {
            echo '<tr>';
            $currstep_a = $t*$i;
            for($t = 0; $t < $columns; $t++){
                // echo '<td>'.($currstep).'</td>';
                $currstep = $currstep_a + $t;
                if($currstep < $totalSteps){
                    $currcolour = tohexcolor($startdec + $stepdec * $currstep);
                    $textColor = ('FFFFFF');                    
                    echo "<td style='background-color:#$currcolour; color:$textColor;'>#$currcolour</td>"; 
                }
                
            }
            
            echo '</tr>';
        }
        echo '</table>';
?>
        </main>
    </body>
</html>