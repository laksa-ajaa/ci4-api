<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Contact extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id' => [
          'type'           => 'INT',
          'unsigned'       => true,
          'auto_increment' => true,
        ],
        'name' => [
          'type'       => 'VARCHAR',
          'constraint' => '100',
          'null'       => true
        ],
        'email' => [
          'type'       => 'VARCHAR',
          'constraint' => '100',
          'null'       => true
        ],
        'message' => [
          'type' => 'TEXT',
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
      $this->forge->dropTable('rnd_contacts');
    }
}
