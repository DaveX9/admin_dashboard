<?php
session_start();


// Database Connection
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch latest content
$stmt = $pdo->prepare("SELECT content FROM ourstory WHERE page_name = 'ourstory'");
$stmt->execute();
$content = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Content</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.15/js/froala_editor.pkgd.min.js"></script>

</head>
<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.story-container {
    width: 90%;
    max-width: 700px;
    margin: 20px auto;
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Header Section */
.story-header {
    text-align: center;
    position: relative;
}

.header-image {
    width: 100%;
    max-height: 250px;
    object-fit: cover;
    border-radius: 8px;
}

.header-title {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    background: rgba(0, 0, 0, 0.6);
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 24px;
}

/* Content Sections */
.story-content, 
.vision-mission, 
.our-founders, 
.commitment {
    margin-top: 20px;
    padding: 15px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
}

/* Vision & Mission */
.vision-mission h2 {
    text-align: center;
    color: #333;
}

.head {
    text-align: center;
    font-size: 18px;
    margin-bottom: 15px;
}

/* Values (Trust, Tech, Team) */
.values {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    text-align: center;
}

.value {
    flex: 1;
    min-width: 150px;
    margin: 10px;
}

.value img {
    width: 50px;
    margin-bottom: 8px;
}

/* Founders Section */
.founders-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.founder {
    text-align: center;
    margin: 15px;
}

.founder-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

/* Commitments */
.commitment-content {
    padding: 10px;
}

.commitment-content ul {
    padding-left: 20px;
}

.commitment-content li {
    margin-bottom: 8px;
}
/* Save Button */
.save-btn {
    width: 100%;
    max-width: 200px; /* Prevents button from stretching on large screens */
    display: block;
    margin: 20px auto;
    padding: 12px;
    background: linear-gradient(90deg, #3b82f6, #9333ea);
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

button:hover {
    background: linear-gradient(90deg, #2563eb, #7e22ce);
    transform: scale(1.05);
}

button:active {
    transform: scale(0.98);
}
.success-message {
            text-align: center;
            color: green;
            display: none;
            font-weight: bold;
}
@media screen and (max-width: 600px) {
    button {
        width: 90%;
        font-size: 14px;
        padding: 10px;
    }
}

@media screen and (max-width: 700px) {
    .story-container {
        width: 95%;
    }

    .header-title {
        font-size: 20px;
        padding: 8px 12px;
    }

    .values {
        flex-direction: column;
    }

    .value {
        width: 100%;
    }

    .founders-container {
        flex-direction: column;
    }

    .founder {
        width: 100%;
    }
}

</style>
<body>
    <div class="admin-container">
        <h2 style="text-align: center;">Manage "Our Story"</h2>
        <form id="edit-form">
            <textarea id="froala-editor" name="content"><?php echo htmlspecialchars($content); ?></textarea>
            <button type="submit" class="save-btn">Save Changes</button>
        </form>

        <div id="success-message" class="success-message">Content updated successfully!</div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var editor = new FroalaEditor('#froala-editor', {
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

            $("#edit-form").on("submit", function(event) {
                event.preventDefault();
                
                var content = editor.html.get();
                var formData = { content: content };

                $.ajax({
                    url: "update-ourstory.php",  // 🔹 Update correct path
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        console.log("Server Response:", response);
                        if (response.status === "success") {
                            $("#success-message").fadeIn().delay(2000).fadeOut();
                            localStorage.setItem("latestContent", response.content);
                        } else {
                            alert("Failed to update content! Server error.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                        alert("An error occurred while updating content!");
                    }
                });
            });

        });


    </script>
</body>
</html>
