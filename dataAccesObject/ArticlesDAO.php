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
    
    public static function search($name, $min, $max, $orderBy, $sens, $page, $sizePage){
        //TIPS : https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/query-builder.html#working-with-querybuilder
        $qb = Bootstrap::$entityManager->createQueryBuilder();
        $qb->select('i')
           ->from('Articles', 'i')
           ->where('i.name LIKE :name')
           ->andwhere('i.price >= :min')
           ->andwhere('i.price <= :max')
           ->orderBy('i.'.$orderBy, $sens)
           
           ->setParameter('name', '%'.$name.'%')
           ->setParameter('min', $min)
           ->setParameter('max', $max)
           ->setFirstResult( ($page-1)*$sizePage )
           ->setMaxResults( $sizePage );
           
        return $qb->getQuery()->getResult();
    }
    
    public static function countItem($name, $min, $max){
        $qb = Bootstrap::$entityManager->createQueryBuilder();
        $qb->select('count(i)')
           ->from('Articles', 'i')
           ->where('i.name LIKE :name')
           ->andwhere('i.price >= :min')
           ->andwhere('i.price <= :max')
           
           ->setParameter('name', '%'.$name.'%')
           ->setParameter('min', $min)
           ->setParameter('max', $max);
           
        return $qb->getQuery()->getResult()[0][1];
    }
    
    public static function create($createPost){
        $item = new Articles;
        $item->setName($createPost['name']);
        $item->setPrice($createPost['price']);
        $item->setDescription($createPost['desc']);
        $item->setImg($createPost['img']);
        
        Bootstrap::$entityManager->persist($item);
        Bootstrap::$entityManager->flush();
        
        return $item->getId();
    }
    
    public static function update($idItem, $modifyPost){
        $item = Bootstrap::$entityManager->getRepository('Articles')->findOneById($idItem);
        if(isset($item)){
            $item->setName($modifyPost['name']);
            $item->setPrice($modifyPost['price']);
            $item->setDescription($modifyPost['desc']);
            $item->setImg($modifyPost['img']);
            
            Bootstrap::$entityManager->persist($item);
            Bootstrap::$entityManager->flush();
        }
        
    }
    
    public static function remove($idItem){
        $item = Bootstrap::$entityManager->getRepository('Articles')->findOneById($idItem);
        if(isset($item)){
            Bootstrap::$entityManager->remove($item);
            Bootstrap::$entityManager->flush();
        }
        
    }
}
?>