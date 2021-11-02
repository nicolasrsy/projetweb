<?php 
require_once 'vue/View.php';
/*controleur c2.php :
  fonctions-action de gestion (c2) 


function a21() {
	require ("modele/m2.php"); 	

	require ("./vue/c2/a21.tpl"); 
}*/

class ControllerAccueil{

	private $_vehiculeManager;
	private $_view;

	public function __construct(){
		if(isset($url) && count($url)>1){
			throw new \Exception("Page introuvable", 1);
		}else{
			$this->vehicules();
		}

	}

	private function vehicules(){
		$this->_vehiculeManager = new VehiculeManager();
		$vehicules = $this->_vehiculeManager->getAllVehicules();
		$this->_view = new View('Accueil');
		$this->_view->generer(array('vehicules' => $vehicules ));
		
	}
}

?>