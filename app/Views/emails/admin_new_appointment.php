<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau rendez-vous</title>
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
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #e74c3c;
        }
        .alert-badge {
            display: inline-block;
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            margin-top: 10px;
            font-weight: bold;
        }
        .appointment-details {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            margin: 30px 0;
            border-left: 4px solid #3498db;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            padding: 8px 0;
            border-bottom: 1px solid #bdc3c7;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #2c3e50;
        }
        .value {
            color: #555;
        }
        .dossier-number {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
            border: 2px solid #ffc107;
        }
        .dossier-number strong {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }
        .dossier-number .number {
            font-size: 24px;
            color: #e74c3c;
            font-weight: bold;
            font-family: monospace;
        }
        .content {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
        }
        .info-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin: 15px 0;
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
            <h1>🔔 Nouveau Rendez-vous</h1>
            <div class="alert-badge">⚠️ À traiter</div>
        </div>

        <div class="content">
            <p>Un nouveau rendez-vous a été enregistré sur la plateforme. Voici les détails:</p>

            <div class="appointment-details">
                <div class="detail-row">
                    <span class="label">👤 Nom du client:</span>
                    <span class="value"><strong><?= htmlspecialchars($name) ?></strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">📧 Email:</span>
                    <span class="value"><?= htmlspecialchars($email) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">📞 Téléphone:</span>
                    <span class="value"><?= htmlspecialchars($phone) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">📅 Date:</span>
                    <span class="value"><strong><?= date('d/m/Y', strtotime($date)) ?></strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">⏰ Heure:</span>
                    <span class="value"><strong><?= htmlspecialchars($time) ?></strong></span>
                </div>
                <div class="detail-row">
                    <span class="label">🏥 Service:</span>
                    <span class="value"><?= htmlspecialchars($service) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">📝 Raison:</span>
                    <span class="value"><?= htmlspecialchars($reason) ?></span>
                </div>
            </div>

            <div class="dossier-number">
                <strong>NUMÉRO DE DOSSIER ATTRIBUÉ</strong>
                <div class="number"><?= htmlspecialchars($dossierNumber) ?></div>
            </div>

            <div class="info-box">
                <strong>✓ Status:</strong> Rendez-vous confirmé et enregistré dans le système
            </div>

            <p><strong>Actions recommandées:</strong></p>
            <ul>
                <li>Vérifier la disponibilité du médecin/service</li>
                <li>Contacter le client si besoin de clarification</li>
                <li>Préparer le dossier du patient</li>
                <li>Envoyer un rappel 24h avant le rendez-vous</li>
            </ul>

            <p style="margin-top: 30px;">Consultez votre tableau de bord pour gérer ce rendez-vous:</p>
            <p style="text-align: center;">
                <a href="http://localhost:9000/admin" style="color: #3498db; text-decoration: none; font-weight: bold;">
                    → Accéder au tableau de bord
                </a>
            </p>

            <p>Cordialement,<br><strong>Système EEC Centre Médical</strong></p>
        </div>

        <div class="footer">
            <p>© 2026 EEC Centre Médical. Tous droits réservés.</p>
            <p>Cet email est une notification système. Veuillez le traiter rapidement.</p>
        </div>
    </div>
</body>
</html>
