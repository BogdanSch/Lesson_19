<?php

if(isset($_POST['submit'])){
    $log = $_POST['login'];
    $last_time = time();

    setcookie("login", $log, time() + 1800);
    setcookie("last_time", $last_time, time() + 1800);
}

echo "
    <h2>Welcome {$_COOKIE['login']}</h2>
    <p>Your last log in time ".date("d.m.Y H:i", $_COOKIE['last_time'])."</p>
";