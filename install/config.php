<?php

$baseUrl = '';
if ($_SERVER["SERVER_PORT"] != "80") {
    $baseUrl .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
    $baseUrl .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
}

$baseUrl = substr($baseUrl, 0, strrpos($baseUrl, '/'));

if (getenv('TRAVIS')) {
    $baseUrl =  'localhost/phpunit/tmp/installTest/install';
}

try {
    $dateTimeObject = new \DateTime();
    $currentTimeZone = $dateTimeObject->getTimezone()->getName();
} catch (Exception $e) {
    $currentTimeZone = 'UTC';
}

return array(
    // GLOBAL
    'SESSION_NAME' => 'install', //prevents session conflict when two sites runs on the same server
    // END GLOBAL

    // DB
    'db' => array(
        'hostname' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'tablePrefix' => '',
        'charset' => '',
    ),

    // GLOBAL
    'BASE_DIR' => dirname(dirname(__FILE__)), //root DIR with trailing slash at the end. If you have moved your site to another place, change this line to correspond your new domain.
    'BASE_URL' => $baseUrl, //root url with trailing slash at the end. If you have moved your site to another place, change this line to correspond your new domain.

    'DEVELOPMENT_ENVIRONMENT' => 1, //displays error and debug information. Change to 0 before deployment to production server
    'ERRORS_SHOW' => 1,  //0 if you don't wish to display errors on the page
    // END GLOBAL

    // FRONTEND
    'CHARSET' => 'UTF-8', //system characterset
    'THEME' => 'CentrusCleanus', //theme from themes directory
    'DEFAULT_DOCTYPE' => 'DOCTYPE_HTML5', //look ip_cms/includes/Ip/View.php for available options.

    'TIMEZONE' => $currentTimeZone,
    // END FRONTEND

    'FILE_OVERRIDES' => array(
        'Plugin/' => __DIR__ . '/Plugin/',
        'Theme/' => __DIR__ . '/Theme/',
    ),

    'URL_OVERRIDES' => array(
        'Plugin/' => "http://{$baseUrl}/Plugin/",//TODOXX find the way to add domain
        'Theme/' => "http://{$baseUrl}/Theme/",
        'Ip/' => 'http://' . dirname($baseUrl) . '/Ip/',
    ),

    'SERVICES' => array(
        'pageAssets' => 'Plugin\\Install\\PageAssets',
    )
);

