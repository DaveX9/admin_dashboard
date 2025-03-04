<?php
// Database Connection
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];

    // Update only one page content
    $stmt = $pdo->prepare("UPDATE pages SET content = ? WHERE page_name = 'joinwithus'");
    $stmt->execute([$content]);

    echo "success"; // Response for AJAX
}
?>
