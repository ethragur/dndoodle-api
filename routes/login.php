<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// TODO: Put exception in source
class DecodeException extends Exception { }
class LoginException extends Exception { }

/* ***********************************************
 * User API Group
 * ***********************************************/
$app->group('/login', function () use ($app)
{
   $app->post('/basic', function (Request $request, Response $response)
   {
      try 
      {
         $cred = $request->getParsedBody(); 

         if($cred == NULL)
            throw new DecodeException("Could not decode Body");
         
         if(!(isset($cred["username"]) && isset($cred["password"]) && $cred["username"] != "" && $cred["password"] != ""))
         {
            throw new LoginException("Could not retrieve Login Parameters");
         }

      } 
      catch (Exception $e) 
      {
         return $response
            ->withStatus(401)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
         ->withStatus(200)
         ->withJson($cred);
   });

   $app->post('/gauth', function (Request $request, Response $response)
   {
      try 
      {
         $cred = $request->getParsedBody(); 

         if($cred == NULL)
            throw new DecodeException("Could not decode Body");
         
         if(!(isset($cred["token"]) && $cred["token"] != "" ))
         {
            throw new LoginException("Could not retrieve Login Parameters");
         }

      } 
      catch (Exception $e) 
      {
         return $response
            ->withStatus(401)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
         ->withStatus(200)
         ->withJson($cred);
   });
});

?>