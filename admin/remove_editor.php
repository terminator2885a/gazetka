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

    if(isset($_GET['editor_id'])){
        $conn->query('DELETE FROM editors WHERE id='.$_GET['editor_id']);
    }

    $conn->close();
    header('Location: edit_editors.php');
?>