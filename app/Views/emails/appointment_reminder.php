<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .reminder-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fcd34d 100%);
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
            color: #78350f;
        }
        .reminder-box h3 {
            margin: 0 0 15px 0;
            color: #92400e;
            font-size: 16px;
        }
        .appointment-info {
            background-color: #f9fafb;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .appointment-info h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 16px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #666;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #333;
        }
        .info-value {
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            background-color: #dbeafe;
            color: #1e40af;
        }
        .instructions {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            color: #065f46;
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 13px;
        }
        .footer p {
            margin: 5px 0;
        }
        .contact-info {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔔 Rappel de rendez-vous</h1>
        </div>
        
        <div class="content">
            <p class="greeting">
                Bonjour <strong><?php echo isset($name) ? htmlspecialchars($name) : 'Patient'; ?></strong>,
            </p>
            
            <div class="reminder-box">
                <h3>⏰ N'oubliez pas votre rendez-vous !</h3>
                <p>Ceci est un rappel de votre rendez-vous prévu à EEC Centre Médical.</p>
            </div>
            
            <div class="appointment-info">
                <h3>📋 Détails du rendez-vous</h3>
                <div class="info-row">
                    <span class="info-label">Service :</span>
                    <span class="info-value"><?php echo isset($service) ? htmlspecialchars($service) : 'Non spécifié'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date :</span>
                    <span class="info-value"><?php echo isset($date) ? htmlspecialchars($date) : 'Non spécifiée'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Raison :</span>
                    <span class="info-value"><?php echo isset($reason) && $reason ? htmlspecialchars($reason) : 'Consultation'; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Statut :</span>
                    <span class="info-value"><span class="status-badge"><?php echo isset($status) ? strtoupper($status) : 'EN ATTENTE'; ?></span></span>
                </div>
            </div>
            
            <div class="instructions">
                <strong>✓ Instructions importantes :</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Arrivez 10 minutes avant votre rendez-vous</li>
                    <li>Apportez votre pièce d'identité et vos documents médicaux si applicable</li>
                    <li>En cas d'impossibilité, veuillez annuler au moins 24h avant</li>
                    <li>Contactez-nous si vous avez des questions</li>
                </ul>
            </div>
            
            <p style="color: #666; font-size: 14px;">
                <strong>Besoin de modifier votre rendez-vous ?</strong><br>
                Contactez-nous au numéro indiqué sur notre site ou connectez-vous à votre compte pour gérer vos rendez-vous.
            </p>
        </div>
        
        <div class="footer">
            <p><strong>EEC Centre Médical</strong></p>
            <p>Merci de votre confiance</p>
            <div class="contact-info">
                <p>📧 noreply@eecsite.com</p>
                <p>Ce message a été généré automatiquement. Merci de ne pas y répondre.</p>
            </div>
        </div>
    </div>
</body>
</html>
