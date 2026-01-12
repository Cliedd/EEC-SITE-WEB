<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateLoginTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idlogin'          => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'name_surName'     => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'email'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'unique'         => true,
            ],
            'telephone'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'mot_de_passe'     => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'Date-creation'    => [
                'type'           => 'DATETIME',
                'default'        => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'Date-modification' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'Date-logout'      => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('idlogin', true);
        $this->forge->createTable('login');
    }

    public function down()
    {
        $this->forge->dropTable('login');
    }
}
