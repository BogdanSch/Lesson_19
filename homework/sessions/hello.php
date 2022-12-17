<?php
ob_start();
include "action.php";
include "header.php";

echo "\n<h2>Secret information is here</h2>\n";
if (isset($_SESSION['authorized']) && $_SESSION["login"] == "admin") {
    $admin = $_SESSION["login"];
    if (check_log_admin($admin)) {
        echo "<p>Hello, $admin</p>";
        echo "<h3>Here are all the students who have bad marks</h2>";
        echo "<hr>";
        $out = out_arr_bad_students();
        if (count($out) > 3) {
            foreach ($out as $row) {
                echo $row;
            }
        } else {
            echo "Fortunately your students are super smart:)";
        }
        echo "<hr>";
    }
} else {
    header("Location: index.php");
    ob_end_flush();
}

include "footer.php";
