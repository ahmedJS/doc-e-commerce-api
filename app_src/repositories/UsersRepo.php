<?php

namespace eCommerceApi\repositories;
use Doctrine\ORM\EntityRepository;
use PhpParser\Node\Expr\Cast\Array_;
use User;

class UsersRepo extends EntityRepository{
   function usersAsArray(array $users=[]){
      $array_users = array();

      if(empty($users))
      {
         $concreteUsers = $this->findAll();
      }else
      {
         $concreteUsers = $users;
      }
      
      foreach($concreteUsers as $concreteUser){
         array_push($array_users,$this->userToArray($concreteUser));
      }

      return $array_users;
   }

   function getUserBy(array $condition) : Array{
      return [$this->findOneBy($condition)];
   }


 function userToArray( User $userEntity){
    $array = [];
    $array["userName"] = $userEntity->getUserName();
    $array["emailAddress"] = $userEntity->getEmailAddress();
    $array["pass"] = $userEntity->getPass();
    $array["phoneNumber"] = $userEntity->getPhoneNumber();
    $array["photo"] = $userEntity->getPhoto();
    $array["address"] = $userEntity->getAddress();
    return $array;
 }
}