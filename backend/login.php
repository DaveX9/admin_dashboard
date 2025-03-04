<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: http://localhost/admin_panel/dashboard1.html");
            exit;            
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://t4.ftcdn.net/jpg/01/05/72/61/360_F_105726195_r0MpL0Noxp2NeMh3RsRwCskbeL7ensjV.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 300px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        em {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 85%;
            padding: 10px 10px 10px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 15px;
        }

        .input-group .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 18px;
            pointer-events: none;
        }

        .input-group .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 18px;
            cursor: pointer;
        }

        button {
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
            width: 100px;
            margin: 0 auto;
        }

        button:hover {
            background: #0056b3;
            transition: background-color 0.3s ease;
        }
        .login-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            display: inline-block;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
        .logbtn {
            font-size: 18px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1><i class="fas fa-lock"></i> Login</h1>
        
        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>
        
        <form method="post">
            <div class="input-group">
                <i class="fas fa-envelope icon"></i>
                <input type="email" name="email" id="email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Enter your email">
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock icon"></i>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password')"></i>
            </div>
            
            <button>Log in</button>
        </form>
        <a href="forgot-password.php">Forgot Password?</a>
        <p class="logbtn"><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const toggleIcon = passwordField.nextElementSibling;
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
