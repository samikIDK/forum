<?php
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand">Ez Fórum</span>
        <div class="d-flex">
            <span class="navbar-text me-3">Přihlášen pod: <?php echo $_SESSION["username"]; ?></span>
            <a href="logout.php" class="btn btn-outline-danger">Odhlásit se</a>
        </div>
    </div>
</nav>