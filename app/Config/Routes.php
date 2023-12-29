<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\Contact;
use App\Controllers\Project;

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);
$routes->get('/', fn() => "Hello World!");

$routes->group('/', static function ($routes) {
  $routes->get('contact', [Contact::class, 'redirect']);
  $routes->post('contact', [Contact::class, 'store']);
  $routes->get('project', [Project::class, 'create']);
});

$routes->group('auth', static function ($routes) {
  $routes->get('/', fn() => redirect()->to('/auth/login'));
  $routes->get('login', 'Auth::login');
  $routes->post('login', 'Auth::login');
});

$routes->group('dashboard', function($routes){
    $routes->get('/', fn() => "Hello World");


    // Contact (API Management)
    $routes->group('contact', static function ($routes){
        $routes->get('/', [Contact::class, 'index']);
        $routes->delete('(:num)', [Contact::class, 'delete/$1']);
    });

    // Project (API Management)
    $routes->group('project', static function ($routes){
        $routes->get('/', [Project::class, 'index'], ['filter' => 'login']);
        $routes->get('detail/(:num)', [Project::class, 'detail/$1'], ['filter' => 'login']);
        $routes->delete('(:num)', [Project::class, 'delete/$1'], ['filter' => 'login']);
    });

    $routes->get('logout', 'Dashboard::logout');
});
