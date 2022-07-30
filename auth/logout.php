<?php

    session_start();
    unset($_SESSION['tecnico_id']); 
    header('Location: /auth/login.php');