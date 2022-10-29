<?php

namespace eCommerceApi;

class Registerer{
    private Array $data;

    /**
     * role of the registerer
     * if set to 1 it will have the admin permitions
     * if set to 0 will have the normal user permitions
     * @var boolean
     */
    private bool $role;

    function setData(array $data , bool $role=0){
        $this->data = $data;
        $this->role = $role;
    }

    function getIdentityUserInfo(){
        $data = $this->data;
        if($this->isAdmin()){
            $this->getAdminInfo($data ,true);
        }else{
            $this->getUserInfo($data ,true);
        }
    }

    private function getAdminInfo( array $data, bool $sesitive_information = true){

    }

    private function getUserInfo(array $data , bool $sesitive_information = true){

    }


    /**
     * this function works on the username and password authintication
     * if the $byRecord param didn't set otherwise will look for record
     * by the field key => value set in $byRecord param and return the user By it
     * 
     * @return bool `false` if the user doesn't existed
     * @return array of the user information
     */
    private function getUserRecords($data,array | bool $byRecord = false){
        if(!$byRecord)
        {
            if(array_key_exists("id",$data))
            {

                /**
                 * @var string $user_name
                 */
    
                $user = $data["id"];
    
                if(array_key_exists("pass",$data)){
    
                    /**
                     * @var string $pass hashed password
                     */
                    $pass = $data["pass"];
                }

                // here use the repository to find that user
            }
        }elseif(is_array($byRecord))
        {
            // here the operation of restoring data
            // i will make it too far
        }
    }

    function isAdmin(){
        return $this->role;
    }
}