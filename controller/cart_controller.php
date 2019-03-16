<?php    
    class CartCtrl{
        static function GET ($request, $response, $args) { 
            if (isset($_SESSION['cart'])){
                $params = Controller::defaultParams('cart');
                $param['cart'] = $_SESSION['cart'] -> compute();
                $template = Controller::$twig -> loadTemplate ('cart.twig');    
                return $response->write( $template -> render ($params)); 
            }else{
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function plus($request, $response, $args) {
            if(isset($_SESSION['cart'])){
                $_SESSION['cart'] = $_SESSION['cart'] -> plus($args['id']);
                return $response->withStatus(302)->withHeader('Location', '/cart/');
            }else{
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
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
    }
?>