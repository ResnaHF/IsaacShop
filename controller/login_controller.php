<?php
    class LoginCtrl{
        static function GET ($request, $response, $args) { 
            $params = Controller::defaultParams('login'); 
            $template = Controller::$twig -> loadTemplate ('login.twig');    
            return $response->write( $template ->render ($params)); 
        }
        
        static function POST($request, $response, $args) { 
            if(UsersDAO::login($_POST)){
                return $response->withStatus(302)->withHeader('Location', '/');
            }else{
                $params = Controller::defaultParams('login'); 
                $template = Controller::$twig -> loadTemplate ('login.twig');  
                return $response->write( $template ->render ($params)); 
            }
        }
    }
?>