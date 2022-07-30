<?php 

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $erro = '';
    $nome = $_POST['nome'];
    $referencia = $_POST['referencia'];
    $peca_id = $_POST['peca_id'];

    if($nome == null || $referencia == null) {
        $erro = 'Por favor, informe o nome e a referência';
    } else {
        $conexao = require '../../util/connection.php';
        $sql = "UPDATE peca SET `nome`=:nome, `referencia`=:referencia WHERE `id`=:id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':referencia', $referencia);
        $stmt->bindParam(':id', $peca_id);
        $stmt->execute();    
    }
    
    echo $erro;
