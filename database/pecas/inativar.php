<?php
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $peca_id = $_POST['peca_id'];
    $ativo = 0;

    if($peca_id == null) {
        $erro = $peca_id;
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE peca SET `ativo`=:ativo WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $peca_id);
        $stmt->execute();    
    }

    echo $erro;
