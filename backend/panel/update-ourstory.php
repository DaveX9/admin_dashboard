<?php
header("Content-Type: application/json");

// Database Connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Check if POST request contains "content"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])) {
    $content = $_POST['content'];

    try {
        // Insert or update latest content
        $stmt = $pdo->prepare("INSERT INTO ourstory (page_name, content) VALUES ('ourstory', ?) 
                                ON DUPLICATE KEY UPDATE content = VALUES(content)");
        $stmt->execute([$content]);

        echo json_encode(['status' => 'success', 'content' => $content]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'SQL Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request!']);
}
?>
