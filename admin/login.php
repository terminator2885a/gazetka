<?php
    session_start();
    require_once '../db/connect.php';
    try{
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Łukasz Grusiecki">
    <title>Gazetka Parafialna - Zaloguj się</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <h1>Gazetka Parafialna CMS</h1>
            <p>Zaloguj się</p>
        </div>
    </header>

    <main class="container">
        <form action="login_.php" method="post">
            <label for="login">Login:</label>
            <input type="text" name="login" id="login">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Zaloguj się">
            <?php if(isset($_SESSION['err'])) {echo '<p class="err">'. $_SESSION['err']. '</p>'; unset($_SESSION['err']);}?>
        </form>
    </main>
    <footer>
        <p>GazetkaCMS &copy; Łukasz Grusiecki</p>
    </footer>
</body>
</html>

<?php
    $conn->close();
?>