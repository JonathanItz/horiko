<?php

namespace App\Controllers;

class Web {
    public $currentPage;
    public $requestMethod;

    public $routeFound = false;
    public $currentRouteFailed = false;

    public function __construct( string $currentPage, string $requestMethod ) {
        $this->currentPage = $currentPage;
        $this->requestMethod = $requestMethod;
    }
    
    public function get( $path, $callback ) {

        /**
         * Leave if route is already found
         */
        if( $this->routeFound ) {
            return;
        }

        if( $this->requestMethod !== 'GET' || $this->currentPage !== $path ) {
            $this->currentRouteFailed = true;
            return;
        }

        $routeData = $callback();

        if( ! isset( $routeData[ 'view' ] ) ) {
            $this->currentRouteFailed = true;
            return;
        }

        $view =  $routeData[ 'view' ];

        $viewData = [];
        if( isset( $routeData[ 'data' ] ) ) {
            $viewData = $routeData[ 'data' ];
            if( is_array( $viewData ) ) {
                foreach( $viewData as $key => $data ) {
                    $$key = $data;
                }
            }
        }

        $viewPath = "../resources/templates/{$view}.php";
        if( ! file_exists( $viewPath ) ) {
            return;
        } else {
            $this->routeFound = true;
        }

        if( $this->currentRouteFailed && ! $this->routeFound ) {
            return;
        }

        include_once $viewPath;
    }

    public function hasRoute() {
        if( $this->currentRouteFailed && ! $this->routeFound ) {
            echo '404';
        }
    }
}