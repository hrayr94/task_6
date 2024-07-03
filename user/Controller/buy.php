<?php

include "../View/header.php";
include "../Model/UserModel.php";

$userModel = new UserModel();
$user_id = $_SESSION['user_id'];
$userModel->addToOrder($user_id);
$userModel->clearCart($user_id);
?>
<script>
        location.replace('../../index.php')
</script>
