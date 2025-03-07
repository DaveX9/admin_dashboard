<?php
include 'db.php';

// Get updated content
$content = $_POST['content'];

// Update database
$sql = "UPDATE newapp_content SET content = ? WHERE id = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $content);

if ($stmt->execute()) {
    // Redirect back with a success message
    header("Location: admin_newapp.php?success=1");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
