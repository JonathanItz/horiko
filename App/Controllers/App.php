<?php
namespace App\Controllers;

use App\Controllers\Web;

class App {
    public static $currentPage;
    public static $requestMethod;

    static function init() {
        $server = $_SERVER;

        self::$currentPage = $server[ 'REQUEST_URI' ];
        self::$requestMethod = $server[ 'REQUEST_METHOD' ];

        /**
         * Set the web variable so we use it in web.php
         */
        $web = new Web(self::$currentPage, self::$requestMethod);

        include_once '../resources/helpers/views.php';
        include_once '../src/web.php';

        $web->hasRoute();
    }
}