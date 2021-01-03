<?php
namespace App\Model;
use App\Config;

/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 11/06/2019
 * Time: 14:08
 */



class Model
{
    private static $_instance;
    var $_connection;
    private $DB_host = Config::DB_HOST;
    private $DB_user_name = Config::DB_USER;
    private $DB_user_password = Config::DB_PASSWORD;
    private $DB_driver = Config::DB_DRIVER;
    private $DB_database = Config::DB_NAME;

    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            }else{
                return self::$_instance;
            }
        } catch (Exception $e) {
            return self::class;
        }
    }

    function __construct()
    {
        $this->_init_db();
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {
                $this->_connection = new \PDO($this->DB_driver.':host='.$this->DB_host.';dbname='.$this->DB_database, $this->DB_user_name, $this->DB_user_password,array(
                    \PDO::ATTR_PERSISTENT => true));
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }
    }

    public function connect()
    {
        return $this->_connection ? $this->_connection : null;
    }






    function _init_table( $table,$data = [])
    {
        $_propiety = '';
        foreach ($data as $champ => $valeur) {
            $_propiety .= '`'.$champ.'`' .$valeur.',';
        }

        $sql = "CREATE TABLE IF NOT EXISTS  `".$table."` 
        ($_propiety PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1  AUTO_INCREMENT=1 ;";


        $res = $this->_connection->exec($sql);

        if ($res == false) {
            logFile("DB _generesql - ajout -$sql :".$this->_connection->errorInfo()[2]);
            return false;
        }
        return true;
    }


    function _init_db( )
    {
        $pdo = new \PDO("mysql:host=localhost", Config::DB_USER, Config::DB_PASSWORD);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $dbname = "`".str_replace("`","``",Config::DB_NAME)."`";
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $pdo->query($sql);
        $res = $pdo->query("use $dbname");
        if ($res == false) {
            logFile("DB _generesql - ajout -$sql :".$this->_connection->errorInfo()[2]);
            return false;
        }
        return true;
    }


    /**
     *  Genere une requete sql du type
     *  insert - update - delete
     * @param $data
     * @param $table
     * @param string $where
     * @param string $type
     * @return bool
     */
    function _genereSql($data, $table, $where = '', $type = 'insert')
    {
        if ($type == 'insert') {
            foreach ($data as $champ => $valeur) {
                $tab_chps[] = $champ;
                $tab_val[] = $valeur;
            }
            $chaine_chps = _tableauToChaine($tab_chps, ', ');
            $chaine_vals = _tableauToChaine($tab_val, ', ', '"');
            $sql = "INSERT INTO $table ($chaine_chps) VALUES ($chaine_vals)";
            $res = $this->_connection->query($sql);
            if ($res == false) {
                logFile("DB _generesql - ajout -$sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }
        if ($type == 'update') {
            $taille = count($data); // pr placer la virgule de separation quand necessaire
            $i = 0;
            $sql_ = '';
            foreach ($data as $champ => $valeur) {
                $sql_ .= " $champ= \"$valeur\" ";
                if ($i < $taille - 1) {
                    $sql_ .= ", ";
                }
                $i++;
            }

            $sql = " UPDATE $table SET $sql_ $where ";
            $res = $this->_connection->query($sql);
            if ($res == false) {
                logFile("DB _generesql - update - $sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }
        if ($type == 'delete') {
            $sql = " DELETE FROM $table $where ";
            $res = $this->_connection->query($sql);
            if ($res == false) {
                logFile("DB _generesql - delete -$sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }

    }



}