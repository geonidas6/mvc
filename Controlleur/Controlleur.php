<?php
namespace App\Controlleur;

use App\Config;




/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 10/06/2019
 * Time: 18:03
 */
class Controlleur
{

    const ENSEIGNANT = 1;
    const TECHNICIEN = 2;



   public function init_root(){

        $lib_controller = (isset($_REQUEST['cl'])) ? ($_REQUEST['cl']) : '';
        $action = (isset($_REQUEST['mt'])) ? $_REQUEST['mt'] : '';
        if ((!isset($_REQUEST['cl'] )) && (!isset($_REQUEST['mt']))){

            if (isset($_SESSION['user_app'])){
                if ($_SESSION['user_app']['role'] == Config::ENSEIGNANT){
                    $enseigantControlleur = new EnseignantControlleur();
                    $enseigantControlleur->indexAction();
                }else{
                    $technicienControlleur = new TechnicienControlleur();
                    $technicienControlleur->indexAction();
                }
            }
            $homeControlleur = new UserControlleur();
            $homeControlleur->loginAction();
            exit;
        }

        if ($lib_controller != '') {
            $lib_controller =  "App\\Controlleur\\".ucfirst($lib_controller)."Controlleur";
           // vd($lib_controller);
            if(class_exists(($lib_controller))){
                $controller = new $lib_controller();
                if (method_exists($controller,$action)){
                    $controller->$action();
                } else {
                    echo "Adresse action  incorrecte.";
                }
            } else {
                echo "Adresse root incorrecte.";
            }
        }

    }

}