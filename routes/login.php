<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


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

         $user  = checkAuthNormal($cred["username"], $cred["password"], $this->db);                  
         $token = createJWT($user);
      } 
      catch (Exception $e) 
      {
         return $response
            ->withStatus(401)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
            ->withStatus(200)
            ->withJson([ "username" => $user["user_name"], 
                         "expiration" => new DateTime("now +1 week"), 
                         "token" => $token]);

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

         $client = new Google_Client(['client_id' => Config::$gauth_secret]);  // Specify the CLIENT_ID of the app that accesses the backend
         $payload = $client->verifyIdToken($cred["token"]);
         
         if ($payload) 
         {
            $user  = checkAuthNormal($cred["username"], $payload["sub"], $this->db);                  
            $token = createJWT($user);
         } 
         else 
         {
            throw new TokenInvalidException("Couldn't parse gauth token");
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
            ->withJson([ "username" => $user["user_name"], 
                         "expiration" => new DateTime("now +1 week"), 
                         "token" => $token]);
   });
});

?>
