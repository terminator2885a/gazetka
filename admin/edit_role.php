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
        $id = $_POST['id'];
        $name = $_POST['name'];

        $query = $conn->prepare('UPDATE roles SET
        name = ?
        WHERE id = ?');
        $query->bind_param('si', $name, $id);
        $query->execute();
    }

    $conn->close();
    header('Location: edit_editors.php');
?>