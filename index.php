<?php
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
header("Location: forum.php");
exit;
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

