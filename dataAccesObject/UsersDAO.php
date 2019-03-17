<?php
class UsersDAO {

    public static function create($signupPost){
        $user = new Users;
        $user->setLogin(strtolower($signupPost['login']));
        $user->setMail(strtolower($signupPost['mail']));
        $user->setLastname($signupPost['lastname']);
        $user->setFirstname($signupPost['firstname']);
        $user->setAdress($signupPost['adresse']);
        $user->setPostalcode($signupPost['postalCode']);
        $user->setCity($signupPost['city']);
        $user->setPhone($signupPost['phone']);
        $user->setPassword($signupPost['password1']);
        $user->setNews(($signupPost['news'])?1:0);
        $user->setAdmin(0);
        
        Bootstrap::$entityManager->persist($user);
        Bootstrap::$entityManager->flush();
    }
    
    public static function login($loginPost){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByLogin($loginPost['login']);
        if(isset($user)){
            if($loginPost['mdp'] === $user->getPassword()){
                $_SESSION['idUsers'] = $user->getId();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public static function isAdmin($idUser){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneById($idUser);
        return isset($user) && $user->getAdmin();
    }
    
    public static function loginExist($login){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByLogin($login);
        return isset($user);
    }
    
    public static function mailExist($mail){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByMail($mail);
        return isset($user);
    }
    
}
?>