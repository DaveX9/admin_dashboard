<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="/ADMIN_PANEL/assets/css/job_form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="job-form-container">
        <h2>🚀 Post a New Job</h2>
        <form action="/ADMIN_PANEL/backend/upload_job.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="title">🎯 Job Title</label>
                <input type="text" id="title" name="title" required placeholder="Enter Job Title">
            </div>

            <div class="form-group">
                <label for="location">📍 Location</label>
                <input type="text" id="location" name="location" required placeholder="Enter Job Location">
            </div>

            <div class="form-group">
                <label for="requirements">📜 Requirements</label>
                <textarea id="requirements" name="requirements" required placeholder="Enter Job Requirements"></textarea>
            </div>

            <div class="form-group">
                <label for="apply_link">🔗 Apply Link</label>
                <input type="text" id="apply_link" name="apply_link" required placeholder="Paste Apply Link Here">
            </div>

            <div class="form-group">
                <label for="job_image">🖼 Upload Image</label>
                <input type="file" id="job_image" name="job_image" accept="image/*" required>
            </div>

            <button type="submit">🚀 Post Job</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
