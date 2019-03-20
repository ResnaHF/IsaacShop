<?php
    class AdminCtrl{
        static function GET ($request, $response, $args) {  
            $params = Controller::defaultParams('admin'); 
            if($params['isAdmin']){
                $template = Controller::$twig -> loadTemplate ('admin.twig');    
                return $response->write( $template ->render ($params));
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'avez pas accès à cette partie du site'
                ));
                return $response->withStatus(302)->withHeader('Location', '/');
            }
        }
    }

?>