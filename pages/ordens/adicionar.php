<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }
   
    $conexao = require '../../util/connection.php';

    $sql = "SELECT * FROM cliente ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(\PDO::FETCH_OBJ);

    $sql = "SELECT * FROM servico ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $servicos = $stmt->fetchAll(\PDO::FETCH_OBJ);

    $sql = "SELECT * FROM peca ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $pecas = $stmt->fetchAll(\PDO::FETCH_OBJ);
?>

<?php include '../../layout/header.php'; ?>


    <form method="POST" id="ordens">
        <fieldset>
            <legend>Serviço</legend>
            <select name="cliente_id" id="cliente_id">
                <option value="">Selecione o cliente</option>
                <?php foreach ($clientes as $key => $cliente) { ?>
                <option 
                    value="<?= $cliente->id;?>">
                    <?=$cliente->id;?> - <?=$cliente->nome;?>
                </option>
                <?php } ?>
            </select>
            <select name="servico_id" id="servico_id">
                <option value="">Selecione o serviço</option>
                <?php foreach ($servicos as $key => $servico) { ?>
                <option 
                    value="<?= $servico->id;?>">
                    <?=$servico->id;?> - <?=$servico->nome;?>
                </option>
                <?php } ?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Peças</legend>
            <div class="box-pecas">
                <?php foreach ($pecas as $key => $peca) { ?>
                    <p>
                        <input type="checkbox" name="pecas[]" value="<?=$peca->id;?>" id="check_<?=$peca->id;?>">
                        <label for="check_<?=$peca->id;?>"><?=$peca->id;?> - <?=$peca->nome;?></label>
                    </p>
                <?php } ?>
            </div>
        </fieldset>
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>
