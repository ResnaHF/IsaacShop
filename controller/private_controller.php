<?php
    include_once 'dataAccesObject/UsersDAO.php';

    function private_controller ($request, $response, $args) { 
        global $twig;  
        
        UsersDAO::create($_POST);
        
        $params = defaultParams('private'); 
        $template = $twig ->loadTemplate ('private.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>