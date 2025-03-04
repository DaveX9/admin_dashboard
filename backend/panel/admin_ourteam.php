<?php
include 'db.php';
$result = $conn->query("SELECT * FROM ourteam");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
    
    <!-- Froala Editor -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor/css/froala_editor.pkgd.min.css">
    <script src="https://cdn.jsdelivr.net/npm/froala-editor/js/froala_editor.pkgd.min.js"></script>
</head>
<style>
    /* General Page Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Admin Panel Container */
.container {
    background: white;
    max-width: 900px;
    width: 100%;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    text-align: left;
}

/* Heading */
h2 {
    font-size: 22px;
    margin-bottom: 15px;
    color: #333;
    font-weight: bold;
}

/* Section Titles */
h3 {
    font-size: 18px;
    color: #444;
    text-align: left;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Fix Froala Toolbar Layout */
.fr-toolbar {
    display: flex !important;
    flex-wrap: wrap !important;
    justify-content: start !important;
    background: #f9f9f9 !important;
    border-radius: 8px 8px 0 0 !important;
    padding: 8px !important;
}

/* Ensure toolbar buttons stay aligned */
.fr-toolbar .fr-btn-grp {
    display: flex !important;
    flex-wrap: nowrap !important;
}

/* Fix Editor Box */
.fr-box {
    border: 1px solid #ddd !important;
    border-radius: 8px !important;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1) !important;
    background: #fff !important;
    padding: 10px;
}

/* Editor Wrapper */
.fr-wrapper {
    border-radius: 0 0 8px 8px !important;
    padding: 10px !important;
    min-height: 250px;
    overflow-y: auto;
}

/* Make editor text clear and readable */
.fr-element {
    font-size: 16px !important;
    color: #333 !important;
    padding: 10px !important;
    line-height: 1.6 !important;
    border-radius: 5px !important;
}


/* Save Button */
button {
    display: block;
    width: 100%;
    background: #007bff;
    color: white;
    font-size: 18px;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}
/* Success Message */
.success-message {
    display: none;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
}


/* Error Message */
.error-message {
    display: none;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
}

button:hover {
    background: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        padding: 15px;
    }
    
    h2 {
        font-size: 20px;
    }

    h3 {
        font-size: 18px;
    }

    textarea {
        min-height: 150px;
    }

    button {
        font-size: 16px;
    }
}

</style>
<body>
<div class="container">
    <h2>Edit Website Content</h2>
    <form id="updateForm">
        <?php while ($row = $result->fetch_assoc()): ?>
            <h3><?php echo ucfirst($row['section']); ?> Section</h3>
            <textarea id="<?php echo $row['section']; ?>" name="content[<?php echo $row['section']; ?>]">
                <?php echo htmlspecialchars($row['content']); ?>
            </textarea>
        <?php endwhile; ?>
        <button type="submit">Save Changes</button>
    </form>

    <!-- Success & Error Messages -->
    <div id="successMessage" class="success-message" style="display: none;">Content updated successfully!</div>
    <div id="errorMessage" class="error-message" style="display: none;">An error occurred. Please try again.</div>
</div>

<script>
    // Initialize Froala Editor
    document.querySelectorAll('textarea').forEach((el) => {
        new FroalaEditor(el, {
            toolbarButtons: [
                ['bold', 'italic', 'underline', 'strikeThrough', '|',
                'fontSize', 'color', '|',
                'align', 'formatOL', 'formatUL', '|',
                'insertImage', 'insertLink', 'insertVideo', '|',
                'undo', 'redo']
            ],
            heightMin: 250,
            theme: 'gray',
            placeholderText: 'Start typing here...',
            charCounterCount: true,
            toolbarSticky: true
        });
    });

    // Handle Form Submission via AJAX
    document.getElementById("updateForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent page reload

        let formData = new FormData(this);

        fetch("update_ourteam.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                document.getElementById("successMessage").style.display = "block";
                document.getElementById("errorMessage").style.display = "none";
            } else {
                document.getElementById("errorMessage").textContent = data.message;
                document.getElementById("errorMessage").style.display = "block";
                document.getElementById("successMessage").style.display = "none";
            }
        })
        .catch(error => {
            document.getElementById("errorMessage").textContent = "An error occurred: " + error;
            document.getElementById("errorMessage").style.display = "block";
            document.getElementById("successMessage").style.display = "none";
        });
    });
</script>


</body>
</html>
