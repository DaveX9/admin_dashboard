<?php
ob_start(); 
session_start(); 
include '../header.php';

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=homespector", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initialize success message variable
$successMessage = "";

// Fetch contact info
$stmt = $pdo->query("SELECT * FROM contact_info LIMIT 1");
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Show success message only if session exists
if (isset($_SESSION['updated']) && $_SESSION['updated'] === true) {
    $successMessage = "<p class='success-message'>Contact information updated successfully.</p>";
    unset($_SESSION['updated']); // Remove session after showing message
}

// Update contact info if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = htmlspecialchars($_POST["company_name"]);
    $address = htmlspecialchars($_POST["address"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);

    $updateStmt = $pdo->prepare("UPDATE contact_info SET company_name=?, address=?, phone=?, email=? WHERE id=1");
    $updateStmt->execute([$company_name, $address, $phone, $email]);

    // ✅ Set session variable to show success message after redirect
    $_SESSION['updated'] = true;

    // ✅ Redirect to same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
ob_end_flush(); // ✅ Flush output buffer
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact Info</title>
</head>
<style>
    .container-center {
    padding: 20px;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    flex-direction: column;
    margin-top:0;
}

    /* Heading */
    h2 {
        text-align: center;
        font-size: 24px;
        color: #333;
    }

    /* Form */
    form {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 700px;
        text-align: left;
        margin-bottom: 150px;
    }

    /* Labels */
    label {
        font-weight: bold;
        display: block;
        margin: 10px 0 5px;
    }

    /* Input Fields */
    input, textarea {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea {
        height: 100px;
        resize: none;
    }

    /* Submit Button */
    button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #218838;
    }

    /* ✅ Success Message */
    .success-message {
        text-align: center;
        font-size: 16px;
        color: green;
        font-weight: bold;
        margin-top: 15px;
    }

    /* 🔹 Responsive Design */
    @media (max-width: 768px) {
        .container-center {
            padding: 10px;
        }

        form {
            width: 90%;
            padding: 20px;
        }

        h2 {
            font-size: 22px;
        }

        button {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        h2 {
            font-size: 20px;
        }

        input, textarea {
            font-size: 14px;
            padding: 10px;
        }

        button {
            font-size: 14px;
            padding: 10px;
        }
    }

</style>
<body>
    <div class="container-center">
        <form action="" method="post">
            <h2>Edit Contact Information</h2>
            <label>Company Name:</label>
            <input type="text" name="company_name" value="<?php echo htmlspecialchars($contact['company_name']); ?>" required>

            <label>Address:</label>
            <textarea name="address" required><?php echo htmlspecialchars($contact['address']); ?></textarea>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>

            <button type="submit">Update</button>

            <!-- ✅ Success Message -->
            <?php echo $successMessage; ?>
        </form>
    </div>


</body>
</html>
