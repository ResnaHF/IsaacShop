<?php
class ArticlesDAO {

    public static function randomList(){
        $articles = Bootstrap::$entityManager->getRepository('Articles')->findAll();
        shuffle($articles);
        return array_slice($articles, 0, 9);
    }
    
    public static function getItem($idItem){
        return Bootstrap::$entityManager->getRepository('Articles')->findOneById($idItem);
    }
    
    public static function getItemList($idItemList){
        return Bootstrap::$entityManager->getRepository('Articles')->findById($idItemList);
    }
}
?>