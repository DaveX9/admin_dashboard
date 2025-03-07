<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    // Handle Image Upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/HOMESPECTOR/backend/panel/uploads/";
        $image_name = basename($_FILES["image"]["name"]);
        $image_path = "/HOMESPECTOR/backend/panel/uploads/" . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_name)) {
            $image = $image_path;
        } else {
            die("File upload failed!");
        }
    }

    // Insert Data into Database
    $sql = "INSERT INTO promotions (title, description, image, link) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $image, $link);

    if ($stmt->execute()) {
        header("Location: admin_promotion.php");
        exit();
    } else {
        echo "Insert failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มโปรโมชั่น</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.14/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.14/js/froala_editor.pkgd.min.js"></script>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #555;
        }

        input[type="text"], textarea {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #2d68c4;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-submit:hover {
            background-color: #1d4c8c;
        }

        .promotion-details {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 750px;
        }

        .promotion-details h3 {
            text-align: center;
            color: #2d68c4;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>เพิ่มโปรโมชั่น</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>ชื่อโปรโมชั่น</label>
            <input type="text" name="title" required>

            <label>อัปโหลดรูป</label>
            <input type="file" name="image">

            <label>ลิงก์ไปยังหน้าโปรโมชั่น</label>
            <input type="text" name="link">


            <!-- Promotion Details Section (Moved Froala Editor Here) -->
            <div class="promotion-details">
                <h3>รายละเอียดโปรโมชั่น</h3>
                
                <label>รายละเอียด</label>
                <textarea name="description" id="froala-editor"></textarea>
            </div>

            <button type="submit" class="btn-submit">บันทึก</button>
        </form>
    </div>


    <script>
        new FroalaEditor('#froala-editor', {
            heightMin: 250,
            heightMax: 400,
            toolbarButtons: [
                'bold', 'italic', 'underline', 'strikeThrough', '|',
                'align', 'formatOL', 'formatUL', '|',
                'insertImage', 'insertLink', 'insertVideo', 'undo', 'redo'
            ],
            imageUploadURL: 'upload_promo_img.php', // ✅ Now using the correct upload script
            fileUploadURL: 'upload_file.php', // If needed, ensure you have a file upload script
        });
    </script>


</body>
</html>
