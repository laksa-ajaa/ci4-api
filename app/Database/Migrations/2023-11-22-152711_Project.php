<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Project extends Migration
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
        'category_id' => [ 
          'type'            => 'INT',
          'unsigned'        => true,
        ],
        'description' => [
          'type'            => 'VARCHAR',
          'constraint'      => '255'
        ],
        'image' => [
          'type' => 'VARCHAR',
          'constraint' => '100'
        ],
        'link' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
          'null' => true
        ],
        'link_github'=> [
          'type' => 'VARCHAR',
          'constraint' => '100',
          'null' => true
        ],
        'is_featured' => [
          'type' => 'BOOLEAN',
          'default' => false
        ],
        'created_at' => [
          'type'    => 'TIMESTAMP',
        ],
        'updated_at' => [
          'type'    => 'TIMESTAMP',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('category_id', 'rnd_projects_categories', 'id');
    $this->forge->createTable('rnd_projects');
    }

    public function down()
    {
        $this->forge->dropTable('rnd_projects');
    }
}
