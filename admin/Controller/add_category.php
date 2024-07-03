<?php

include "../Model/AdminModel.php";


$adminModel = new AdminModel();
$action = $_POST['action'];
$name = $_POST['name'];

if ($action == 'add') {
    if (empty($name)) {
        echo "error";
    } else {
        $adminModel->addCategories($name);
    }
    header('location: ../View/categories.php');
    die;
}

if ($action == 'update') {
    $id = $_POST['id'];
    $adminModel->updateCategories($name, $id);
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $adminModel->deleteCategories($id);
}
