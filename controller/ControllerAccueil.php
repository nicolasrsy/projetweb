<?php 
require_once 'vue/View.php';

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