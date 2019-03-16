<?php
    function logout_controller ($request, $response, $args) { 
        global $twig;  
        unset($_SESSION['id']);
        $params = defaultParams('logout'); 
        return $response->withStatus(302)->withHeader('Location', '/');
    }
?>