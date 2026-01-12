<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte créé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }
        .logo {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .success-badge {
            display: inline-block;
            background-color: #27ae60;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            margin-top: 10px;
            font-weight: bold;
        }
        .content {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
        }
        .info-box {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 12px;
            border-radius: 4px;
            margin: 15px 0;
        }
        .features {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .features ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .features li {
            margin: 8px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 EEC Centre Médical</h1>
            <div class="logo">Bienvenue!</div>
            <div class="success-badge">✓ Compte créé avec succès</div>
        </div>

        <div class="content">
            <p>Bonjour <strong><?= htmlspecialchars($userName) ?></strong>,</p>

            <p>Votre compte a été créé avec succès! Vous pouvez maintenant accéder à tous les services de notre plateforme.</p>

            <div class="info-box">
                <strong>ℹ️ Email de votre compte:</strong><br>
                <?= htmlspecialchars($email) ?>
            </div>

            <p><strong>Vous pouvez maintenant:</strong></p>
            <div class="features">
                <ul>
                    <li>✓ Prendre rendez-vous avec nos spécialistes</li>
                    <li>✓ Consulter l'historique de vos visites</li>
                    <li>✓ Recevoir des rappels de rendez-vous</li>
                    <li>✓ Contacter nos services médicaux</li>
                    <li>✓ Accéder à votre dossier médical sécurisé</li>
                </ul>
            </div>

            <p><strong>Pour vous connecter:</strong></p>
            <ol>
                <li>Allez sur notre site: <a href="http://localhost:9000" style="color: #3498db;">http://localhost:9000</a></li>
                <li>Cliquez sur "Se connecter"</li>
                <li>Entrez votre email et mot de passe</li>
            </ol>

            <p style="margin-top: 30px;"><strong>Besoin d'aide?</strong><br>
            N'hésitez pas à nous contacter:</p>
            <ul>
                <li>📞 Téléphone: +237 6XX XXX XXX</li>
                <li>📧 Email: support@eecmedical.cm</li>
                <li>💬 Chat en direct sur notre site</li>
            </ul>

            <p>Cordialement,<br><strong>L'équipe EEC Centre Médical</strong></p>
        </div>

        <div class="footer">
            <p>© 2026 EEC Centre Médical. Tous droits réservés.</p>
            <p>Cet email vous a été envoyé car vous avez créé un compte sur notre plateforme.</p>
        </div>
    </div>
</body>
</html>
