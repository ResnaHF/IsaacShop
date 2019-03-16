<?php
class UsersDAO {

    public static function create($signupPost){
        global $entityManager;
        
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
        
        $entityManager->persist($user);
        $entityManager->flush();
    }
    
    public static function login($loginPost){
        global $entityManager;
        $user = $entityManager->getRepository('Users')->findOneByLogin($loginPost['login']);
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