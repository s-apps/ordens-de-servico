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
                "servico \n" . 
            "WHERE \n" . 
                "id = " . $id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $servico = $stmt->fetch(\PDO::FETCH_OBJ);

?>

<?php include '../../layout/header.php'; ?>

    <form method="POST" id="servicos">
        <input type="hidden" name="servico_id" value="<?=$servico->id;?>" id="servico_id">
        <input type="text" name="nome" placeholder="nome" id="nome" value="<?= $servico->nome; ?>">
        <input type="text" name="referencia" placeholder="referência" id="referencia" value="<?= $servico->referencia; ?>">
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>