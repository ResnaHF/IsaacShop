<?php    
    class CartCtrl{
        static function GET ($request, $response, $args) { 
            if (isset($_SESSION['cart'])){
                $params = Controller::defaultParams('cart');
                $param['cart'] = $_SESSION['cart'] -> compute();
                if($param['cart']->getNumber() > 0){
                    $template = Controller::$twig -> loadTemplate ('cart.twig');    
                    return $response->write( $template -> render ($params)); 
                }else{
                    unset($_SESSION['cart']);
                    return $response->withStatus(302)->withHeader('Location', '/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Votre panier est vide'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function plus($request, $response, $args) {
            if(isset($_SESSION['cart'])){ 
                $item = ArticlesDAO::getItem($args['id']);
                if(isset($item)){
                    $_SESSION['cart'] = $_SESSION['cart'] -> plus($args['id']);
                }
                return $response->withStatus(302)->withHeader('Location', '/cart/');
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Votre panier est vide'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function minus($request, $response, $args) { 
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'] -> minus($args['id']);
                if($cart->getNumber() == 0){
                    unset($_SESSION['cart']);
                    return $response->withStatus(302)->withHeader('Location', '/');
                }else{
                    $_SESSION['cart'] = $cart;
                    return $response->withStatus(302)->withHeader('Location', '/cart/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Votre panier est vide'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function set($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($_SESSION['cart'])){
                if(isset($item) && isset($_GET['nb']) && (int)$_GET['nb'] >= 0){
                    $cart = $_SESSION['cart'];
                    $cart->set($args['id'], (int)$_GET['nb']);
                    if($cart->getNumber() == 0){
                        unset($_SESSION['cart']);
                        return $response->withStatus(302)->withHeader('Location', '/');
                    }else{
                        $_SESSION['cart'] = $cart;
                    }
                }
                return $response->withStatus(302)->withHeader('Location', '/cart/');
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Votre panier est vide'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function remove($request, $response, $args) { 
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'] -> remove($args['id']);
                if($cart->getNumber() == 0){
                    unset($_SESSION['cart']);
                    return $response->withStatus(302)->withHeader('Location', '/');
                }else{
                    $_SESSION['cart'] = $cart;
                    return $response->withStatus(302)->withHeader('Location', '/cart/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Votre panier est vide'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
    }
?>