<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1=disponible, 0=indisponible',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('services');

        // Insertion des services par défaut
        $defaultServices = [
            [
                'name' => 'Consultation générale',
                'description' => 'Consultation médicale générale pour tous types de problèmes de santé',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pédiatrie/Néonatologie',
                'description' => 'Soins médicaux spécialisés pour les enfants et nouveau-nés',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Obstétrique/Gynécologie',
                'description' => 'Suivi gynécologique et suivi de grossesse',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chirurgie générale',
                'description' => 'Interventions chirurgicales diverses',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Médecine interne',
                'description' => 'Diagnostic et traitement des maladies internes',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Neurologie',
                'description' => 'Spécialité des troubles du système nerveux',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Réanimation',
                'description' => 'Soins intensifs et réanimation',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kinésithérapie',
                'description' => 'Rééducation physique et motrice',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Nutrition',
                'description' => 'Conseil et suivi nutritionnel',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Échographie',
                'description' => 'Examens échographiques diagnostiques',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Laboratoire',
                'description' => 'Analyses biologiques et médicales',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'UPEC',
                'description' => 'Unité de Premiers Secours et des Urgences',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Vaccination',
                'description' => 'Services de vaccination pour enfants et adultes',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('services')->insertBatch($defaultServices);
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
