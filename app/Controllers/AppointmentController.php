<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AppointmentModel;
use App\Models\VisitorModel;
use App\Models\ServiceModel;
use App\Services\EmailService;

class AppointmentController extends BaseController
{
    protected $emailService;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->emailService = new EmailService();
    }

    // Afficher le formulaire de rendez-vous
    public function index()
    {
        // Récupérer seulement les services disponibles
        $serviceModel = new ServiceModel();
        $availableServices = $serviceModel->getAvailableServices();
        
        // Créer une liste simple pour le formulaire
        $servicesOptions = [];
        foreach ($availableServices as $service) {
            $servicesOptions[$service['name']] = $service['name'];
        }

        return view('PrendreRendez_vous', [
            'availableServices' => $servicesOptions
        ]);
    }

    // Enregistrer un rendez-vous
    public function store()
    {
        // Récupérer les services disponibles pour validation
        $serviceModel = new ServiceModel();
        $availableServices = $serviceModel->getAvailableServices();
        $availableServiceNames = array_column($availableServices, 'name');
        
        $rules = [
            'name_surName' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'telephone' => 'required|numeric|min_length[10]|max_length[20]',
            'date_appointment' => 'required',
            'time_appointment' => 'required',
            'service' => 'required|in_list[' . implode(',', $availableServiceNames) . ']',
            'raison' => 'permit_empty|string|max_length[1000]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
                'available_services' => $availableServiceNames
            ]);
        }

        // Vérifier que le service sélectionné est bien disponible
        $selectedService = $this->request->getPost('service');
        if (!$serviceModel->isServiceAvailable($selectedService)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Le service sélectionné n\'est plus disponible. Veuillez choisir un autre service.',
                'available_services' => $availableServiceNames
            ], 400);
        }

        $AppointmentModel = new AppointmentModel();
        
        // Combiner date et heure
        $date_appointment = $this->request->getPost('date_appointment');
        $time_appointment = $this->request->getPost('time_appointment');
        $appointment_datetime = $date_appointment . ' ' . $time_appointment;

        // Vérifier que la date n'est pas dans le passé
        $appointmentDate = new \DateTime($appointment_datetime);
        $now = new \DateTime();
        if ($appointmentDate < $now) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'La date et l\'heure du rendez-vous doivent être dans le futur.'
            ], 400);
        }

        $appointmentData = [
            'name_surName' => $this->request->getPost('name_surName'),
            'email' => $this->request->getPost('email'),
            'telephone' => $this->request->getPost('telephone'),
            'date_appointment' => $appointment_datetime,
            'service' => $selectedService,
            'raison' => $this->request->getPost('raison'),
            'status' => 'pending'
        ];

        // Ajouter idlogin si l'utilisateur est connecté
        if (session()->has('idlogin')) {
            $appointmentData['idlogin'] = session()->get('idlogin');
        }

        try {
            $appointmentId = $AppointmentModel->insert($appointmentData);

            // Enregistrer comme visiteur si pas encore connecté
            if (!session()->has('idlogin')) {
                $VisitorModel = new VisitorModel();
                $visitorData = [
                    'name_surName' => $this->request->getPost('name_surName'),
                    'email' => $this->request->getPost('email'),
                    'telephone' => $this->request->getPost('telephone'),
                    'visitor_type' => 'appointment_request',
                    'date_visit' => date('Y-m-d H:i:s')
                ];
                $VisitorModel->save($visitorData);
            }

            // Envoyer un email de confirmation
            $this->emailService->sendNotification(
                $appointmentData['email'],
                'Confirmation de votre rendez-vous - EEC Centre Médical',
                'emails/appointment_confirmation',
                [
                    'name' => $appointmentData['name_surName'],
                    'email' => $appointmentData['email'],
                    'telephone' => $appointmentData['telephone'],
                    'date_appointment' => $appointment_datetime,
                    'service' => $selectedService,
                    'raison' => $appointmentData['raison']
                ]
            );

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Rendez-vous enregistré avec succès! Un email de confirmation a été envoyé.',
                'appointment_id' => $appointmentId
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la création du rendez-vous: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.'
            ], 500);
        }
    }

    // Obtenir les détails d'un rendez-vous (pour la pop-up)
    public function getDetails($appointmentId)
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

    // Mettre à jour le statut d'un rendez-vous et envoyer une notification
    public function updateStatus($appointmentId)
    {
        $newStatus = $this->request->getPost('status');

        if (!in_array($newStatus, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Statut invalide'
            ]);
        }

        $AppointmentModel = new AppointmentModel();
        $appointment = $AppointmentModel->find($appointmentId);

        if (!$appointment) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Rendez-vous non trouvé'
            ], 404);
        }

        $AppointmentModel->update($appointmentId, ['status' => $newStatus]);

        // Envoyer notification au patient selon le nouveau statut
        if ($newStatus === 'confirmed') {
            $this->emailService->sendNotification(
                $appointment['email'],
                'Votre rendez-vous a été confirmé',
                'emails/appointment_status_update',
                [
                    'name' => $appointment['name_surName'],
                    'date' => $appointment['date_appointment'],
                    'service' => $appointment['service'],
                    'status' => 'CONFIRMÉ',
                    'statusColor' => 'green'
                ]
            );
        } elseif ($newStatus === 'cancelled') {
            $this->emailService->sendNotification(
                $appointment['email'],
                'Votre rendez-vous a été annulé',
                'emails/appointment_status_update',
                [
                    'name' => $appointment['name_surName'],
                    'date' => $appointment['date_appointment'],
                    'service' => $appointment['service'],
                    'status' => 'ANNULÉ',
                    'statusColor' => 'red'
                ]
            );
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Statut mis à jour et notification envoyée'
        ]);
    }

    // API pour récupérer les services disponibles (pour les mises à jour dynamiques)
    public function getAvailableServices()
    {
        $serviceModel = new ServiceModel();
        $availableServices = $serviceModel->getAvailableServices();

        return $this->response->setJSON([
            'status' => 'success',
            'services' => $availableServices
        ]);
    }
}
