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
                "peca \n" . 
            "WHERE \n" . 
                "id = " . $id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $peca = $stmt->fetch(\PDO::FETCH_OBJ);

?>

<?php include '../../layout/header.php'; ?>

    <form method="POST" id="pecas">
        <input type="hidden" name="peca_id" value="<?=$peca->id;?>" id="peca_id">
        <input type="text" name="nome" placeholder="nome" id="nome" value="<?= $peca->nome; ?>">
        <input type="text" name="referencia" placeholder="referência" id="referencia" value="<?= $peca->referencia; ?>">
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>