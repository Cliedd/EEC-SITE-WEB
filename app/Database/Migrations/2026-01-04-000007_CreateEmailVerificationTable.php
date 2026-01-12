<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmailVerificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_verification' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => false,
                'unique' => true,
            ],
            'entity_type' => [
                'type' => 'ENUM',
                'constraint' => ['login', 'admin', 'contact'],
                'default' => 'login',
            ],
            'entity_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'verified' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'expires_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id_verification', true);
        $this->forge->addKey('verified');
        $this->forge->createTable('email_verifications');
    }

    public function down()
    {
        $this->forge->dropTable('email_verifications');
    }
}
