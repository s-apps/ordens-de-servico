<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $id = $_GET['id'];
    
    $conexao = require '../../util/connection.php';
    $sql = "SELECT \n" . 
                "* \n" .
            "FROM \n" .
                "cliente \n" . 
            "WHERE \n" . 
                "id = " . $id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $cliente = $stmt->fetch(\PDO::FETCH_OBJ);

?>

<?php include '../../layout/header.php'; ?>

    <form method="POST" id="clientes">
        <input type="hidden" name="cliente_id" value="<?=$cliente->id;?>" id="cliente_id">
        <input type="text" name="nome" placeholder="nome" id="nome" value="<?= $cliente->nome; ?>">
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>