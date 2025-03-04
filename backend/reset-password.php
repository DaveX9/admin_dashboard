<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
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
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 300px;
            text-align: center;
        }


        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .password-container {
            position: relative;
            margin-bottom: 15px;
        }

        .password-container input {
            width: 100%;
            padding: 12px 40px 12px 35px; /* Adjust padding for icons */
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 18px;
            box-sizing: border-box;
        }

        .password-container .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 16px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #007bff;
        }

        

        button {
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius:15px;
            font-size: 16px;
            cursor: pointer;
            width: 100px;
            margin-top: 20px;
            align-self: center;
        }

        button:hover {
            background: #0056b3;
        }
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 16px;
            color: #007bff;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            display: none; /* Hidden by default */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-lock"></i> Reset Password</h1>

        <form id="resetPasswordForm" method="post" action="process-reset-password.php">
            
            <!-- Hidden Token Field -->
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <!-- Password Field -->
            <div class="password-container">
                <input type="password" id="password" name="password" required placeholder="New password">
                <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
            </div>

            <!-- Confirm Password Field -->
            <div class="password-container">
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat password">
                <i class="toggle-password fas fa-eye" onclick="togglePassword('password_confirmation')"></i>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitButton">Confirm</button>

            <!-- Error Message -->
            <p id="errorMessage" class="error-message">Passwords do not match. Please try again.</p>
        </form>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        // Function to toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
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

        // Add event listener for form submission
        document.getElementById("resetPasswordForm").addEventListener("submit", function (e) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("password_confirmation").value;
            const errorMessage = document.getElementById("errorMessage");

            // Check if passwords match
            if (password !== confirmPassword) {
                e.preventDefault(); // Prevent form submission
                errorMessage.style.display = "block"; // Show the error message
            } else {
                errorMessage.style.display = "none"; // Hide the error message
            }
        });
    </script>

</body>
</html>

