<?php
if ($_FILES['file']['name']) {
    $filename = time() . '_' . basename($_FILES['file']['name']);

    // Set the correct upload directory (inside /HOMESPECTOR/backend/panel/uploads/)
    $uploadDir = __DIR__ . '/uploads/';
    $filepath = $uploadDir . $filename;

    // Ensure the uploads folder exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        // Return the correct public path
        echo json_encode([
            'link' => "http://localhost/HOMESPECTOR/backend/panel/uploads/" . $filename
        ]);
    } else {
        echo json_encode(['error' => 'File upload failed']);
    }
}
?>
