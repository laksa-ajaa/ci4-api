<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\ContactController as Contact;
use App\Controllers\ProjectController as Project;

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);

$routes->group('/', static function ($routes) {
  $routes->get('', fn() => "Hello World!");
  $routes->get('contact', [Contact::class, 'redirect']);
  $routes->post('contact', [Contact::class, 'store']);
  $routes->get('project', [Project::class, 'indexjson']);
});

$routes->group('auth', static function ($routes) {
  $routes->get('', fn() => redirect()->to('/auth/login'));
  $routes->get('login', 'Auth::login');
  $routes->post('login', 'Auth::login');
  $routes->post('logout', 'Auth::logout');
});

$routes->group('dashboard', function($routes){
    $routes->get('/', fn() => "Hello World");

    // Contact (API Management)
    $routes->group('contact', static function ($routes){
        $routes->get('/', [Contact::class, 'index'], ['filter' => 'session']);
        $routes->get('(:num)', [Contact::class, 'detail/$1'], ['filter' => 'session']);
        $routes->delete('(:num)', [Contact::class, 'delete/$1'], ['filter' => 'session']);
    });

    // Project (API Management)
    $routes->group('project', static function ($routes){
        $routes->get('/', [Project::class, 'index'], ['filter' => 'session']);
        $routes->get('detail/(:num)', [Project::class, 'detail/$1'], ['filter' => 'session']);
        $routes->delete('(:num)', [Project::class, 'delete/$1'], ['filter' => 'session']);
    });
});
