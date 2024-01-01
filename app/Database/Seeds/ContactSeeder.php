<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use \Faker\Factory;

class ContactSeeder extends Seeder
{
    public function run()
    {
      $faker = Factory::create('id_ID');
      for($i = 0; $i < 20; $i++){
        $data = [
          'name'           => $faker->name,
          'email'          => $faker->email,
          'message'        => $faker->text(300),
          'created_at'     => Time::createFromTimestamp($faker->unixTime()),
        ];
        $this->db->table('rnd_contacts')->insert($data);
      }
    }
}
