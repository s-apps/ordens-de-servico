<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }
?>

<?php include '../../layout/header.php'; ?>

    <h1>Ordem de Serviços - Servicos - Adicionar</h1>

    <form method="POST" id="servicos">
        <input type="text" name="nome" placeholder="nome" id="nome">
        <input type="text" name="referencia" placeholder="referência" id="referencia">
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>
