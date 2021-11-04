<?php

class Model{

    private static $_bdd;

    private static function setBdd(){
        self::$_bdd = new PDO('mysql:host=localhost;dbname=connexion;charset=utf8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public function getBdd(){
        if(self::$_bdd == null){
            self::setBdd();
            return self::$_bdd;
        }
    }

    public function getAll($table, $obj){
        $this->getBdd();
        $tab=[];
        $req = self::$_bdd->prepare('SELECT * FROM '.$table);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $tab[]=new $obj($data);
        }
        return $tab;
        $req->closeCursor();
    }

    public function getUserConnected($adresse, $mdp){
        $tab = $this->getAll('user', 'User');
        foreach($tab as $us){
            if ($us->getAdresse() == $adresse && $us->getMdp() == $mdp){
                return $us->getIdUser();
            }
        }  
    }

    public function getUser($table, $obj, $id){
        $this->getBdd();
        $tab=[];
        $req = self::$_bdd->prepare('SELECT * FROM '.$table.' WHERE idUser=?');
        $req->execute(array($id));

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $tab[]=new $obj($data);
        }
        $req->closeCursor();
        return $tab;
    }
}

?>