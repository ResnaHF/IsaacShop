<?php 
    require_once 'vendor/autoload.php';
    require 'bootstrap.php';
    
    session_name('IsaacShop');
    session_start();
    $app= new \Slim\App([
        'settings' => ['displayErrorDetails' => true]
    ]);
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array( 'cache' => false ));

    function defaultParams($pageName){
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
        
        if(isset($_SESSION['nbCart'])){
            $result['value'] = 'nbCart : '.$_SESSION['nbCart'];
            $result['cart'] = true;
            $result['nbCart'] = $_SESSION['nbCart'];
        }else{
            $result['value'] = 'noCart';
            $result['cart'] = false;
        }
        
        return $result;
    }
    
    require 'signUp_controller.php';
    require 'welcome_controller.php';
    require 'private_controller.php';
    require 'profil_controller.php';
    require 'admin_controller.php';
    require 'search_controller.php';
    require 'login_controller.php';
    require 'logout_controller.php';
    require 'item_controller.php';
    require 'cart_controller.php';

    $app->get('/', welcome_controller);
    $app->get('/signup/', signUp_controller);
    $app->get('/profil/', profil_controller);
    $app->post('/validate/', private_controller);
    $app->get('/admin/', admin_controller);
    $app->get('/search/', search_controller);
    
    $app->get('/login/', login_get_controller);
    $app->post('/login/', login_post_controller);
    
    $app->get('/logout/', logout_controller);
    
    $app->get('/item/{id}', item_controller);
    
    $app->get('/cart/', cart_controller);
    $app->run();    
?>