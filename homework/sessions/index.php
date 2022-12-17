<?php
include "action.php";
include "header.php";

if (isset($_POST["go"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];
    $_SESSION["login"] = $login;
    if (check_user($login, $password)) {
        echo "<h3>Hello, $login!</h3>";
    } else {
        echo "You are not registred!";
    }
}

if (isset($_SESSION['authorized']) && !isset($_POST["go"])) {
    echo "<h3>Hello, {$_SESSION["login"]}!</h3>";
}
if (check_admin()) {
    echo "<a href='hello.php?login={$_SESSION["login"]}'>Viewing a Report</a><br>";
}
if (!isset($_SESSION['authorized'])) {
    $str_form = '
    <div class="container">
      <h3 class= "my-2">Sign in:</h3>
      <form class="form-inline" action="' . "{$_SERVER["PHP_SELF"]}" . '" method="post" onsubmit="return verify(this)">
        <label for="login" class="m-2">Login:</label> <input type="text" name="login" class="form-control my-2" id="login" placeholder="Enter login">
        <label for="pass" class="m-2">Password:</label> <input type="password" name="pass" id="pass" class="form-control my-2" placeholder="Enter password" >
        <input type="submit" value="OK" name="go" class="btn btn-secondary m-2">
      </form>
      <span id="massage"></span>
    </div>';
    echo $str_form;
} else {
    echo "<a href=\"logout.php\">Log out</a>";
}
// $out = out_arr();

// if (count($out) > 0) {
//     foreach ($out as $row) {
//         echo $row;
//     }
// } else {
//     echo "No data...";
// }

$str_form_s = '
<div class="container">
  <h3 class= "my-2">Sort by:</h3>
  <form action="index.php" method="post" name="sort_form" class="sort-form">
    <select name="sort" id="sort" size="1" class="form-control">
        <option value="name">name</option>
        <option value="age">age</option>
        <option value="average_mark">average mark</option>
    </select>
    <input type="submit" name="submit" value="OK" class="btn btn-secondary my-2" >
  </form>
</div>';

if (isset($_SESSION['authorized'])) {
    echo $str_form_s;

    if (isset($_POST['sort'])) {
        $how_to_sort = $_POST['sort'];
        sorting($how_to_sort);
    }
    echo "<hr>";
    $out = out_arr();
    if (count($out) > 3) {
        foreach ($out as $row) {
            echo $row;
        }
    } else {
        echo "No data...";
    }
    echo "<hr>";
    if (isset($_POST['search'])) {
        $data = test_input($_POST['search']);
        $out = out_search($data);

        // вызов функции out_arr() из action.php для получения массива
        if (count($out) > 3) {
            foreach ($out as $row) { //вывод массива построчно
                echo $row;
            }
        } else // если нет данных
        {
            echo "Nothing found...";
        }
    }
}
else{
    echo "<hr><h2>Sorry but you must be authorized to see all the information about our students!</h2><hr>";
}


include "footer.php";
