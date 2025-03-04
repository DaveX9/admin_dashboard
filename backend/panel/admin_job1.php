<?php
session_start();
// Database Connection
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch Latest Job Sections
$stmt1 = $pdo->prepare("SELECT job_section FROM job_details ORDER BY id DESC LIMIT 1");
$stmt1->execute();
$job_section = $stmt1->fetchColumn();

$stmt2 = $pdo->prepare("SELECT job_content FROM job_details1 ORDER BY id DESC LIMIT 1");
$stmt2->execute();
$job_content = $stmt2->fetchColumn();

// Handle Updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'job_section') {
        $stmt = $pdo->prepare("UPDATE job_details SET job_section=? ORDER BY id DESC LIMIT 1");
        echo $stmt->execute([$_POST['content']]) ? "success" : "error";
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'job_content') {
        $stmt = $pdo->prepare("UPDATE job_details1 SET job_content=? ORDER BY id DESC LIMIT 1");
        echo $stmt->execute([$_POST['content']]) ? "success" : "error";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Job Sections</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/js/froala_editor.pkgd.min.js"></script>
    <style>
    
        .container-job {
            max-width: 900px;
            width: 90%;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }
        textarea {
            width: 100%;
            height: 400px;
            border: 2px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }
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
    </style>
</head>
<body>

<div class="container-job">
    <h2>Edit Job Section 1</h2>
    <form class="edit-form" data-form-type="job_section">
        <textarea class="froala-editor" name="content"><?php echo htmlspecialchars_decode($job_section); ?></textarea>
        <input type="hidden" name="form_type" value="job_section">
        <br>
        <button type="submit">Save Changes</button>
        <div class="success-message">Content updated successfully!</div>
    </form>
</div>

<div class="container-job">
    <h2>Edit Job Section 2</h2>
    <form class="edit-form" data-form-type="job_content">
        <textarea class="froala-editor" name="content"><?php echo htmlspecialchars_decode($job_content); ?></textarea>
        <input type="hidden" name="form_type" value="job_content">
        <br>
        <button type="submit">Save Changes</button>
        <div class="success-message">Content updated successfully!</div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Initialize Froala Editor for all textareas
        $('.froala-editor').each(function() {
            new FroalaEditor(this, {
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
        });

        // Handle form submissions
        $(".edit-form").on("submit", function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: "",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.trim() === "success") {
                        form.find(".success-message").fadeIn().delay(2000).fadeOut();
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
