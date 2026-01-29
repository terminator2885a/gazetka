<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
        exit();
    }

    require_once '../db/connect.php';
    try{
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    }catch(Exception $e){
        echo $e->getMessage();
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $year  = (int)$_POST['year'];
        $month = (int)$_POST['month'];
        $month_str = sprintf('%02d', $month);

        // $cnt = $conn->query('SELECT COUNT(*) AS cnt FROM archive')->fetch_assoc()['cnt'];
        $cnt = $conn->query("SELECT COUNT(*) AS cnt FROM archive WHERE year='$year'AND month='$month'")->fetch_assoc()['cnt'];
        $cnt++;

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = '../pdf/';
            $fileName  = "GazetkaParafialna_{$year}_{$month_str}_{$cnt}.pdf";
            $targetPath = $uploadDir . $fileName;

            // (opcjonalnie) sprawdzenie typu pliku
            $fileType = mime_content_type($_FILES['file']['tmp_name']);
            if ($fileType !== 'application/pdf') {
                die('Dozwolone są tylko pliki PDF.');
            }

            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                // Lecimy z SQL

                $query = $conn->prepare('INSERT INTO archive(name, year, month, in_month) VALUES (?, ?, ?, ?)');
                $query->bind_param('siii', $name, $year, $month, $cnt);
                $query->execute();

            } else {
                echo "Błąd podczas zapisywania pliku.";
            }

        } else {
            echo "Nie przesłano pliku lub wystąpił błąd.";
        }
    }

    $conn->close();
    header('Location: ../admin/');
?>