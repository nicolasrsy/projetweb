<?php
require_once 'vue/View.php';



class Router{
	private $ctrl;
	private $view;

	public function routeReq(){
		try{
			spl_autoload_register(function($class){
				require_once('model/' .$class.'.php');
			});

			$url ='';
			if(isset($_GET['url'])){
				$url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
				$controller = ucfirst(strtolower($url[0]));

				$ctrlerClass = "Controller".$controller;
				$ctrlerFile = "controller/".$ctrlerClass.".php";
				if(file_exists($ctrlerFile)){
					require_once($ctrlerFile);
					$this->ctrl = new $ctrlerClass($url);
				} else{
					throw new \Exception("Page introuvable", 1);
				} 
			}
			else{
				require_once('controller/ControllerAccueil.php');
				$this->ctrl = new ControllerAccueil($url);
			}
			
		} catch (\Exception $e){
			$errMsg = $e->getMessage();
			$this->_view = new View('Error');
			$this->_view->generer(array('errMsg' =>$errMsg ));
			require_once('vue/viewError.php');
		}


	}


}












?>