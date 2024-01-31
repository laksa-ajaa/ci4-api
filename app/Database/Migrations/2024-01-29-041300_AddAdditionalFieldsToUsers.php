<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class AddAdditionalFieldsToUsers extends Migration
{
  /**
   * @var string[]
   */
  private array $tables;

  public function __construct(?Forge $forge = null)
  {
    parent::__construct($forge);

    /** @var \Config\Auth $authConfig */
    $authConfig   = config('Auth');
    $this->tables = $authConfig->tables;
  }

  public function up()
  {
    $fields = [
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => '150',
        'after' => 'username',
        'default' => 'User',
      ],
    ];
    $this->forge->addColumn($this->tables['users'], $fields);
  }

  public function down()
  {
    $fields = [
      'name',
    ];
    $this->forge->dropColumn($this->tables['users'], $fields);
  }
}
