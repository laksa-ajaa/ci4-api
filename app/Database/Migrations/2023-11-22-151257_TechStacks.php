<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TechStacks extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id' => [
          'type'            => 'INT',
          'unsigned'        => true,
          'auto_increment'  => true,
        ],
        'name' => [
          'type'            => 'VARCHAR',
          'constraint'      => '255',
        ],
        'image' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
          'null' => true
        ],
        'created_at' => [
          'type'    => 'TIMESTAMP',
        ],
        'updated_at' => [
          'type'    => 'TIMESTAMP',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('rnd_techstacks');
    }

    public function down()
    {
      $this->forge->dropTable('rnd_techstacks');
    }
}
