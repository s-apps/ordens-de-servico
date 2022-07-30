<?php include '../layout/header.php'; ?>

    <h1>Ordens de Serviço - Login</h1>
    <p>Informe seu login e senha</p>

    <form method="POST" class="form-login" id="login-form">
        <input type="text" placeholder="login" name="login" id="login">
        <input type="password" placeholder="senha" name="senha" id="senha">
        <button type="submit">Entrar</button>
    </form>
    <div id="erro" class="erro"></div>
    
<?php include '../layout/footer.php'; ?>