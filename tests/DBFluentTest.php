<?php

use eCommerceApi\DbFluentResource;
use PHPUnit\Framework\TestCase;
use eCommerceApi\RepositoriesManager;
use eCommerceApi\DBOperations;
use function PHPUnit\Framework\assertIsArray;

class DBFluentTest extends TestCase {
    private $setUp = false;
    private $db_fluent;
    function setUp(): void
    {
        if(!$this->setUp){
            $this->setUp = true;
            // here one excecuting code work
            $this->db_fluent = new
             DbFluentResource(new RepositoriesManager(new DBOperations()));

        }
    }
    function testCreateUserAndProduct(){

        // get the repositories manager
        $rm = $this->db_fluent->forTest();
        
        // getting the repositories
        /**
         * @var \eCommerceApi\repositories\UsersRepo
         */
        $users_repo = $rm->getRepo("users");
        $products_repo = $rm->getRepo("products");

        // setting the product
        $product = new Product();
        $product->setPriceUs(50)
                ->setTitle("addedccc with user adding");


        // setting the user
        $user = new User();

        $username = (string)uniqid();

            $user->setUserName($username)
                    ->setAddress("location-to-address")
                    ->setEmailAddress("email@info.com")
                    ->setPhoneNumber("044475")
                    ->setPass("the password")
                    ->setProducts_id($product);

        // persisting
            $rm->getEntityManager()->persist($user);
            $rm->getEntityManager()->flush();

            /**
             * @var Array<User>
             */
            $fetched_user = $users_repo->getUserBy(["userName"=>$username]);

            
            $this->assertInstanceOf(User::class,$fetched_user[0]);
            $this->assertArrayOfType($fetched_user[0]->getProducts()->getValues(),Product::class);
        
        }


    function testGetAllUsersAsArray(){
        $users_array = $this->db_fluent->getAllUsersAsNativeArray();
        $this->assertIsArray($users_array);
    }

    function assertArrayOfType($array,$type) {
        foreach($array as $item) {
            $this->assertInstanceOf($type,$item);
        }
    }
    function tearDown(): void
    {
        
    }
}