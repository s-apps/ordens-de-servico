<?php

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $erro = '';

    if($login == null || $senha == null) {
        $erro = 'Por favor, informe login e senha';
    }else{
        $conexao = require '../util/connection.php';
        $sql = "SELECT * FROM `tecnico` WHERE `login` = :login AND `senha` = :senha LIMIT 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $tecnico = $stmt->fetch(\PDO::FETCH_OBJ);
        
        if(!$tecnico) {
            $erro = 'Login ou Senha inválidos';
        }else{
            session_start();
            $_SESSION['tecnico_id'] = $tecnico->id;
            $_SESSION['nome_do_tecnico'] = $tecnico->nome;
        }

    }

    echo $erro;
