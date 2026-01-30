<?php
    header('Content-type: application/json');
    require_once '../db/connect.php';
    try{
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    }catch(Exception $e){
        $exc = array(
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        );
        echo json_encode($exc);
    }
