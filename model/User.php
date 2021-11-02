<?php


class User {

    private $_idUser;
    private $_nom;
    private $_prenom;
    private $_mdp;
    private $_email;

    public function __construct(array $data){

        $this->remplir($data);
    }
    
    public function remplir(array $data){
        foreach ($data as $key => $value){
            $methode = 'set'.ucfirst($key);
            if(method_exists($this, $methode)){
                $this->$methode($value);
            }
        }
    }
    
    public function setIdUser($id){
        if($id > 0){
            $this->_idEnt = $id;
        }
    }

    public function setNom($nom){
        if(is_string($nom)){
            $this->_nom= $nom;
        }
    }
    public function setPrenom($prenom){
        if(is_string($prenom)){
            $this->_prenom= $prenom;
        }
    }

    public function setMdp($mdp){
        if(is_string($mdp)){
            $this->_mdp = $mdp;
        }
    }

    public function setEmail($mail){
        if(is_string($mail)){
            $this->_email = $mail;
        }
    }


    public function getIdUser(){
        return $this->_idUser;
    }

    public function getNom(){
        return $this->_nom;
    }

    public function getMdp(){
        return $this->_mdp;
    }

    public function getEmail(){
        return $this->_email;
    }
}





?>