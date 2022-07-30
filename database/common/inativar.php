<?php
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $id = $_POST['id'];
    $tabela = $_POST['tabela'];
    $ativo = 0;

    if($id == null || $tabela == null) {
        $erro = $id;
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE " . $tabela . " SET `ativo`=:ativo WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();    
    }

    echo $erro;
