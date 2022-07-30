<?php
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $cliente_id = $_POST['cliente_id'];
    $ativo = 0;

    if($cliente_id == null) {
        $erro = $cliente_id;
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE cliente SET `ativo`=:ativo WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $cliente_id);
        $stmt->execute();    
    }

    echo $erro;
