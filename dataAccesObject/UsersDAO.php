<?php
class UsersDAO {

    public static function create($signupPost){
        $user = new Users;
        $user->setLogin(strtolower($signupPost['login']));
        $user->setMail(strtolower($signupPost['mail']));
        $user->setPassword(password_hash($signupPost['password1'],PASSWORD_BCRYPT));
        $user->setLastname($signupPost['lastname']);
        $user->setFirstname($signupPost['firstname']);
        $user->setAdress($signupPost['adress']);
        $user->setPostalcode($signupPost['postalCode']);
        $user->setCity($signupPost['city']);
        $user->setPhone($signupPost['phone']);
        $user->setNews(($signupPost['news'])?1:0);
        $user->setAdmin(0);
        
        Bootstrap::$entityManager->persist($user);
        Bootstrap::$entityManager->flush();
    }
    
    public static function update($idUser, $profilPost){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneById($idUser);
        if(isset($user)){
            if(!empty($profilPost['password1'])){
                $user->setPassword(password_hash($profilPost['password1'],PASSWORD_BCRYPT));
            }
            $user->setLastname($profilPost['lastname']);
            $user->setFirstname($profilPost['firstname']);
            $user->setAdress($profilPost['adress']);
            $user->setPostalcode($profilPost['postalCode']);
            $user->setCity($profilPost['city']);
            $user->setPhone($profilPost['phone']);
            $user->setNews(($profilPost['news'])?1:0);
            
            Bootstrap::$entityManager->persist($user);
            Bootstrap::$entityManager->flush();
        }
    }
    
    public static function login($loginPost){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByLogin(strtolower($loginPost['login']));
        if(isset($user)){
            if(password_verify($loginPost['mdp'], $user->getPassword())){
                $_SESSION['idUsers'] = $user->getId();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public static function getUser($idUser){
        return Bootstrap::$entityManager->getRepository('Users')->findOneById($idUser);
    }
    
    public static function isAdmin($idUser){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneById($idUser);
        return isset($user) && $user->getAdmin();
    }
    
    public static function loginExist($login){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByLogin(strtolower($login));
        return isset($user);
    }
    
    public static function mailExist($mail){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByMail(strtolower($mail));
        return isset($user);
    }
    
}
?>