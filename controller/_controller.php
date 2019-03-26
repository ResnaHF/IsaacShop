<?php 
    class Controller{
        static $twig;
        
        static function run(){
            session_name('IsaacShop');
            session_start();
            
            $container = new \Slim\Container();
            $container['notFoundHandler'] = function ($c) {
                return function ($request, $response) use ($c) {
                    $_SESSION['infos'] = array(array(
                        'type' => 'INFO',
                        'message' => 'Page introuvable'
                    ));
                    return $response->withStatus(302)->withHeader('Location', '/');
                };  
            };
            $app = new \Slim\App($container, [
                'settings' => ['displayErrorDetails' => true]
            ]);
            
            Bootstrap::start();
            $loader = new Twig_Loader_Filesystem('templates');
            Controller::$twig = new Twig_Environment($loader, array( 'cache' => false ));
            Controller::$twig->getExtension(\Twig\Extension\CoreExtension::class)->setNumberFormat(0, '.', ' ');
                
            $app->get('/', 'WelcomeCtrl::GET');
            
            $app->get('/profil/', 'ProfilCtrl::Donnee_GET');
            $app->get('/profil/donnee/', 'ProfilCtrl::Donnee_GET');
            $app->post('/profil/donnee/', 'ProfilCtrl::Donnee_POST');
            $app->get('/profil/historique/', 'ProfilCtrl::Historique_GET');
            $app->get('/profil/delete/{verifyCode}', 'ProfilCtrl::delete');
            
            $app->get('/search/', 'SearchCtrl::GET');
            
            $app->get('/item/{id}', 'ItemCtrl::GET');
            $app->get('/item/plus/{id}', 'ItemCtrl::plus');
            $app->get('/item/minus/{id}', 'ItemCtrl::minus');
            $app->get('/item/remove/{id}', 'ItemCtrl::remove');
            $app->get('/item/set/{id}', 'ItemCtrl::set');
            
            $app->get('/item/create/', 'ItemCtrl::create_GET');
            $app->post('/item/create/', 'ItemCtrl::create_POST');
            $app->get('/item/modify/{id}', 'ItemCtrl::modify_GET');
            $app->post('/item/modify/{id}', 'ItemCtrl::modify_POST');
            $app->get('/item/delete/{id}/{verifyCode}', 'ItemCtrl::delete');
            
            $app->get('/cart/', 'CartCtrl::GET');
            $app->get('/cart/plus/{id}', 'CartCtrl::plus');
            $app->get('/cart/minus/{id}', 'CartCtrl::minus');
            $app->get('/cart/remove/{id}', 'CartCtrl::remove');
            $app->get('/cart/set/{id}', 'CartCtrl::set');
            
            $app->get('/admin/', 'AdminCtrl::GET');
            
            $app->get('/signup/', 'SignupCtrl::GET');
            $app->post('/signup/', 'SignupCtrl::POST');
            
            $app->get('/login/', 'LoginCtrl::GET');
            $app->post('/login/', 'LoginCtrl::POST');
            
            $app->get('/logout/', 'LogoutCtrl::GET');
            
            $app->run();    
        }
    
        static function defaultParams($pageName){
            $result = array();
            $result['page'] = $pageName;
            unset($_SESSION['verifyCode']);
            
            if (isset($_SESSION['idUsers'])){
                $result['isConnected'] = true;
                $result['idUsers'] = $_SESSION['idUsers'];
                $result['isAdmin'] = UsersDAO::isAdmin($_SESSION['idUsers']);
                
            }else{
                $result['isConnected'] = false;
                $result['isAdmin'] = false;
            }
            
            if(isset($_SESSION['idItem'])){
                $result['isItem'] = true;
                $result['idItem'] = $_SESSION['idItem'];
            }else{
                $result['isItem'] = false;
            }
            
            if(isset($_SESSION['cart'])){
                $result['isCart'] = true;
                $result['cart'] = $_SESSION['cart'];
            }else{
                $result['isCart'] = false;
            }
            
            if(isset($_SESSION['infos'])){
                $result['isInfo'] = true;
                $result['infos'] = $_SESSION['infos'];
                foreach($result['infos'] as $info){
                    if(isset($info['idt'])){
                        foreach($info['idt'] as $idt){
                            $result[$idt] = true;
                        }
                    }
                }
                unset($_SESSION['infos']);
            }else{
                $result['isInfo'] = false;
            }
            
            return $result;
        }

    }
?>