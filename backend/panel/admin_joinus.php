<?php
session_start();
// Database Connection
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch the latest content
$stmt = $pdo->prepare("SELECT content FROM pages WHERE page_name = 'joinwithus'");
$stmt->execute();
$content = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Edit Page</title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/CSS/admin_panel.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/js/froala_editor.pkgd.min.js"></script>
</head>
<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* Admin Panel Container */
    .admin-container {
        width: 100%;
        max-width: 800px; /* Maximum width */
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    /* Header */
    .admin-header {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        padding-bottom: 15px;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
    }

    /* Form Styling */
    .admin-form {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Froala Editor */
    #froala-editor {
        width: 100%;
        min-height: 400px;
    }

    /* Save Button */
    #save-btn {
        width: 100%;
        max-width: 200px;
        background: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 15px;
        transition: 0.3s;
    }

    #save-btn:hover {
        background: #0056b3;
    }

    /* Success Message */
    .success-message {
        background: #28a745;
        color: white;
        padding: 10px;
        margin-top: 15px;
        border-radius: 5px;
        display: none;
        font-weight: bold;
    }

</style>
<body>

<div class="admin-container">
    <div class="admin-header">Join With Us - Edit Page</div>
    
    <form id="edit-form" class="admin-form">
        <textarea id="froala-editor" name="content"><?php echo htmlspecialchars($content); ?></textarea>
        <button type="submit" id="save-btn">Save Changes</button>
    </form>

    <!-- Success Message (Initially Hidden) -->
    <div id="success-message" class="success-message" style="display: none;"> Content updated successfully!</div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Froala Editor
        new FroalaEditor('#froala-editor', {
            heightMin: 400,
            heightMax: 800,
            toolbarButtons: [
                'bold', 'italic', 'underline', 'strikeThrough', '|',
                'fontFamily', 'fontSize', 'color', 'backgroundColor', '|',
                'align', 'formatOL', 'formatUL', 'indent', 'outdent', '|',
                'insertLink', 'insertImage', 'insertVideo', 'insertTable', '|',
                'undo', 'redo', 'clearFormatting', 'html', 'fullscreen', '|',
                'paragraphFormat', 'quote', 'insertHR', 'specialCharacters', '|',
                'insertFile', 'emoticons', 'print', 'help'
            ]
        });

        // AJAX Submission to Prevent Page Reload
        $("#edit-form").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: "update_content.php", // PHP file to process the update
                type: "POST",
                data: formData,
                dataType: "text",
                success: function(response) {
                    console.log(response); // Debugging
                    if (response.trim() === "success") {
                        $("#success-message").fadeIn().delay(2000).fadeOut(); // Show message & hide after 2 sec
                    } else {
                        alert("Error updating content!");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                    alert("Failed to update content!");
                }
            });
        });
    });
</script>

</body>
</html>
