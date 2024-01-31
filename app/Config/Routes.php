<?php

use App\Controllers\BaseController;
use CodeIgniter\Router\RouteCollection;

use App\Controllers\HomeController as Home;
use App\Controllers\ContactController as Contact;
use App\Controllers\ProjectController as Project;
use App\Controllers\ProjectCategoryController as ProjectCategory;
use App\Controllers\ProjectTechStacksController as ProjectTechStacks;
use App\Controllers\AccountController as Account;

/**
 * @var RouteCollection $routes
 */
service('auth')->routes($routes);

$routes->group('/', static function ($routes) {
  $routes->get('', fn () => "Hello World!");
  $routes->get('contact',   [Contact::class, 'redirect']);
  $routes->post('contact',  [Contact::class, 'store']);
  $routes->get('project',   [Project::class, 'indexjson']);
  $routes->get('cv',        [Home::class, 'cv']);
});

$routes->group('dashboard', ['filter' => 'session'], function ($routes) {
  $routes->get('', [Home::class, 'dashboard']);

  // Contact (API Management)
  $routes->group('contact', static function ($routes) {
    $routes->get('',          [Contact::class, 'index']);
    $routes->get('(:num)',    [Contact::class, 'detail/$1']);
    $routes->delete('(:num)', [Contact::class, 'delete/$1']);
  });

  // Project (API Management)
  $routes->group('project', static function ($routes) {
    $routes->get('',              [Project::class, 'index']);
    $routes->get('new',           [Project::class, 'new']);
    $routes->post('',             [Project::class, 'create']);
    $routes->get('edit/(:num)',   [Project::class, 'edit/$1']);
    $routes->put('edit/(:num)',   [Project::class, 'update/$1']);
    $routes->patch('edit/(:num)', [Project::class, 'update/$1']);
    $routes->delete('(:num)',     [Project::class, 'delete/$1']);

    $routes->group('techstack', static function ($routes) {
      $routes->get('',              [ProjectTechStacks::class, 'index']);
      $routes->post('',             [ProjectTechStacks::class, 'create']);
      $routes->put('edit/(:num)',   [ProjectTechStacks::class, 'update/$1']);
      $routes->patch('edit/(:num)', [ProjectTechStacks::class, 'update/$1']);
      $routes->delete('(:num)',     [ProjectTechStacks::class, 'delete/$1']);
    });

    $routes->group('category', static function ($routes) {
      $routes->get('',              [ProjectCategory::class, 'index']);
      $routes->post('',             [ProjectCategory::class, 'create']);
      $routes->put('edit/(:num)',   [ProjectCategory::class, 'update/$1']);
      $routes->patch('edit/(:num)', [ProjectCategory::class, 'update/$1']);
      $routes->delete('(:num)',     [ProjectCategory::class, 'delete/$1']);
    });
  });

  // PHPInfo
  $routes->group('phpinfo', static function ($routes) {
    $routes->get('',       [Home::class, 'phpinfo_index']);
    $routes->get('iframe', [Home::class, 'phpinfo_iframe']);
  });

  // Profile
  $routes->group('account', static function ($routes) {
    $routes->get('',               [Account::class, 'index']);
    $routes->put('edit',           [Account::class, 'edit']);
    $routes->patch('edit',         [Account::class, 'edit']);
    $routes->put('editpassword',   [Account::class, 'editpassword']);
    $routes->patch('editpassword', [Account::class, 'editpassword']);
  });

  // Settings
  $routes->group('settings', static function ($routes) {
    $routes->get('',  [Home::class, 'settings_index']);
    $routes->post('', [Home::class, 'settings_edit']);
  });
});
