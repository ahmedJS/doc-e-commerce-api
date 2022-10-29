<?php
namespace eCommerceApi;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
class DBOperations{
    public static EntityManager $entityManager;
    public $entitiesDir = [__DIR__."/../entities/"];
    function __construct()
    {
        
    }
    static function getConn(array $annotation_dirs) : EntityManager{
        if(!isset(self::$entityManager)){

            $orm_drive = ORMSetup::createAnnotationMetadataConfiguration(
                            $annotation_dirs,true,null
                         );

            $conn = DriverManager::getConnection([
                "dbname" => "ecommerce_db",
                "password" => "root",
                "user" => "root",
                "host" => "localhost",
                "driver" => "pdo_mysql"
            ]);
            self::$entityManager = new EntityManager($conn,$orm_drive);
        }
        return self::$entityManager;
    }
    function runConsole(){
        $em = $this->getEntityManager();
        ConsoleRunner::run(new SingleManagerProvider($em));
    }

    function getEntityManager() : EntityManager{
        return $this->getConn($this->entitiesDir);
    }
}