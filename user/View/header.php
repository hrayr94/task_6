<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/body.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/sections.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/wish.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/cart.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/product.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/categories.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/order.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/hrayr/task_6/user/Assets/css/media.css">
    <title>Online Shop</title>
</head>
<body>
<?php
session_start();
if (isset($_COOKIE['user_email'])) {
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}
?>
<header>
<div class="header-wrap">
<div class="header-top">
    <h1 id="header-h">ONLINE SHOP</h1>
</div>
<nav>
    <button class="sidebar-toggle"><i class='bx bx-menu'></i></button>
    <ul class="list" id="list-home">
        <li><a href="http://localhost/hrayr/task_6">Categories</a>
        <li><a href="http://localhost/hrayr/task_6/user/View/home.php">Home</a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/about.php">About</a></li>
        <li><a href="#footer">Contact</a></li>
    </ul>
    <ul class="sidebar-box">
        <li><button class="sidebar-toggle"><i class='bx bx-menu'></i></button></li>
        <li><a href="http://localhost/hrayr/task_6">Categories</a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/home.php">Home</a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/about.php">About</a></li>
        <li><a href="#footer">Contact</a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/cart.php">Cart</a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/wish.php">Wish List</a></li>
<?php
if (isset($_SESSION['user_email'])) : ?>
        <li><a href="http://localhost/hrayr/task_6/user/Controller/logout.php">SIGN OUT</a></li>
        <li><a href="#"><i class='bx bx-user-circle'></i><?=$_SESSION['user_email']?></a></li>
<?php  else : ?>
        <li><a href="http://localhost/hrayr/task_6/user/View/login_form.php">SIGN IN / SIGN UP</a></li>
<?php endif; ?>
        </ul>
    <ul class="list" id="list-sign">
        <li><a href="http://localhost/hrayr/task_6/user/View/cart.php" title="Cart"><i class='bx bx-cart' ></i></a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/wish.php" title="Wish List"><i class='bx bx-list-check'></i></a></li>
<?php
if (isset($_SESSION['user_email'])) : ?>
        <li><a href="http://localhost/hrayr/task_6/user/Controller/logout.php" title="Sign Out"><i class='bx bx-user'></i></a></li>
        <li><a href="http://localhost/hrayr/task_6/user/View/order.php" title="<?=$_SESSION['user_email']?>"><i class='bx bx-user-circle'></i></a></li>
<?php  else : ?>
        <li><a href="http://localhost/hrayr/task_6/user/View/login_form.php"><i class='bx bx-user'></i></a></li>
<?php endif; ?>
    </ul>
</nav>
</div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(function () {
        $('.sidebar-toggle').click(function() {
            $('.sidebar-box').toggleClass('toggle');
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() > 0) {
                $('.header-top').addClass('toggle');
                $('#header-h').addClass('tog');
            } else {
                $('.header-top').removeClass('toggle');
                $('#header-h').removeClass('tog');
            }
        })
    })
</script>