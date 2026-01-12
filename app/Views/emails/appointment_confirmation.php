<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de rendez-vous</title>
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
            color: #ff6b6b;
            font-weight: bold;
            font-family: monospace;
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
            <div class="logo">Confirmation de rendez-vous</div>
            <div class="success-badge">✓ Confirmation reçue</div>
        </div>

        <div class="content">
            <p>Bonjour <strong><?= htmlspecialchars($name) ?></strong>,</p>

            <p>Votre rendez-vous a été enregistré avec succès. Voici les détails de votre visite:</p>

            <div class="appointment-details">
                <div class="detail-row">
                    <span class="label">📅 Date:</span>
                    <span class="value"><?= date('d/m/Y', strtotime($date)) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">⏰ Heure:</span>
                    <span class="value"><?= htmlspecialchars($time) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">🏥 Service:</span>
                    <span class="value"><?= htmlspecialchars($service) ?></span>
                </div>
                <div class="detail-row">
                    <span class="label">📞 Téléphone:</span>
                    <span class="value"><?= htmlspecialchars($phone) ?></span>
                </div>
            </div>

            <div class="dossier-number">
                <strong>NUMÉRO DE DOSSIER</strong>
                <div class="number"><?= htmlspecialchars($dossierNumber) ?></div>
            </div>

            <div class="info-box">
                <strong>ℹ️ Important:</strong> Veuillez conserver votre numéro de dossier. Vous en aurez besoin lors de votre visite.
            </div>

            <p><strong>Points à retenir:</strong></p>
            <ul>
                <li>Arrivez <strong>15 minutes avant</strong>votre rendez-vous</li>
                <li>Apportez votre carte d'identité ou pièce d'identité</li>
                <li>Apportez tout document médical pertinent</li>
                <li>Pour annuler ou reporter, contactez-nous au moins 24h avant</li>
            </ul>

            <p><strong>Besoin d'assistance?</strong><br>
            Contactez-nous:</p>
            <ul>
                <li>📞 Téléphone: +237 6XX XXX XXX</li>
                <li>📧 Email: contact@eecmedical.cm</li>
                <li>🏥 Adresse: EEC Centre Médical, Bafoussam</li>
            </ul>

            <p style="margin-top: 30px;">Merci de votre confiance!<br><strong>L'équipe EEC Centre Médical</strong></p>
        </div>

        <div class="footer">
            <p>© 2026 EEC Centre Médical. Tous droits réservés.</p>
            <p>Cet email est une confirmation de votre rendez-vous pris sur notre plateforme.</p>
        </div>
    </div>
</body>
</html>
