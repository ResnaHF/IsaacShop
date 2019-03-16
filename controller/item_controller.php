<?php
    function item_controller ($request, $response, $args) { 
        global $twig;  
        $item = ArticlesDAO::getItem($args['id']);
        if(isset($_SESSION['nbCart'])){
            $_SESSION['nbCart'] += 1;
        }else{
            echo 'je set';
            $_SESSION['nbCart'] = 1;
        }
        if(isset($item)){
            $params = defaultParams('item'); 
            $_SESSION['idItem'] = $args['id'];
            $params['item'] = $item;
            $template = $twig ->loadTemplate ('item.twig');
            return $response->write( $template ->render ($params)); 
        }else{
            unset($_SESSION['idItem']);
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
?>