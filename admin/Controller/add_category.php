<?php

require_once '../Model/CategoryModel.php';


$adminModel = new AdminModel();
$pdo = $adminModel->getConnection();
$categoryModel = new CategoryModel($pdo);

$action = $_POST['action'];
$name = $_POST['name'];

if ($action == 'add') {
    if (empty($name)) {
        echo "error";
    } else {
        $categoryModel->addCategory($name);
    }
    header('location: ../View/categories.php');
    die;
}

if ($action == 'update') {
    $id = $_POST['id'];
    $categoryModel->updateCategory($name, $id);
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $categoryModel->deleteCategory($id);
}
