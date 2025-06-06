<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$filename = "posts.txt";

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete'];

    $lines = file($filename);
    $new_lines = [];

    foreach ($lines as $line) {
        $parts = explode("|", trim($line));
        if (count($parts) === 4) {
            list($id, $time, $author, $text) = $parts;
            if ($id !== $delete_id || $author !== $_SESSION['username']) {
                $new_lines[] = $line;
            }
        }
    }
    file_put_contents($filename, implode("\n", $new_lines));
    header("Location: forum.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = trim($_POST['text']);
    if (!empty($text)) {
        $text = str_replace("\n", "|n|", $text);
        $id = uniqid();
        $time = date("d.m.Y H:i");
        $author = $_SESSION['username'];
        $line = "$id|$time|$author|$text\n";
        file_put_contents($filename, $line, FILE_APPEND);

        header("Location: forum.php");
        exit();
    }
}
?>

<!-- HTML část -->
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Moje fórum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"; ?>

<div class="container mt-4">
    <?php include "form.php"; ?>

    <h3 class="mt-5">Příspěvky</h3>
    <div class="bg-light p-3 rounded shadow-sm">

        <?php
        if (file_exists($filename)) {
            $lines = file($filename);
            foreach (array_reverse($lines) as $line) {
                $parts = explode("|", trim($line));
                if (count($parts) === 4) {
                    list($id, $time, $author, $text) = $parts;
                    $safe_text = htmlspecialchars(str_replace("|n|", "<br>", $text));
                    echo "<div class='mb-3 border-bottom pb-2'>";
                    echo "<strong>$author</strong> <em>[$time]</em><p>$safe_text</p>";
                    if ($_SESSION['username'] === $author) {
                        echo "
                        <form method='post'>
                            <input type='hidden' name='delete' value='$id'>
                            <button class='btn btn-sm btn-danger'>Smazat</button>
                        </form>
                    ";
                    }

                    echo "</div>";
                }
            }
        } else {
            echo "<p>Žádné příspěvky zatím nejsou.</p>";
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
