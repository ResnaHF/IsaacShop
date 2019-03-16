<?php
    function item_controller ($request, $response, $args) { 
        global $twig;
        $item = ArticlesDAO::getItem($args['id']);
        if(isset($item)){
            $params = defaultParams('item'); 
            $_SESSION['idItem'] = $args['id'];
            $params['item'] = $item;
            $template = $twig ->loadTemplate ('item.twig');
            return $response->write( $template ->render ($params)); 
        }else{
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
    
    function item_plus_controller($request, $response, $args) { 
        global $twig;  
        $item = ArticlesDAO::getItem($args['id']);
        if(isset($item)){
            if(!isset($_SESSION['cart'])){
                $cart = new Cart();
            }else{
                $cart = $_SESSION['cart'];
            }
            $cart->plus($args['id']);
            $_SESSION['cart'] = $cart;
            return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
        }else{
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
    
    function item_minus_controller($request, $response, $args) { 
        global $twig;  
        $item = ArticlesDAO::getItem($args['id']);
        if(isset($item)){
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $cart->minus($args['id']);
                if($cart->getTotal() == 0){
                    unset($_SESSION['cart']);
                }else{
                    $_SESSION['cart'] = $cart;
                }
            }
            return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
        }else{
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
    
    function item_remove_controller($request, $response, $args) { 
        global $twig;  
        $item = ArticlesDAO::getItem($args['id']);
        if(isset($item)){
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $cart->remove($args['id']);
                if($cart->getTotal() == 0){
                    unset($_SESSION['cart']);
                }else{
                    $_SESSION['cart'] = $cart;
                }
            }
            return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
        }else{
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
?>