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
    $pecas = json_decode($_POST['pecas']);

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
        $ordem_id = $conexao->lastInsertId();

        foreach ($pecas as $key => $peca) {
            $sql = "INSERT INTO os_peca (`id`, `peca`) VALUES (:id, :peca)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $ordem_id);
            $stmt->bindParam(':peca', $peca);
            $stmt->execute();                
        }
    }

    echo $erro;