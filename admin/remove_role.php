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

    if(isset($_GET['role_id'])){
        $conn->query('DELETE FROM roles WHERE id='.$_GET['role_id']);
    }

    $conn->close();
    header('Location: edit_editors.php');
?>