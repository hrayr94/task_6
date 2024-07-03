<?php

session_start();
session_destroy();

setcookie('user_id', '', -1, '/');
setcookie('user_email', '', -1, '/');

header('location: ../View/login_form.php');