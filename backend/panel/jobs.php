<?php
$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch all job listings
$stmt = $pdo->prepare("SELECT * FROM job_listings ORDER BY date_posted DESC");
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Available Jobs</h2>
    <?php foreach ($jobs as $job): ?>
        <div class="card my-3">
            <div class="card-body">
                <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($job['job_type']); ?></p>
                <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
                <p><?php echo htmlspecialchars_decode($job['description']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
