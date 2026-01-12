<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifiez votre email</title>
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
        .content {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            margin: 30px 0;
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 12px;
            text-align: center;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
            padding: 12px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 EEC Centre Médical</h1>
            <div class="logo">Vérification d'email</div>
        </div>

        <div class="content">
            <p>Bonjour <strong><?= htmlspecialchars($userName) ?></strong>,</p>

            <p>Merci de vous être inscrit sur notre plateforme. Pour activer votre compte et accéder à tous les services, veuillez vérifier votre adresse email en cliquant sur le bouton ci-dessous:</p>

            <div style="text-align: center;">
                <a href="<?= htmlspecialchars($verificationLink) ?>" class="button">
                    ✓ Vérifier mon email
                </a>
            </div>

            <p>Ou copier-collez ce lien dans votre navigateur:</p>
            <p style="background-color: #f9f9f9; padding: 10px; border-left: 3px solid #3498db; word-break: break-all;">
                <code><?= htmlspecialchars($verificationLink) ?></code>
            </p>

            <div class="warning">
                ⏰ Ce lien expire dans <strong>24 heures</strong>. Si vous ne cliquez pas dans ce délai, vous devrez vous réinscrire.
            </div>

            <p style="margin-top: 30px;">Si vous n'avez pas créé de compte, veuillez ignorer cet email.</p>

            <p>Cordialement,<br><strong>L'équipe EEC Centre Médical</strong></p>
        </div>

        <div class="footer">
            <p>© 2026 EEC Centre Médical. Tous droits réservés.</p>
            <p>Cet email vous a été envoyé car vous vous êtes inscrit sur notre plateforme.</p>
        </div>
    </div>
</body>
</html>
