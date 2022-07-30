<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }

    $conexao = require 'util/connection.php';
    $sql = "SELECT \n" . 
                "tec.nome AS tecnico, \n" .
                "cli.nome AS cliente, \n" .
                "serv.nome AS servico, \n" .
                "oss.id \n" .
            "FROM \n" .
                "os AS oss \n" . 
            "INNER JOIN \n" . 
                "cliente AS cli ON oss.cliente = cli.id \n" .
            "INNER JOIN \n" . 
                "servico AS serv ON oss.servico = serv.id \n" . 
            "INNER JOIN \n" . 
                "tecnico AS tec ON oss.tecnico = tec.id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $ordensDeServico = $stmt->fetchAll(\PDO::FETCH_OBJ);    
?>

<?php include 'layout/header.php'; ?>
    
    <h1>Ordem de Serviços</h1>
    <p>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="auth/logout.php">SAIR</a> | <a href="servicos.php">Serviços</a> | <a href="clientes.php">Clientes</a> | <a href="pecas.php">Peças</a> | <a href="/pages/ordens/adicionar.php">Adicionar Ordem de Serviço</a></p>

    <table class="padrao">
        <thead>
            <tr>
                <th class="left">ID</th>
                <th class="left">TÉCNICO</th>
                <th class="left">CLIENTE</th>
                <th class="left">SERVIÇO</th>
                <th colspan="2" class="center" style="width: 15%;">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordensDeServico as $key => $ordemDeServico): ?>
            <tr>
                <td><?= $ordemDeServico->id; ?></td>
                <td><?= $ordemDeServico->tecnico; ?></td>
                <td><?= $ordemDeServico->cliente; ?></td>
                <td><?= $ordemDeServico->servico; ?></td>
                <td class="center acoes acoes-editar">
                    <a href="/pages/ordens/editar.php?id=<?= $ordemDeServico->id; ?>">Editar</a>
                </td>
                <td class="center acoes acoes-cancelar">
                    <a href="/pages/ordens/cancelar.php?id=<?= $ordemDeServico->id; ?>">Cancelar</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php include 'layout/footer.php'; ?>    
