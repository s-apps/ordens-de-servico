<?php 
    session_start();
    if(!isset($_SESSION['tecnico_id'])) {
        header('Location: /auth/login.php');
        die();
    }
?>

<?php include '../../layout/header.php'; ?>

    <h1>Ordem de Serviços - Clientes - Adicionar</h1>

    <form method="POST" id="clientes">
        <input type="text" name="nome" placeholder="nome" id="nome">
        <button type="submit">Salvar</button>
    </form>
    <div id="erro" class="erro"></div>

<?php include '../../layout/footer.php'; ?>
