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
            <h2>Zespół redaktorski</h2>
            <?php
                echo '<ol>';
                $editors_query = "SELECT e.id AS id, e.name, r.name AS 'role_name' FROM editors e JOIN roles r ON e.role_id = r.id ORDER BY r.id";

                $editors = $conn->query($editors_query);

                while($row = $editors->fetch_assoc()){
                    echo '<li>'.
                    '<strong>'. $row['role_name']. ' </strong>'.
                    $row['name'].
                    ' <a href="remove_editor.php?editor_id='. $row['id']. '" class="remove">Usuń</a>'.
                    '</li>';
                }

                $editors->free_result();
                echo '</ol>';
            ?>
        </section>

        <section>
            <h2>Dodawanie nowego członka</h2>
            <form action="add_editor.php" method="post">
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="role">
                <label for="role">Rola:</label>
                <select name="role" id="role">
                    <?php
                        $roles_query = 'SELECT * FROM roles';
                        $roles_result = $conn->query($roles_query);
                        while($row = $roles_result->fetch_assoc()){
                            echo '<option value="' . $row['id']. '">'.
                            $row['name']. '</option>';
                        }
                        $roles_result->free_result();
                    ?>
                </select>
                <p><input type="submit" value="Dodaj"></p>
            </form>
        </section>

        <section>
            <h2>Edytowanie członka</h2>
            <form action="edit_editor.php" method="post">
                <label for="id">Członek zespołu:</label>
                <select name="id" id="id">
                    <?php
                        $editors_query = "SELECT e.id AS id, e.name, r.name AS 'role_name' FROM editors e JOIN roles r ON e.role_id = r.id ORDER BY r.id";

                        $editors = $conn->query($editors_query);

                        while($row = $editors->fetch_assoc()){
                            echo '<option value="'. $row['id']. '">'. $row['name']. '</option>';
                        }

                        $editors->free_result();
                    ?>
                </select>
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="role">
                <label for="role">Rola:</label>
                <select name="role" id="role">
                    <?php
                        $roles_query = 'SELECT * FROM roles';
                        $roles_result = $conn->query($roles_query);
                        while($row = $roles_result->fetch_assoc()){
                            echo '<option value="' . $row['id']. '">'.
                            $row['name']. '</option>';
                        }
                        $roles_result->free_result();
                    ?>
                </select>
                <p><input type="submit" value="Zatwierdź"></p>
            </form>
        </section>

        <section>
            <h2>Role</h2>
            <?php
                echo '<ol>';
                $roles_query = "SELECT * FROM roles";

                $roles = $conn->query($roles_query);

                while($row = $roles->fetch_assoc()){
                    echo '<li>'.
                    $row['name'].
                    ' <a href="remove_role.php?role_id='. $row['id']. '" class="remove">Usuń</a>'.
                    '</li>';
                }

                $roles->free_result();
                echo '</ol>';
            ?>
        </section>

        <section>
            <h2>Dodawanie nowej roli</h2>
            <form action="add_role.php" method="post">
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="name">
                <p><input type="submit" value="Dodaj rolę"></p>
            </form>
        </section>

        <section>
            <h2>Edytowanie roli</h2>
            <form action="edit_role.php" method="post">
                <label for="id">Nazwa roli:</label>
                <select name="id" id="id">
                    <?php
                        $roles = "SELECT * FROM roles";

                        $roles = $conn->query($roles_query);

                        while($row = $roles->fetch_assoc()){
                            echo '<option value="'. $row['id']. '">'. $row['name']. '</option>';
                        }

                        $roles->free_result();
                    ?>
                </select>
                <label for="name">Nowa nazwa:</label>
                <input type="text" name="name" id="role">
                <p><input type="submit" value="Zatwierdź"></p>
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