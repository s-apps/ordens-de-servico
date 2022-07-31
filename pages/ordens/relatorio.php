<?php

    $ordem_id = $_GET['ordem_id'];
    
    $conexao = require '../../util/connection.php';
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
            "WHERE oss.cancelada = false AND oss.id=" . $ordem_id;

    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $ordensDeServico = $stmt->fetchAll(\PDO::FETCH_OBJ);    

    $sql = "SELECT osp.id, osp.peca, pec.id AS peca_id, pec.nome FROM os_peca AS osp INNER JOIN peca AS pec ON osp.peca = pec.id WHERE osp.id=" . $ordem_id;
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $os_pecas = $stmt->fetchAll(\PDO::FETCH_OBJ);

?>

<?php include '../../layout/header.php'; ?>
    <table style="width: 100%;">
    <thead>
    <tr>
        <th colspan="4" style="text-align: center;">Ordem de Serviço : <?=$ordem_id;?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>ID</td>
        <td>TÉCNICO</td>
        <td>CLIENTE</td>
        <td>SERVIÇO</td>
    </tr>
    <?php foreach ($ordensDeServico as $key => $ordem) { ?>
    <tr>
        <td><?=$ordem->id;?></td>
        <td><?=$ordem->tecnico;?></td>
        <td><?=$ordem->cliente;?></td>
        <td><?=$ordem->servico;?></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    &nbsp&nbsp;
    <table  style="width: 100%;">
    <thead>
    <tr>
        <th colspan="2">PEÇAS</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>ID</td>
        <td>NOME</td>
    </tr>
    <?php foreach ($os_pecas as $key => $peca) { ?>
    <tr>
        <td><?=$peca->peca_id;?></td>
        <td><?=$peca->nome;?></td>
    </tr>
    <?php } ?>
    <?php if(!$os_pecas) { ?>
        <tr>
            <td colspan="2" class="center">Nenhuma peça foi adicionada</td>
    </tr>
    <?php } ?>    
    </tbody>
    </table>
<?php include '../../layout/footer.php'; ?>