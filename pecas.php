<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $conexao = require 'util/connection.php';
    $sql = "SELECT * FROM peca WHERE ativo = true ORDER BY nome ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $pecas = $stmt->fetchAll(\PDO::FETCH_OBJ);    
?>

<?php include 'layout/header.php'; ?>
    
    <h1>Ordem de Serviços - Peças</h1>
    <p><a href="/"><= Ordens de Serviço</a> | <a href="/pages/pecas/adicionar.php">Adicionar Peça</a></p>

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
            <?php foreach ($pecas as $key => $peca): ?>
            <tr id="tr_<?=$peca->id;?>">
                <td><?= $peca->id; ?></td>
                <td><?= $peca->nome; ?></td>
                <td><?= $peca->referencia; ?></td>
                <td class="center acoes acoes-editar">
                    <a href="/pages/pecas/editar.php?id=<?= $peca->id; ?>">Editar</a>
                </td>
                <td class="center acoes acoes-cancelar">
                    <a 
                        href="javascript:void(0);" 
                        data-id="<?= $peca->id; ?>"
                        data-tabela="peca" 
                        onclick="inativar(this)">Inativar
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php include 'layout/footer.php'; ?>    
