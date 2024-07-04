<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/Fonts/Robot/SourceSansPro-Black.ttf">
    <title>Login</title>
    <style>
        @font-face {
            font-family: Staat;
            src: url(../Fonts/Staatliches/Staatliches-Regular.ttf);
        }
        body {
            background: #e2e2e5;
        }
        .wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .inner_left {
            width: 300px;
            background: white;
            box-shadow: 0 0 40px 16px rgba(0,0,0,0.22);
            transition: 300ms ease-in-out;
        }
        .inner_left > p {
            margin: 50px auto;
            font-size: 40px;
            text-align: center;
            font-family: Staat, sans-serif;
            letter-spacing: 3px;
        }
        .inner_right {
            width: 400px;
            background: #474a59;
            border-radius: 10px;
            box-shadow: 0 0 40px 16px rgba(0,0,0,0.22);
            transition: 300ms;
            padding: 20px;
        }
        .form > h1 {
            text-align: center;
            color: #fff;
            font-size: 40px;
            font-family: Staat, sans-serif;
            letter-spacing: 3px;
        }
        @media only screen and (max-width: 750px) {
            .inner_left {
                width: 0;
            }
        }
        @media only screen and (max-width: 430px) {
            .inner_left {
                display: none;
            }
            .inner_right {
                width: 320px;
            }
        }
    </style>
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
                <div class="form-group">
                    <input type="text" name="login" class="form-control" placeholder="Login">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" name="btn_enter" value="enter" class="btn btn-success btn-block">Enter</button>
            </form>
        </div>
    </div>
</div>
<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
