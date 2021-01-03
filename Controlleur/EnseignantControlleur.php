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



class EnseignantControlleur extends Controlleur
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
        $vars['titre'] = 'Interface Enseignant';
        $vars['app_user'] = $_SESSION['user_app'];
        $user_id = $_SESSION['user_app']['id'];
        $vars['list_recl'] =  $this->reclamationModel->getReclamationByUserId($user_id);



        render(Config::VIEW_PATH . "enseignant/dashboard.php", $vars);
    }

    public function addaction()
    {
        $data = $_REQUEST['data'];
        if ($data != null) {
            if (!valid_textarea($data['contenue'])) {
                $_SESSION['message'][] = [
                    'text' => "Verifier le champs contenue",
                    'type' => "error",
                    'title' => "Error",
                ];
                $this->error = true;
            }
            if (!valid_input($data['objet'])) {
                $_SESSION['message'][] = [
                    'text' => "Verifier le champs objet",
                    'type' => "error",
                    'title' => "Error",
                ];
                $this->error = true;
            }


            if ($this->error == true) {
                header("Location: ?cl=enseignant&mt=indexAction");
                exit();
            }

            $this->reclamationModel->setUser(intval($_SESSION['user_app']['id']));
            $this->reclamationModel->setStatus(null);
            $this->reclamationModel->setContenue($data['contenue']);
            $this->reclamationModel->setObjet($data['objet']);
            $this->reclamationModel->setDatereclamation(date("Y-m-d H:i:s"));

            $reponse = $this->reclamationModel->save($this->reclamationModel);

            if ($reponse == true) {

                $resultat = $this->userModele->getAll();

                if (count($resultat) > 0){
                   $tech_info = $resultat[ array_rand($resultat)];
                    $nomcomplet = $tech_info['nomcomplet'];
                    $email = $tech_info['email'];
                    $tel = $tech_info['tel'];
                    $enseignant =  $_SESSION['user_app']['nomcomplet'];
                    $success = mail($email, "Demande de reclamation", "Une reclamation à été créer par l'enseignant $enseignant" );
                    if (!$success) {
                        // $errorMessage = error_get_last()['message'];
                        $_SESSION['message'][] = [
                            'text'=> "Erreur d'envoi d'email",
                            'type'=>"error",
                            'title'=>"Error",
                        ];
                    }else{
                        $_SESSION['message'][] = [
                            'text'=> "L'email  à été envoyer à $nomcomplet avec succèss",
                            'type'=>"success",
                            'title'=>"Success",
                        ];
                    }
                    $sms_response = sendSms($tel,"Bonnjour $nomcomplet Une demande de reclamation vien d'être envoyer par $enseignant");
                    $sms_response = json_decode($sms_response,true);

                    if ($sms_response['success'] != true ){
                        $_SESSION['message'][] = [
                            'text'=> $sms_response['error'],
                            'type'=>"error",
                            'title'=>"Error",
                        ];
                    }else{
                        $_SESSION['message'][] = [
                            'text'=> "L'sms  à été envoyer à $nomcomplet avec succèss",
                            'type'=>"success",
                            'title'=>"Success",
                        ];
                    }
                }else{
                    $_SESSION['message'][] = [
                        'text'=> "Il n'y aucun technicien dans le système",
                        'type'=>"error",
                        'title'=>"Error",
                    ];
                }




                $_SESSION['message'][] = [
                    'text' => "Creation de la réclamation  effectuer avec succès",
                    'type' => "success",
                    'title' => "Success",
                ];
            } else {
                $_SESSION['message'][] = [
                    'text' => "Echec création de la réclamation",
                    'type' => "error",
                    'title' => "Error",
                ];

            }

            header("Location: ?cl=enseignant&mt=indexAction");
        }
    }



}