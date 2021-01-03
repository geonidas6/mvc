<?php
namespace App\Model;
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:01
 */




class RoleModel extends Model
{

    public  $id;
    public  $libelle;


    public function initialisation()
    {

        $data = [
            'id'=>' int(11) NOT NULL AUTO_INCREMENT',
            'libelle'=>'  varchar(100) NOT NULL ',
            
        ];
        //vd('test');exit();
        $this->_init_table("role",$data); // TODO: Change the autogenerated stub
        //insertion du role enseignant et technicien
        $resultat = $this->getRoleByLib();

        if(count($resultat) == 0){
            $this->_genereSql(["libelle"=>"enseignant"],'role');
            $this->_genereSql(["libelle"=>"technicien"],'role');
        }
      
    }

    public function save(RoleModel $roleModel){
        $data = array_slice(get_object_vars($this), 1,1);
       return $this->_genereSql($data,'role');
    }

    public function getRoleByLib()
    {
        $sql = "SELECT * FROM role WHERE libelle IN ('enseignant','technicien')";
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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }


}