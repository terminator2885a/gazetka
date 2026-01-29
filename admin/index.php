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
    <form action="edit_content.php" method="post">
        <header>
            <div class="container">
                <?php
                    echo '<input type="text" name="title" value="'.$content['title'].'">';
                    echo '<input type="text" name="title_desc" value="'.$content['title_desc'].'">';
                ?>
                <a href="logout.php" class="logout">Wyloguj się z panelu CMS</a>
            </div>
        </header>

        <main class="container">
            <section id="description">
                <h2>Słowo o Gazetce</h2>
                <textarea name="about"><?php echo $content['about']; ?></textarea>
            </section>

            <section id="editors">
                <h2>Zespół Redakcyjny</h2>
                <p><a href="edit_editors.php">Przejdź do edycji zespołu redakcyjnego</a></p>
            </section>

            <section id="archive">
                <h2>Archiwum Wydań</h2>
                <p><a href="archive_add.php">Dodaj nowy numer gazetki</a></p>
            </section>

            <section id="contact">
                <h2>Kontakt</h2>
                <?php
                    echo '<input type="text" name="contact" value="'.$content['contact'].'">';
                ?>
                <p>Adres e-mail: 
                    <?php echo '<input type="text" name="e_mail" value="'.$content['e_mail'].'">'; ?>    
                </p>
            </section>
        </main>

        <footer>
            <label for="footer" style="font-size: 24px;">Edytuj stopkę</label>
            <p>
            <?php
                echo '<input type="text" name="footer" id="footer" value="'.$content['footer'].'">';
            ?>
            </p>
        </footer>
        <div class="form-btns">
            <input type="reset" value="Resetuj">
            <input type="submit" value="Zatwierdź zmiany">
        </div>
    </form>
    <footer>
        <p>GazetkaCMS &copy; Łukasz Grusiecki</p>
    </footer>
</body>
</html>

<?php
    $conn->close();
?>