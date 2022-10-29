<?php
use eCommerceApi\ApiOperations\CleanUpAuthinticationMiddleWare;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
use eCommerceApi\DBOperations;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response as slimResponse;
use Psr\Http\Message\StreamInterface;
use eCommerceApi\ApiOperations\AuthinticationApiMiddleWare;
require_once "vendor/autoload.php";

$dboperations = new DBOperations();

$app = AppFactory::create(null,new DI\Container);

$app->addErrorMiddleware(true,false,false);

/**
 * @var DI\Container
 */
$container = $app->getContainer();


$container->set("state",function(){
    $app_state = new stdClass;
    $app_state->state = true;
    return $app_state;
});

$state_service = $container->get("state");


$app->group("/api",function($group){
    $group->get("/beers",function($req,$res,$arg) {
        $res->getBody()->write("hello world");
        return $res;
    });
})->add(new AuthinticationApiMiddleWare($state_service));


$app->get("/test",function($req,$res,$args){
    var_dump($this->get("state"));
})->add(new AuthinticationApiMiddleWare($state_service));

$app->run();