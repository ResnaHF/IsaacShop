<?php
    class SignupCtrl{
        static function GET ($request, $response, $args) {
            $params = Controller::defaultParams('signup');
            $params['news'] = true;
            $template = Controller::$twig -> loadTemplate ('signup.twig');    
            return $response->write( $template ->render ($params)); 
        }
        
        static function POST($request, $response, $args) {
            if(SignupCtrl::verify($_POST)){
                UsersDAO::create($_POST);
                $_SESSION['infos'] = array(array(
                    'type' => 'SUCCES',
                    'message' => 'Compte utilisateur créé'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }else{
                $params = Controller::defaultParams('signup');
                
                $params['login'] = $_POST['login'];
                $params['mail'] = $_POST['mail'];
                $params['password1'] = $_POST['password1'];
                $params['password2'] = $_POST['password2'];
                $params['lastname'] = $_POST['lastname'];
                $params['firstname'] = $_POST['firstname'];
                $params['adress'] = $_POST['adress'];
                $params['postalCode'] = $_POST['postalCode'];
                $params['city'] = $_POST['city'];
                $params['phone'] = $_POST['phone'];
                $params['news'] = $_POST['news'];
                
                $template = Controller::$twig -> loadTemplate ('signup.twig');    
                return $response->write( $template ->render ($params)); 
            }
        }
        
        static private function verify($post){
            $infos = array();
            
            if(UsersDAO::loginExist(strtolower($post['login']))){
               array_push($infos, array(
                    'type' => 'ERROR',
                    'message' => 'Login déjà utilisé',
                    'idt' => array('ErrLogin')
                )); 
            }
            
            if(UsersDAO::mailExist(strtolower($post['mail']))){
               array_push($infos, array(
                    'type' => 'ERROR',
                    'message' => 'Adresse mail déjà utilisée',
                    'idt' => array('ErrMail')
                )); 
            }
            
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
                return true;
            }
        }
    }
?>