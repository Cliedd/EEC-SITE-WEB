# Guide d'intégration Email - EEC Centre Médical

## Vue d'ensemble

Le système d'email a été entièrement intégré dans l'application CodeIgniter 4 avec Gmail SMTP. Les emails sont envoyés automatiquement aux points clés du flux d'application.

---

## Configuration SMTP

**Fichier:** `app/Config/Email.php`

```php
public string $protocol = 'smtp';
public string $SMTPHost = 'smtp.gmail.com';
public int $SMTPPort = 587;
public string $SMTPUser = 'boumbisaij@gmail.com';
public string $SMTPPass = 'uintjoiyiawuvgio'; // App Password
public string $SMTPCrypto = 'tls';
public string $mailType = 'html';
public bool $SMTPVerifySSL = false; // Mode développement
```

**Paramètres Gmail :**
- **Protocole:** SMTP (TLS)
- **Port:** 587
- **Authentication:** Gmail App Password (non le mot de passe principal)
- **Format:** HTML avec CSS intégré

---

## EmailService - Classe réutilisable

**Fichier:** `app/Services/EmailService.php`

### Méthodes disponibles

#### 1. **sendVerificationEmail($email, $userName, $verificationLink)**
Envoie un email de vérification d'adresse email.

```php
$emailService = new EmailService();
$emailService->sendVerificationEmail(
    'user@example.com',
    'John Doe',
    'https://eecsite.com/auth/verify?token=...'
);
```

**Template:** `app/Views/emails/verification_email.php`

#### 2. **sendAppointmentConfirmation($name, $date, $service, $dossierNumber, $email, $phone, $reason)**
Envoie une confirmation de rendez-vous au patient.

```php
$emailService->sendAppointmentConfirmation(
    'Jean Dupont',
    '2024-01-20 10:30',
    'Consultation générale',
    12345,
    'jean@example.com',
    '+33612345678',
    'Douleur abdominale'
);
```

**Template:** `app/Views/emails/appointment_confirmation.php`

#### 3. **sendNewAppointmentNotificationToAdmin($name, $email, $phone, $date, $service, $reason, $dossierNumber)**
Envoie une alerte à l'administrateur pour un nouveau rendez-vous.

```php
$emailService->sendNewAppointmentNotificationToAdmin(
    'Jean Dupont',
    'jean@example.com',
    '+33612345678',
    '2024-01-20 10:30',
    'Consultation générale',
    'Douleur abdominale',
    12345
);
```

**Template:** `app/Views/emails/admin_new_appointment.php`

#### 4. **sendAccountCreatedEmail($email, $userName)**
Envoie un email de bienvenue après création de compte.

```php
$emailService->sendAccountCreatedEmail('user@example.com', 'John Doe');
```

**Template:** `app/Views/emails/account_created.php`

#### 5. **sendPasswordResetEmail($email, $resetLink)**
Envoie un lien de réinitialisation de mot de passe.

```php
$emailService->sendPasswordResetEmail(
    'user@example.com',
    'https://eecsite.com/auth/reset-password?token=...'
);
```

#### 6. **sendNotification($to, $subject, $templatePath, $data)**
Méthode générique pour envoyer des emails personnalisés avec n'importe quel template.

```php
$emailService->sendNotification(
    'user@example.com',
    'Mise à jour de votre rendez-vous',
    'emails/appointment_status_update',
    [
        'name' => 'Jean Dupont',
        'date' => '2024-01-20',
        'service' => 'Consultation',
        'status' => 'CONFIRMÉ',
        'statusColor' => 'green'
    ]
);
```

---

## Intégrations dans les Contrôleurs

### 1. **Creer_compte.php** (Inscription)
Envoie automatiquement un email de vérification lors de l'inscription.

```php
// Après la création du compte :
$emailService->sendVerificationEmail(
    $email,
    $name,
    $verificationLink
);
```

**Flux :**
1. L'utilisateur crée un compte
2. Un token de vérification est généré
3. Un email de vérification est envoyé
4. L'utilisateur clique sur le lien pour vérifier son email

### 2. **AppointmentController.php** (Rendez-vous)

#### À la création d'un rendez-vous
```php
// Email au patient
$emailService->sendAppointmentConfirmation(...);

// Notification à l'admin
$emailService->sendNewAppointmentNotificationToAdmin(...);
```

#### À la mise à jour du statut
```php
public function updateStatus($appointmentId)
{
    // Si confirmé
    if ($newStatus === 'confirmed') {
        $emailService->sendNotification(
            $appointment['email'],
            'Votre rendez-vous a été confirmé',
            'emails/appointment_status_update',
            [...] // données
        );
    }
    
    // Si annulé
    elseif ($newStatus === 'cancelled') {
        $emailService->sendNotification(
            $appointment['email'],
            'Votre rendez-vous a été annulé',
            'emails/appointment_status_update',
            [...] // données
        );
    }
}
```

### 3. **Dashboard.php** (Admin)

#### Mise à jour du statut depuis le dashboard
```php
public function updateAppointmentStatus($appointmentId)
{
    // ... mise à jour du statut ...
    
    // Notification automatique au patient
    if ($status === 'confirmed') {
        $this->emailService->sendNotification(...);
    }
}
```

#### Envoi manuel d'email de rappel
```php
public function sendEmailFromDashboard($appointmentId)
{
    $this->emailService->sendNotification(
        $appointment['email'],
        'Rappel de rendez-vous',
        'emails/appointment_reminder',
        [...]
    );
}
```

---

## Templates Email

Tous les templates sont situés dans `app/Views/emails/`

### 1. **verification_email.php**
- **Usage:** Vérification d'adresse email
- **Variables:** `$userName`, `$verificationLink`
- **Style:** Bouton CTA + lien direct

### 2. **appointment_confirmation.php**
- **Usage:** Confirmation de rendez-vous au patient
- **Variables:** `$name`, `$date`, `$time`, `$service`, `$dossierNumber`, `$phone`
- **Style:** Badge de succès + tableau de détails

### 3. **admin_new_appointment.php**
- **Usage:** Alerte pour nouvel rendez-vous
- **Variables:** `$name`, `$email`, `$phone`, `$date`, `$time`, `$service`, `$reason`, `$dossierNumber`
- **Style:** Badge d'alerte + détails complets

### 4. **account_created.php**
- **Usage:** Email de bienvenue
- **Variables:** `$userName`, `$email`
- **Style:** Message de bienvenue + liste de fonctionnalités

### 5. **appointment_status_update.php**
- **Usage:** Mise à jour du statut de rendez-vous
- **Variables:** `$name`, `$date`, `$service`, `$status`, `$statusColor`
- **Style:** Badge de statut dynamique (vert/rouge)

### 6. **appointment_reminder.php**
- **Usage:** Rappel de rendez-vous
- **Variables:** `$name`, `$date`, `$service`, `$reason`, `$status`
- **Style:** Alerte jaune + instructions

---

## Flux d'email dans l'application

```
┌─────────────────────────────────────────────────────┐
│         Événement utilisateur                       │
└────────────────┬────────────────────────────────────┘
                 │
        ┌────────┴─────────────────────────────────┐
        │                                          │
        ▼                                          ▼
┌──────────────────┐                    ┌────────────────────┐
│ Inscription      │                    │ Rendez-vous        │
│ (Creer_compte)   │                    │ (Appointment)      │
└────────┬─────────┘                    └────────┬───────────┘
         │                                       │
         ▼                                       ├─► Email patient (confirmation)
    ✉ Email de                                  │
    vérification                                └─► Email admin (alerte)
    + Token                                         
         │                                       │
         │                                       ▼
         │                              ┌────────────────────┐
         │                              │ Mise à jour statut │
         │                              │ (Dashboard)        │
         │                              └────────┬───────────┘
         │                                       │
         │                    ┌──────────────────┼──────────────────┐
         │                    │                  │                  │
         │                    ▼                  ▼                  ▼
         │              ✉ Confirmé         ✉ Annulé         ✉ Rappel manuel
         │
         └──────────────────┬─────────────────────────┘
                            │
                            ▼
                    ✓ Utilisateur vérifié
```

---

## Tests d'envoi d'email

### Test depuis le contrôleur
```php
$emailService = new EmailService();
$result = $emailService->sendVerificationEmail(
    'test@gmail.com',
    'Test User',
    'http://localhost/verify?token=test123'
);
```

### Vérification des logs
```
writable/logs/log-2024-*.log
```

### Configuration SMTP en production
Pour la production, modifier `app/Config/Email.php`:
```php
public bool $SMTPVerifySSL = true; // Production
```

---

## Dépannage

### Erreur: "SMTP connect() failed"
- Vérifier la connexion Internet
- Vérifier que SMTP Port 587 n'est pas bloqué
- Vérifier les credentials Gmail

### Erreur: "535 5.7.8 Username and Password not accepted"
- Utiliser l'App Password (pas le mot de passe Gmail principal)
- S'assurer que l'app password est correct: `uintjoiyiawuvgio`

### Erreur: "554 Message rejected"
- Vérifier le format HTML du template
- Vérifier les adresses email (format valide)

### Les emails ne sont pas envoyés
- Vérifier que le service Email est configuré
- Vérifier les logs: `writable/logs/`
- Vérifier que les templates existent

---

## Variables d'environnement (optionnel)

Pour plus de sécurité, stocker les credentials dans `.env`:

```env
email.SMTPUser=boumbisaij@gmail.com
email.SMTPPass=uintjoiyiawuvgio
```

Puis modifier `app/Config/Email.php`:
```php
public string $SMTPUser = $_ENV['email.SMTPUser'];
public string $SMTPPass = $_ENV['email.SMTPPass'];
```

---

## Résumé des intégrations

| Événement | Contrôleur | Email envoyé à | Template |
|-----------|-----------|----------------|----------|
| Inscription | Creer_compte::store() | Patient | verification_email.php |
| Nouveau rendez-vous | Appointment::store() | Patient + Admin | appointment_confirmation.php + admin_new_appointment.php |
| Confirmer rendez-vous | Dashboard::updateAppointmentStatus() | Patient | appointment_status_update.php |
| Annuler rendez-vous | Dashboard::updateAppointmentStatus() | Patient | appointment_status_update.php |
| Rappel manual | Dashboard::sendEmailFromDashboard() | Patient | appointment_reminder.php |

---

## Support

Pour toute question ou problème relatif aux emails:
1. Vérifier les logs: `writable/logs/`
2. Tester avec `sendEmailFromDashboard()` depuis l'admin
3. Vérifier la configuration SMTP: `app/Config/Email.php`

Dernière mise à jour: 2024
