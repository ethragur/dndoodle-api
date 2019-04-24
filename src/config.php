<?php

class Config
{
    public static $mysql_host  = "";
    public static $mysql_user  = "";
    public static $mysql_pwd   = "";
    public static $mysql_db    = "";

    public static $dndoodle_version = "0.1alpha";

    public static $slim_settings =
        [
            'settings' => 
            [
                'addContentLengthHeader' => false
            ]
        ];

    public static $logger_settings = 
        [
            // Path to log directory
            'directory' => '/tmp/',
            // Log file name
            'filename' => 'dndoodle-api.log',
            // Your timezone
            'timezone' => 'Europe/Vienna',
            // Log level
            'level' => 'debug',
            // List of Monolog Handlers you wanna use
            'handlers' => [],
        ];

    public static $jwtauth_settings  =
        [
            "secure"        => false,
            "relaxed"       => ["localhost"],
            "secret"        => "",
            "passthrough"   => ["/",  ]
#            "path"          => "/",
        ];
}

?>
