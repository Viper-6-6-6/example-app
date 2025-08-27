<?php
namespace App\Http;

class Kernel
{
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'verified' => \App\Http\Middleware\verified::class,
    ];
}
?>