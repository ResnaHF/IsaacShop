<?php
    class ProfilCtrl{
        static function GET ($request, $response, $args) { 
            global $twig;  
            $params = Controller::defaultParams('profil'); 
            $template = Controller::$twig -> loadTemplate ('profil.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>