<?php
ob_start();
include "action.php";
include "header.php";

echo "\n<h2>Secret information is here</h2>\n";
if (isset($_SESSION['authorized']) && $_SESSION["login"] == "admin") {
    $admin = $_SESSION["login"];
    if (check_log_admin($admin)) {
        echo "<p>Hello, $admin</p>";
        echo "<p>Weather info is here</p>";
    }
} else {
    header("Location: index.php");
    ob_end_flush();
}

include "footer.php";