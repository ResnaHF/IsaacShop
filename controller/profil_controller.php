<?php
    class ProfilCtrl{
        
        static function Donnee_GET ($request, $response, $args) { 
            $params = Controller::defaultParams('profil');
            if(isset($params['idUsers'])){
                $user = UsersDAO::getUser($params['idUsers']);
                
                $params['login'] = $user->getLogin();
                $params['mail'] = $user->getMail();
                $params['lastname'] = $user->getLastname();
                $params['firstname'] = $user->getFirstname();
                $params['adress'] = $user->getAdress();;
                $params['postalCode'] = $user->getPostalcode();
                $params['city'] = $user->getCity();
                $params['phone'] = $user->getPhone();
                $params['news'] = $user->getNews();
                
                $template = Controller::$twig -> loadTemplate ('profil_donnee.twig');    
                return $response->write( $template ->render ($params)); 
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous devez être connecté pour accéder à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function Donnee_POST ($request, $response, $args) {
            if(isset($_SESSION['idUsers'])){
                $user = UsersDAO::getUser($_SESSION['idUsers']);
                if(ProfilCtrl::verify($_POST, $user)){
                    UsersDAO::update($_SESSION['idUsers'], $_POST);
                }
                
                $params = Controller::defaultParams('profil'); 
                $params['login'] = $user->getLogin();
                $params['mail'] = $user->getMail();
                $params['password1'] = $_POST['password1'];
                $params['password2'] = $_POST['password2'];
                $params['lastname'] = $_POST['lastname'];
                $params['firstname'] = $_POST['firstname'];
                $params['adress'] = $_POST['adress'];
                $params['postalCode'] = $_POST['postalCode'];
                $params['city'] = $_POST['city'];
                $params['phone'] = $_POST['phone'];
                $params['news'] = $_POST['news'];
                
                $template = Controller::$twig -> loadTemplate ('profil_donnee.twig');    
                return $response->write( $template ->render ($params)); 
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous devez être connecté pour accéder à cette page'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
        
        static function verify($post, $user){
            $infos = array();
            
            if($post['password1'] !== $post['password2']){
                array_push($infos, array(
                    'type' => 'ERROR',
                    'message' => 'Les mots de passes ne coïncident pas',
                    'idt' => array('ErrPwd1', 'ErrPwd2')
                ));
            }
            
            if(count($infos) > 0){
                $_SESSION['infos'] = $infos; 
                return false;
            }else{
                
                if(!empty($post['password1']) && $post['password1'] != $user->getPassword()){
                    $infos = ProfilCtrl::addId($infos, 'SucPwd1');
                }
                
                if($post['lastname'] != $user->getLastname()){
                    $infos = ProfilCtrl::addId($infos, 'SucLname');
                }
                
                if($post['firstname'] != $user->getFirstname()){
                    $infos = ProfilCtrl::addId($infos, 'SucFname');
                }
                
                if($post['adress'] != $user->getAdress()){
                    $infos = ProfilCtrl::addId($infos, 'SucAdr');
                }
                
                if($post['postalCode'] != $user->getPostalcode()){
                    $infos = ProfilCtrl::addId($infos, 'SucPostC');
                }
                
                if($post['city'] != $user->getCity()){
                    $infos = ProfilCtrl::addId($infos, 'SucCity');
                }
                
                if($post['phone'] != $user->getPhone()){
                    $infos = ProfilCtrl::addId($infos, 'SucPho');
                }
                
                if($post['news'] != $user->getNews()){
                    $infos = ProfilCtrl::addId($infos, 'SucNews');
                }
                
                if(count($infos) > 0){
                    $_SESSION['infos'] = $infos; 
                    return true;
                }else{
                    array_push($infos, array(
                        'type' => 'INFO',
                        'message' => 'aucune modification'
                    ));
                    $_SESSION['infos'] = $infos; 
                    return false;
                }
            }
        }
        
        static function addId($array, $id){
            if(count($array) == 0){
                array_push($array, array(
                    'type' => 'SUCCES',
                    'message' => 'Données mises à jour',
                    'idt' => array()
                ));
            }
            array_push($array[0]['idt'], $id);
            return $array;
        }
        
        static function Historique_GET($request, $response, $args) {
            $params = Controller::defaultParams('profil'); 
            $template = Controller::$twig -> loadTemplate ('profil_historique.twig');    
            return $response->write( $template ->render ($params)); 
        }
    }
?>