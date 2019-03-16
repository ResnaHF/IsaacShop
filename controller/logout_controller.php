<?php
    class LogoutCtrl{
        static function GET ($request, $response, $args) { 
            unset($_SESSION['id']);
            return $response->withStatus(302)->withHeader('Location', '/');
        }
    }
?>