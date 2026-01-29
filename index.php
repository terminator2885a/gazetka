<?php
    require_once 'db/connect.php';
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
    <title>Gazetka Parafialna - Parafia Świętej Rodziny</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <h1><?php echo $content['title']; ?></h1>
            <p><?php echo $content['title_desc']; ?></p>
        </div>
    </header>

    <main class="container">
        <section id="description">
            <h2>Słowo o Gazetce</h2>
            <p>
                <?php echo $content['about']; ?>
            </p>
        </section>

        <section id="editors">
            <h2>Zespół Redakcyjny</h2>
            <ul class="editors-list">
                <?php
                    $editors_query = "SELECT e.name, r.name AS 'role_name' FROM editors e JOIN roles r ON e.role_id = r.id ORDER BY r.id";

                    $editors = $conn->query($editors_query);

                    while($row = $editors->fetch_assoc()){
                        echo '<li>'.
                        '<strong>'. $row['role_name']. ' </strong>'.
                        $row['name'].
                        '</li>';
                    }

                    $editors->free_result();

                ?>
            </ul>
        </section>

        <section id="current-edition">
            <h2>Bieżący Numer</h2>
            <div class="download-box">
                <?php
                    $cnt = $conn->query('SELECT COUNT(*) AS cnt FROM archive')->fetch_assoc()['cnt'];
                    if($cnt > 0){
                        $newest_query = "SELECT * FROM archive ORDER BY year DESC,month DESC,in_month DESC LIMIT 1";
                        $newest_result = $conn->query($newest_query);
    
                        $newest = $newest_result->fetch_assoc();
                        $path = 'pdf/GazetkaParafialna_' . sprintf('%04d', $newest['year']) . '_' . sprintf('%02d', $newest['month']). '_'. sprintf('%01d', $newest['in_month']) . '.pdf';
    
                        echo '<p>Zapraszamy do lektury najnowszego numeru:</p>';
                        echo '<a href="' . $path. '" class="btn-download" download>'.$newest['name'].' (pobierz)</a>';
                        $newest_result->free_result();
                    }else{
                        echo '<p>Na razie nie wydano żadnego numeru</p>';
                    }


                    ?>
            </div>
        </section>

        <section id="archive">
            <h2>Archiwum Wydań</h2>
            <ul class="archive-list">
                <?php
                    if($cnt > 0){
                        $archive_query = "SELECT * FROM archive ORDER BY year DESC,month DESC,in_month DESC";
                        $archive_result = $conn->query($archive_query);
                        while($row = $archive_result->fetch_assoc()){
                            $path = 'pdf/GazetkaParafialna_' . sprintf('%04d', $row['year']) . '_' . sprintf('%02d', $row['month']). '_'. sprintf('%01d', $row['in_month']). '.pdf';
    
                            echo '<li>' . '<a href="' . $path. '" download>' . $row['name'] . ' - ' . sprintf('%02d', $row['month']). '.'. sprintf('%04d', $row['year']). 'r.</a></li>';
                        }                    
                    }else{
                        echo '<li>Tutaj będą się ukazywały archiwalne wydania gazetki</li>';
                    }

                ?>
            </ul>
        </section>

        <section id="contact">
            <h2>Kontakt</h2>
            <p>
                <?php echo $content['contact'] ?>
            </p>
            <p>Adres e-mail: 
                <a <?php echo 'href="mailto:'. $content['e_mail']. '"';  ?>>
                    <?php echo $content['e_mail']; ?>
            </a></p>
        </section>
    </main>

    <footer>
        <p>
            <?php echo $content['footer']; ?>
        </p>
    </footer>
</body>
</html>

<?php
    $conn->close();
?>