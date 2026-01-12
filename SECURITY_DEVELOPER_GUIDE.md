# 🔐 Guide d'Intégration Sécurité - Développeurs

## Vue d'ensemble

Ce guide explique comment utiliser le système de sécurité implémenté dans votre application CodeIgniter.

---

## 1. Système d'Audit (AuditLogModel)

### Utilisation Basique

```php
use App\Models\AuditLogModel;

$auditLog = new AuditLogModel();

// Logger une action simple
$auditLog->logAction('ACTION_NAME', 'success');

// Logger avec détails
$auditLog->logAction(
    'USER_CREATED',
    'success',
    ['email' => 'user@example.com', 'role' => 'admin'],
    'user',
    $userId
);

// Logger une tentative de connexion
$auditLog->logLoginAttempt('user@example.com', true);  // Succès
$auditLog->logLoginAttempt('user@example.com', false, 'Invalid password');  // Échoué
```

### Actions Standard

```php
LOGIN_ATTEMPT       // Tentative de connexion
LOGOUT             // Déconnexion
FILE_UPLOADED      // Fichier uploadé
FILE_DELETED       // Fichier supprimé
USER_CREATED       // Utilisateur créé
USER_UPDATED       // Utilisateur modifié
APPOINTMENT_CREATED
APPOINTMENT_DELETED
```

### Requêtes Utiles

```php
// Récupérer les 50 derniers logs
$logs = $auditLog->orderBy('created_at', 'DESC')->limit(50)->findAll();

// Logs d'un utilisateur
$userLogs = $auditLog->where('user_id', $userId)
    ->orderBy('created_at', 'DESC')
    ->findAll();

// Tentatives échouées (dernières 15 minutes)
$failedAttempts = $auditLog->getFailedLogins('user@example.com', 15);
if (count($failedAttempts) >= 5) {
    // Bloquer l'utilisateur
}

// Exporter
$allLogs = $auditLog->findAll();
```

---

## 2. Vérification d'Email (EmailVerificationModel)

### Créer un Token

```php
use App\Models\EmailVerificationModel;

$emailVerification = new EmailVerificationModel();

// Créer un token (24h d'expiration)
$token = $emailVerification->createVerificationToken(
    'user@example.com',
    'login',  // entity_type: login, admin, ou contact
    $userId,  // entity_id (optionnel)
    24        // heures avant expiration
);

// Envoyer l'email
$verificationLink = "http://localhost:9000/auth/verifyEmail/{$token}";
// ... code d'envoi email ...
```

### Vérifier un Token

```php
// Vérifier le token (appelé par auth/verifyEmail route)
$result = $emailVerification->verifyToken($token);

if ($result) {
    // Email vérifié avec succès
    echo "Email confirmé pour: " . $result['email'];
} else {
    // Token invalide ou expiré
    echo "Token invalid or expired";
}
```

### Vérifier si Email est Confirmé

```php
if ($emailVerification->isEmailVerified('user@example.com', 'login')) {
    // Email confirmé, permettre la connexion
} else {
    // Email non confirmé, afficher message
    echo "Veuillez confirmer votre email";
}
```

### Nettoyage

```php
// Supprimer les tokens expirés
$emailVerification->cleanupExpiredTokens();
```

---

## 3. Upload Sécurisé (FileUploadController)

### Upload via Formulaire

```html
<form action="/upload" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>
```

### Upload via AJAX

```javascript
const file = document.querySelector('input[type="file"]').files[0];
const formData = new FormData();
formData.append('file', file);

fetch('/upload', {
    method: 'POST',
    body: formData
})
.then(r => r.json())
.then(data => {
    if (data.success) {
        console.log('Fichier uploadé:', data.path);
    } else {
        alert('Erreur: ' + data.error);
    }
});
```

### Types Acceptés

```
Images: .jpg, .png, .gif
Documents: .pdf, .doc, .docx, .xls, .xlsx
Limites: Max 5 MB par fichier
```

### Gestion des Fichiers

```php
use App\Controllers\FileUploadController;

// Supprimer un fichier
DELETE /fileupload/delete/{filename}

// Lister les fichiers
GET /fileupload/list  // Retourne JSON
```

---

## 4. Validation des Inputs (InputValidationFilter)

Le filtre s'applique automatiquement à tous les POST/PUT/PATCH.

### Ce qui est Bloqué

```
❌ <script>, <iframe>, on* attributes (XSS)
❌ \x00, %00 (null bytes)
❌ ${}, @{} (template injection)
❌ eval(), exec(), system() (code injection)
❌ Arrays non autorisés
```

### Ce qui est Permis

```
✅ Texte normal
✅ Emails
✅ URLs
✅ JSON
✅ Nombres
```

### Exemple (Automatique)

```php
// Dans votre contrôleur
$data = $this->request->getPost();  // Automatiquement validé!
// Si données suspectes → HTTP 400 response
```

---

## 5. Session Sécurisée

### Configuration Actuelle

```php
// Session expire après 30 minutes
$expiration = 1800;  // secondes

// IP doit rester identique
$matchIP = true;

// Régénération du token
$timeToUpdate = 300;  // 5 minutes
$regenerateDestroy = false;
```

### Utilisation

```php
// Vérifier si connecté
if (session()->has('admin_id')) {
    $adminId = session()->get('admin_id');
    $adminEmail = session()->get('admin_email');
}

// Déconnexion
session()->destroy();  // Automatiquement loggé par Auth controller
```

---

## 6. Rate Limiting (Intégré dans Auth)

### Fonctionnement Automatique

```
1. Première tentative échouée → Enregistrée
2. 5 tentatives en 15 min → Compte bloqué
3. Message: "Compte temporairement bloqué. Réessayez dans 15 minutes"
4. Après 15 min → Réinitialisation automatique
```

### Vérifier Manuellement

```php
$auditLog = new AuditLogModel();
$failedLogins = $auditLog->getFailedLogins('user@example.com', 15);

if (count($failedLogins) >= 5) {
    // L'utilisateur est bloqué
}
```

---

## 7. Routes Créées

### Audit Logs
```
GET  /auditlogs                          // Tous les logs
GET  /auditlogs/filterByAction/{action}  // Filtrer par action
GET  /auditlogs/userLogs/{id}           // Logs d'un utilisateur
GET  /auditlogs/failedLogins            // Tentatives échouées
GET  /auditlogs/export                  // Export CSV
POST /auditlogs/cleanup                 // Nettoyer vieux logs
```

### Email Verification
```
GET /auth/verifyEmail/{token}  // Confirmer email (automatique)
```

### File Upload
```
POST   /upload                       // Uploader fichier
DELETE /fileupload/delete/{filename} // Supprimer fichier
GET    /fileupload/list             // Lister fichiers
```

---

## 8. Exemples Complets

### Exemple 1: Créer un Compte Sécurisé

```php
// Dans votre contrôleur
public function register()
{
    // Récupérer les données (validées automatiquement)
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $auditLog = new AuditLogModel();
    $emailVerification = new EmailVerificationModel();

    try {
        // Créer l'utilisateur
        $user = new UserModel();
        $userId = $user->insert([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);

        // Générer token de vérification
        $token = $emailVerification->createVerificationToken($email, 'login', $userId);

        // Envoyer email
        $this->sendVerificationEmail($email, $token);

        // Logger
        $auditLog->logAction('USER_REGISTERED', 'success', ['email' => $email], 'user', $userId);

        return redirect()->to('/')->with('success', 'Vérifiez votre email');
    } catch (\Exception $e) {
        $auditLog->logAction('USER_REGISTRATION_FAILED', 'failed', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Erreur lors de l\'inscription');
    }
}
```

### Exemple 2: Protéger une Action Admin

```php
public function deleteUser($userId)
{
    // Vérifier si connecté
    if (!session()->has('admin_id')) {
        return redirect()->to('/auth/login');
    }

    $auditLog = new AuditLogModel();

    // Logger avant de supprimer
    $auditLog->logAction('USER_DELETED', 'success', ['deleted_user_id' => $userId], 'user', $userId, session()->get('admin_id'));

    // Supprimer l'utilisateur
    $userModel = new UserModel();
    $userModel->delete($userId);

    return redirect()->back()->with('success', 'Utilisateur supprimé');
}
```

### Exemple 3: Vérifier le Rate Limiting

```php
public function customLogin()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $auditLog = new AuditLogModel();

    // Vérifier le rate limiting
    $failedAttempts = $auditLog->getFailedLogins($email, 15);
    if (count($failedAttempts) >= 5) {
        return redirect()->back()->with('error', 'Compte bloqué. Réessayez plus tard.');
    }

    // ... votre logique de login ...
}
```

---

## 9. Dépannage

### Q: Les logs ne s'enregistrent pas?
**R:** Vérifiez que la table `audit_logs` existe:
```bash
php spark migrate
```

### Q: Les emails ne sont pas vérifiés?
**R:** Vérifiez que la table `email_verifications` existe et que le token est correct.

### Q: Le rate limiting ne fonctionne pas?
**R:** Vérifiez que `AuditLogModel` est correctement initialisée dans votre contrôleur.

### Q: Les fichiers ne s'uploadent pas?
**R:** 
1. Vérifiez les permissions du dossier `writable/uploads`
2. Vérifiez que le type MIME est autorisé
3. Vérifiez que la taille < 5MB

---

## 10. Bonnes Pratiques

✅ **À FAIRE:**
- Toujours logger les actions importantes
- Vérifier la session avant d'accéder aux données admin
- Utiliser les modèles pour les opérations DB
- Capturer les exceptions et les logger

❌ **À NE PAS FAIRE:**
- Stocker les mots de passe en clair
- Ignorer les erreurs de validation
- Désactiver le filtre d'input
- Stocker les tokens email en clair

---

## 11. Monitoring

### Accéder à la page des logs

Allez sur: `http://localhost:9000/auditlogs`

Vous verrez:
- ✅ Toutes les tentatives login (succès et échouées)
- ✅ Qui s'est connecté et quand
- ✅ D'où (adresse IP)
- ✅ Quel navigateur utilisé
- ✅ Quels fichiers ont été uploadés/supprimés

---

## 12. Support

Si vous avez besoin de modifier la sécurité:

1. **Ajouter une nouvelle action d'audit:**
   - Modifiez `AuditLogModel.php`
   - Appellez `logAction()` dans votre contrôleur

2. **Modifier le timeout de session:**
   - Éditez `app/Config/Session.php`
   - Changez `$expiration`

3. **Ajouter des types MIME:**
   - Modifiez `FileUploadController.php`
   - Ajoutez dans `$allowedMimeTypes`

4. **Ajouter du rate limiting ailleurs:**
   - Utilisez `getFailedLogins()` dans d'autres contrôleurs
   - Ou créez une méthode similaire pour d'autres actions

---

## ✨ Conclusion

Vous avez maintenant un système de sécurité complet et professionnel! 🔒

Questions? Consultez le `SECURITY_IMPLEMENTATION_REPORT.md`
