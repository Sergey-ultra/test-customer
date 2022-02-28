<?php

return [
    [
        'uri' => "/customer",
        'method' => 'GET',
        'controller' => 'Customer',
        'action' => 'index'
    ],
    [
        'uri' => "/customer/{id}",
        'method' => 'GET',
        'controller' => 'Customer',
        'action' => 'view'
    ],
];
