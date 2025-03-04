<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['content'] as $section => $content) {
        $stmt = $conn->prepare("UPDATE ourteam SET content = ? WHERE section = ?");
        $stmt->bind_param("ss", $content, $section);
        if (!$stmt->execute()) {
            echo json_encode(["status" => "error", "message" => "Error updating content: " . $stmt->error]);
            exit;
        }
    }
    
    echo json_encode(["status" => "success", "message" => "Content updated successfully!"]);
    exit;
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
    exit;
}
?>
