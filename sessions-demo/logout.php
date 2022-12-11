<?php

session_start();
// Очистить данные сессии для текущего сценария. 
$_SESSION = array(); 
// Удалить cookie, соответствующую SID. 
unset($_COOKIE[session_name()]); 
// Уничтожить хранилище сессии. 

if(session_destroy()){
    header("Location: index.php");
}
