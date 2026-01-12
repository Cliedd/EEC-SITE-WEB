<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuditLogModel;

class FileUploadController extends Controller
{
    // Configuration des uploads
    private $allowedMimeTypes = [
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
        'image/gif' => '.gif',
        'application/pdf' => '.pdf',
        'application/msword' => '.doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
        'application/vnd.ms-excel' => '.xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => '.xlsx',
    ];

    private $maxFileSize = 5242880; // 5 MB
    private $uploadPath = WRITEPATH . 'uploads';

    /**
     * Valide et upload un fichier de manière sécurisée
     */
    public function upload()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return $this->response->setJSON(['success' => false, 'error' => 'Accès refusé'])->setStatusCode(403);
        }

        $file = $this->request->getFile('file');

        // Validations
        if (!$file) {
            return $this->response->setJSON(['success' => false, 'error' => 'Aucun fichier fourni'])->setStatusCode(400);
        }

        if ($file->getError() !== UPLOAD_ERR_OK) {
            return $this->response->setJSON(['success' => false, 'error' => 'Erreur lors de l\'upload'])->setStatusCode(400);
        }

        if ($file->getSize() > $this->maxFileSize) {
            $auditLog = new AuditLogModel();
            $auditLog->logAction('FILE_UPLOAD_REJECTED', 'failed', [
                'reason' => 'File too large',
                'size' => $file->getSize(),
                'max_size' => $this->maxFileSize,
            ]);
            return $this->response->setJSON(['success' => false, 'error' => 'Fichier trop volumineux (max 5 MB)'])->setStatusCode(413);
        }

        $mimeType = mime_content_type($file->getTempName());
        if (!isset($this->allowedMimeTypes[$mimeType])) {
            $auditLog = new AuditLogModel();
            $auditLog->logAction('FILE_UPLOAD_REJECTED', 'failed', [
                'reason' => 'Invalid mime type',
                'mime_type' => $mimeType,
            ]);
            return $this->response->setJSON(['success' => false, 'error' => 'Type de fichier non autorisé'])->setStatusCode(415);
        }

        // Générer un nom de fichier sécurisé
        $newName = bin2hex(random_bytes(16)) . $this->allowedMimeTypes[$mimeType];

        // Créer le répertoire si nécessaire
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }

        // Déplacer le fichier
        if ($file->move($this->uploadPath, $newName)) {
            $auditLog = new AuditLogModel();
            $auditLog->logAction('FILE_UPLOADED', 'success', [
                'filename' => $newName,
                'original_name' => $file->getClientName(),
                'size' => $file->getSize(),
                'mime_type' => $mimeType,
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Fichier uploadé avec succès',
                'filename' => $newName,
                'path' => '/uploads/' . $newName,
            ])->setStatusCode(200);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'Erreur lors de la sauvegarde du fichier'])->setStatusCode(500);
    }

    /**
     * Supprimer un fichier (admin seulement)
     */
    public function delete($filename)
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return $this->response->setJSON(['success' => false, 'error' => 'Accès refusé'])->setStatusCode(403);
        }

        // Valider le nom du fichier pour éviter les traversal attacks
        if (strpos($filename, '..') !== false || strpos($filename, '/') !== false) {
            return $this->response->setJSON(['success' => false, 'error' => 'Nom de fichier invalide'])->setStatusCode(400);
        }

        $filePath = $this->uploadPath . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($filePath)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Fichier non trouvé'])->setStatusCode(404);
        }

        if (unlink($filePath)) {
            $auditLog = new AuditLogModel();
            $auditLog->logAction('FILE_DELETED', 'success', ['filename' => $filename]);
            return $this->response->setJSON(['success' => true, 'message' => 'Fichier supprimé avec succès']);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'Erreur lors de la suppression'])->setStatusCode(500);
    }

    /**
     * Lister les fichiers uploadés (admin seulement)
     */
    public function listFiles()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->has('admin_id')) {
            return $this->response->setJSON(['success' => false, 'error' => 'Accès refusé'])->setStatusCode(403);
        }

        if (!is_dir($this->uploadPath)) {
            return $this->response->setJSON(['success' => true, 'files' => []]);
        }

        $files = array_diff(scandir($this->uploadPath), ['.', '..']);
        $fileList = [];

        foreach ($files as $file) {
            $filePath = $this->uploadPath . DIRECTORY_SEPARATOR . $file;
            $fileList[] = [
                'name' => $file,
                'size' => filesize($filePath),
                'date' => date('Y-m-d H:i:s', filemtime($filePath)),
            ];
        }

        return $this->response->setJSON(['success' => true, 'files' => $fileList]);
    }
}
