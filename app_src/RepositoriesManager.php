<?php
namespace eCommerceApi;
use eCommerceApi\DBOperations;
use Doctrine\ORM\EntityRepository;

class RepositoriesManager {
    public DBOperations $db_operations;

    public array $repos = [];

    function __construct(DBOperations $dBOperations){
        $this->db_operations = $dBOperations;
    }

    function addRepo(string $identity , EntityRepository $repo) : void{
        $this->repos[$identity] = $repo;
    }

    function getRepo($identity) : null | EntityRepository{
        return $this->repos[$identity] ?? null;
    }

    function getEntityManager(){
        return $this->db_operations->getEntityManager();
    }

}