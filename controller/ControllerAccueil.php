<?php 
require_once 'vue/View.php';

class ControllerAccueil{

	private $_model;
	private $_view;

	public function __construct(){
		if(isset($url) && count($url)>1){
			throw new \Exception("Page introuvable", 1);
		}else{
			$this->init();
		}

	}

	private function init(){
		if(isset($_GET['id'])){
		$this->_model = new Model();
		$user = $this->_model->getUser('user', 'User', $_GET['id']);
		$this->_view = new View('Accueil');
		$this->_view->generer(array('user' => $user ));
		}
	}
}

?>