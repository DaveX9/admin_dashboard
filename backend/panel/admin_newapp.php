<?php
include 'db.php';

// Fetch current content from the database
$sql = "SELECT content FROM newapp_content WHERE id = 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Content</title>

    <!-- Froala Editor -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.14/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.14/js/froala_editor.pkgd.min.js"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .admin-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            display: none;
        }
        .save-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            font-size: 18px;
            border: none;
            cursor: pointer;
            text-align: center;
            border-radius: 5px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .save-btn:hover {
            background: #218838;
        }
    </style>
</head>

<body>

    <div class="admin-container">
        <h2>✏️ Edit Home Inspection App Page</h2>

        <!-- Success Message -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message" id="successMessage">Content updated successfully!</div>
            <script>
                document.getElementById("successMessage").style.display = "block";
                setTimeout(() => {
                    document.getElementById("successMessage").style.display = "none";
                }, 3000);
            </script>
        <?php endif; ?>

        <form action="update-newapp.php" method="POST">
            <textarea id="froala-editor" name="content"><?= $data['content']; ?></textarea>
            <button type="submit" class="save-btn">💾 Save Changes</button>
        </form>
    </div>

    <script>
        new FroalaEditor('#froala-editor', {
            height: 500,
            fullPage: true,
            htmlAllowedTags: ['.*'],
            htmlAllowedAttrs: ['.*'],
            imageUploadURL: 'upload-app-image.php',  // This script now saves to /backend/panel/uploads
            fileUploadURL: 'upload_file.php',
            imageUploadParams: {
                folder: '/HOMESPECTOR/backend/panel/uploads/'  // Ensure correct folder path
            },
            imageDefaultWidth: 600, // Optional: Set default image width
        });
    </script>


</body>
</html>
