<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Project extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'project_id' => [
          'type'           => 'INT',
          'unsigned'       => true,
          'auto_increment' => true,
        ],
        'project_name' => [
          'type'       => 'VARCHAR',
          'constraint' => '100',
        ],
        'project_description' => [
          'type'       => 'VARCHAR',
          'constraint' => '255',
          'null'       => true
        ],
        'project_image' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
          'null' => true
        ],
        'project_url' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
          'null' => true
        ],
        'created_at' => [
          'type'    => 'TIMESTAMP',
          'default' => new RawSql('CURRENT_TIMESTAMP'),
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('rnd_contacts');
    }

    public function down()
    {
        //
    }
}
