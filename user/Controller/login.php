<?php

include "../Model/UserModel.php";

session_start();

$user_model = new UserModel();
$email = $_POST['email'];
$pass = $_POST['pass'];

if (empty($_POST['btn_login'])) die;

if (empty($email) || empty($pass)) {
    $_SESSION['error'] = "Empty field!";
    header('location: ../View/login_form.php');
    die;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email!";
    header('location: ../View/login_form.php');
    die;
}

$userModel = new UserModel();
$user = $userModel->checkUser($email, $pass);

if (!$user) {
    $_SESSION['error'] = "Wrong login or password!";
    header('location: ../View/login_form.php');
    die;
}

if (isset($_POST['inp_check'])) {
    setcookie('user_id', $user['id'], time() + (86400 * 3), "/");
    setcookie('user_email', $user['email'], time() + (86400 * 3), "/");
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
header('location: ../../index.php');
