<?php
define("URL","http://localhost/chat2/");
function charger($file)
{
    if (file_exists("controlleur/$file.php")) {
        require_once "controlleur/$file.php";
    }elseif (file_exists("core/$file.php")) {
        require_once "core/$file.php";
    }elseif (file_exists("model/$file.php")) {
        require_once "model/$file.php";
    }
}

spl_autoload_register("charger");