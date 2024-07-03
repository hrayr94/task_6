<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/hrayr/onlineshop/admin/Assets/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="wrap">
        <div class="inner_left">
            <p><strong>Welcome to Admin panel</strong></p>
        </div>
        <div class="inner_right">
            <div class="form">
                <h1>LOGIN</h1>
                <form action="Controller/login_check.php" method="post">
                    <input type="text" name="login" class="inputs" placeholder="Login">
                    <input type="password" name="password" class="inputs" placeholder="Password">
                    <button name="btn_enter" value="enter" class="btn">Enter</button>
                </form>
            </div>
        </div>
    </div>
    <?php

        session_start();

        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }

    ?>
</body>
</html>
