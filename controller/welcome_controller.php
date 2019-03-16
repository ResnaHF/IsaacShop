<?php
    include_once 'dataAccesObject/ArticlesDAO.php';
    
    function welcome_controller($resquest,$response,$args) { 
        global $twig;
        $params = defaultParams('welcome');
        $params['randomList'] = ArticlesDAO::randomList(); 
        $template = $twig ->loadTemplate ('welcome.twig');    
        return $response->write( $template ->render ($params)); 
    }
?>