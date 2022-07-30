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

    $sql = "SELECT * FROM peca WHERE ativo = true ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $pecas = $stmt->fetchAll(\PDO::FETCH_OBJ);

    $sql = "SELECT id, peca AS peca_id FROM os_peca WHERE id=" . $id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $os_pecas = $stmt->fetchAll(\PDO::FETCH_OBJ);
?>

<?php include '../../layout/header.php'; ?>

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Ordens de Serviço / editar</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>

        <form method="POST" id="ordens">
            <input type="hidden" name="ordem_id" value="<?=$ordemDeServico->id;?>" id="ordem_id">
            <fieldset>
                <legend>Serviço</legend>
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id">
                    <option value="">Selecione o cliente</option>
                    <?php foreach ($clientes as $key => $cliente) { ?>
                    <option  
                        <?= $ordemDeServico->cliente_id == $cliente->id ? 'selected="selected"' : ''; ?>
                        value="<?= $cliente->id;?>">
                        <?=$cliente->id;?> - <?=$cliente->nome;?>
                    </option>
                    <?php } ?>
                </select>
                <label for="servico_id">Serviço:</label>
                <select name="servico_id" id="servico_id">
                    <option value="">Selecione o serviço</option>
                    <?php foreach ($servicos as $key => $servico) { ?>
                    <option 
                        <?= $ordemDeServico->servico_id == $servico->id ? 'selected="selected"' : ''; ?>
                        value="<?= $servico->id;?>">
                        <?=$servico->id;?> - <?=$servico->nome;?>
                    </option>
                    <?php } ?>
                </select>
            </fieldset>
            &nbsp;&nbsp;
            <fieldset>
                <legend>Peças</legend>
                <div class="box-pecas">
                    <?php foreach ($pecas as $key => $peca) { ?>
                        <p>
                            <input
                                <?php
                                    foreach ($os_pecas as $key => $os_peca) {
                                        if($peca->id == $os_peca->peca_id) {
                                            echo 'checked="checked"';
                                        }
                                    }
                                ?>
                                type="checkbox" 
                                name="pecas[]" 
                                value="<?=$peca->id;?>" 
                                id="check_<?=$peca->id;?>">
                            <label for="check_<?=$peca->id;?>"><?=$peca->id;?> - <?=$peca->nome;?></label>
                        </p>
                        
                    <?php } ?>
                </div>
            </fieldset>
            <button type="submit">Salvar</button>
            <a href="/" class="btn-cancelar">Cancelar</a>
        </form>
        <div id="erro" class="erro"></div>
    </div>

<?php include '../../layout/footer.php'; ?>





