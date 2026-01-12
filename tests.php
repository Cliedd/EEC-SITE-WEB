<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests du Système</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px 20px;
            background-color: #f5f5f5;
        }
        .test-section {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .test-section h2 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .test-item {
            padding: 15px;
            margin-bottom: 10px;
            border-left: 4px solid #3498db;
            background-color: #ecf0f1;
            border-radius: 4px;
        }
        .badge {
            margin-left: 10px;
        }
        .code {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
            margin-top: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: #2c3e50; margin-bottom: 30px;">
            <i class="bi bi-hospital"></i> Tests du Système EEC
        </h1>

        <!-- Tests Connexion -->
        <div class="test-section">
            <h2>1. Teste de Connexion Admin</h2>

            <div class="test-item">
                <strong>URL de Connexion:</strong>
                <span class="badge bg-success">http://127.0.0.1:9000/auth/login</span>
                <div class="code">
                    Email: adminstrateurcmp@dashboard.com<br>
                    Mot de passe: Test@1234
                </div>
            </div>

            <div class="test-item">
                <strong>Dashboard Admin:</strong>
                <span class="badge bg-info">http://127.0.0.1:9000/admin</span>
                <p style="margin-top: 10px;">Après connexion réussie, vous verrez la dashboard avec les statistiques et les données</p>
            </div>
        </div>

        <!-- Tests de Fonctionnalités -->
        <div class="test-section">
            <h2>2. Fonctionnalités de la Dashboard</h2>

            <div class="test-item">
                <strong>Rendez-vous:</strong>
                <span class="badge bg-primary">http://127.0.0.1:9000/admin/appointments</span>
                <p style="margin-top: 10px;">Affiche la liste de tous les rendez-vous avec pagination</p>
            </div>

            <div class="test-item">
                <strong>Visiteurs:</strong>
                <span class="badge bg-primary">http://127.0.0.1:9000/admin/visitors</span>
                <p style="margin-top: 10px;">Affiche l'historique des visiteurs du site</p>
            </div>

            <div class="test-item">
                <strong>Comptes Utilisateurs:</strong>
                <span class="badge bg-primary">http://127.0.0.1:9000/admin/accounts</span>
                <p style="margin-top: 10px;">Affiche tous les comptes utilisateurs créés</p>
            </div>

            <div class="test-item">
                <strong>Messages de Contact:</strong>
                <span class="badge bg-primary">http://127.0.0.1:9000/admin/contacts</span>
                <p style="margin-top: 10px;">Affiche les messages reçus via le formulaire de contact</p>
            </div>

            <div class="test-item">
                <strong>Services:</strong>
                <span class="badge bg-primary">http://127.0.0.1:9000/admin/services</span>
                <p style="margin-top: 10px;">Affiche la liste des services médicaux disponibles</p>
            </div>
        </div>

        <!-- Tests de Formulaires -->
        <div class="test-section">
            <h2>3. Tests de Formulaires et Enregistrement de Données</h2>

            <div class="test-item">
                <strong>Page d'Accueil Test:</strong>
                <span class="badge bg-warning text-dark">http://127.0.0.1:9000/acceuil_test.php</span>
                <p style="margin-top: 10px;">Teste les fonctionnalités suivantes:</p>
                <ul style="margin-top: 10px; margin-bottom: 0;">
                    <li>Formulaire de rendez-vous - Crée automatiquement un rendez-vous dans la BD</li>
                    <li>Formulaire de contact - Crée automatiquement un message de contact</li>
                    <li>Suivi des visiteurs - Enregistre chaque visite automatiquement</li>
                </ul>
            </div>

            <div class="test-item">
                <strong>Enregistrement automatique des visiteurs:</strong>
                <p style="margin-top: 10px;">Chaque fois qu'un utilisateur visite une page du site, l'IP, le navigateur, la page visitée et l'heure sont enregistrés automatiquement dans la table <code>visitors</code></p>
            </div>
        </div>

        <!-- Informations Techniques -->
        <div class="test-section">
            <h2>4. Informations Techniques</h2>

            <div class="test-item">
                <strong>Serveur:</strong>
                <span class="badge bg-success">PHP 8.5.1</span>
                <span class="badge bg-success">CodeIgniter 4.6.1</span>
            </div>

            <div class="test-item">
                <strong>Base de Données:</strong>
                <span class="badge bg-success">MySQL - eecbafoussam</span>
                <p style="margin-top: 10px;">Tables créées et opérationnelles:</p>
                <ul style="margin-top: 10px; margin-bottom: 0;">
                    <li>admin_users - Comptes administrateurs</li>
                    <li>email_verifications - Vérification des emails</li>
                    <li>visitors - Enregistrement des visiteurs</li>
                    <li>appointments - Rendez-vous médicaux</li>
                    <li>accounts - Comptes utilisateurs du site</li>
                    <li>contacts - Messages de contact</li>
                    <li>services - Services médicaux</li>
                    <li>audit_logs - Logs des actions</li>
                </ul>
            </div>

            <div class="test-item">
                <strong>Authentification:</strong>
                <p style="margin-top: 10px;">Système d'authentification sécurisé avec:</p>
                <ul style="margin-top: 10px; margin-bottom: 0;">
                    <li>Bcrypt pour les mots de passe</li>
                    <li>Vérification des emails requise</li>
                    <li>Sessions sécurisées</li>
                    <li>Logs d'audit pour toutes les actions</li>
                </ul>
            </div>
        </div>

        <!-- Instructions d'Utilisation -->
        <div class="test-section">
            <h2>5. Instructions d'Utilisation</h2>

            <div class="test-item">
                <strong>Étape 1: Connectez-vous</strong>
                <div class="code">
                    Allez à: http://127.0.0.1:9000/auth/login<br>
                    Email: adminstrateurcmp@dashboard.com<br>
                    Mot de passe: Test@1234
                </div>
            </div>

            <div class="test-item">
                <strong>Étape 2: Accédez à la Dashboard</strong>
                <p>Une fois connecté, vous serez redirigé automatiquement vers la dashboard à /admin</p>
            </div>

            <div class="test-item">
                <strong>Étape 3: Consultez les Données</strong>
                <p>Utilisez le menu latéral pour naviguer entre les différentes sections</p>
            </div>

            <div class="test-item">
                <strong>Étape 4: Testez les Formulaires</strong>
                <p>Visitez la page d'accueil test pour soumettre des rendez-vous et des messages de contact</p>
            </div>
        </div>

        <!-- Status du Système -->
        <div class="test-section">
            <h2>6. Status du Système</h2>
            <div style="padding: 20px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; color: #155724;">
                <h4><i class="bi bi-check-circle"></i> Système Opérationnel</h4>
                <p style="margin-top: 10px; margin-bottom: 0;">
                    ✓ Authentification admin fonctionnelle<br>
                    ✓ Dashboard complète et responsive<br>
                    ✓ Enregistrement automatique des visiteurs<br>
                    ✓ Gestion des rendez-vous<br>
                    ✓ Gestion des messages de contact<br>
                    ✓ Gestion des comptes utilisateurs<br>
                    ✓ Logs d'audit complets<br>
                    ✓ Base de données synchronisée
                </p>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="test-section">
            <h2>7. Prochaines Étapes Suggérées</h2>

            <div class="test-item">
                <strong>1. Mise en Production:</strong>
                <p style="margin-top: 10px;">Configurer un certificat SSL, mettre en place une base de données de production, configurer les emails</p>
            </div>

            <div class="test-item">
                <strong>2. Notifications par Email:</strong>
                <p style="margin-top: 10px;">Ajouter les notifications par email pour les nouveaux rendez-vous et messages</p>
            </div>

            <div class="test-item">
                <strong>3. Paiements en Ligne:</strong>
                <p style="margin-top: 10px;">Intégrer un système de paiement pour les consultations en ligne</p>
            </div>

            <div class="test-item">
                <strong>4. Sauvegardes Régulières:</strong>
                <p style="margin-top: 10px;">Mettre en place un système de sauvegarde automatique de la base de données</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
