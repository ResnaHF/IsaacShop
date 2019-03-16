<?php
    function search_controller ($request, $response, $args) { 
        global $twig;  
        $params = defaultParams('search'); 
        $template = $twig ->loadTemplate ('search.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>