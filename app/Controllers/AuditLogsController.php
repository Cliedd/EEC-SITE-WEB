<?php

namespace App\Controllers;

use App\Models\AuditLogModel;
use CodeIgniter\Controller;

class AuditLogsController extends Controller
{
    /**
     * Afficher les logs d'audit (admin seulement)
     */
    public function index()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return redirect()->to('/auth/login')->with('error', 'Accès refusé');
        }

        $auditLog = new AuditLogModel();
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 50;
        $offset = ($page - 1) * $limit;

        // Récupérer les logs avec pagination
        $logs = $auditLog
            ->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        $total = $auditLog->countAll();
        $totalPages = ceil($total / $limit);

        return view('admin/audit_logs', [
            'logs' => $logs,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
        ]);
    }

    /**
     * Filtrer les logs par action
     */
    public function filterByAction($action)
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return redirect()->to('/auth/login')->with('error', 'Accès refusé');
        }

        $auditLog = new AuditLogModel();
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 50;
        $offset = ($page - 1) * $limit;

        $logs = $auditLog
            ->where('action', $action)
            ->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        $total = $auditLog->where('action', $action)->countAllResults();
        $totalPages = ceil($total / $limit);

        return view('admin/audit_logs', [
            'logs' => $logs,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'filterAction' => $action,
        ]);
    }

    /**
     * Afficher les logs d'un utilisateur
     */
    public function userLogs($userId)
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return redirect()->to('/auth/login')->with('error', 'Accès refusé');
        }

        $auditLog = new AuditLogModel();
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 50;
        $offset = ($page - 1) * $limit;

        $logs = $auditLog
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        $total = $auditLog->where('user_id', $userId)->countAllResults();
        $totalPages = ceil($total / $limit);

        return view('admin/audit_logs', [
            'logs' => $logs,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'filterUser' => $userId,
        ]);
    }

    /**
     * Afficher les logs des tentatives de connexion échouées
     */
    public function failedLogins()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return redirect()->to('/auth/login')->with('error', 'Accès refusé');
        }

        $auditLog = new AuditLogModel();
        $page = (int) $this->request->getGet('page') ?? 1;
        $limit = 50;
        $offset = ($page - 1) * $limit;

        $logs = $auditLog
            ->where('action', 'LOGIN_ATTEMPT')
            ->where('status', 'failed')
            ->orderBy('created_at', 'DESC')
            ->limit($limit, $offset)
            ->findAll();

        $total = $auditLog
            ->where('action', 'LOGIN_ATTEMPT')
            ->where('status', 'failed')
            ->countAllResults();

        $totalPages = ceil($total / $limit);

        return view('admin/audit_logs', [
            'logs' => $logs,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'filterType' => 'failed_logins',
        ]);
    }

    /**
     * Exporter les logs en CSV
     */
    public function export()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return $this->response->setJSON(['error' => 'Accès refusé'])->setStatusCode(403);
        }

        $auditLog = new AuditLogModel();
        $logs = $auditLog->orderBy('created_at', 'DESC')->findAll();

        // Préparer les données CSV
        $csv = "ID,Action,Entity Type,Entity ID,User ID,User Email,IP Address,Status,Details,Created At\n";

        foreach ($logs as $log) {
            $details = str_replace('"', '""', $log['details'] ?? '');
            $csv .= sprintf(
                '%d,"%s","%s",%s,%s,"%s","%s","%s","%s","%s"' . "\n",
                $log['id_audit'],
                $log['action'],
                $log['entity_type'] ?? '',
                $log['entity_id'] ?? '',
                $log['user_id'] ?? '',
                $log['user_email'],
                $log['ip_address'],
                $log['status'],
                $details,
                $log['created_at']
            );
        }

        // Télécharger le fichier
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename=audit_logs_' . date('Y-m-d_H-i-s') . '.csv')
            ->setBody($csv);
    }

    /**
     * Nettoyer les logs anciens
     */
    public function cleanup()
    {
        // Vérifier que l'utilisateur est connecté et admin
        if (!session()->has('admin_id')) {
            return $this->response->setJSON(['error' => 'Accès refusé'])->setStatusCode(403);
        }

        $auditLog = new AuditLogModel();

        // Supprimer les logs de plus de 90 jours
        $cutoffDate = date('Y-m-d H:i:s', strtotime('-90 days'));
        $deleted = $auditLog->where('created_at <', $cutoffDate)->delete();

        // Logger l'action
        $auditLog->logAction('AUDIT_LOGS_CLEANUP', 'success', ['deleted_records' => $deleted]);

        return $this->response->setJSON([
            'success' => true,
            'message' => "Nettoyage effectué: {$deleted} enregistrements supprimés",
            'deleted' => $deleted,
        ]);
    }
}
