<?php
session_start();

// Database Connection using PDO
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Get image path from database
    $stmt = $pdo->prepare("SELECT image_url FROM service_carousel WHERE id=?");
    $stmt->execute([$id]);
    $image_url = $stmt->fetchColumn();

    // Delete image file
    if (file_exists($image_url)) {
        unlink($image_url);
    }

    // Delete from database
    $stmt = $pdo->prepare("DELETE FROM service_carousel WHERE id=?");
    $stmt->execute([$id]);

    echo "Image deleted successfully.";
}
?>
