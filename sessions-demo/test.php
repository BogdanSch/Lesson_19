<?php

ob_start();

// if (session_status() != PHP_SESSION_ACTIVE)
    session_start();

if (!$_SESSION['authorized']) {
    header("Location:index.php");
    ob_end_flush();
    exit;
}

echo $_SESSION['test'];