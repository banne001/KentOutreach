<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header("location: adminLogin.html");
    }

    session_destroy();
    $_SESSION = array();
    header("location: home.html");
    ?>