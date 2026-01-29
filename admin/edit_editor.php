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
        $role = $_POST['role'];

        $query = $conn->prepare('UPDATE editors SET
        name = ?,
        role_id = ?
        WHERE id = ?');
        $query->bind_param('sii', $name, $role, $id);
        $query->execute();
    }

    $conn->close();
    header('Location: edit_editors.php');
?>