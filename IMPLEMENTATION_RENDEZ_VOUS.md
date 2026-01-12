# Implémentation du Système de Gestion des Rendez-vous et Visiteurs

## 📋 Résumé des Modifications

Ce document détaille les changements apportés au site EEC Centre Médical pour implémenter un système complet de gestion des rendez-vous, visiteurs et tableau de bord administrateur.

---

## 🗄️ 1. Modifications de la Base de Données

### Migrations Exécutées

#### 1. Création de la Table `appointments` (Rendez-vous)
- **Fichier**: `app/Database/Migrations/2026-01-02-000002_CreateAppointmentsTable.php`
- **Champs**:
  - `id_appointment` (INT, PRIMARY KEY, AUTO_INCREMENT)
  - `idlogin` (INT, NULLABLE - clé étrangère vers login)
  - `name_surName` (VARCHAR 100)
  - `email` (VARCHAR 100)
  - `telephone` (VARCHAR 20)
  - `date_appointment` (DATETIME)
  - `raison` (TEXT)
  - `status` (ENUM: pending, confirmed, cancelled)
  - `date_creation` (DATETIME AUTO TIMESTAMP)
  - `date_modification` (DATETIME)

#### 2. Création de la Table `visitors` (Visiteurs)
- **Fichier**: `app/Database/Migrations/2026-01-02-000003_CreateVisitorsTable.php`
- **Champs**:
  - `id_visitor` (INT, PRIMARY KEY, AUTO_INCREMENT)
  - `idlogin` (INT, NULLABLE - clé étrangère)
  - `name_surName` (VARCHAR 100)
  - `email` (VARCHAR 100)
  - `telephone` (VARCHAR 20)
  - `visitor_type` (ENUM: new_account, appointment_request, contact)
  - `date_visit` (DATETIME)

**Status**: ✅ Exécutées avec succès

---

## 📁 2. Models Créés/Modifiés

### AppointmentModel
- **Fichier**: `app/Models/AppointmentModel.php`
- **Fonctionnalités**:
  - Gestion complète des rendez-vous (CRUD)
  - Validation des données avec messages en français
  - Timestamps automatiques

### VisitorModel
- **Fichier**: `app/Models/VisitorModel.php`
- **Fonctionnalités**:
  - Suivi des visiteurs (création de compte, demande de rendez-vous, contact)
  - Enregistrement automatique de toute activité

---

## 🎮 3. Contrôleurs Modifiés/Créés

### Creer_compte.php (Modifié)
**Modifications**:
- Import du `VisitorModel`
- Méthode `store()` mise à jour pour:
  - Créer automatiquement un enregistrement `visiteur` avec `visitor_type = 'new_account'`
  - Enregistrer la date et l'heure de la visite
  - Lier le visiteur au compte créé via `idlogin`

**Code ajouté**:
```php
// Enregistrer automatiquement comme nouveau visiteur
if($idlogin){
    $VisitorModel = new VisitorModel();
    $visitorData = [
        'idlogin' => $idlogin,
        'name_surName' => $this->request->getPost('name_surName'),
        'email' => $this->request->getPost('email'),
        'telephone' => $this->request->getPost('telephone'),
        'visitor_type' => 'new_account',
        'date_visit' => date('Y-m-d H:i:s')
    ];
    $VisitorModel->save($visitorData);
}
```

### AppointmentController.php (Créé)
- **Fichier**: `app/Controllers/AppointmentController.php`
- **Méthodes**:
  - `index()` - Affiche le formulaire de rendez-vous
  - `store()` - Enregistre un rendez-vous avec:
    - Validation des données
    - Enregistrement en base de données
    - Création d'enregistrement visiteur si non connecté
    - **Envoi automatique d'email de confirmation**
  - `getDetails($id)` - Récupère les détails d'un rendez-vous (JSON)
  - `sendConfirmationEmail()` - Envoie email HTML formaté

**Fonctionnalités clés**:
- Validation complète du formulaire
- Enregistrement du rendez-vous avec statut "pending"
- Enregistrement automatique comme visiteur avec `visitor_type = 'appointment_request'`
- Email de confirmation HTML contenant:
  - Les détails du rendez-vous
  - Le numéro de dossier
  - Instructions pour confirmer par téléphone

### Dashboard.php (Complètement Recréé)
- **Fichier**: `app/Controllers/Dashboard.php`
- **Méthodes**:
  - `index()` - Affiche le tableau de bord complet avec:
    - Statistiques totales (rendez-vous, visiteurs, utilisateurs)
    - Statistiques par statut (en attente, confirmés)
    - Groupe de visiteurs par type
    - Liste des 10 rendez-vous récents
    - Liste des 10 visiteurs récents
  - `updateAppointmentStatus($id)` - Met à jour le statut d'un rendez-vous
  - `deleteAppointment($id)` - Supprime un rendez-vous
  - `sendEmailFromDashboard($id)` - Envoie un email de rappel depuis le dashboard

**Fonctionnalités**:
- Vue d'ensemble avec statistiques en temps réel
- Gestion complète des rendez-vous (modification, suppression, email)
- Gestion des visiteurs (affichage, suivi)
- Gestion des utilisateurs (affichage)

---

## 🖼️ 4. Vues Modifiées/Créées

### PrendreRendez_vous.php (Modifiée)
**Modifications**:
- Import de Bootstrap 5.3.0 pour les modales
- Mise à jour du formulaire pour collecter:
  - `name_surName` (nom complet)
  - `email` (adresse email)
  - `telephone` (numéro de téléphone)
  - `date_appointment` (date du rendez-vous)
  - `raison` (motif de la visite)

**Fonctionnalités JavaScript**:
- Soumission du formulaire en AJAX
- Affichage d'une modal de confirmation contenant:
  - Message de succès
  - Numéro de dossier du rendez-vous
  - Numéros de téléphone du centre pour confirmation
  - Message explicite demandant d'appeler pour confirmer
  - Confirmation de l'email envoyé

**Modal Bootstrap**:
```html
<!-- Détails du rendez-vous enregistré -->
- Numéro de dossier unique
- Deux numéros de téléphone pour confirmation
- Instructions claires en français
- Boutons: Fermer | Retour à l'accueil
```

### dashboard/dashboard.php (Créé)
**Contenus**:
- **Sidebar de navigation** avec 4 onglets:
  - Vue d'ensemble (Overview)
  - Rendez-vous (Appointments)
  - Visiteurs (Visitors)
  - Utilisateurs (Users)

- **Onglet Vue d'ensemble**:
  - Cartes de statistiques: Total, En attente, Confirmés, Visiteurs
  - Statistiques par type de visiteur
  - Table des 10 rendez-vous récents

- **Onglet Rendez-vous**:
  - Table complète de tous les rendez-vous
  - Boutons d'action: Modifier, Email, Supprimer
  - Affichage du statut avec badges de couleur

- **Onglet Visiteurs**:
  - Table de tous les visiteurs
  - Regroupement par type de visite
  - Historique des visites

- **Onglet Utilisateurs**:
  - Table de tous les utilisateurs enregistrés
  - Données: ID, Nom, Email, Téléphone, Date création

**Fonctionnalités JavaScript**:
- Navigation entre onglets
- Modification du statut d'un rendez-vous
- Envoi d'email de rappel
- Suppression de rendez-vous
- Confirmations avant actions critiques

**Styles CSS**:
- Sidebar fixe à gauche (250px)
- Responsive sur mobile
- Cartes de statistiques avec couleurs distinctes
- Badges de statut: orange (pending), vert (confirmed), rouge (cancelled)
- Tableau responsive avec scroll horizontal

---

## 🔗 5. Routage Mis à Jour

**Fichier**: `app/Config/Routes.php`

### Routes Appointments
```php
$routes->get('appointment', 'AppointmentController::index');
$routes->post('appointment/store', 'AppointmentController::store');
$routes->get('appointment/details/(:num)', 'AppointmentController::getDetails/$1');
```

### Routes Dashboard
```php
$routes->get('admin', 'Dashboard::index');
$routes->post('admin/updateAppointmentStatus/(:num)', 'Dashboard::updateAppointmentStatus/$1');
$routes->post('admin/deleteAppointment/(:num)', 'Dashboard::deleteAppointment/$1');
$routes->post('admin/sendEmailFromDashboard/(:num)', 'Dashboard::sendEmailFromDashboard/$1');
```

---

## 📧 6. Fonctionnalité Email

### Configuration Requise
- Service email CodeIgniter configuré dans `app/Config/Email.php`
- Actuellement configuré pour utiliser SMTP (à adapter selon votre serveur)

### Emails Automatiques
1. **Email de confirmation de rendez-vous**
   - Déclenché: Lors de la création d'un rendez-vous
   - Contient: Détails du rendez-vous + numéro de dossier
   - Destinataire: Email fourni dans le formulaire

2. **Email de rappel depuis le dashboard**
   - Déclenché: Manuellement par l'administrateur
   - Contient: Détails du rendez-vous + rappel de statut
   - Destinataire: Email du client

---

## 🔄 7. Flux de Données

### Création de Compte
```
1. Utilisateur remplit formulaire creer_un_compte
2. POST /Creer_compte/store
3. Validation des données
4. Enregistrement en table `login`
5. Création automatique en table `visitors` (type: new_account)
6. Redirection avec message de succès
```

### Demande de Rendez-vous
```
1. Utilisateur remplit formulaire rendez-vous
2. POST /appointment/store (via AJAX)
3. Validation des données
4. Enregistrement en table `appointments` (status: pending)
5. Création visiteur si non connecté (type: appointment_request)
6. Envoi email de confirmation automatique
7. Affichage modal de confirmation avec:
   - Numéro de dossier
   - Numéros de téléphone
   - Instructions de confirmation
```

### Gestion Dashboard
```
1. Admin accède /admin
2. Affichage de toutes les statistiques
3. Admin peut:
   - Voir tous les rendez-vous
   - Modifier le statut d'un rendez-vous
   - Envoyer email de rappel
   - Supprimer un rendez-vous
   - Consulter l'historique des visiteurs
   - Voir tous les utilisateurs enregistrés
```

---

## 📊 8. Types de Visiteurs Tracés

| Type | Déclencheur | Description |
|------|------------|-------------|
| `new_account` | Création de compte | Nouvel utilisateur enregistré |
| `appointment_request` | Demande de rendez-vous | Client qui a demandé un RDV |
| `contact` | Formulaire de contact | Client qui a rempli formulaire contact |

---

## 🔐 9. Sécurité et Validation

### Validation Formulaire
- **Rendez-vous**:
  - Nom: 3-100 caractères (requis)
  - Email: Format email valide (requis)
  - Téléphone: 10-20 chiffres (requis)
  - Date: Requise
  - Raison: Optionnelle

- **Compte**:
  - Nom: 3-50 caractères (requis)
  - Email: Format email valide (requis)
  - Téléphone: 10-15 chiffres (requis)
  - Password: Min 8 caractères, hashé (PASSWORD_DEFAULT)

### Messages d'Erreur
- En français
- Affichage dynamique dans les formulaires
- Réponses JSON avec statut et messages détaillés

---

## 🚀 10. Installation et Déploiement

### Prérequis
- PHP 8.5.1 ou supérieur
- MySQL/MariaDB
- Extensions: intl, mbstring, mysqli
- CodeIgniter 4.6.1

### Étapes d'Installation Effectuées
1. ✅ Création des migrations pour appointments et visitors
2. ✅ Exécution des migrations (`php spark migrate`)
3. ✅ Création des models
4. ✅ Création des controllers
5. ✅ Création des vues
6. ✅ Configuration des routes
7. ✅ Démarrage du serveur de développement

### Démarrage du Serveur
```bash
php spark serve --host localhost --port 9000
```

---

## 📱 11. Accès aux Nouvelles Fonctionnalités

### Pour les Clients
- **Créer un compte**: `http://localhost:9000/Creer_compte`
- **Prendre rendez-vous**: `http://localhost:9000/PrendreRendez_vous`
- **Voir les rendez-vous existants**: Après connexion, accès via dashboard personnel

### Pour les Administrateurs
- **Dashboard complet**: `http://localhost:9000/admin`
- **Gestion des rendez-vous**: Onglet "Rendez-vous" dans le dashboard
- **Gestion des visiteurs**: Onglet "Visiteurs" dans le dashboard
- **Gestion des utilisateurs**: Onglet "Utilisateurs" dans le dashboard

---

## 🎯 12. Fonctionnalités Complétées

✅ **Enregistrement automatique des visiteurs** lors de création de compte
✅ **Enregistrement automatique des rendez-vous** en base de données
✅ **Pop-up de confirmation** avec modal Bootstrap
✅ **Envoi automatique d'emails** de confirmation avec PHP
✅ **Table appointments** créée et opérationnelle
✅ **Table visitors** créée et opérationnelle
✅ **Dashboard complète** avec toutes les données du site
✅ **Gestion des statuts** des rendez-vous
✅ **Interface administrative** intuitive et responsive

---

## 📝 Notes Importantes

1. **Configuration Email**: Assurez-vous que le serveur SMTP est configuré correctement dans `app/Config/Email.php`
2. **Base de Données**: Toutes les migrations ont été exécutées avec succès
3. **Routes**: Vérifiez que `setAutoRoute(true)` est activé pour les actions personnalisées
4. **Sécurité**: Ajoutez un système d'authentification pour protéger le dashboard admin
5. **Bootstrap**: La version 5.3.0 est utilisée pour les modales et le responsive design

---

## 🔧 Maintenance Future

### À Faire
- [ ] Ajouter authentification pour le dashboard admin
- [ ] Implémenter des rapports/statistiques avancées
- [ ] Ajouter export des données en CSV/PDF
- [ ] Implémenter des rappels automatiques par SMS
- [ ] Ajouter système de notification par push
- [ ] Implémenter pagination pour les grandes tables
- [ ] Ajouter filtrage et recherche avancée
- [ ] Implémenter sauvegarde/restauration de base de données

---

**Date de Création**: 2 Janvier 2026
**Version**: 1.0
**Status**: ✅ Complet et Opérationnel

