<?php
include 'db.php';

// Fetch content from database
$sql = "SELECT content FROM newapp_content WHERE id = 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/HOMESPECTOR/CSS/app-inspector.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <title>Home</title>
</head>
<body>

    <div class="container-newapp" data-aos="fade-up" data-aos-duration="3000">
        <?= html_entity_decode($data['content']); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
