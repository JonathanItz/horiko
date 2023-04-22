<?php

namespace App\Controllers;

class Web {
    public $currentPage;
    public $requestMethod;

    public function __construct( string $currentPage, string $requestMethod ) {
        $this->currentPage = $currentPage;
        $this->requestMethod = $requestMethod;
    }
    
    public function get( $path, $callback ) {
        if( $this->requestMethod === 'GET' && $this->currentPage === $path ) {
            $routeData = $callback();
            
            if( ! isset( $routeData[ 'view' ] ) ) {
                echo 'no';
                $this->notFound();
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

            // echo __DIR__;
            // echo '<br>';
            $viewPath = "../src/templates/{$view}.php";
            // echo $viewPath;
            if( ! file_exists( $viewPath ) ) {
                echo 'no';
                return;
            }
            
            return include_once $viewPath;
        }

        $this->notFound();
        return;
    }

    public function notFound() {
        echo '404';
    }
}