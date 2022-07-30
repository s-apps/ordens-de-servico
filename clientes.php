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

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Clientes</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>
        <div class="box-titulo">
            <div>
                <ul class="menu">
                    <li><a href="/">ORDENS DE SERVIÇO</a></li>
                    <li><a href="servicos.php">SERVIÇOS</a></li>
                    <li><a href="clientes.php" class="active">CLIENTES</a></li> 
                    <li><a href="pecas.php">PEÇAS</a></li>
                </ul>
            </div>
            <div><a href="/pages/clientes/adicionar.php" class="btn-adicionar">Adicionar Cliente</a></div>
        </div>

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
                            onclick="confirmaInativar(<?=$cliente->id;?>)">Inativar
                        </a>
                    </td>
                </tr>
                <tr id="tr_confirmacao_<?=$cliente->id;?>" class="confirmacao">
                    <td colspan="5" style="background-color: #ededed;">
                        <div>
                            Inativar cliente ID <?=$cliente->id;?> ? 
                            <button 
                                class="vermelho" 
                                data-id="<?= $cliente->id; ?>" 
                                data-tabela="cliente" 
                                onclick="inativar(this)">Sim
                            </button> | 
                            <button 
                                onclick="cancelaInativar(<?=$cliente->id;?>)">Não
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>        
    <div>

<?php include 'layout/footer.php'; ?>