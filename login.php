<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
    header("Location: forum.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
<h2>Přihlášení do fóra</h2>
<form method="post">
    <input class="form-control my-2" type="text" name="username" placeholder="Zadej přezdívku" required>
    <button class="btn btn-primary" type="submit">Přihlásit se</button>
</form>
</body>
</html>