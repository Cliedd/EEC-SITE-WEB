<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'audit_logs';
    protected $primaryKey = 'id_audit';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'action',
        'entity_type',
        'entity_id',
        'user_id',
        'user_email',
        'ip_address',
        'user_agent',
        'status',
        'details',
        'created_at',
    ];

    protected $useTimestamps = false;

    /**
     * Log une action d'audit
     */
    public function logAction($action, $status = 'success', $details = null, $entityType = null, $entityId = null, $userId = null)
    {
        $logData = [
            'action' => $action,
            'status' => $status,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'user_id' => $userId ?? session()->get('admin_id'),
            'user_email' => session()->get('admin_email') ?? 'ANONYMOUS',
            'ip_address' => $this->getClientIP(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'details' => $details ? json_encode($details) : null,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->insert($logData);
    }

    /**
     * Log une tentative de connexion
     */
    public function logLoginAttempt($email, $success = false, $reason = null)
    {
        return $this->logAction(
            'LOGIN_ATTEMPT',
            $success ? 'success' : 'failed',
            ['email' => $email, 'reason' => $reason],
            'admin_user',
            null,
            null
        );
    }

    /**
     * Obtenir l'IP du client
     */
    private function getClientIP()
    {
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        }
    }

    /**
     * Récupère les logs d'un utilisateur
     */
    public function getUserLogs($userId, $limit = 50)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Récupère les tentatives login échouées
     */
    public function getFailedLogins($email, $minutes = 15)
    {
        $timeLimit = date('Y-m-d H:i:s', strtotime("-{$minutes} minutes"));
        return $this->where('action', 'LOGIN_ATTEMPT')
            ->where('status', 'failed')
            ->where("user_email = '{$email}'", null, false)
            ->where("created_at >= '{$timeLimit}'", null, false)
            ->findAll();
    }
}
