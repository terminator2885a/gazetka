<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
        exit();
    }
?>

<?php
    require_once '../db/connect.php';
    try{
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    }catch(Exception $e){
        echo $e->getMessage();
    }

    $content =  $conn->query('SELECT * FROM content')
                ->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Łukasz Grusiecki">
    <title>Gazetka Parafialna - Panel Administracyjny CMS</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cms.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
</head>
<body>
        <header>
            <div class="container">
            <h1><?php echo $content['title']; ?></h1>
            <p><?php echo $content['title_desc']; ?></p>
            <a href="logout.php" class="logout">Wyloguj się z panelu CMS</a>
            <a href="../admin/" class="logout">Powrót do strony głównej</a>
        </div>
        </header>

        <main class="container">

            <section>
                <h2>Dodawanie nowego numeru gazetki</h2>
                <form action="archive_add_.php" method="post" enctype="multipart/form-data">
                    <label for="name">Nazwa numeru:</label>
                    <input type="text" name="name" id="name" required>
                    <label for="year">Rok:</label>
                    <input type="number" name="year" id="year" min="2000" max="2100" value="2026" required>
                    <label for="month">Miesiąc:</label>
                    <select name="month" id="month">
                        <option value="1">Styczeń</option>
                        <option value="2">Luty</option>
                        <option value="3">Marzec</option>
                        <option value="4">Kwiecień</option>
                        <option value="5">Maj</option>
                        <option value="6">Czerwiec</option>
                        <option value="7">Lipiec</option>
                        <option value="8">Sierpień</option>
                        <option value="9">Wrzesień</option>
                        <option value="10">Październik</option>
                        <option value="11">Listopad</option>
                        <option value="12">Grudzień</option>
                    </select>
                    <label for="file">Plik:</label>
                    <input type="file" name="file" id="file" accept=".pdf" required>
                    <input type="submit" value="Prześlij nowy numer">
                </form>
            </section>
        </main>
    <footer>
        <p>GazetkaCMS &copy; Łukasz Grusiecki</p>
    </footer>
</body>
</html>

<?php
    $conn->close();
?>