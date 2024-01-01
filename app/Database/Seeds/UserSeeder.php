<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class UserSeeder extends Seeder
{
    public function run(){
      
      // Get the User Provider (UserModel by default)
      $users = auth()->getProvider();
      $user = new User([
        'username' => 'rndio',
        'email'    => 'mail@rndio.my.id',
        'password' => '12345678',
      ]);
      $users->save($user);
      
      // To get the complete user object with ID, we need to get from the database
      $user = $users->findById($users->getInsertID());

      // Add to default group
      $users->addToDefaultGroup($user);
    }
}
