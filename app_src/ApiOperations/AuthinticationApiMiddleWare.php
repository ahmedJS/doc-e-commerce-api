<?php
namespace eCommerceApi\ApiOperations;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Fig\Http\Message\StatusCodeInterface as StatusCode; 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class AuthinticationApiMiddleWare{
    
    public JWT $JWT;
    private $state_service;
    function __construct(&$state_service)
    {
        $this->state_service = $state_service;

        $this->JWT = new JWT;
    }
    
    function __invoke(Request $request , RequestHandler $requestHandler)
    {

            if ($request->hasHeader('app-auth-token'))
            {

                /**
                 * @var array
                 */
                $tokenHeader = $request->getHeader("app-auth-token");

                /**
                 * @var \Psr\Http\Message\ResponseInterface
                 */
                $response = null;

                /**
                 * @var string
                 */
               $token = end($tokenHeader);
               
               // key object
               $key = $this->getKey("keykeykey","HS256");

               /**
                * @var array `associative` of user credintials
                * @var false if it is not validate JWT
                */
               $checking_result = $this->checkJWT($token,$key);

               if(!$checking_result)
               {
                
                // here produce the error response message for auth failure

                $response =  new Response(StatusCode::STATUS_UNAUTHORIZED);

               }
               else
               {

                // **** here the successful of the tokens ***** //
                
                // let the other middleware , app request pass in
                
                
                $response = $requestHandler->handle($request);
                
                

               }

            }
            else
            {
                // here produce the error response message for auth failure

                $response = new Response(StatusCode::STATUS_UNAUTHORIZED);

            }

            if($response->getStatusCode() == StatusCode::STATUS_OK) {
                $this->state_service->state = true;
            }else{
                $this->state_service->state = false;
            }

            return $response;
    
    }


    /**
     * check and unserialize JWT Token and return the result
     *
     * @param string $JWTToken
     * @param Key $key
     * @return bool `false` on failure
     * @return \stdClass `object` of payloads on success
     */
    function checkJWT(string $JWTToken,Key $key): bool | \stdClass{
        try
        {
            /**
             * @var \stdClass
             */
            $token = $this->JWT->decode($JWTToken,$key);
        }
        catch(\Exception)
        {
            return false;
        }
        
        return $token;
    }

    function getKey(string $key,string $algorithm) : Key{
        return $key = new Key($key,$algorithm);
    }
    
}