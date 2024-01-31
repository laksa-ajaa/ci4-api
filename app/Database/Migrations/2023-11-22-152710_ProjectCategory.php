<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectCategory extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id' => array(
          'type'            => 'INT',
          'unsigned'        => true,
          'auto_increment'  => true,
        ),
        'name' => array(
          'type'            => 'VARCHAR',
          'constraint'      => 50,
        ),
        'created_at' => array(
          'type'            => 'TIMESTAMP',
        ),
        'updated_at' => array(
          'type'            => 'TIMESTAMP',
        ),
      ]);
      $this->forge->addKey('id', true);
      $this->forge->createTable('rnd_projects_categories');
    }

    public function down()
    {
      $this->forge->dropTable('rnd_projects_categories');
    }
}
