<?php
    class LogoutCtrl{
        static function GET ($request, $response, $args) { 
            if(isset($_SESSION['idUsers'])){
                unset($_SESSION['idUsers']);
                $_SESSION['infos'] = array(array(
                    'type' => 'SUCCES',
                    'message' => 'Vous êtes déconnecté'
                ));
            }else{
                $_SESSION['infos'] = array(array(
                    'type' => 'INFO',
                    'message' => 'Vous n\'étiez pas connecté'
                ));
            }
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
?>