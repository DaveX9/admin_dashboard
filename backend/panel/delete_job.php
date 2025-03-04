<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM job_listings WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: admin_manage_jobs.php");
exit();
?>
