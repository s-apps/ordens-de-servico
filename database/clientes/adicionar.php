<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $nome = $_POST['nome'];

    if($nome == null) {
        $erro = 'Por favor, informe o nome';
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "INSERT INTO cliente (`nome`) VALUES (:nome)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
    }    

    echo $erro;
