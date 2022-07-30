<?php
    if(!isset($_SESSION['tecnico_id'])) {
        echo '<script src="/assets/js/login.js"></script>';
    }else{
        echo '<script src="/assets/js/main.js"></script>'; 
    }
?>
</body>
</html>