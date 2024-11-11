<?php
    session_start();

    session_unset();
    session_destroy();

    if (isset($_COOKIE['remember'])) {
        setcookie('remember', '', time() - 3600, "/"); // Expire the cookie
    };

    header('location:index.php?log=You have logged out!');
    exit();

?>