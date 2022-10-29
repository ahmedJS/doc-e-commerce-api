<?php

namespace eCommerceApi;

use Doctrine\ORM\Mapping\ClassMetadata;
use eCommerceApi\repositories\UsersRepo;
use eCommerceApi\RepositoriesManager;
use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Stmt\Function_;
class DbFluentResource{
    function __construct
    (
        private RepositoriesManager $rm
    )
    {
        $this->rm = $rm;
        $this->setUpRepositories();
    }

    function setUpRepositories() : void{
        $this->rm->addRepo("users",new UsersRepo($this->rm->getEntityManager(),new ClassMetadata("User")));
        $this->rm->addRepo("products",new UsersRepo($this->rm->getEntityManager(),new ClassMetadata("Product")));
    }
    function getAllUsersAsNativeArray() : array {
        /**
         * @var \eCommerceApi\repositories\UsersRepo
         */
        $users_repo = $this->rm->getRepo("users");

        return $users_repo->usersAsArray();
        
    }

    /**
     * Undocumented function
     *
     * @return array of one entity
     */
    function getUserByUserName($userName) : array{
        /**
         * @var \eCommerceApi\repositories\UsersRepo
         */
        $users_repo = $this->rm->getRepo("users");

        return $users_repo->getUserByUserName($userName);
    }


    function forTest(){
        return $this->rm;
    }

    function getRM() : RepositoriesManager{
        return $this->rm;
    }

    function getEM(){
        return $this->getRM()->getEntityManager();
    }

}