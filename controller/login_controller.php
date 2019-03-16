<?php
    function login_get_controller ($request, $response, $args) { 
        global $twig;  
        $params = defaultParams('login'); 
        $template = $twig ->loadTemplate ('login.twig');    
        return $response->write( $template ->render ($params)); 
    }
    
    function login_post_controller($request, $response, $args) { 
        global $twig;  
        
        if(UsersDAO::login($_POST)){
            return $response->withStatus(302)->withHeader('Location', '/');
        }else{
            $params = defaultParams('login'); 
            $template = $twig ->loadTemplate ('login.twig');  
            return $response->write( $template ->render ($params)); 
        }
    }
?>