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

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Serviços / editar</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>
        <form method="POST" id="servicos">
            <input type="hidden" name="servico_id" value="<?=$servico->id;?>" id="servico_id">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" placeholder="nome" id="nome" value="<?= $servico->nome; ?>">
            <label for="referencia">Referência:</label>
            <input type="text" name="referencia" placeholder="referência" id="referencia" value="<?= $servico->referencia; ?>">
            <button type="submit">Salvar</button>
            <a href="/servicos.php" class="btn-cancelar">Cancelar</a>
        </form>
        <div id="erro" class="erro"></div>
    </div>

<?php include '../../layout/footer.php'; ?>