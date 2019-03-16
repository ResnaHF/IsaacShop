<?php
    class SearchCtrl{
        static function GET ($request, $response, $args) {
            $params = Controller::defaultParams('search'); 
            $template = Controller::$twig -> loadTemplate ('search.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>