<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $conexao = require 'util/connection.php';
    $sql = "SELECT * FROM servico WHERE ativo = true ORDER BY nome ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $servicos = $stmt->fetchAll(\PDO::FETCH_OBJ);    
?>

<?php include 'layout/header.php'; ?>
    
    <h1>Ordem de Serviços - Serviços</h1>
    <p><a href="/"><= Ordens de Serviço</a> | <a href="/pages/servicos/adicionar.php">Adicionar Serviço</a></p>

    <table class="padrao">
        <thead>
            <tr>
                <th class="left">ID</th>
                <th class="left">NOME</th>
                <th class="left">REFERÊNCIA</th>
                <th colspan="2" class="center" style="width: 15%;">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicos as $key => $servico): ?>
            <tr id="tr_<?= $servico->id; ?>">
                <td><?= $servico->id; ?></td>
                <td><?= $servico->nome; ?></td>
                <td><?= $servico->referencia; ?></td>
                <td class="center acoes acoes-editar">
                    <a href="/pages/servicos/editar.php?id=<?= $servico->id; ?>">Editar</a>
                </td>
                <td class="center acoes acoes-cancelar">
                    <a 
                        href="javascript:void(0);" 
                        data-id="<?= $servico->id; ?>" 
                        data-tabela="servico"
                        onclick="inativar(this)">Inativar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php include 'layout/footer.php'; ?>    
