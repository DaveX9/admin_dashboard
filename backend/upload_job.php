<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $location = $_POST['location'];
    $requirements = $_POST['requirements'];
    $apply_link = $_POST['apply_link'];
    $image = $_FILES['job_image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);

    // Move uploaded file to uploads folder
    if (move_uploaded_file($_FILES['job_image']['tmp_name'], $target_file)) {
        // Insert job into database
        $sql = "INSERT INTO jobs (title, location, requirements, apply_link, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $location, $requirements, $apply_link, $image);

        if ($stmt->execute()) {
            // Redirect with success message
            echo "<script>
                sessionStorage.setItem('job_posted', 'true');
                window.location.href = '/ADMIN_PANEL/backend/job_list.php';
            </script>";
        } else {
            echo "<script>alert('Error posting job!'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error uploading image!'); window.history.back();</script>";
    }
}

$conn->close();
?>
