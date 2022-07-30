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
                "tecnico AS tec ON oss.tecnico = tec.id \n" . 
            "WHERE oss.cancelada = false";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $ordensDeServico = $stmt->fetchAll(\PDO::FETCH_OBJ);    
?>

<?php include 'layout/header.php'; ?>

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Ordens de Serviço</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>
        <div class="box-titulo">
            <div>
                <ul class="menu">
                    <li><a href="/" class="active">ORDENS DE SERVIÇO</a></li>
                    <li><a href="servicos.php">SERVIÇOS</a></li>
                    <li><a href="clientes.php">CLIENTES</a></li> 
                    <li><a href="pecas.php">PEÇAS</a></li>
                </ul>
            </div>
            <div><a href="/pages/ordens/adicionar.php" class="btn-adicionar">Adicionar Ordem de Serviço</a></div>
        </div>
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
                <tr id="tr_<?= $ordemDeServico->id; ?>">
                    <td><?= $ordemDeServico->id; ?></td>
                    <td><?= $ordemDeServico->tecnico; ?></td>
                    <td><?= $ordemDeServico->cliente; ?></td>
                    <td><?= $ordemDeServico->servico; ?></td>
                    <td class="center acoes acoes-editar">
                        <a href="/pages/ordens/editar.php?id=<?= $ordemDeServico->id; ?>">Editar</a>
                    </td>
                    <td class="center acoes acoes-cancelar">
                        <a 
                            href="javascript:void(0);" 
                            onclick="confirmaInativar(<?=$ordemDeServico->id;?>)">Cancelar
                        </a>
                    </td>
                </tr>
                <tr id="tr_confirmacao_<?=$ordemDeServico->id;?>" class="confirmacao">
                    <td colspan="6" style="background-color: #ededed;">
                        <div>
                            Cancelar ordem de serviço ID <?=$ordemDeServico->id;?> ? 
                            <button 
                                class="vermelho" 
                                data-id="<?= $ordemDeServico->id; ?>" 
                                onclick="cancelarOrdem(this)">Sim
                            </button> | 
                            <button 
                                onclick="cancelaInativar(<?=$ordemDeServico->id;?>)">Não
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
<?php include 'layout/footer.php'; ?>    
