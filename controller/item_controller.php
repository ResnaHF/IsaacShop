<?php
    class ItemCtrl{
        static function GET ($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($item)){ 
                $_SESSION['idItem'] = $args['id'];
                $params = Controller::defaultParams('item');
                $params['item'] = $item;
                $template = Controller::$twig -> loadTemplate ('item.twig');
                return $response->write( $template ->render ($params)); 
            }else{
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function plus($request, $response, $args) { 
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
        
        static function minus($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($item)){
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    $cart->minus($args['id']);
                    if($cart->getNumber() == 0){
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
        
        static function remove($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($item)){
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    $cart->remove($args['id']);
                    if($cart->getNumber() == 0){
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
    }
?>