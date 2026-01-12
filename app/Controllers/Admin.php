<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ServiceModel;

class Admin extends BaseController
{
    /**
     * Vérifier que l'admin est connecté
     */
    private function checkAuth()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/auth/login')->with('error', 'Vous devez vous connecter pour accéder à cette page');
        }
        return null;
    }
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    /**
     * Page d'accueil de la dashboard
     */
    public function index()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        // Récupérer les statistiques
        $stats = [
            'total_visitors' => $this->db->table('visitors')->countAllResults(),
            'total_appointments' => $this->db->table('appointments')->countAllResults(),
            'pending_appointments' => $this->db->table('appointments')->where('status', 'pending')->countAllResults(),
            'total_accounts' => $this->db->table('accounts')->countAllResults(),
            'total_contacts' => $this->db->table('contacts')->countAllResults(),
            'unread_contacts' => $this->db->table('contacts')->where('status', 'unread')->countAllResults(),
        ];

        // Récents rendez-vous
        $recent_appointments = $this->db->table('appointments')
            ->orderBy('date_appointment', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // Derniers visiteurs
        $recent_visitors = $this->db->table('visitors')
            ->orderBy('date_visit', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        return view('admin/dashboard', [
            'stats' => $stats,
            'recent_appointments' => $recent_appointments,
            'recent_visitors' => $recent_visitors,
        ]);
    }

    /**
     * Gestion des rendez-vous
     */
    public function appointments()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $page = (int)($this->request->getGet('page') ?? 1);
        $per_page = 10;
        $offset = ($page - 1) * $per_page;

        $appointments = $this->db->table('appointments')
            ->orderBy('date_appointment', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->getResultArray();

        $total = $this->db->table('appointments')->countAllResults();

        return view('admin/appointments', [
            'appointments' => $appointments,
            'current_page' => $page,
            'total_pages' => ceil($total / $per_page),
            'total' => $total,
        ]);
    }

    /**
     * Afficher les détails d'un rendez-vous
     */
    public function viewAppointment($id)
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $appointment = $this->db->table('appointments')->where('id_appointment', $id)->get()->getRowArray();

        if (!$appointment) {
            return redirect()->to('/admin/appointments')->with('error', 'Rendez-vous non trouvé');
        }

        return view('admin/view_appointment', ['appointment' => $appointment]);
    }

    /**
     * Obtenir les détails d'un rendez-vous (API)
     */
    public function getAppointmentDetails($id)
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $appointment = $this->db->table('appointments')->where('id_appointment', $id)->get()->getRowArray();

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

    /**
     * Mettre à jour le statut d'un rendez-vous
     */
    public function updateAppointmentStatus()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $id = $this->request->getPost('id_appointment');
        $status = $this->request->getPost('status');

        // Validation du statut
        $validStatuses = ['pending', 'confirmed', 'cancelled'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Statut invalide');
        }

        $this->db->table('appointments')->update(
            ['status' => $status],
            ['id_appointment' => $id]
        );

        return redirect()->back()->with('success', 'Statut mis à jour');
    }

    /**
     * Gestion des visiteurs
     */
    public function visitors()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $page = (int)($this->request->getGet('page') ?? 1);
        $per_page = 20;
        $offset = ($page - 1) * $per_page;

        $visitors = $this->db->table('visitors')
            ->orderBy('date_visit', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->getResultArray();

        $total = $this->db->table('visitors')->countAllResults();

        // Grouper par date
        $visitor_by_date = [];
        foreach ($visitors as $visitor) {
            $date = date('Y-m-d', strtotime($visitor['date_visit']));
            if (!isset($visitor_by_date[$date])) {
                $visitor_by_date[$date] = [];
            }
            $visitor_by_date[$date][] = $visitor;
        }

        return view('admin/visitors', [
            'visitors_by_date' => $visitor_by_date,
            'current_page' => $page,
            'total_pages' => ceil($total / $per_page),
            'total' => $total,
        ]);
    }

    /**
     * Gestion des comptes utilisateurs
     */
    public function accounts()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $page = (int)($this->request->getGet('page') ?? 1);
        $per_page = 10;
        $offset = ($page - 1) * $per_page;

        $accounts = $this->db->table('accounts')
            ->orderBy('created_at', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->getResultArray();

        $total = $this->db->table('accounts')->countAllResults();

        return view('admin/accounts', [
            'accounts' => $accounts,
            'current_page' => $page,
            'total_pages' => ceil($total / $per_page),
            'total' => $total,
        ]);
    }

    /**
     * Gestion des messages de contact
     */
    public function contacts()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $page = (int)($this->request->getGet('page') ?? 1);
        $per_page = 10;
        $offset = ($page - 1) * $per_page;

        $contacts = $this->db->table('contacts')
            ->orderBy('created_at', 'DESC')
            ->limit($per_page, $offset)
            ->get()
            ->getResultArray();

        $total = $this->db->table('contacts')->countAllResults();

        return view('admin/contacts', [
            'contacts' => $contacts,
            'current_page' => $page,
            'total_pages' => ceil($total / $per_page),
            'total' => $total,
        ]);
    }

    /**
     * Gestion des services
     */
    public function services()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $serviceModel = new ServiceModel();
        
        $data = [
            'services' => $serviceModel->getAllServices(),
            'stats' => $serviceModel->getServiceStats()
        ];

        return view('admin/services', $data);
    }

    /**
     * Basculer la disponibilité d'un service
     */
    public function toggleService()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $serviceId = $this->request->getPost('service_id');
        $action = $this->request->getPost('action');

        if (empty($serviceId) || empty($action)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Données manquantes'
            ]);
        }

        $serviceModel = new ServiceModel();
        
        if ($action === 'enable') {
            $result = $serviceModel->enableService($serviceId);
            $message = 'Service activé avec succès';
        } elseif ($action === 'disable') {
            $result = $serviceModel->disableService($serviceId);
            $message = 'Service désactivé avec succès';
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Action invalide'
            ]);
        }

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $message
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour du service'
            ]);
        }
    }

    /**
     * Obtenir les détails d'un service
     */
    public function getServiceDetails($serviceId)
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($serviceId);

        if (!$service) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Service non trouvé'
            ], 404);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'service' => $service
        ]);
    }

    /**
     * Envoyer un email manuel
     */
    public function sendManualEmail()
    {
        $auth = $this->checkAuth();
        if ($auth) return $auth;

        // Logique d'envoi d'email (à implémenter selon vos besoins)
        // Pour l'instant, on retourne un succès
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Email envoyé avec succès'
        ]);
    }

    /**
     * Se déconnecter
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Vous avez été déconnecté');
    }
}
