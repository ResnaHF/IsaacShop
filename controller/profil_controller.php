<?php
    function profil_controller ($request, $response, $args) { 
        global $twig;  
        $params = defaultParams('profil'); 
        $template = $twig ->loadTemplate ('profil.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>