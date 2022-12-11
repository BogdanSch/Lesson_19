<?php

$value = 'my cookies';
setcookie("TestCookie", $value);
setcookie("TestCookie", $value, time() + 3600); /* срок действия 1 час */
setcookie("TestCookie", $value, time() + 3600, "/path_to_cookies/", "example.com", 1);

setcookie("order[1]", "apple");
setcookie("order[2]", "milk");
setcookie("order[3]", "bread");
if (isset($_COOKIE['order'])) {
    foreach ($_COOKIE['order'] as $name => $value) {
        echo "$name : $value <br />";
    }
}
