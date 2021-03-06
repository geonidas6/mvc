<?php
namespace App\Model;
use App\Config;

/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:01
 */




class UserModel extends Model
{

    private  $id;
    private  $username;
    private $nomcomplet;
    private $password;
    private $email;
    private $role;
    private $tel;

    public function initialisation()
    {
        $data = [
            'id'=>' int(11) NOT NULL AUTO_INCREMENT',
            'username'=>' text NOT NULL ',
            'password'=>'  varchar(100) NOT NULL ',
            'email'=>'  varchar(100) NOT NULL ',
            'nomcomplet'=>'  varchar(200) NOT NULL ',
            'tel'=>'  varchar(13) NOT NULL ',
            'role'=>' int(11) NOT NULL , FOREIGN KEY (role) REFERENCES role(id) '
            
        ];
        $this->_init_table("user",$data); // TODO: Change the autogenerated stub
    }

    public function save(UserModel $userModel){
        $data = array_slice(get_object_vars($this), 1, 6);
       return $this->_genereSql($data,'user');
    }

    public function getReclamationByEmailAndPassword($email,$password)
    {
        $sql = "SELECT u.id, u.username, u.nomcomplet, u.email, u.role , u.tel , r.libelle FROM user u LEFT JOIN role r ON (u.role = r.id) WHERE (u.email  = '$email' AND u.password  = '$password')";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->_connection->errorInfo()[2], true));
        return $res->fetchAll();
    }

    public function getReclamationByEmailAndUsername($email,$username)
    {
        $sql = "SELECT u.id, u.username, u.nomcomplet, u.email, u.role , u.tel , r.libelle FROM user u LEFT JOIN role r ON (u.role = r.id) WHERE (u.email  = '$email' AND u.username  = '$username')";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->_connection->errorInfo()[2], true));
        return $res->fetchAll();
    }

    public function getAll()
    {
        $technicien = Config::TECHNICIEN;

        $sql = "SELECT u.id, u.username, u.nomcomplet, u.email, u.role , u.tel , r.libelle FROM user u LEFT JOIN role r ON (u.role = r.id) WHERE (u.role  = '$technicien' )";
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getNomcomplet()
    {
        return $this->nomcomplet;
    }

    /**
     * @param mixed $nomcomplet
     */
    public function setNomcomplet($nomcomplet)
    {
        $this->nomcomplet = $nomcomplet;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }


}