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
        .security-alert {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-left: 4px solid #dc2626;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            color: #7f1d1d;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .reset-button:hover {
            opacity: 0.9;
        }
        .link-section {
            background-color: #f9fafb;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
            word-break: break-all;
        }
        .link-section h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 14px;
        }
        .link-section p {
            margin: 0;
            color: #666;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            background-color: #ffffff;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #e5e7eb;
        }
        .instructions {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            color: #065f46;
        }
        .instructions h3 {
            margin: 0 0 10px 0;
        }
        .instructions ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .instructions li {
            margin: 5px 0;
        }
        .expiration-notice {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            margin: 20px 0;
            border-radius: 4px;
            color: #78350f;
            font-size: 13px;
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
            <h1>🔐 Réinitialisation de mot de passe</h1>
        </div>
        
        <div class="content">
            <p class="greeting">
                Bonjour,
            </p>
            
            <p>
                Vous avez demandé une réinitialisation de mot de passe pour votre compte administrateur.
            </p>
            
            <div class="security-alert">
                <strong>⚠️ Sécurité :</strong><br>
                Si vous n'avez pas demandé cette réinitialisation, ignorez cet email. Votre compte reste sécurisé.
            </div>
            
            <p>Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>
            
            <div class="button-container">
                <a href="<?php echo isset($resetLink) ? htmlspecialchars($resetLink) : '#'; ?>" class="reset-button">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            
            <p style="text-align: center; color: #666; font-size: 13px; margin: 15px 0;">
                Ou copiez ce lien dans votre navigateur :
            </p>
            
            <div class="link-section">
                <h3>Lien de réinitialisation :</h3>
                <p><?php echo isset($resetLink) ? htmlspecialchars($resetLink) : 'Lien non disponible'; ?></p>
            </div>
            
            <div class="instructions">
                <h3>📋 Instructions :</h3>
                <ol>
                    <li>Cliquez sur le bouton "Réinitialiser mon mot de passe"</li>
                    <li>Entrez votre nouveau mot de passe</li>
                    <li>Confirmez votre nouveau mot de passe</li>
                    <li>Cliquez sur "Enregistrer"</li>
                    <li>Connectez-vous avec votre nouveau mot de passe</li>
                </ol>
            </div>
            
            <div class="expiration-notice">
                <strong>⏰ Important :</strong> Ce lien expire dans 24 heures. Veuillez réinitialiser votre mot de passe avant cette date limite.
            </div>
            
            <p style="color: #666; font-size: 14px;">
                <strong>Conseil de sécurité :</strong>
            </p>
            <ul style="color: #666; font-size: 13px;">
                <li>Utilisez un mot de passe fort avec des majuscules, minuscules, chiffres et caractères spéciaux</li>
                <li>Ne partagez jamais votre mot de passe</li>
                <li>Ne cliquez pas sur ce lien si vous ne l'avez pas demandé</li>
            </ul>
        </div>
        
        <div class="footer">
            <p><strong>EEC Centre Médical - Admin Portal</strong></p>
            <p>Cet email a été généré automatiquement. Veuillez ne pas y répondre.</p>
            <div class="contact-info">
                <p>📧 noreply@eecsite.com</p>
                <p>Pour toute question, contactez l'administrateur système.</p>
            </div>
        </div>
    </div>
</body>
</html>
