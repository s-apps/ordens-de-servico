<?php
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $ordem_id = $_POST['ordem_id'];
    $cancelada = 1;

    if($ordem_id == null) {
        $erro = $ordem_id;
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE os SET `cancelada`=:cancelada WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':cancelada', $cancelada);
        $stmt->bindParam(':id', $ordem_id);
        $stmt->execute();    
    }

    echo $erro;
