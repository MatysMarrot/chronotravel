<?php 

/**
 * Fonction permettant de logger des valeurs dans la session:
 * data: Array sous forme clé -> valeur où clé est le nom de la colonne du tableau
 */
    function log_session(array $data) : bool{

        $status = session_status();
        if ($status == PHP_SESSION_DISABLED){
            throw new Exception ("Sessions are disabled !");
        }
        //Je crois il l'évite si session none ?
        session_start();

        foreach($data as $key => $val){
            $_SESSION[$key] = $val;
        }
        return true;
        
    }





?>