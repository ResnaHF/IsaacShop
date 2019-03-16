<?php 
    use Doctrine\ORM\Tools\Console\ConsoleRunner;
    require_once 'bootstrap.php';
    Bootstrap::start();
    return ConsoleRunner::createHelperSet(Bootstrap::$entityManager);
?>