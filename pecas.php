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

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Peças</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>
        <div class="box-titulo">
            <div>
                <ul class="menu">
                    <li><a href="/">ORDENS DE SERVIÇO</a></li>
                    <li><a href="servicos.php">SERVIÇOS</a></li>
                    <li><a href="clientes.php">CLIENTES</a></li> 
                    <li><a href="pecas.php" class="active">PEÇAS</a></li>
                </ul>
            </div>
            <div><a href="/pages/pecas/adicionar.php" class="btn-adicionar">Adicionar Peça</a></div>
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
                            onclick="confirmaInativar(<?=$peca->id;?>)">Inativar
                        </a>
                    </td>
                </tr>
                <tr id="tr_confirmacao_<?=$peca->id;?>" class="confirmacao">
                    <td colspan="5" style="background-color: #ededed;">
                        <div>
                            Inativar peça ID <?=$peca->id;?> ? 
                            <button 
                                class="vermelho" 
                                data-id="<?= $peca->id; ?>" 
                                data-tabela="peca" 
                                onclick="inativar(this)">Sim
                            </button> | 
                            <button 
                                onclick="cancelaInativar(<?=$peca->id;?>)">Não
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    
<?php include 'layout/footer.php'; ?>    
