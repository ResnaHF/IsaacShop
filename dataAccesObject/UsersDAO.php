<?php
class UsersDAO {

    public static function create($signupPost){
        $user = new Users;
        $user->setLogin($signupPost['login']);
        $user->setMail($signupPost['email']);
        $user->setLastname($signupPost['lastname']);
        $user->setFirstname($signupPost['firstname']);
        $user->setAdress($signupPost['Adresse']);
        $user->setPostalcode($signupPost['CodePostal']);
        $user->setCity($signupPost['Ville']);
        $user->setPhone($signupPost['Telephone']);
        $user->setPassword($signupPost['password1']);
        $user->setNews(($signupPost['News'])?1:0);
        $user->setAdmin(0);
        
        Bootstrap::$entityManager->persist($user);
        Bootstrap::$entityManager->flush();
    }
    
    public static function login($loginPost){
        $user = Bootstrap::$entityManager->getRepository('Users')->findOneByLogin($loginPost['login']);
        if(isset($user)){
            if($loginPost['mdp'] === $user->getPassword()){
                $_SESSION['id'] = $user->getId();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
?>