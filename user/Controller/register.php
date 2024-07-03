<?php

include "../Model/UserModel.php";

session_start();

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$conf_pass = $_POST['conf_pass'];

if (empty($_POST['btn_reg'])) die;

if (empty($name) || empty($login) || empty($email) || empty($pass) || empty($conf_pass)) {
    $_SESSION['error'] = "Empty field!";
    header('location: ../View/reg_form.php');
    die;
}
if ($pass != $conf_pass) {
    $_SESSION['error'] = "Passwords are not the same!";
    header('location: ../View/reg_form.php');
    die;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email!";
    header('location: ../View/reg_form.php');
    die;
}

$userModel = new UserModel();
$user = $userModel->checkUser($email, $pass);

if ($user) {
    $_SESSION['error'] = "User already exists!";
    header('location: ../View/reg_form.php');
    die;
}

$userModel->addUser($name, $login, $pass, $email);
header('location: ../View/login_form.php');
