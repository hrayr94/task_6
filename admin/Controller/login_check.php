<?php

session_start();

include "../Model/AdminModel.php";

$adminModel = new AdminModel();
$login = $_POST['login'];
$pass = $_POST['password'];

if (!isset($_POST['btn_enter'])) {
    header('location: ../index.php');
    die;
}

if (empty($login) || empty($pass)) {
    $_SESSION['error'] = "Empty login or password!";
    header('location: ../index.php');
    die;
}

$count = $adminModel->admin($login, $pass);

if ($count > 0) {
    $_SESSION['admin'] = $login;
} else {
    $_SESSION['error'] = "Wrong login or password";
}
header('location: ../View/products.php');
die;