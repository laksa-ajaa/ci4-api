<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProjectTechStacks extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'project_id' => [
        'type'            => 'INT',
        'unsigned'        => true,
      ],
      'techstack_id' => [
        'type' => 'INT',
        'unsigned' => true,
      ]
    ]);
    $this->forge->addForeignKey('project_id', 'rnd_projects', 'id', 'DELETE', 'CASCADE');
    $this->forge->addForeignKey('techstack_id', 'rnd_techstacks', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('rnd_projects_techstacks');
  }

  public function down()
  {
    $this->forge->dropTable('rnd_projects_techstacks');
  }
}
