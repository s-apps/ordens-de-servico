<?php

    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $conexao = require 'util/connection.php';
    $sql = "SELECT \n" . 
                "* \n" .
            "FROM \n" .
                "cliente \n" . 
            "WHERE ativo = true ORDER BY nome ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(\PDO::FETCH_OBJ);    
?>

<?php include 'layout/header.php'; ?>

    <h1>Ordem de Serviços - Clientes</h1>
    <p><a href="/"><= Ordens de Serviço</a> | <a href="/pages/clientes/adicionar.php">Adicionar Cliente</a></p>

    <table class="padrao">
        <thead>
            <tr>
                <th class="left">ID</th>
                <th class="left">NOME</th>
                <th colspan="2" class="center" style="width: 15%;">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $key => $cliente): ?>
            <tr id="tr_<?= $cliente->id; ?>">
                <td><?= $cliente->id; ?></td>
                <td><?= $cliente->nome; ?></td>
                <td class="center acoes acoes-editar">
                    <a href="/pages/clientes/editar.php?id=<?= $cliente->id; ?>">Editar</a>
                </td>
                <td class="center acoes acoes-cancelar">
                    <a 
                        href="javascript:void(0);" 
                        data-id="<?= $cliente->id; ?>" 
                        onclick="inativarCliente(this)">Inativar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php include 'layout/footer.php'; ?>