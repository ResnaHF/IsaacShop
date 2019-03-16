<?php    
    class CartCtrl{
        static function GET ($request, $response, $args) { 
            $params = Controller::defaultParams('cart'); 
            $template = Controller::$twig -> loadTemplate ('cart.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>