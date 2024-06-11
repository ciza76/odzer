<?php

defined('ROOTPATH') OR exit('Access Denied!');

if ((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli') || (!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'mysql:host=127.0.0.1')) {
    /** database config **/
    define('DBNAME', 'mvc_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'https://eso.vse.cz/~stao04/stanzinFotoGallery/public');

}
elseif ((!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'odzer.localhost')) {
    /** database config **/
    define('DBUSER', 'root');
    define('DBPASS', 'hesloheslo');
    define('DBDRIVER', 'mysql');
    define('DSN', "mysql:host=odzer-db;dbname=mvc_db");
    define('ROOT', 'http://odzer.localhost');

}
else {
    /** database config **/
    define('DBNAME', 'stao04');
    define('DBHOST', '127.0.0.1');
    define('DBUSER', 'stao04');
    define('DBPASS', 'uqu7thoojon7Je7woo');
    define('DBDRIVER', 'mysql');

    define('ROOT', 'https://eso.vse.cz/~stao04/stanzinFotoGallery/public');

}

define('APP_NAME', "stanzinFotoGallery");
define('APP_DESC', "Fotogallery made by Stanzin");

/** true means show errors **/
define('DEBUG', true);


