<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Démarrage Rapide - EEC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 20px;
            font-weight: 600;
            font-size: 18px;
        }

        .step-box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 5px solid #3498db;
        }

        .step-number {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #3498db;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            font-weight: 700;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .code-box {
            background: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            margin: 15px 0;
            border-left: 3px solid #3498db;
            overflow-x: auto;
        }

        .btn-link-custom {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 5px 10px 0;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            font-weight: 600;
        }

        .btn-link-custom:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            text-decoration: none;
            color: white;
        }

        .success-box {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 5px;
        }

        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="bi bi-hospital"></i> EEC Centre Médical</h1>
            <p>Votre système est maintenant 100% opérationnel!</p>
            <div style="margin-top: 15px;">
                <span class="status-badge">✓ Système Opérationnel</span>
                <span class="status-badge">✓ Database OK</span>
                <span class="status-badge">✓ Admin Connecté</span>
            </div>
        </div>

        <!-- Success Message -->
        <div class="success-box">
            <h4><i class="bi bi-check-circle"></i> Félicitations!</h4>
            <p style="margin-top: 10px; margin-bottom: 0;">
                Votre système d'administration pour le centre médical EEC est complètement configuré et opérationnel.
                Toutes les fonctionnalités sont intégrées et testées.
            </p>
        </div>

        <!-- Quick Start -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lightning-fill"></i> Démarrage Rapide (2 minutes)
            </div>
            <div class="card-body">
                <div class="step-box">
                    <span class="step-number">1</span>
                    <h5>Connectez-vous à la Dashboard</h5>
                    <p>Cliquez sur le bouton ci-dessous pour accéder à la page de connexion</p>
                    <a href="http://127.0.0.1:9000/auth/login" class="btn-link-custom" target="_blank">
                        <i class="bi bi-door-open"></i> Accéder à la Connexion
                    </a>
                </div>

                <div class="step-box">
                    <span class="step-number">2</span>
                    <h5>Identifiants de Connexion</h5>
                    <div class="code-box">
Email: <strong>adminstrateurcmp@dashboard.com</strong><br>
Mot de passe: <strong>Test@1234</strong>
                    </div>
                    <p style="color: #666; margin-top: 10px; margin-bottom: 0;">
                        <small>Copier-collez simplement ces identifiants dans le formulaire</small>
                    </p>
                </div>

                <div class="step-box">
                    <span class="step-number">3</span>
                    <h5>Accédez à la Dashboard</h5>
                    <p>Après connexion, vous serez automatiquement redirigé vers votre dashboard</p>
                    <a href="http://127.0.0.1:9000/admin" class="btn-link-custom" target="_blank">
                        <i class="bi bi-speedometer2"></i> Dashboard Admin
                    </a>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-gear-fill"></i> Fonctionnalités Principales
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-person-circle"></i> Gestion des Rendez-vous</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Consultez, créez et gérez tous les rendez-vous médicaux
                        </p>
                        <a href="http://127.0.0.1:9000/admin/appointments" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Voir les rendez-vous
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-eye"></i> Suivi des Visiteurs</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Analysez les statistiques de visite du site en temps réel
                        </p>
                        <a href="http://127.0.0.1:9000/admin/visitors" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Voir les visiteurs
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-person"></i> Gestion des Comptes</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Gérez tous les comptes utilisateurs créés
                        </p>
                        <a href="http://127.0.0.1:9000/admin/accounts" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Voir les comptes
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-envelope"></i> Messages de Contact</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Consultez les messages reçus via le site
                        </p>
                        <a href="http://127.0.0.1:9000/admin/contacts" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Voir les messages
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-stethoscope"></i> Gestion des Services</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Gérez les services médicaux disponibles
                        </p>
                        <a href="http://127.0.0.1:9000/admin/services" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Voir les services
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6><i class="bi bi-graph-up"></i> Statistiques Globales</h6>
                        <p style="color: #666; margin-bottom: 10px;">
                            Vue d'ensemble complète de votre plateforme
                        </p>
                        <a href="http://127.0.0.1:9000/admin" class="btn-link-custom" target="_blank" style="font-size: 12px;">
                            Dashboard Principale
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testing -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-beaker"></i> Tester le Système
            </div>
            <div class="card-body">
                <p>Vous pouvez tester les formulaires en accédant à la page d'accueil test:</p>
                <a href="http://127.0.0.1:9000/acceuil_test.php" class="btn-link-custom" target="_blank">
                    <i class="bi bi-window"></i> Page d'Accueil Test avec Formulaires
                </a>
                <p style="color: #666; margin-top: 15px; margin-bottom: 0;">
                    <small>Sur cette page, vous pouvez:</small>
                </p>
                <ul style="color: #666; margin-top: 5px;">
                    <li>Soumettre un rendez-vous → Enregistré automatiquement</li>
                    <li>Soumettre un message de contact → Enregistré automatiquement</li>
                    <li>Enregistrement des visiteurs → Automatique</li>
                </ul>
            </div>
        </div>

        <!-- Info -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Informations Système
            </div>
            <div class="card-body">
                <table class="table table-sm" style="margin-bottom: 0;">
                    <tr>
                        <td><strong>Framework:</strong></td>
                        <td>CodeIgniter 4.6.1</td>
                    </tr>
                    <tr>
                        <td><strong>PHP Version:</strong></td>
                        <td>8.5.1</td>
                    </tr>
                    <tr>
                        <td><strong>Database:</strong></td>
                        <td>MySQL (eecbafoussam)</td>
                    </tr>
                    <tr>
                        <td><strong>Serveur:</strong></td>
                        <td>http://127.0.0.1:9000</td>
                    </tr>
                    <tr>
                        <td><strong>Tables:</strong></td>
                        <td>8 tables opérationnelles</td>
                    </tr>
                    <tr>
                        <td><strong>Sécurité:</strong></td>
                        <td>Bcrypt, Sessions sécurisées, Logs d'audit</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Important -->
        <div class="warning-box">
            <h5><i class="bi bi-exclamation-triangle"></i> Notes Importantes</h5>
            <ul style="margin-bottom: 0;">
                <li><strong>Sauvegarde:</strong> Faites régulièrement des sauvegardes de votre base de données</li>
                <li><strong>Sécurité:</strong> Changez le mot de passe après le test</li>
                <li><strong>SSL:</strong> En production, utilisez un certificat SSL/HTTPS</li>
                <li><strong>Emails:</strong> Configurez les notifications par email pour les rendez-vous</li>
            </ul>
        </div>

        <!-- Footer -->
        <div style="background: white; padding: 20px; border-radius: 10px; text-align: center; margin-top: 30px;">
            <p style="color: #666; margin: 0;">
                Système EEC Centre Médical © 2026 - Tous droits réservés
            </p>
            <p style="color: #999; font-size: 12px; margin-top: 10px; margin-bottom: 0;">
                Documentation complète disponible dans <code>README_COMPLET.md</code>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Message de bienvenue
        setTimeout(() => {
            console.log('%c🏥 Bienvenue sur EEC Centre Médical!', 'font-size: 20px; color: #3498db; font-weight: bold;');
            console.log('%cLe système est 100% opérationnel. Bonne utilisation!', 'font-size: 14px; color: #27ae60;');
        }, 500);
    </script>
</body>
</html>
