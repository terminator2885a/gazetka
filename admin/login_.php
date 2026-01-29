<?php
    session_start();
    if(isset($_SESSION['user'])) {header('Location: ../admin/'); exit();}


    if(isset($_POST['login'])){
        require_once '../db/connect.php';
        $conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);
        mysqli_set_charset($conn, 'utf8mb4');

        $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
		$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

        if ($result = $conn->query(
			sprintf("SELECT * FROM users WHERE login='%s'",
			mysqli_real_escape_string($conn,$login)))){
                $row = $result->fetch_assoc();

                if(password_verify($password, $row['password'])){
                    $_SESSION['user'] = array(
                        'id' => $row['id'],
                        'login' => $row['login'],
                    );

                    unset($_SESSION['err']);
					$result->free_result();
                    header('Location: ../admin/');
                    exit();
                }else{
                    $_SESSION['err'] = 'Nieprawidłowy login lub hasło!';
					header('Location: login.php');
                }
            }
            $conn->close();
    }else{
        header('Location: ../admin/');
    }

    $conn->close();
?>