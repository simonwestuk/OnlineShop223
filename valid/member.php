<?php
session_start();

if (!isset($_SESSION['username']))
{
    header('Location: login.php?errmsg=' . 'You need to login.');
    exit;
}
?>

<?php require __DIR__ . "/inc/header.php"; ?>

<h1>Welcome <?= htmlspecialchars($_SESSION['username'] ?? 'Member') ?></h1>

<?php require __DIR__ . "/inc/footer.php"; ?>