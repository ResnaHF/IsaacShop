<?php
    class SignupCtrl{
        static function GET ($request, $response, $args) {
            $params = Controller::defaultParams('signup');
            $template = Controller::$twig -> loadTemplate ('signup.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>