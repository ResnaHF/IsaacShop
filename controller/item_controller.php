<?php
    class ItemCtrl{
        static function GET ($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($item)){ 
                $_SESSION['idItem'] = $args['id'];
                $params = Controller::defaultParams('item');
                $params['item'] = $item;
                $params['nbInCart'] = isset($params['cart'])?$params['cart']->getNumberItem($item->getId()):0;
                $params['verifyCode'] = $_SESSION['verifyCode'] = rand(1000000,999999999);
                $template = Controller::$twig -> loadTemplate ('item.twig');
                return $response->write( $template ->render ($params)); 
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Cet article n\'existe pas'
                ));
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
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Cet article n\'existe pas'
                ));
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
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Cet article n\'existe pas'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function set($request, $response, $args) { 
            $item = ArticlesDAO::getItem($args['id']);
            if(isset($item)){
                if(isset($_SESSION['cart']) && isset($_GET['nb']) && (int)$_GET['nb'] >= 0){
                    $cart = $_SESSION['cart'];
                    $cart->set($args['id'], (int)$_GET['nb']);
                    if($cart->getNumber() == 0){
                        unset($_SESSION['cart']);
                    }else{
                        $_SESSION['cart'] = $cart;
                    }
                }
                return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Cet article n\'existe pas'
                ));
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
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Cet article n\'existe pas'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function create_GET($request, $response, $args) { 
            $params = Controller::defaultParams('item');
            if($params['isAdmin']){
                $template = Controller::$twig -> loadTemplate ('item_create.twig');
                return $response->write( $template ->render ($params)); 
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/search/');
            }
        }
        
        static function create_POST($request, $response, $args) { 
            $params = Controller::defaultParams('item');
            if($params['isAdmin']){
                $idItem = ArticlesDAO::create($_POST);
                $_SESSION['infos'] = array(array(
                    'type' => 'SUCCES',
                    'message' => 'Article créé'
                ));
                return $response->withStatus(302)->withHeader('Location', '/item/'.$idItem);
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/search/');
            }
        }
        
        static function modify_GET($request, $response, $args) { 
            $params = Controller::defaultParams('item');
            if($params['isAdmin']){
                $params['item'] = ArticlesDAO::getItem($args['id']);
                if(isset($params['item'])){
                    $template = Controller::$twig -> loadTemplate ('item_modify.twig');
                    return $response->write( $template ->render ($params)); 
                }else{
                    $_SESSION['infos'] = array(array(
                        'type' => 'INFO',
                        'message' => 'Cet article n\'existe pas'
                    ));
                    return $response->withStatus(302)->withHeader('Location', '/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
            }
        }
        
        static function modify_POST($request, $response, $args) { 
            $params = Controller::defaultParams('item');
            if($params['isAdmin']){
                $params['item'] = ArticlesDAO::getItem($args['id']);
                if(isset($params['item'])){
                    ArticlesDAO::update($args['id'], $_POST);
                    $_SESSION['infos'] = array(array(
                        'type' => 'SUCCES',
                        'message' => 'Vous avez modifié cet article'
                    ));
                    $template = Controller::$twig -> loadTemplate ('item_modify.twig');
                    return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
                }else{
                    $_SESSION['infos'] = array(array(
                        'type' => 'INFO',
                        'message' => 'Cet article n\'existe pas'
                    ));
                    return $response->withStatus(302)->withHeader('Location', '/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
            }
        }
        
        static function delete($request, $response, $args) {
            $verifyCode = $_SESSION['verifyCode'];
            $params = Controller::defaultParams('item');
            if($params['isAdmin']){
                $params['item'] = ArticlesDAO::getItem($args['id']);
                if(isset($params['item'])){
                    if(isset($verifyCode) && $verifyCode == $args['verifyCode']){
                        ArticlesDAO::remove($args['id']);
                        $_SESSION['infos'] = array(array(
                            'type' => 'SUCCES',
                            'message' => 'article supprimé'
                        ));
                        return $response->withStatus(302)->withHeader('Location', '/search/');
                    }else{
                        $_SESSION['infos'] = array(array(
                            'type' => 'ERROR',
                            'message' => 'clé de validation invalide'
                        ));
                        return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
                    }
                }else{
                    $_SESSION['infos'] = array(array(
                        'type' => 'INFO',
                        'message' => 'Cet article n\'existe pas'
                    ));
                    return $response->withStatus(302)->withHeader('Location', '/');
                }
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/item/'.$args['id']);
            }
        }
    }
?>