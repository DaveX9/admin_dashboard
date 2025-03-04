<?php
header('Content-Type: application/json'); // JSON response
header('Access-Control-Allow-Origin: *'); // Allow frontend access

include 'db.php';

// Fetch the first row of contact info
$sql = "SELECT * FROM contact_info LIMIT 1";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["error" => "Database query failed: " . $conn->error]);
    exit;
}

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No contact info found"]);
}

$conn->close();
?>
