<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TechStacksModel as TechStacks;

class TechStacksSeeder extends Seeder
{
    public function run()
    {
      $data = [
        ['name' => 'Laravel', 'image' => 'laravel.svg'],
        ['name' => 'Codeigniter', 'image' => 'codeigniter.svg'],
        ['name' => 'Blogger', 'image' => 'blogger.svg'],
        ['name' => 'Bootstrap', 'image' => 'bootstrap.svg'],
        ['name' => 'Tailwind', 'image' => 'tailwind.svg'],
        ['name' => 'Vue', 'image' => 'vue.svg'],
        ['name' => 'React', 'image' => 'react.svg']
      ];
      $techstacks = new TechStacks();
      $techstacks->insertBatch($data);
    }
}
