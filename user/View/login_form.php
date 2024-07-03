<?php
include "header.php";
?>

<main>
    <div class="div_big">
        <div class="div_form">
            <form action="../Controller/login.php" method="post">
                <input type="email" name="email" placeholder="Email" class="inputs">
                <input type="password" name="pass" placeholder="Password" class="inputs">
                <label>Remember me
                    <input type="checkbox" name="inp_check" class="checkbox">
                </label>
                <button name="btn_login" value="btn" class="btn">SIGN IN</button>
            </form>
            <h3>OR</h3>
            <a href="http://localhost/hrayr/onlineshop/user/View/reg_form.php">SIGN UP</a>
            <p id="error-mess">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </p>
        </div>
    </div>
</main>

<?php
include "footer.php"
?>