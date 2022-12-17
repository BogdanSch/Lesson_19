<?php

include "action.php";
// Очистить данные сессии для текущего сценария. 
$_SESSION = array(); 
// Удалить cookie, соответствующую SID. 
unset($_COOKIE[session_name()]); 
// Уничтожить хранилище сессии. 

if(session_destroy()){
    ob_start();
    header("Location: index.php");
    ob_end_flush();
}
