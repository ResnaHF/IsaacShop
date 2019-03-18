<?php
    class LoginCtrl{
        static function GET ($request, $response, $args) { 
            if(isset($_SESSION['idUsers'])){
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous êtes déjà connecté'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }else{
                $params = Controller::defaultParams('login'); 
                $template = Controller::$twig -> loadTemplate ('login.twig');    
                return $response->write( $template ->render ($params)); 
            }
        }
        
        static function POST($request, $response, $args) { 
            if(UsersDAO::login($_POST)){
                $_SESSION['infos'] = array(array(
                    'type' => 'SUCCES',
                    'message' => 'Vous êtes connecté'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'ERROR',
                    'message' => 'Identifiant ou mot de passe invalide'
                ));
                $params = Controller::defaultParams('login'); 
                $params['login'] = $_POST['login'];
                $template = Controller::$twig -> loadTemplate ('login.twig');  
                return $response->write( $template ->render ($params)); 
            }
        }
    }
?>