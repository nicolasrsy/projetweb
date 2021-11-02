<?php

class View{
    private $_file;
    private $_t;
    
    function __construct($action){
        $this->_file= 'vue/view'.$action.'.php';

    }

    public function generer($data){
        $contenu = $this->genererFic($this->_file, $data);

        $vue = $this->genererFic('vue/temp.php', array('t' => $this->_t, 'content' => $contenu));
        echo $vue;
    }

    private function genererFic($fic, $data){
        if(file_exists($fic)){
            extract($data);

            ob_start();

            require $fic;
            return ob_get_clean();
        }else{
            throw new \Exception("fichier ".$fic." introuvable", 1);
        }
    }

    
}



?>