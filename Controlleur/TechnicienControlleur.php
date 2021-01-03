<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:09
 */

namespace App\Controlleur;


use App\Config;
use App\Model\ReclamationModel;
use App\Model\RoleModel;
use App\Model\UserModel;
use Cassandra\Date;
use const Grpc\STATUS_OK;


class TechnicienControlleur extends Controlleur
{

    private $error = false;
    private $userModele;
    private $roleModele;
    private $reclamationModel;


    public function __construct()
    {
        $this->roleModele = new RoleModel();
        $this->userModele = new UserModel();
        $this->reclamationModel = new ReclamationModel();
        $this->reclamationModel->initialisation();
    }


    function indexAction()
    {

        $vars['titre'] = 'Interface Technicien';
        $vars['app_user'] = $_SESSION['user_app'];
        $champs = ['id', 'status', 'objet', 'contenue', 'datereclamation', 'user'];
        $table = "reclamation";
        $vars['list_recl'] = $this->reclamationModel->getAllReclamation();
      if ( isset($_REQUEST['id'])){
          $id_recl = $_REQUEST['id'];
         $resultat =  $this->reclamationModel->getReclamationById($id_recl);
         if ($resultat !== false){
             $vars['form_recl'] = $resultat;
         }
      }
//        vdd($_SESSION);

        render(Config::VIEW_PATH . "technicien/dashboard.php", $vars);
    }


    function updateAction()
    {
        $data = $_REQUEST['data'];
        if ($data != null) {
            $status = $data['status'];
            $nomcomplet = $data['user'];
            $email = $data['email'];
            $objet = $data['objet'];
            $tel = $data['tel'];
            $thechnicien =  $_SESSION['user_app']['nomcomplet'];
            $champ_data = [
                "status" => $status
            ];
            $id = $data['id'];
            $table = "reclamation";
            $where = " WHERE id = '$id'";
            $reponse = $this->reclamationModel->_genereSql($champ_data, $table, $where, 'update');
            if ($reponse == true) {
                $success = mail($email, "Reclamation à propos de: ".$objet, "Bonnjour $nomcomplet Votre demande de reclamation à été passé vers le status: ".$status." \n par le technicien $thechnicien" );
                if (!$success) {
                   // $errorMessage = error_get_last()['message'];
                    $_SESSION['message'][] = [
                        'text'=> "Erreur denvoi d'email",
                        'type'=>"error",
                        'title'=>"Error",
                    ];
                }else{
                    $_SESSION['message'][] = [
                        'text'=> "Lemail  à été envoyer à $nomcomplet avec succèss",
                        'type'=>"success",
                        'title'=>"Success",
                    ];
                }
                $sms_response = sendSms($tel,"Bonnjour $nomcomplet Votre demande de reclamation à été passé vers le status: ".$status." \n par le technicien $thechnicien");
                $sms_response = json_decode($sms_response,true);

                if ($sms_response['success'] != true ){
                    $_SESSION['message'][] = [
                        'text'=> $sms_response['error'],
                        'type'=>"error",
                        'title'=>"Error",
                    ];
                }else{
                    $_SESSION['message'][] = [
                        'text'=> "Lsms  à été envoyer à $nomcomplet avec succèss",
                        'type'=>"success",
                        'title'=>"Success",
                    ];
                }

                $_SESSION['message'][] = [
                    'text'=> " Modification effectuer avec succès",
                    'type'=>"success",
                    'title'=>"Success",
                ];
            } else {
                $_SESSION['message'][] = [
                    'text'=> "Le système à rencontrer un erreur veillez réssayer",
                    'type'=>"error",
                    'title'=>"Error",
                ];
            }
            header("Location: ?cl=technicien&mt=indexAction");
        }

    }
}