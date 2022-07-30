<?php
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $servico_id = $_POST['servico_id'];
    $ativo = 0;

    if($servico_id == null) {
        $erro = $servico_id;
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE servico SET `ativo`=:ativo WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $servico_id);
        $stmt->execute();    
    }

    echo $erro;
