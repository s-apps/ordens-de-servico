<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $nome = $_POST['nome'];
    $referencia = $_POST['referencia'];

    if($nome == null || $referencia == null) {
        $erro = 'Por favor, informe o nome e a referĂȘncia';
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "INSERT INTO peca (`nome`, `referencia`) VALUES (:nome, :referencia)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':referencia', $referencia);
        $stmt->execute();
    }    

    echo $erro;
