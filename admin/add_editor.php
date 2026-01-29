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
        $role = $_POST['role'];

        $query = $conn->prepare('INSERT INTO editors(name, role_id) VALUES (?, ?)');
        $query->bind_param('si', $name, $role);
        $query->execute();
    }

    $conn->close();
    header('Location: edit_editors.php');
?>