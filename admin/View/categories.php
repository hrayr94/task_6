<?php
include 'header.php';
require_once '../Model/CategoryModel.php';

session_start();
?>

<main class='main-cat'>
    <div class='main-wrap' id='main-wrap-left'>
        <div class='main-inner' id='main-inner-info'>
            <h1>Welcome home, <?= ucfirst($_SESSION['admin']) ?>!</h1>
            <ul>
                <li><p>To add category click 'Add'</p></li>
                <li><p>To rename category click on the name, rename it, then click 'Update'</p></li>
                <li><p>To delete category click 'Delete'</p></li>
                <li><p>To show category and products click on 'Arrow'</p></li>
            </ul>
        </div>
        <div class='main-inner' id='main-inner-add-cat'>
            <label>Add Categories:
                <input type='text' id='input-cat' name='input-cat'>
            </label>
            <button id='btn-add' name='add'>Add</button>
            <p id='p-mess'></p> <!-- todo response not working -->
        </div>
    </div>
    <div class='sidebar'>
        <form action=''../Controller/add_category.php' method='post'>
            <label>Add Categories:
                <input type='text' id='input-cat' name='name'>
            </label>
            <button id='btn-add' name='action' value='add'>Add</button>
        </form>
        <button class='sidebar-toggle'><i class='bx bx-sidebar'></i></button>
        <div style='margin: 50px 10px;'>
            <h1>Welcome home, <?= ucfirst($_SESSION['admin']) ?>!</h1>
            <ul>
                <li><p>To add category click 'Add'</p></li>
                <li><p>To rename category click on the name, rename it, then click 'Update'</p></li>
                <li><p>To delete category click 'Delete'</p></li>
                <li><p>To show category and products click on 'Arrow'</p></li>
            </ul>
        </div>
    </div>
    <?php
    $adminModel = new AdminModel();
    $pdo = $adminModel->getConnection();
    $categoryModel = new CategoryModel($pdo);
    $categories = $categoryModel->getCategories();

    if (!isset($_SESSION['admin'])) {
        header('location: ../index.php');
        die;
    }
    ?>
    <div class="main-wrap" id="main-wrap-right">
        <?php
        foreach ($categories as $category) : ?>
            <article id="<?= $category['id'] ?>" class="inner-cat">
                <h2 contenteditable><?= strtoupper($category['name']) ?></h2>
                <div class="inner-cat-buttons">
                    <button class="btn-upd">Update</button>
                    <button class="btn-del">Delete</button>
                    <a href="products.php?cat_id=<?= $category['id'] ?>">
                        <i class='bx bxs-right-arrow-circle'></i>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<script src="../Assets/js/categories.js"></script>

<?php
include "footer.php";
?>
