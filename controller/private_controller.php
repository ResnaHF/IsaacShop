<?php
    class PrivateCtrl{
        static function POST ($request, $response, $args) { 
            UsersDAO::create($_POST);
            
            $params = Controller::defaultParams('private'); 
            $template = Controller::$twig -> loadTemplate ('private.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>