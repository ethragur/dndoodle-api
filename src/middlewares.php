<?php

use \Firebase\JWT\JWT;
/* ***********************************************
 * JWT Middleware to obtain user_id, username ...
 * ***********************************************/
$jwtmw = function($request, $response, $next)
{
    try
    {

        $headerValueString = filter_var( explode(" ", $request->getHeaderLine('Authorization'))[1], FILTER_SANITIZE_STRING);

        $decoded = (array)JWT::decode($headerValueString, Config::$jwtauth_settings["secret"], array('HS256'));

        $request = $request->withAttribute('user_name', $decoded['una']);
        $request = $request->withAttribute('user_id',   $decoded['uid']);

        $response = $next($request, $response);

        return $response;
    }
    catch(Exception $e)
    {
         return $response
            ->withStatus(401)
            ->withJson(["message" => $e->getMessage()]);
    }
};

?>
