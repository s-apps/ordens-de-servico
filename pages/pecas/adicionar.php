<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }
?>

<?php include '../../layout/header.php'; ?>

    <div class="container">
        <div class="box-titulo borda-bottom">
            <div><h1>Peças / adicionar</h1></div>
            <div>Olá, <?= $_SESSION['nome_do_tecnico']; ?> | <a href="/auth/logout.php">SAIR</a></div>
        </div>

        <form method="POST" id="pecas">
            <input type="text" name="nome" placeholder="nome" id="nome">
            <input type="text" name="referencia" placeholder="referência" id="referencia">
            <button type="submit">Salvar</button>
            <a href="/pecas.php" class="btn-cancelar">Cancelar</a>
        </form>
        <div id="erro" class="erro"></div>
    </div>

<?php include '../../layout/footer.php'; ?>
