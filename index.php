<?php
include "user/View/header.php";
include "user/Model/UserModel.php";
?>

    <main>

        <?php
        $userModel = new UserModel();
        $categories = $userModel->getCategories();
        ?>

        <?php
        if (!count($categories)) : ?>
            <p class='p-mess'>There are <span>NO</span> categories!</p>
        <?php else : ?>

        <div class="cat-wrap">
            <div class="cat">
                <?php
                foreach ($categories as $category) : ?>
                    <div id="<?= $category['id'] ?>" class="cat-box">
                        <a href="user/View/products.php?cat_id=<?= $category['id'] ?>"><?= strtoupper($category['name']) ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="cat-info">
                <div class="cat-info-inner">
                    <div id="icon">
                        <i class='bx bxs-shopping-bag'></i>
                    </div>
                    <h2>EleganceEnsemble</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae
                        malesuada turpis. Nam pellentesque in ac aliquam. Aliquam tempor
                        mi porta egestas maximus lorem ipsum dolor.</p>
                </div>
            </div>
        </div>
    </main>

<?php
include "user/View/footer.php";
?>