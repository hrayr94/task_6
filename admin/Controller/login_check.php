<?php

session_start();

require_once "../Model/AdminModel.php";

$adminModel = new AdminModel();
$login = $_POST['login'];
$pass = $_POST['password'];

if (!isset($_POST['btn_enter'])) {
    header('location: ../index.php');
    exit; // Stop further execution
}

if (empty($login) || empty($pass)) {
    $_SESSION['error'] = "Empty login or password!";
    header('location: ../index.php');
    exit; // Stop further execution
}

$admin = $adminModel->admin($login, $pass);

if ($admin) {
    $_SESSION['admin'] = $admin['username'];
    header('location: ../View/products.php');
    exit;
} else {
    $_SESSION['error'] = "Wrong login or password";
    header('location: ../index.php');
    exit;
}
