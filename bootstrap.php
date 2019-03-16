<?php
    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;
    
    class Bootstrap{
        static $entityManager;
        
        static function start(){
            date_default_timezone_set('America/Lima');
            $isDevMode = true;
            $config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
            $conn = array(
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '',
                'dbname' => 'c9',
                'port' => '3306'
            );
            Bootstrap::$entityManager = EntityManager::create($conn, $config);
        }
    }
?>