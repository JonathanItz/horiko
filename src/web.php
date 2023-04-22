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