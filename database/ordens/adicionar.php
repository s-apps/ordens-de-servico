<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';

    $cliente = $_POST['cliente'];
    $servico = $_POST['servico'];
    $tecnicoID = $_SESSION['tecnico_id'];

    if($cliente == null || $servico == null) {
        $erro = 'Por favor, informe o cliente e o serviço';
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "INSERT INTO os (`cliente`, `tecnico`, `servico`) VALUES (:cliente, :tecnico, :servico)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':tecnico', $tecnicoID);
        $stmt->bindParam(':servico', $servico);
        $stmt->execute();
    }

    echo $erro;