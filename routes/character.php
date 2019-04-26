<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/* ***********************************************
 * ***********************************************/
$app->group('/char', function () use ($app)
{


   $app->post('', function (Request $request, Response $response)
   {
      try 
      {
         $char = $request->getParsedBody(); 
         $char_id = createCharacter($char, $request->getAttribute('user_id', NULL), $this->db);
      }
      catch(Exception $e)
      {
         return $response
            ->withStatus(400)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
            ->withJson( $char_id )
            ->withStatus(201);
   });

   $app->get('/{id}', function (Request $request, Response $response)
   {
      try 
      {
         $char = getCharacter($request->getAttribute('id', NULL), $this->db);
      }
      catch(Exception $e)
      {
         return $response
            ->withStatus(400)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
            ->withJson( $char )
            ->withStatus(200);

   });


   $app->post('/{id}/attr', function (Request $request, Response $response)
   {
      try 
      {
         $attr = $request->getParsedBody(); 
         createCharacterAttr($attr, $request->getAttribute('id', NULL), $this->db);
      }
      catch(Exception $e)
      {
         return $response
            ->withStatus(400)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
            ->withStatus(200);


   });

   $app->get('/{id}/attr', function (Request $request, Response $response)
   {
      try 
      {
         $attr = getCharacterAttr($request->getAttribute('id', NULL), $this->db);
         $this->logger->info(explode($attr));
      }
      catch(Exception $e)
      {
         return $response
            ->withStatus(400)
            ->withJson(["message" => $e->getMessage()]);
      }

      return $response
         ->withJson($attr)
         ->withStatus(200);


   });


})->add($jwtmw);
