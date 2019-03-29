<?php
require_once 'db_connection.php';
// Подключаемся к базе данных.
?>
<header>
    <title>Пропускная система</title>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
</header>
<body>
    <center>
        <section class="column">
            <div class="container">
                <a class="button" href='./index.php'>Мониторинг</a>
                <a class="button" href='./groups.php'>Группы</a>
                <a class="button" href='./users.php'>Пользователи</a>
            </div>
        </section>
    </center>
</body>
