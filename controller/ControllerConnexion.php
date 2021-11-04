<?php 
require_once 'view/View.php';


class ControllerConnexion{
    private $_model;
	private $_view;

	public function __construct(){
		if(isset($url) && count($url) < 1){
			throw new \Exception("Page introuvable", 1);
        }
        elseif(isset($_GET['submit']))
        {
            $this->_model = new Model();
            if(($id=$this->_model->getUserConnected($_POST['adresse'], $_POST['mdp']))){
                
                $user = $this->_model->getUser('user','User',$id);
                $this->_view = new View('Accueil');
                $this->_view->generer(array('user' => $user));
            }
            else{
                $this->connectError();
            }
        }
        else{
			$this->connect();
		}
	}

	private function connect(){
        $msg = "Entrez vos identifiants";
        $this->_view = new View('Connexion');
        $this->_view->generer(array('msg' => $msg));  
    }

    private function connectError(){
        $msg = "Mauvais mot de passe ou email";
        $this->_view = new View('Connexion');
        $this->_view->generer(array('msg' => $msg ));  
    }
}
?>