<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 350px;
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
            align-items: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 15px;
            box-sizing: border-box;
        }

        .input-group .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 18px;
        }

        button {
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
            width: 35%;
            max-width: 150px;
        }

        button:hover {
            background: #0056b3;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Forgot Password</h1>

        <form method="post" action="send-password-reset.php">

            <div class="input-group">
                <i class="fas fa-envelope icon"></i>
                <input type="email" name="email" id="email" placeholder="Enter your email">
            </div>

            <button>Send</button>

        </form>
    </div>

</body>
</html>
