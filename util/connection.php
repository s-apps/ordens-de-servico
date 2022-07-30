<?php

    $conexao = new \PDO(
        'mysql:host=localhost;dbname=oss;charset=utf8',
        'root',
        'senha@123'
    ); 

    return $conexao;