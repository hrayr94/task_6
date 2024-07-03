<?php
include "header.php";
?>

<main>
    <div class="div_big">
        <div class="div_form">
            <form action="../Controller/register.php" method="post">
                <input type="text" name="name" placeholder="Name" class="inputs">
                <input type="text" name="login" placeholder="Login" class="inputs">
                <input type="email" name="email" placeholder="Email" class="inputs">
                <input type="password" name="pass" placeholder="Password" class="inputs">
                <input type="password" name="conf_pass" placeholder="Confirm password" class="inputs">
                <button name="btn_reg" value="btn" class="btn">SIGN UP</button>
            </form>
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