<?php

session_start();
$_SESSION['test'] = "Hello world!";
// $_SESSION['authorized'] = 1;
?>

<?php
    if(isset($_SESSION["authorized"])){
        echo "<a href=\"test.php\">Test</a>";
    }
?>
<br>
<a href="logout.php">Log out</a>