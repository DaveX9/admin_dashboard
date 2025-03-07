<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=homespector", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ✅ Fetch Services Section
$stmt = $pdo->query("SELECT * FROM services_section LIMIT 1");
$service = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Handle Service Section Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["content"])) {
    $content = $_POST["content"];
    $phone = $_POST["phone"];
    $facebook = $_POST["facebook_link"];
    $instagram = $_POST["instagram_link"];
    $line = $_POST["line_link"];
    $call_number = $_POST["call_number"];

    // ✅ Handle Image Upload
    if ($_FILES["service_image"]["name"]) {
        $targetDir = __DIR__ . "/uploads/";  // Ensure correct path
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    
        $imageName = time() . "_" . basename($_FILES["service_image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
    
        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $targetFilePath)) {
            $image = $imageName;  // ✅ Store only filename in the database
        } else {
            $image = $service['image']; // Keep old image if upload fails
        }
    }
    

    $updateStmt = $pdo->prepare("UPDATE services_section SET content=?, phone=?, facebook_link=?, instagram_link=?, line_link=?, call_number=?, image=? WHERE id=1");
    $updateStmt->execute([$content, $phone, $facebook, $instagram, $line, $call_number, $image]);

    $_SESSION['success'] = "Services section updated successfully!";
    header("Location: admin_service.php");
    exit();
}

// ✅ Handle Carousel Image Upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["carousel_image"])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["carousel_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["carousel_image"]["tmp_name"], $targetFilePath)) {
        $stmt = $pdo->prepare("INSERT INTO service_carousel (heading, image) VALUES (?, ?)");
        $stmt->execute(["ราคาค่าบริการตรวจบ้านทาวน์โฮม", $fileName]);
        $_SESSION['success'] = "Carousel image uploaded successfully!";
    } else {
        $_SESSION['error'] = "Failed to upload carousel image.";
    }

    header("Location: admin_service.php");
    exit();
}

// ✅ Handle Carousel Image Deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM service_carousel WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['success'] = "Image deleted successfully!";
    header("Location: admin_service.php");
    exit();
}

// ✅ Fetch Carousel Images
$stmt = $pdo->query("SELECT * FROM service_carousel");
$carousel_images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Services & Carousel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_editor.pkgd.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/css/froala_style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    

</head>
<style>
    .container-service {
        max-width: 700px;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
        margin-bottom: 20px;
        color: #333;
    }
    form {
        text-align: left;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
        color: #333;
    }

    input, button, textarea {
        width: 95%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    

    textarea {
        height: 150px;
        resize: none;
    }

    button {
        background: #28a745;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #218838;
    }

    .success {
        color: green;
        font-weight: bold;
        margin-top: 15px;
    }

    .error {
        color: red;
        font-weight: bold;
        margin-top: 15px;
    }
    .image-preview {
        width: 100%;
        max-width: 300px;
        margin-top: 10px;
        border-radius: 10px;
    }

    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .gallery img {
        width: 150px;
        border-radius: 10px;
        border: 1px solid #ccc;
        transition: transform 0.3s ease;
    }

    .gallery img:hover {
        transform: scale(1.05);
    }

    .delete-btn {
        display: block;
        text-align: center;
        color: red;
        margin-top: 5px;
        font-weight: bold;
        text-decoration: none;
    }
    .fr-toolbar, .fr-wrapper {
        font-family: Arial, sans-serif !important;
        z-index: 9999 !important;
    }
    .fr-command {
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }
    .fr-toolbar .fr-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 35px;
        width: 35px;
        margin: 3px;
    }
    .fr-popup, .fr-dropdown-menu {
        z-index: 99999 !important;
        font-size: 14px !important;
    }
    .fr-toolbar {
        display: flex !important;
        flex-wrap: wrap;
        justify-content: center;
    }

</style>
<body>
    <div class="container-service">
        <h2>Manage Services & Carousel</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <!-- ✅ Edit Service Section -->
        <form action="" method="post" enctype="multipart/form-data">
            <label>Service Image:</label>
            <input type="file" name="service_image">
            <img src="uploads/<?php echo htmlspecialchars($service['image']); ?>" width="100">

            <label>Call Number:</label>
            <input type="text" name="call_number" value="<?php echo htmlspecialchars($service['call_number']); ?>" required>

            <label>Service Content:</label>
            <textarea id="froala-editor" name="content"><?php echo htmlspecialchars($service['content']); ?></textarea>
            
            <label>Phone Number:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($service['phone']); ?>" required>

            <label>Facebook Link:</label>
            <input type="text" name="facebook_link" value="<?php echo htmlspecialchars($service['facebook_link']); ?>" required>

            <label>Instagram Link:</label>
            <input type="text" name="instagram_link" value="<?php echo htmlspecialchars($service['instagram_link']); ?>" required>

            <label>Line Link:</label>
            <input type="text" name="line_link" value="<?php echo htmlspecialchars($service['line_link']); ?>" required>

            <button type="submit">Save Changes</button>
        </form>
        <!-- ✅ Upload Carousel Image -->
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Upload Carousel Image</h3>
            <input type="file" name="carousel_image" required>
            <button type="submit">Upload Image</button>
        </form>

        <!-- ✅ Display Carousel Images -->
        <div class="gallery">
            <?php foreach ($carousel_images as $image): ?>
                <div>
                    <img src="uploads/<?php echo htmlspecialchars($image['image']); ?>" alt="Carousel Image">
                    <a href="?delete=<?php echo $image['id']; ?>" class="delete-btn">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new FroalaEditor('#froala-editor', {
                heightMin: 400,
                heightMax: 800,
                toolbarButtons: [
                    'bold', 'italic', 'underline', 'strikeThrough', '|',
                    'fontFamily', 'fontSize', 'color', 'backgroundColor', '|',
                    'align', 'formatOL', 'formatUL', 'indent', 'outdent', '|',
                    'insertLink', 'insertImage', 'insertVideo', 'insertTable', '|',
                    'undo', 'redo', 'clearFormatting', 'fullscreen', '|',
                    'paragraphFormat', 'quote', 'insertHR', 'specialCharacters', '|',
                    'insertFile','help'
                ]
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.17/js/froala_editor.pkgd.min.js"></script>
    

</body>
</html>
