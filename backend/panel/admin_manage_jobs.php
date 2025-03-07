<?php

$pdo = new PDO('mysql:host=localhost;dbname=homespector', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch job listings ordered by created_at
$stmt_jobs = $pdo->prepare("SELECT * FROM job_listings ORDER BY created_at DESC");
$stmt_jobs->execute();
$jobs = $stmt_jobs->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        .container-manage {
            max-width: 900px;
            width: 90%;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
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
            padding: 12px;
            font-size: 16px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        /* Buttons Styling */
        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .btn-warning {
            background: #ffc107;
            color: black;
            border: none;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-primary {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 6px;
            display: inline-block;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: left; /* Ensures text is aligned left */
        }


        .btn-primary:hover {
            background: #0056b3;
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

<div class="container-manage">
    <h2 class="text-center">Manage Job Listings</h2>

    <!-- Left-Aligned Add New Job Button -->
    <div class="text-start mb-3">
        <a href="add_job.php" class="btn btn-primary">+ Add New Job</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Posted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                <td><?php echo htmlspecialchars($job['job_location']); ?></td>
                <td><?php echo htmlspecialchars($job['created_at']); ?></td>
                <td>
                    <a href="add_job.php?id=<?php echo $job['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_job.php?id=<?php echo $job['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


</body>
</html>
