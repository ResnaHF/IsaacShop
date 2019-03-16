<?php
    class WelcomeCtrl{
        static function GET($resquest,$response,$args) { 
            global $twig;
            $params = Controller::defaultParams('welcome');
            $params['randomList'] = ArticlesDAO::randomList(); 
            $template = Controller::$twig -> loadTemplate ('welcome.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>