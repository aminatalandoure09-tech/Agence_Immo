<?php
protected $routeMiddleware = [
    // ...
    'auth.client' => \App\Http\Middleware\AuthClient::class,
];
?>