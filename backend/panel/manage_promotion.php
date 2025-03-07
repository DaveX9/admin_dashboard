<?php
include 'db.php';

// ดึงข้อมูลโปรโมชั่น
$result = $conn->query("SELECT * FROM promotions ORDER BY position ASC");

if (isset($_POST['move'])) {
    $id = $_POST['id'];
    $direction = $_POST['move'];

    // ค้นหาตำแหน่งปัจจุบัน
    $current = $conn->query("SELECT position FROM promotions WHERE id=$id")->fetch_assoc();
    $current_pos = $current['position'];

    if ($direction == "up") {
        $new_pos = $current_pos - 1;
    } else {
        $new_pos = $current_pos + 1;
    }

    // หา ID ที่มี position เป้าหมาย
    $swap = $conn->query("SELECT id FROM promotions WHERE position=$new_pos")->fetch_assoc();

    if ($swap) {
        $conn->query("UPDATE promotions SET position=$current_pos WHERE id=" . $swap['id']);
        $conn->query("UPDATE promotions SET position=$new_pos WHERE id=$id");
    }

    header("Location: manage_promotion.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM promotions WHERE id=$id");
    header("Location: manage_promotion.php");
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการแสดงผล</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #2d68c4;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 2px;
        }

        .btn-move-up {
            background-color: #4CAF50;
            color: white;
        }

        .btn-move-down {
            background-color: #ff9800;
            color: white;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .icon {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>จัดการแสดงผลโปรโมชั่น</h2>
        <table>
            <tr>
                <th>ชื่อโปรโมชั่น</th>
                <th>จัดการ</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="move" value="up" class="btn btn-move-up">
                                <i class="fa-solid fa-arrow-up icon"></i>
                            </button>
                            <button type="submit" name="move" value="down" class="btn btn-move-down">
                                <i class="fa-solid fa-arrow-down icon"></i>
                            </button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="delete" class="btn btn-delete">
                                <i class="fa-solid fa-trash icon"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>