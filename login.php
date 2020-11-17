<?php 
    require 'functions.php';
    session_start();

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");
        if( mysqli_num_rows($result) === 1) {
            
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['foto'] = $row['foto'];
                $_SESSION['level'] = $row['level'];
                header('Location: index.php');
                exit;
                
            }
        }
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental | Login</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 100%;
            height: 560px;
            display: flex;
        }
        .login-form {
            margin: auto;
            width: 300px;
            padding: 20px;
            /* background-color: red; */
        }
        .input-group {
            display: flex;
            flex-direction: column;
        }
        .input-group input {
            margin-bottom: 15px;
            padding: 6px 0 6px 0;
            outline: none;
            border-top: 0;
            border-left: 0;
            border-bottom: 1px solid #101010;
            border-right: 0;
            font-size: 16px;
            letter-spacing: 1px;
        }
        .input-group button {
            padding: 8px;
            background-color: #373a4e;
            border: none;
            color: #FDFEFF;
            font-size: 16px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <form action="" method="post">
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>