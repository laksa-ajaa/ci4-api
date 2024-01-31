<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use \Faker\Factory;

use App\Models\ContactModel as Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
      $faker = Factory::create('id_ID');
      for($i = 0; $i < 100; $i++){
        $data = [
          'name'           => $faker->name,
          'email'          => $faker->email,
          'message'        => $faker->text(300)
        ];
        $project = new Contact();
        $project->insert($data);
      }
    }
}
