<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailVerificationModel extends Model
{
    protected $table = 'email_verifications';
    protected $primaryKey = 'id_verification';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'email',
        'token',
        'entity_type',
        'entity_id',
        'verified',
        'verified_at',
        'expires_at',
        'created_at',
        'type',
    ];

    protected $useTimestamps = false;

    /**
     * Crée un token de vérification d'email
     */
    public function createVerificationToken($email, $entityType = 'login', $entityId = null, $expiresInHours = 24)
    {
        // Supprimer les tokens existants non vérifiés pour cet email
        $this->where('email', $email)
            ->where('verified', false)
            ->delete();

        // Générer un token sécurisé
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime("+{$expiresInHours} hours"));

        return $this->insert([
            'email' => $email,
            'token' => $token,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'verified' => false,
            'expires_at' => $expiresAt,
            'created_at' => date('Y-m-d H:i:s'),
        ]) ? $token : false;
    }

    /**
     * Vérifie un token et marque l'email comme vérifié
     */
    public function verifyToken($token)
    {
        $record = $this->where('token', $token)
            ->where('verified', false)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$record) {
            return false;
        }

        $this->update($record['id_verification'], [
            'verified' => true,
            'verified_at' => date('Y-m-d H:i:s'),
        ]);

        return $record;
    }

    /**
     * Vérifie si un email est confirmé
     */
    public function isEmailVerified($email, $entityType = 'login')
    {
        $record = $this->where('email', $email)
            ->where('entity_type', $entityType)
            ->where('verified', true)
            ->first();

        return $record !== null;
    }

    /**
     * Nettoie les tokens expirés
     */
    public function cleanupExpiredTokens()
    {
        return $this->where('expires_at <', date('Y-m-d H:i:s'))
            ->delete();
    }

    /**
     * Obtient un token pour un email
     */
    public function getTokenByEmail($email)
    {
        return $this->where('email', $email)
            ->where('verified', false)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->first();
    }

    /**
     * Crée un token de réinitialisation de mot de passe
     */
    public function createPasswordResetToken($email, $entityType = 'admin', $expiresInHours = 24)
    {
        // Supprimer les tokens existants non utilisés pour cet email
        $this->where('email', $email)
            ->where('type', 'password_reset')
            ->delete();

        // Générer un token sécurisé
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime("+{$expiresInHours} hours"));

        return $this->insert([
            'email' => $email,
            'token' => $token,
            'entity_type' => $entityType,
            'type' => 'password_reset',
            'verified' => false,
            'expires_at' => $expiresAt,
            'created_at' => date('Y-m-d H:i:s'),
        ]) ? $token : false;
    }
}
