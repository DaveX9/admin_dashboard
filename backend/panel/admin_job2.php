<?php
session_start();

// Database Connection
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch Latest Job Section
$stmt = $pdo->prepare("SELECT job_content FROM job_details1 ORDER BY id DESC LIMIT 1");
$stmt->execute();
$job_content = $stmt->fetchColumn();

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE job_details1 SET job_content=? ORDER BY id DESC LIMIT 1");
    if ($stmt->execute([$_POST['content']])) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Job Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/js/froala_editor.pkgd.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        /* Container */
        .container {
            max-width: 900px;
            width: 90%;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        /* Header */
        .container h2 {
            font-size: 24px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }
        /* Form */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }
        /* Froala Editor */
        textarea {
            width: 100%;
            height: 400px;
            border: 2px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
            transition: border-color 0.3s ease-in-out;
        }
        /* Save Button */
        button {
            padding: 12px 20px;
            font-size: 18px;
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        button:hover {
            background: linear-gradient(45deg, #218838, #17a2b8);
        }
        /* Success Message */
        .success-message {
            margin-top: 10px;
            padding: 12px;
            background: #28a745;
            color: #fff;
            border-radius: 5px;
            text-align: center;
            font-weight: 600;
            display: none;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            .container h2 {
                font-size: 20px;
            }
            textarea {
                font-size: 14px;
                padding: 10px;
            }
            button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Job Section</h2>
    <form id="edit-form">
        <textarea id="froala-editor" name="content"><?php echo htmlspecialchars_decode($job_content); ?></textarea>
        <br>
        <button type="submit">Save Changes</button>
        <div id="success-message" class="success-message">Content updated successfully!</div>
    </form>
</div>

<script>
        $(document).ready(function() {
                    // Initialize Froala Editor
                    new FroalaEditor('#froala-editor', {
                        toolbarButtons: [
                            'bold', 'italic', 'underline', 'strikeThrough', '|',
                            'fontFamily', 'fontSize', 'color', 'backgroundColor', '|',
                            'align', 'formatOL', 'formatUL', 'indent', 'outdent', '|',
                            'insertLink', 'insertImage', 'insertVideo', 'insertTable', '|',
                            'undo', 'redo', 'clearFormatting', 'html', 'fullscreen', '|',
                            'paragraphFormat', 'quote', 'insertHR', 'specialCharacters', '|',
                            'insertFile', 'emoticons', 'print', 'help'
                        ],
                        heightMin: 400,
                        heightMax: 800
                    });

        $("#edit-form").on("submit", function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "admin_job2.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.trim() === "success") {
                        $("#success-message").fadeIn().delay(2000).fadeOut();
                    } else {
                        alert("Update failed!");
                    }
                }
            });
        });
    });
</script>

</body>
</html>
