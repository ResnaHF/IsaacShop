<?php
    function admin_controller ($request, $response, $args) { 
        global $twig;  
        $params = defaultParams('admin'); 
        $template = $twig ->loadTemplate ('admin.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>