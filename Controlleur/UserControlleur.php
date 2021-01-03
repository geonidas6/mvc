<?php


namespace App\Controlleur;


use App\Config;
use App\Model\UserModel;
use App\Model\RoleModel;


class UserControlleur extends Controlleur
{

    private $error = false;
    private $userModele;
    private $roleModele;

    public function __construct()
    {


        $this->roleModele = new RoleModel();
        $this->roleModele->initialisation();

        $this->userModele = new UserModel();
        $this->userModele->initialisation();



    }

    public function loginAction(){

        $data =(isset($_REQUEST['data']))?$_REQUEST['data']:null;

        if ($data != null) {
            //
            if (!valid_input($data['email'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs email",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if (!valid_input($data['password'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs password",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }

            if ($this->error == true){
                header("Location: ?login");
                exit();
            }
            $password = md5($data['password']);
            $email = $data['email'];

            $resultat = $this->userModele->getReclamationByEmailAndPassword($email,$password);
            //fetchALL donne [] quand c'est vide
            if (count($resultat) == 1) {
                $resultat =  $resultat[0];
                $_SESSION['message'][] = [
                    'text'=>  "Connexion effectuer avec succès",
                    'type'=>"success",
                    'title'=>"Success",
                ];

                $_SESSION['user_app'] = [
                    'id'=>$resultat['id'],
                    'username'=> $resultat['username'],
                    'nomcomplet'=>$resultat['nomcomplet'],
                    'email'=>$resultat['email'],
                    'role'=> $resultat['role'],
                    'tel'=> $resultat['tel']
                ];
                if ( $resultat['role'] ==  Config::ENSEIGNANT){
                    header("Location: ?cl=enseignant&mt=indexAction");
                    exit();
                }
                if ( $resultat['role'] ==  Config::TECHNICIEN){
                    header("Location: ?cl=technicien&mt=indexAction");
                    exit();
                }
                exit;
            } else {
                $_SESSION['message'][] = [
                    'text'=> "Le système à rencontrer un erreur veillez réssayer,Email ou mot de passe incorect",
                    'type'=>"error",
                    'title'=>"Error",
                ];
            }
            header("Location: ?cl=user&mt=loginAction");
            exit();
        }
       render(Config::VIEW_PATH. "login/login.php");
    }

    function  deconnexionAction(){
        unset($_SESSION);
        session_destroy ();
        $_SESSION['message'][] = [
            'text'=>  "Déconnexion effectuer avec succès",
            'type'=>"success",
            'title'=>"Success",
        ];


        header("Location: ?cl=user&mt=loginAction");
    }


    public function addaction(){
        $data = $_REQUEST['data'];
        if ($data != null){
            if (!valid_input($data['username'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs username",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if (!valid_input($data['role'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs role",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if (!valid_input($data['password'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs password",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }if (!valid_input($data['password_cnf'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs password",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if ($data['password_cnf'] !== $data['password']){
                $_SESSION['message'][] = [
                    'text'=>"Mot de passe saisis ne conrespond pas réssayer!",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if (!valid_input($data['nomcomplet'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs nomcomplet",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if (!valid_phone($data['tel'])){
                $_SESSION['message'][] = [
                    'text'=>"Verifier le champs tel",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                $this->error = true;
            }
            if ($this->error == true){
                header("Location: ?cl=user&mt=loginAction#signup");
                exit();
            }
            //verification du username et de l'email 
            $email = $data['email'];
            $username = $data['username'];
            $resultat = $this->userModele->getReclamationByEmailAndUsername($email,$username);
           
            if(count($resultat)>0){
                $_SESSION['message'][] = [
                    'text'=>"cette email est existe deja veullier entrer un autre adress email !",
                    'type'=>"error",
                    'title'=>"Error",
                ];
                header("Location: ?cl=user&mt=loginAction#signup");
                exit();
            }

            $this->userModele->setUsername($data['username']) ;
            $this->userModele->setPassword( md5($data['password'])) ;
            $this->userModele->setEmail($data['email']) ;
            $this->userModele->setNomcomplet(ucfirst($data['nomcomplet'])) ;
            $this->userModele->setRole(intval($data['role'])) ;
            $this->userModele->setTel($data['tel']) ;
            $reponse = $this->userModele->save($this->userModele);

            if ($reponse == true){
                $_SESSION['message'][] = [
                    'text'=> "Creation de compte effectuer avec succès",
                    'type'=>"success",
                    'title'=>"Success",
                ];
            }else{
                $_SESSION['message'][] = [
                    'text'=> "Echec création de l'utilisateur ",
                    'type'=>"error",
                    'title'=>"Error",
                ];

            }
            header("Location: ?cl=user&mt=loginAction");
        }
    }

}