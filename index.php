<?php
require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/* ***********************************************
 * Include all functionality into the main program
 * ***********************************************/
$srcFiles = ( array ) glob( 'src/*.php' );
foreach( $srcFiles as $srcFile )
{
   require $srcFile;
}


$app = new Slim\App(Config::$slim_settings);

/* ***********************************************
 * Fetch SLIM app Container
 * ***********************************************/
$container = $app->getContainer();

/* ***********************************************
 * Database Connection
 * ***********************************************/
$container['db'] = function ($c) {
   $pdo = new PDO("mysql:host=" . Config::$mysql_host . ";dbname=" . Config::$mysql_db .";charset=UTF8", Config::$mysql_user, Config::$mysql_pwd);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   return $pdo;

};


/* ***********************************************
 * Cors Settings 
 * ***********************************************/
$app->add(function ($req, $res, $next) {
   $response = $next($req, $res);
   $server = $req->getServerParams();
   $http_origin = $server["HTTP_ORIGIN"] ?? NULL;

   if(isset($http_origin))
   {
      return $response
         ->withHeader('Access-Control-Allow-Origin', $http_origin)
         ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
         ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
   }
   else
   {
      return $response
         ->withHeader('Access-Control-Allow-Origin', '*' )
         ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
         ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
   }
});

/* ***********************************************
 * Returns the Version of the Telmedica API
 * ***********************************************/
$app->get('/version', function (Request $request, Response $response)
{
   return $response->withJson(array("DnDoodle Version" => Config::$dndoodle_version));
});


/* ***********************************************
 * Include all routes to the main program
 * ***********************************************/
$routeFiles = ( array ) glob( 'routes/*.php' );
foreach( $routeFiles as $routeFile )
{
   require $routeFile;
}


/* ***********************************************
 * Let's go
 * ***********************************************/
$app->run();

?>
