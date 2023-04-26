<?php

$web->get( '/', function() {
    return [
        'view' => 'home',
        'data' => [
            'username' => 'JackalJon',
            'rank' => 'Platinum'
        ]
    ];
} );

$web->get( '/about', function() {
    return [
        'view' => 'about',
        'data' => [
            'username' => 'JackalJon',
            'rank' => 'Platinum'
        ]
    ];
} );