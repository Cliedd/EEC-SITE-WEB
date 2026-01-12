<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AppointmentModel;
use App\Models\VisitorModel;
use App\Models\Creer_compteModel;
use App\Services\EmailService;

class Dashboard extends BaseController
{
    protected $emailService;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->emailService = new EmailService();
    }

    public function index()
    {
        // Vérifier si l'utilisateur est authentifié comme admin
        if (!session()->has('admin_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Veuillez vous connecter pour accéder au dashboard');
        }
        
        $AppointmentModel = new AppointmentModel();
        $VisitorModel = new VisitorModel();
        $CreerCompteModel = new Creer_compteModel();

        // Get all data
        $appointments = $AppointmentModel->findAll();
        $visitors = $VisitorModel->findAll();
        $users = $CreerCompteModel->findAll();

        // Calculate statistics
        $totalAppointments = count($appointments);
        $pendingAppointments = count(array_filter($appointments, fn($a) => $a['status'] === 'pending'));
        $confirmedAppointments = count(array_filter($appointments, fn($a) => $a['status'] === 'confirmed'));
        $totalVisitors = count($visitors);
        $totalUsers = count($users);
        
        // Group visitors by type
        $visitorsByType = [];
        foreach ($visitors as $visitor) {
            $type = $visitor['visitor_type'];
            $visitorsByType[$type] = ($visitorsByType[$type] ?? 0) + 1;
        }

        // Recent appointments
        usort($appointments, fn($a, $b) => strtotime($b['date_creation']) - strtotime($a['date_creation']));
        $recentAppointments = array_slice($appointments, 0, 10);

        // Recent visitors
        usort($visitors, fn($a, $b) => strtotime($b['date_visit']) - strtotime($a['date_visit']));
        $recentVisitors = array_slice($visitors, 0, 10);

        $data = [
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'totalVisitors' => $totalVisitors,
            'totalUsers' => $totalUsers,
            'visitorsByType' => $visitorsByType,
            'appointments' => $appointments,
            'recentAppointments' => $recentAppointments,
            'recentVisitors' => $recentVisitors,
            'visitors' => $visitors
        ];

        return view('dashboard/dashboard', $data);
    }

    // Mettre à jour le statut d'un rendez-vous
    public function updateAppointmentStatus($appointmentId)
    {
        $AppointmentModel = new AppointmentModel();
        $status = $this->request->getPost('status');

        $appointment = $AppointmentModel->find($appointmentId);
        if (!$appointment) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Rendez-vous non trouvé'
            ], 404);
        }

        $AppointmentModel->update($appointmentId, ['status' => $status]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Statut mis à jour'
        ]);
    }

    // Obtenir les détails d'un rendez-vous
    public function getAppointmentDetails($appointmentId)
    {
        $AppointmentModel = new AppointmentModel();
        $appointment = $AppointmentModel->find($appointmentId);

        if (!$appointment) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Rendez-vous non trouvé'
            ], 404);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $appointment
        ]);
    }

    // Envoyer un email manuel
    public function sendManualEmail()
    {
        $appointmentId = $this->request->getPost('appointment_id');
        $patientEmail = $this->request->getPost('patient_email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        // Validation
        if (empty($appointmentId) || empty($patientEmail) || empty($subject) || empty($message)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tous les champs sont requis'
            ]);
        }

        // Envoyer l'email
        $result = $this->emailService->sendNotification(
            $patientEmail,
            $subject,
            null, // Pas de template, message personnalisé
            [
                'message' => $message
            ]
        );

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Email envoyé avec succès'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erreur lors de l\'envoi de l\'email'
            ]);
        }
    }

    // Obtenir les rendez-vous à venir pour les notifications
    public function getUpcomingAppointments()
    {
        $AppointmentModel = new AppointmentModel();
        
        // Récupérer les rendez-vous des prochaines 24 heures
        $now = date('Y-m-d H:i:s');
        $next24Hours = date('Y-m-d H:i:s', strtotime('+24 hours'));
        
        $appointments = $AppointmentModel->where('date_appointment >=', $now)
                                        ->where('date_appointment <=', $next24Hours)
                                        ->where('status', 'pending')
                                        ->orderBy('date_appointment', 'ASC')
                                        ->findAll();

        $upcomingAppointments = [];
        
        foreach ($appointments as $appointment) {
            $appointmentTime = new \DateTime($appointment['date_appointment']);
            $nowTime = new \DateTime();
            $interval = $nowTime->diff($appointmentTime);
            
            // Calculer le temps restant
            if ($appointmentTime > $nowTime) {
                $hours = $interval->h + ($interval->days * 24);
                $minutes = $interval->i;
                
                if ($hours > 0) {
                    $timeUntil = $hours . ' heure(s) ' . $minutes . ' minute(s)';
                } else {
                    $timeUntil = $minutes . ' minute(s)';
                }
                
                $upcomingAppointments[] = [
                    'id_appointment' => $appointment['id_appointment'],
                    'name_surName' => $appointment['name_surName'],
                    'service' => $appointment['service'] ?? $appointment['raison'],
                    'time' => date('H:i', strtotime($appointment['date_appointment'])),
                    'time_until' => $timeUntil
                ];
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'appointments' => $upcomingAppointments
        ]);
    }

    // Nettoyer les rendez-vous expirés
    public function cleanupExpiredAppointments()
    {
        $AppointmentModel = new AppointmentModel();
        
        // Supprimer les rendez-vous expirés non confirmés
        $now = date('Y-m-d H:i:s');
        
        $expiredAppointments = $AppointmentModel->where('date_appointment <', $now)
                                               ->where('status', 'pending')
                                               ->findAll();

        if (!empty($expiredAppointments)) {
            foreach ($expiredAppointments as $appointment) {
                $AppointmentModel->delete($appointment['id_appointment']);
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => count($expiredAppointments) . ' rendez-vous expirés supprimés'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Aucun rendez-vous expiré à supprimer'
        ]);
    }

    // Supprimer un rendez-vous
    public function deleteAppointment($appointmentId)
    {
        $AppointmentModel = new AppointmentModel();
        $AppointmentModel->delete($appointmentId);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Rendez-vous supprimé'
        ]);
    }

    // Envoyer un email depuis le dashboard
    public function sendEmailFromDashboard($appointmentId)
    {
        $AppointmentModel = new AppointmentModel();
        $appointment = $AppointmentModel->find($appointmentId);

        if (!$appointment) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Rendez-vous non trouvé'
            ], 404);
        }

        // Envoyer un rappel via le service Email
        $this->emailService->sendNotification(
            $appointment['email'],
            'Rappel de rendez-vous',
            'emails/appointment_reminder',
            [
                'name' => $appointment['name_surName'],
                'date' => $appointment['date_appointment'],
                'service' => $appointment['service'],
                'reason' => $appointment['raison'],
                'status' => $appointment['status']
            ]
        );

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Email de rappel envoyé avec succès'
        ]);
    }
}
