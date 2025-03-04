<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $facebook_link = $_POST['facebook_link'];
    $instagram_link = $_POST['instagram_link'];
    $line_link = $_POST['line_link'];
    $phone_link = $_POST['phone_link'];

    // Ensure at least one row exists (if not, insert new)
    $sql_check = "SELECT * FROM contact_info LIMIT 1";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Update existing record
        $sql = "UPDATE contact_info SET 
                company_name='$company_name',
                address='$address',
                phone='$phone',
                email='$email',
                facebook_link='$facebook_link',
                instagram_link='$instagram_link',
                line_link='$line_link',
                phone_link='$phone_link'
                WHERE id=1";
    } else {
        // Insert new record if none exists
        $sql = "INSERT INTO contact_info (company_name, address, phone, email, facebook_link, instagram_link, line_link, phone_link) 
                VALUES ('$company_name', '$address', '$phone', '$email', '$facebook_link', '$instagram_link', '$line_link', '$phone_link')";
    }

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => "Contact info updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating contact info: " . $conn->error]);
    }

    $conn->close();
}
?>
