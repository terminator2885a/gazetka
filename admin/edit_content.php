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

    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $title_desc = $_POST['title_desc'];
        $about = $_POST['about'];
        $contact = $_POST['contact'];
        $e_mail = $_POST['e_mail'];
        $footer = $_POST['footer'];

        $query = $conn->prepare('UPDATE content SET
        title = ?,
        title_desc = ?,
        about = ?,
        contact = ?,
        e_mail = ?,
        footer = ?');
        $query->bind_param('ssssss',
        $title,
        $title_desc,
        $about,
        $contact,
        $e_mail,
        $footer);
        $query->execute();
    }

    header('Location: ../admin/');

    $conn->close();
?>