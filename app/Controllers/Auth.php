<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminUserModel;
use App\Models\AuditLogModel;
use App\Models\EmailVerificationModel;
use App\Services\EmailService;

class Auth extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Afficher la page de connexion
     */
    public function login()
    {
        // Si déjà connecté, rediriger vers le dashboard
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin');
        }
        // Sinon, afficher le formulaire de connexion
        return view('admin/login');
    }

    /**
     * Vérifier les identifiants d'authentification
     */
    public function authenticate()
    {
        // TEST : requête avec email en dur
        // Use raw SQL for admin authentication
        $email = $this->request->getPost('email');
        $mot_de_passe = $this->request->getPost('mot_de_passe');
        $sql = "SELECT * FROM admin_users WHERE email = ? AND actif = 1 LIMIT 1";
        $result = $this->db->query($sql, [$email]);
        $admin = $result->getRowArray();
            if ($admin && password_verify($mot_de_passe, $admin['mot_de_passe'])) {
                // Successful login
                session()->set('admin_logged_in', true);
                session()->set('admin_id', $admin['id_admin']);
                session()->set('admin_email', $admin['email']);
                session()->set('admin_nom', $admin['nom']);
                return redirect()->to('/admin');
            }
            // Failed login (generic message, no logs)
            $data['error'] = 'Email ou mot de passe incorrect';
            return view('admin/login', $data);
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        $auditLog = new AuditLogModel();
        $auditLog->logAction('LOGOUT', 'success');
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Vous avez été déconnecté');
    }

    /**
     * Vérifier un email via token
     */
    public function verifyEmail($token)
    {
        $emailVerification = new EmailVerificationModel();
        $result = $emailVerification->verifyToken($token);

        if (!$result) {
            return redirect()->to('/auth/login')->with('error', 'Token invalide ou expiré');
        }

        // Email vérifié avec succès
        return redirect()->to('/auth/login')->with('success', 'Email confirmé avec succès! Vous pouvez maintenant vous connecter.');
    }
    /**
     * Afficher le formulaire de réinitialisation de mot de passe
     */
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    /**
     * Envoyer un email de réinitialisation
     */
    public function sendPasswordReset()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $AdminUserModel = new AdminUserModel();
        $admin = $AdminUserModel->where('email', $email)->first();

        // Pour la sécurité, ne pas révéler si l'email existe
        if ($admin) {
            $emailVerification = new EmailVerificationModel();
            $token = $emailVerification->createPasswordResetToken($email, 'admin');

            $resetLink = base_url('/auth/reset-password/' . $token);

            $emailService = new EmailService();
            $emailService->sendPasswordResetEmail($email, $resetLink);
        }

        // Message générique pour la sécurité
        return redirect()->to('/auth/login')->with('success', 'Si cet email existe, un lien de réinitialisation vous a été envoyé.');
    }

    /**
     * Afficher le formulaire de réinitialisation avec token
     */
    public function resetPassword($token)
    {
        $emailVerification = new EmailVerificationModel();
        $verification = $emailVerification->where('token', $token)
                                         ->where('type', 'password_reset')
                                         ->where('expires_at', '>', date('Y-m-d H:i:s'))
                                         ->first();

        if (!$verification) {
            return redirect()->to('/auth/login')->with('error', 'Lien de réinitialisation invalide ou expiré');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    /**
     * Traiter la réinitialisation du mot de passe
     */
    public function confirmPasswordReset()
    {
        $rules = [
            'token' => 'required',
            'mot_de_passe' => 'required|min_length[8]',
            'mot_de_passe_confirm' => 'required|matches[mot_de_passe]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('mot_de_passe');

        $emailVerification = new EmailVerificationModel();
        $verification = $emailVerification->where('token', $token)
                                         ->where('type', 'password_reset')
                                         ->where('expires_at', '>', date('Y-m-d H:i:s'))
                                         ->first();

        if (!$verification) {
            return redirect()->to('/auth/login')->with('error', 'Lien de réinitialisation invalide ou expiré');
        }

        // Mettre à jour le mot de passe
        $AdminUserModel = new AdminUserModel();
        $admin = $AdminUserModel->where('email', $verification['email'])->first();

        if ($admin) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $AdminUserModel->update($admin['id_admin'], ['mot_de_passe' => $hashedPassword]);

            // Supprimer le token utilisé
            $emailVerification->delete($verification['id']);

            // Logger l'action
            $auditLog = new AuditLogModel();
            $auditLog->logAction('PASSWORD_RESET', 'success', 'Admin password reset via email');

            return redirect()->to('/auth/login')->with('success', 'Mot de passe réinitialisé avec succès! Vous pouvez maintenant vous connecter.');
        }

        return redirect()->to('/auth/login')->with('error', 'Erreur lors de la réinitialisation');
    }
}
