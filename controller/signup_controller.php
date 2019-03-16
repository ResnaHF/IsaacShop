<?php
    function signUp_controller ($request, $response, $args) { 
        global $twig; 
        $params = defaultParams('signup');
        $template = $twig ->loadTemplate ('signup.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>