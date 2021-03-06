<?php
namespace App\Model;
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:01
 */




class ReclamationModel extends Model
{

    private  $id;
    private  $user;
    private $objet;
    private $contenue;
    private $datereclamation;
    private $status;


    public function initialisation()
    {
        $data = [
            'id'=>' int(11) NOT NULL AUTO_INCREMENT',
            'status'=>' varchar(50)  NULL ',
            'objet'=>'  varchar(50) NOT NULL ',
            'contenue'=>'  text NOT NULL ',
            'datereclamation'=>'  DATETIME NOT NULL ',
            'user'=>' int(11) NOT NULL , FOREIGN KEY (user) REFERENCES user(id) '
            
        ];
        $this->_init_table("reclamation",$data); // TODO: Change the autogenerated stub
    }

    public function save(ReclamationModel $reclamationModel){
        $data = array_slice(get_object_vars($this), 1, 5);
       return $this->_genereSql($data,'reclamation');
    }


    public function getReclamationById($id)
    {
        $sql = "SELECT r.id, status, objet, contenue, datereclamation, u.username, u.email, u.nomcomplet, u.tel  FROM reclamation r LEFT JOIN user u ON (r.user = u.id) WHERE (r.id  = '$id')";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->_connection->errorInfo()[2], true));
        return $res->fetch();
    }
    public function getReclamationByUserId($id)
    {
        $sql = "SELECT r.id, status, objet, contenue, datereclamation, u.username, u.email, u.nomcomplet , u.tel FROM reclamation r LEFT JOIN user u ON (r.user = u.id) WHERE (u.id  = '$id')";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->_connection->errorInfo()[2], true));
        return $res->fetchAll();
    }

    public function getAllReclamation()
    {
        $sql = "SELECT r.id, status, objet, contenue, datereclamation, u.username, u.email, u.nomcomplet, u.tel  FROM reclamation r LEFT JOIN user u ON (r.user = u.id) ";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->_connection->errorInfo()[2], true));
        return $res->fetchAll();
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param mixed $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    /**
     * @return mixed
     */
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * @param mixed $contenue
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;
    }

    /**
     * @return mixed
     */
    public function getDatereclamation()
    {
        return $this->datereclamation;
    }

    /**
     * @param mixed $datereclamation
     */
    public function setDatereclamation($datereclamation)
    {
        $this->datereclamation = $datereclamation;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}