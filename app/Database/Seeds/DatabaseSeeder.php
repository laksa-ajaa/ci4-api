<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call('ContactSeeder');
    $this->call('TechStacksSeeder');
    $this->call('ProjectCategorySeeder');
    $this->call('ProjectSeeder');
    $this->call('UserSeeder');

    setting('App.sitename', 'RND RestAPI');
  }
}
