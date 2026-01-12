<?php

namespace App\Services;

use CodeIgniter\Email\Email;

class EmailService
{
    protected $email;

    public function __construct()
    {
        $this->email = service('email');
    }

    /**
     * Envoyer un email de vérification
     */
    public function sendVerificationEmail($toEmail, $userName, $verificationLink)
    {
        $subject = 'Vérifiez votre adresse email - EEC Centre Médical';

        $message = view('emails/verification_email', [
            'userName' => $userName,
            'verificationLink' => $verificationLink,
        ]);

        return $this->send($toEmail, $subject, $message);
    }

    /**
     * Envoyer une confirmation de rendez-vous
     */
    public function sendAppointmentConfirmation($name, $date, $service, $dossierNumber, $email, $phone, $reason = null)
    {
        $subject = 'Confirmation de votre rendez-vous - EEC Centre Médical';
        
        // Extract time from date
        $time = date('H:i', strtotime($date));

        $message = view('emails/appointment_confirmation', [
            'name' => $name,
            'date' => $date,
            'time' => $time,
            'service' => $service,
            'dossierNumber' => $dossierNumber,
            'phone' => $phone,
            'reason' => $reason
        ]);

        return $this->send($email, $subject, $message);
    }

    /**
     * Envoyer une notification de nouveau rendez-vous (admin)
     */
    public function sendNewAppointmentNotificationToAdmin($name, $email, $phone, $date, $service, $reason, $dossierNumber)
    {
        $adminEmail = 'boumbisaij@gmail.com';
        $subject = '🔔 Nouveau rendez-vous - ' . $dossierNumber;
        
        // Extract time from date
        $time = date('H:i', strtotime($date));

        $message = view('emails/admin_new_appointment', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'service' => $service,
            'reason' => $reason,
            'dossierNumber' => $dossierNumber,
        ]);

        return $this->send($adminEmail, $subject, $message);
    }

    /**
     * Envoyer une notification de compte créé
     */
    public function sendAccountCreatedEmail($toEmail, $userName)
    {
        $subject = 'Compte créé avec succès - EEC Centre Médical';

        $message = view('emails/account_created', [
            'userName' => $userName,
            'email' => $toEmail,
        ]);

        return $this->send($toEmail, $subject, $message);
    }

    /**
     * Envoyer un email de réinitialisation de mot de passe
     */
    public function sendPasswordResetEmail($toEmail, $resetLink)
    {
        $subject = 'Réinitialisez votre mot de passe - EEC Centre Médical';

        $message = view('emails/password_reset', [
            'resetLink' => $resetLink,
        ]);

        return $this->send($toEmail, $subject, $message);
    }

    /**
     * Envoyer un email de notification générique avec template personnalisé
     */
    public function sendNotification($toEmail, $subject, $templatePath, $data = [])
    {
        try {
            $message = view($templatePath, $data);
            return $this->send($toEmail, $subject, $message);
        } catch (\Exception $e) {
            log_message('error', 'Template view error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Envoyer l'email (méthode protégée)
     */
    protected function send($toEmail, $subject, $message)
    {
        try {
            // Valider l'adresse email
            if (!filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
                log_message('error', 'Invalid email address: ' . $toEmail);
                return false;
            }

            $this->email->setTo($toEmail);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            if (!$this->email->send(false)) {
                log_message('error', 'Email send failed for: ' . $toEmail);
                return false;
            }

            // Réinitialiser l'email pour le prochain envoi
            $this->email->clear();

            log_message('info', 'Email sent successfully to: ' . $toEmail);

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Email exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtenir les détails du dernier erreur
     */
    public function getError()
    {
        return $this->email->printDebugger(['headers']);
    }
}

