<?php
    class AdminCtrl{
        static function GET ($request, $response, $args) {  
            $params = Controller::defaultParams('admin'); 
            $template = Controller::$twig -> loadTemplate ('admin.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }

?>