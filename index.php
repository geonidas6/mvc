<?php
session_start();
require_once "fonction.php";
require_once "VarDump.php";

$extra_file = [
    "Config.php",
    "Model/Model.php",
    "Controlleur/Controlleur.php",
];
autoload_all_class($extra_file);
use App\Controlleur\Controlleur;
/*
 * Set error reporting to the max level.
 */
//error_reporting(E_ALL);

//ini_set('display_errors','stderr');
$root = new Controlleur();
$root->init_root();
