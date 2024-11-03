<!DOCTYPE html>
<html>
    <head>
        <title>Лабораторные работы</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
            <h1>Лабораторные работы</h1>
            <menu>
                <?php
                    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'lab_01';
                    if (isset($_GET['page'])) {
                        switch ($page) {
                            case 'lab_01':
                                echo '<p>Лабораторная работа 1</p>
                                <a href="index.php?page=lab_02">Лабораторная работа 2</a>
                                <a href="index.php?page=lab_03">Лабораторная работа 3</a>
                                <a href="index.php?page=lab_04">Лабораторная работа 4</a>';
                                break;
                            case 'lab_02':
                                echo '<a href="index.php?page=lab_01">Лабораторная работа 1</a>
                                <p>Лабораторная работа 2</p>
                                <a href="index.php?page=lab_03">Лабораторная работа 3</a>
                                <a href="index.php?page=lab_04">Лабораторная работа 4</a>';
                                break;
                            case 'lab_03':
                                echo '<a href="index.php?page=lab_01">Лабораторная работа 1</a>
                                <a href="index.php?page=lab_02">Лабораторная работа 2</a>
                                <p>Лабораторная работа 3</p>
                                <a href="index.php?page=lab_04">Лабораторная работа 4</a>';
                                break;
                            case 'lab_04':
                                echo '<a href="index.php?page=lab_01">Лабораторная работа 1</a>
                                <a href="index.php?page=lab_02">Лабораторная работа 2</a>
                                <a href="index.php?page=lab_03">Лабораторная работа 3</a>
                                <p>Лабораторная работа 4</p>';
                                break;
                            }
                    } else{
                        echo '<a href="index.php?page=lab_01">Лабораторная работа 1</a>
                        <a href="index.php?page=lab_02">Лабораторная работа 2</a>
                        <a href="index.php?page=lab_03">Лабораторная работа 3</a>
                        <a href="index.php?page=lab_04">Лабораторная работа 4</a>';
                    }
                ?>
            </menu>
        </header>
        <main>
            <?php
            $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'lab_01';
            
            $routes = ['lab_01' => 'lab_01.php',
                       'lab_02' => 'lab_02.php',
                       'lab_03' => 'lab_03.php',
                       'lab_04' => 'lab_04.php'];
            if(array_key_exists($page, $routes) && file_exists($routes[$page])){
                echo '<iframe seamless src="'.$routes[$page].'"></iframe>';
            } else{
                echo '<p>Выберите лабораторную работу</p>';
            }
        
            ?>
        </main>
        <footer>
            <p>Лабраторные работы отправлять на адрес эл.почты: ifmogt@mail.ru, в теме письма указывать номер группы, ФИО и «Проектирование и разработка веб-сайтов, л.р. [№],
            пример: P3473, Иванов Иван Иванович, Проектирование и разработка веб-сайтов, л.р. 1</p>
        </footer>
    </body>

</html