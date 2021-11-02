<?php 
require_once 'vue/View.php';


class ControllerConnexion{

   
    private $_entrepriseManager;
	private $_view;

	public function __construct(){
		if(isset($url) && count($url) < 1){
			throw new \Exception("Page introuvable", 1);
		
        }
        elseif(isset($_GET['submit']))
        {
            $this->_entrepriseManager = new EntrepriseManager();
            
            if(($id=$this->_entrepriseManager->getEntreprise($_POST['email'], $_POST['mdp']))){
                $this->_vehiculeManager = new VehiculeManager();
                $vehicules = $this->_vehiculeManager->getVehiculesEnt($id);
                
                

                $dispo = $this->_vehiculeManager->getVehiculesDispo();
               
                
                $entreprise = $this->_entrepriseManager->getOneEntreprise($id);
                $this->_view = new View('Entreprise');
                $this->_view->generer(array('entreprise' => $entreprise, 'vehicules' => $vehicules, 'dispo' =>$dispo ));
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