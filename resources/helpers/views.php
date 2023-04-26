<?php

function component( $view ) {
    $view = trim( $view, '/' );
    $view = "../resources/templates/components/$view";
    if( ! file_exists( $view ) ) {
        return false;
    }

    return include_once $view;
}

function asset( $path ) {
    $pathExists = trim( $path, '/' );
    $pathExists = "../public/assets/$path";

    $path = trim( $path, '/' );
    $path = "/public/assets/$path";

    
    if( ! file_exists( $pathExists ) ) {
        echo 'no';
        return false;
    }

    return '<link rel="stylesheet" href="' . $path . '?c=' . filemtime( $pathExists ) . '">';
}