<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_appointment'      => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'idlogin'             => [
                'type'           => 'INT',
                'null'           => true,
            ],
            'name_surName'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'email'               => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'telephone'           => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'date_appointment'    => [
                'type'           => 'DATETIME',
            ],
            'raison'              => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'status'              => [
                'type'           => 'ENUM',
                'constraint'     => ['pending', 'confirmed', 'cancelled'],
                'default'        => 'pending',
            ],
            'date_creation'       => [
                'type'           => 'DATETIME',
                'default'        => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_modification'   => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);

        $this->forge->addKey('id_appointment', true);
        $this->forge->createTable('appointments');
    }

    public function down()
    {
        $this->forge->dropTable('appointments');
    }
}
