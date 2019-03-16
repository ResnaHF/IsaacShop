<?php
class ArticlesDAO {

    public static function randomList(){
        global $entityManager;
        $articles = $entityManager->getRepository('Articles')->findAll();
        shuffle($articles);
        return array_slice($articles, 0, 9);
    }
    
    public static function getItem($idItem){
        global $entityManager;
        return $entityManager->getRepository('Articles')->findOneById($idItem);
    }
}
?>