<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProjectCategoryModel as ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    public function run()
    {
      $data = [
        ['name' => 'Content Management System'],
        ['name' => 'Management Information System'],
        ['name' => 'Blog']
      ];

      $projectCategory = new ProjectCategory();
      $projectCategory->insertBatch($data);
    }
}
