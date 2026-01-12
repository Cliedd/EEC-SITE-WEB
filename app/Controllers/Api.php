<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Enregistrer un visiteur
     */
    public function trackVisitor()
    {
        $data = $this->request->getJSON();

        try {
            $this->db->table('visitors')->insert([
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $data->userAgent ?? '',
                'page_visited' => $data->page ?? '/',
                'referrer' => $data->referrer ?? '',
                'session_id' => session_id(),
                'visit_date' => date('Y-m-d H:i:s')
            ]);

            return $this->respond(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->fail('Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Créer un rendez-vous
     */
    public function createAppointment()
    {
        $patient_name = $this->request->getPost('patient_name');
        $patient_email = $this->request->getPost('patient_email');
        $patient_phone = $this->request->getPost('patient_phone');
        $appointment_date = $this->request->getPost('appointment_date');
        $appointment_time = $this->request->getPost('appointment_time');
        $service_type = $this->request->getPost('service_type');
        $description = $this->request->getPost('description');

        if (!$patient_name || !$patient_email || !$appointment_date) {
            return redirect()->back()->with('error', 'Veuillez remplir tous les champs requis');
        }

        try {
            // Créer le rendez-vous
            $this->db->table('appointments')->insert([
                'patient_name' => $patient_name,
                'patient_email' => $patient_email,
                'patient_phone' => $patient_phone,
                'appointment_date' => $appointment_date . ' ' . ($appointment_time ?? '09:00'),
                'appointment_time' => $appointment_time,
                'service_type' => $service_type,
                'description' => $description,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Enregistrer l'action dans les audit logs
            $this->db->table('audit_logs')->insert([
                'action_type' => 'APPOINTMENT_CREATED',
                'user_email' => $patient_email,
                'details' => "Rendez-vous créé pour " . $service_type,
                'status' => 'success',
                'ip_address' => $this->request->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect('/')->with('success', 'Rendez-vous enregistré avec succès! Vérifiez votre email pour la confirmation.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du rendez-vous: ' . $e->getMessage());
        }
    }

    /**
     * Créer un message de contact
     */
    public function createContact()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        if (!$name || !$email || !$message) {
            return redirect()->back()->with('error', 'Veuillez remplir tous les champs requis');
        }

        try {
            // Créer le contact
            $this->db->table('contacts')->insert([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message,
                'status' => 'unread',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Enregistrer l'action dans les audit logs
            $this->db->table('audit_logs')->insert([
                'action_type' => 'CONTACT_MESSAGE',
                'user_email' => $email,
                'details' => "Message de contact reçu: " . substr($subject, 0, 50),
                'status' => 'success',
                'ip_address' => $this->request->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect('/')->with('success', 'Message envoyé avec succès! Nous vous contacterons bientôt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi du message');
        }
    }
}
