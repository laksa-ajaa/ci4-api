<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
  public function run()
  {
    setting('App.sitename', 'RND API');
  }
}
