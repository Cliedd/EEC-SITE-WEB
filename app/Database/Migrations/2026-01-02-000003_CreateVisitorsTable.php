<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_visitor'     => [
                'type'           => 'INT',
                'auto_increment'  => true,
            ],
            'idlogin'        => [
                'type'           => 'INT',
                'null'           => true,
            ],
            'name_surName'   => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'email'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ],
            'telephone'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 20,
            ],
            'visitor_type'   => [
                'type'           => 'ENUM',
                'constraint'     => ['new_account', 'appointment_request', 'contact'],
                'default'        => 'new_account',
            ],
            'date_visit'     => [
                'type'           => 'DATETIME',
                'default'        => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id_visitor', true);
        $this->forge->createTable('visitors');
    }

    public function down()
    {
        $this->forge->dropTable('visitors');
    }
}
