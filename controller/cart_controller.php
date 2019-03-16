<?php    
    function cart_controller ($request, $response, $args) { 
        global $twig; 
        $params = defaultParams('cart'); 
        $template = $twig ->loadTemplate ('cart.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>