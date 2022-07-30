<?php 

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $nome = $_POST['nome'];
    $cliente_id = $_POST['cliente_id'];

    if($nome == null) {
        $erro = 'Por favor, informe o nome';
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE cliente SET `nome`=:nome WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $cliente_id);
        $stmt->execute();    
    }
    
    echo $erro;
