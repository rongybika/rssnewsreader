<?php

require __DIR__.'/../vendor/autoload.php';

//use Auth module
use PHPAuth\Config as PHPAuthConfig;
use PHPAuth\Auth as PHPAuth;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//include config information for database
include(__DIR__.'/../config/config.php');

$loader = new \Twig\Loader\FilesystemLoader('../templates');
//$loader->addPath($templateDir3);
$twig = new \Twig\Environment($loader);

$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);

$config = new PHPAuthConfig($dbh, 'rssnewsreader_phpauth_config','');
$auth = new PHPAuth($dbh, $config);

//echo 'dhht6546th5er4h64h'.'<br>';
//user2@yahoo.com

if (isset($_GET['url'])) {
    switch ($_GET['url']) {
        case '':
        require __DIR__.'/../src/controller/home.php';
        break;
        case 'home':
        require __DIR__.'/../src/controller/home.php';
        break;
        case 'contact':
        require __DIR__.'/../src/controller/contact.php';
        break;
        case 'login':
        require __DIR__.'/../src/controller/auth/login.php';
        break;
        case 'register':
        require __DIR__.'/../src/controller/auth/register.php';
        break;
        case 'showfeed':
        require __DIR__.'/../src/controller/showfeed.php';
        break;
        case 'showurls':
        require __DIR__.'/../src/controller/showurls.php';
        break;
        case 'addnewurl':
        require __DIR__.'/../src/controller/addnewurl.php';
        break;
        case 'logout':
        require __DIR__.'/../src/controller/logout.php';
        break;
        case 'settings':
        require __DIR__.'/../src/controller/settings.php';
        break;
        case 'resetpassword':
        require __DIR__.'/../src/controller/auth/resetpassword.php';
        break;
        case 'modifyurl':
        require __DIR__.'/../src/controller/modifyurl.php';
        break;
    default:
        require __DIR__.'/../src/controller/404.php';
    }
} else {
    require __DIR__.'/../src/controller/home.php';
}