<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemovePriceFromServicesTable extends Migration
{
    public function up()
    {
        // Supprimer le champ price et duration_minutes s'ils existent
        $this->db->query('ALTER TABLE services DROP COLUMN IF EXISTS price');
        $this->db->query('ALTER TABLE services DROP COLUMN IF EXISTS duration_minutes');
    }

    public function down()
    {
        // Remettre les champs en cas de rollback (optionnel)
        $this->db->query('ALTER TABLE services ADD COLUMN price DECIMAL(10,2) NULL AFTER description');
        $this->db->query('ALTER TABLE services ADD COLUMN duration_minutes INT NULL AFTER price');
    }
}
