<?php

define("ROOT", __DIR__);
// Active l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "core/Autoload.php";
if (isset($_GET["action"])) {
    # code...
    Root::executer($_GET["action"]);

}else{    
    Root::executer("InscriptionControlleur");
}

?>