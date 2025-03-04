<?php
session_start();


$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if editing mode is active
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$job_title = $job_description = $job_location = $job_type = $salary = $contact_email = "";

// Fetch job details if editing
if ($job_id) {
    $stmt = $pdo->prepare("SELECT * FROM job_listings WHERE id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($job) {
        $job_title = $job['job_title'];
        $job_description = $job['job_description'];
        $job_location = $job['job_location'];
        $job_type = $job['job_type'];
        $salary = $job['salary'];
        $contact_email = $job['contact_email'];
    } else {
        header("Location:admin_manage_jobs.php");
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_title = $_POST['job_title'];
    $job_location = $_POST['job_location'];
    $job_type = $_POST['job_type'];
    $salary = $_POST['salary'];
    $contact_email = $_POST['contact_email'];
    $job_description = $_POST['job_description'];

    if ($job_id) {
        // Update job (fixed query order)
        $stmt = $pdo->prepare("UPDATE job_listings SET job_title=?, job_description=?, job_location=?, job_type=?, salary=?, contact_email=? WHERE id=?");
        $stmt->execute([$job_title, $job_description, $job_location, $job_type, $salary, $contact_email, $job_id]);
    } else {
        // Insert new job (fixed query order)
        $stmt = $pdo->prepare("INSERT INTO job_listings (job_title, job_description, job_location, job_type, salary, contact_email) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$job_title, $job_description, $job_location, $job_type, $salary, $contact_email]);
    }

    header("Location: admin_manage_jobs.php"); // Redirect back to job listings page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $job_id ? "Edit Job" : "Add Job"; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor/css/froala_editor.pkgd.min.css">
</head>
<style>

    .container-add {
        max-width: 900px; /* Limit width to 900px */
        width: 90%; /* Adjust for smaller screens */
        margin: 50px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Table Styles */
    .table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .table th {
        background: #007bff;
        color: white;
        text-align: left;
        padding: 10px;
    }

    .table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* Button Styling */
    .btn {
        padding: 8px 12px;
        font-size: 14px;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-warning {
        background: #ffc107;
        color: black;
        border: none;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
        border: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            width: 95%;
            padding: 15px;
        }
        
        .table th, .table td {
            padding: 8px;
            font-size: 14px;
        }
        
        .btn {
            font-size: 12px;
            padding: 6px 10px;
        }
    }

</style>
<body>
    <div class="container-add">
        <h2 class="mt-3"><?php echo $job_id ? "Edit Job" : "Add New Job"; ?></h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="job_title" class="form-control" required value="<?php echo htmlspecialchars($job_title); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="job_location" class="form-control" required value="<?php echo htmlspecialchars($job_location); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Job Type</label>
                <input type="text" name="job_type" class="form-control" required value="<?php echo htmlspecialchars($job_type); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input type="text" name="salary" class="form-control" required value="<?php echo htmlspecialchars($salary); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Email</label>
                <input type="email" name="contact_email" class="form-control" required value="<?php echo htmlspecialchars($contact_email); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea id="job_description" name="job_description" class="form-control"><?php echo htmlspecialchars($job_description); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success"><?php echo $job_id ? "Update Job" : "Add Job"; ?></button>
        </form>
    </div>

    <!-- Froala Editor JS -->
    <script src="https://cdn.jsdelivr.net/npm/froala-editor/js/froala_editor.pkgd.min.js"></script>
    <script>
        new FroalaEditor('#job_description', {
            heightMin: 300,
            heightMax: 600,
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
    </script>
</body>
</html>
