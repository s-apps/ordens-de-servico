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

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Serviços</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>
        <div class="box-titulo">
            <div>
                <ul class="menu">
                    <li><a href="/">ORDENS DE SERVIÇO</a></li>
                    <li><a href="servicos.php" class="active">SERVIÇOS</a></li>
                    <li><a href="clientes.php">CLIENTES</a></li> 
                    <li><a href="pecas.php">PEÇAS</a></li>
                </ul>
            </div>
            <div><a href="/pages/servicos/adicionar.php" class="btn-adicionar">Adicionar Serviço</a></div>
        </div>

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
                            onclick="confirmaInativar(<?=$servico->id;?>)">Inativar
                        </a>
                    </td>
                </tr>
                <tr id="tr_confirmacao_<?=$servico->id;?>" class="confirmacao">
                    <td colspan="5" style="background-color: #ededed;">
                        <div>
                            Inativar serviço ID <?=$servico->id;?> ? 
                            <button 
                                class="vermelho" 
                                data-id="<?= $servico->id; ?>" 
                                data-tabela="servico" 
                                onclick="inativar(this)">Sim
                            </button> | 
                            <button 
                                onclick="cancelaInativar(<?=$servico->id;?>)">Não
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
<?php include 'layout/footer.php'; ?>    
