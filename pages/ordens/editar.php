<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $id = $_GET['id'];
    
    $conexao = require '../../util/connection.php';
    $sql = "SELECT \n" . 
                "cli.id AS cliente_id, \n" .
                "cli.nome AS cliente, \n" .
                "serv.id AS servico_id, \n" .
                "serv.nome AS servico, \n" .
                "oss.id \n" .
            "FROM \n" .
                "os AS oss \n" . 
            "INNER JOIN \n" . 
                "cliente AS cli ON oss.cliente = cli.id \n" .
            "INNER JOIN \n" . 
                "servico AS serv ON oss.servico = serv.id \n" . 
            "WHERE \n" . 
                "oss.id = " . $id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $ordemDeServico = $stmt->fetch(\PDO::FETCH_OBJ);

    $sql = "SELECT * FROM cliente ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(\PDO::FETCH_OBJ);

    $sql = "SELECT * FROM servico ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $servicos = $stmt->fetchAll(\PDO::FETCH_OBJ);

?>

<?php include '../../layout/header.php'; ?>

    <form method="POST" id="ordens">
        <input type="hidden" name="ordem_id" value="<?=$ordemDeServico->id;?>" id="ordem_id">
        <select name="cliente_id" id="cliente_id">
            <?php foreach ($clientes as $key => $cliente) { ?>
            <option 
                value="<?= $cliente->id;?>" 
                <?=$ordemDeServico->cliente_id == $cliente->id ? 'selected="selected"' : '';?>>
                <?=$cliente->id;?> - <?=$cliente->nome;?>
            </option>
            <?php } ?>
        </select>
        <select name="servico_id" id="servico_id">
            <?php foreach ($servicos as $key => $servico) { ?>
            <option 
                value="<?= $servico->id;?>" 
                <?=$ordemDeServico->servico_id == $servico->id ? 'selected="selected"' : '';?>>
                <?=$servico->id;?> - <?=$servico->nome;?>
            </option>
            <?php } ?>
        </select>
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>





