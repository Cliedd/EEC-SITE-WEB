<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddServiceToAppointments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('appointments', [
            'service' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'default' => 'Consultation générale',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('appointments', 'service');
    }
}
