<?php 
    class Controller{
        static $twig;
        
        static function run(){
            session_name('IsaacShop');
            session_start();
            $app= new \Slim\App([
                'settings' => ['displayErrorDetails' => true]
            ]);
            Bootstrap::start();
            $loader = new Twig_Loader_Filesystem('templates');
            Controller::$twig = new Twig_Environment($loader, array( 'cache' => false ));
                
            $app->get('/', 'WelcomeCtrl::GET');
            $app->get('/signup/', 'SignupCtrl::GET');
            $app->get('/profil/', 'ProfilCtrl::GET');
            $app->post('/validate/', 'PrivateCtrl::POST');
            $app->get('/admin/', 'AdminCtrl::GET');
            $app->get('/search/', 'SearchCtrl::GET');
            
            $app->get('/login/', 'LoginCtrl::GET');
            $app->post('/login/', 'LoginCtrl::POST');
            
            $app->get('/logout/', 'LogoutCtrl::GET');
            
            $app->get('/item/{id}', 'ItemCtrl::GET');
            $app->get('/item/plus/{id}', 'ItemCtrl::plus');
            $app->get('/item/minus/{id}', 'ItemCtrl::minus');
            $app->get('/item/remove/{id}', 'ItemCtrl::remove');
            
            $app->get('/cart/', 'CartCtrl::GET');
            $app->run();    
        }
    
        static function defaultParams($pageName){
            $result = array();
            $result['page'] = $pageName;
            
            if (isset($_SESSION['id'])){
                $result['connected'] = true;
                $result['idUsers'] = $_SESSION['id'];
                $result['admin'] = false;
                
            }else{
                $result['connected'] = false;
                $result['admin'] = false;
            }
            
            if(isset($_SESSION['idItem'])){
                $result['item'] = true;
                $result['idItem'] = $_SESSION['idItem'];
            }else{
                $result['item'] = false;
            }
            
            if(isset($_SESSION['cart'])){
                $result['isCart'] = true;
                $result['cart'] = $_SESSION['cart'];
            }else{
                $result['isCart'] = false;
            }
            
            return $result;
        }

    }
?>