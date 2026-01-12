<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateAdminUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'mot_de_passe' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'date_creation' => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_modification' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'actif' => [
                'type' => 'TINYINT',
                'default' => 1,
            ],
        ]);

        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admin_users');
    }

    public function down()
    {
        $this->forge->dropTable('admin_users');
    }
}
