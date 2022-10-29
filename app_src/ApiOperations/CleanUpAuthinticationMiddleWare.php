<?php
namespace eCommerceApi\ApiOperations;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as slimResponse;

class CleanUpAuthinticationMiddleWare{
    function __invoke(Request $req, RequestHandler $reqHndlr)
    {
        /**
         * @var Response
         */
        $resp = $reqHndlr->handle($req);
        if($resp->getStatusCode() == 401){
            $finlResp = new slimResponse();

            // here the message to display
            $finlResp->getBody()->write("please authorize the api to get the resources");

            return $finlResp->withStatus(401);
        }
    }
}