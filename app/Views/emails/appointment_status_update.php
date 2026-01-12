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
        .status-badge {
            display: inline-block;
            background-color: <?php echo isset($statusColor) ? ($statusColor === 'green' ? '#10b981' : '#ef4444') : '#3b82f6'; ?>;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 10px;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .appointment-details {
            background-color: #f9fafb;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .appointment-details h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 16px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #666;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #333;
        }
        .detail-value {
            color: #666;
        }
        .action-message {
            padding: 15px;
            background-color: #eff6ff;
            border-radius: 4px;
            color: #0c4a6e;
            margin: 20px 0;
            border-left: 4px solid #0284c7;
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
            <h1>Mise à jour de votre rendez-vous</h1>
            <div class="status-badge">
                <?php echo isset($status) ? strtoupper($status) : 'EN ATTENTE'; ?>
            </div>
        </div>
        
        <div class="content">
            <p class="greeting">
                Bonjour <strong><?php echo isset($name) ? htmlspecialchars($name) : 'Patient'; ?></strong>,
            </p>
            
            <p>Voici les détails actualisés de votre rendez-vous :</p>
            
            <div class="appointment-details">
                <h3>📋 Détails du rendez-vous</h3>
                <div class="detail-row">
                    <span class="detail-label">Service :</span>
                    <span class="detail-value"><?php echo isset($service) ? htmlspecialchars($service) : 'Non spécifié'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date :</span>
                    <span class="detail-value"><?php echo isset($date) ? htmlspecialchars($date) : 'Non spécifiée'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Statut :</span>
                    <span class="detail-value"><strong><?php echo isset($status) ? htmlspecialchars($status) : 'EN ATTENTE'; ?></strong></span>
                </div>
            </div>
            
            <div class="action-message">
                <?php 
                    if (isset($status) && $status === 'CONFIRMÉ') {
                        echo '<strong>✓ Votre rendez-vous est confirmé !</strong><br>Nous vous attendons à la date et heure prévues. Si vous avez besoin d\'annuler ou de reprogrammer, veuillez nous contacter au numéro indiqué sur notre site.';
                    } elseif (isset($status) && $status === 'ANNULÉ') {
                        echo '<strong>✗ Votre rendez-vous a été annulé</strong><br>Si vous souhaitez reprendre un rendez-vous, veuillez faire une nouvelle demande via notre site ou nous appeler directement.';
                    } else {
                        echo '<strong>Merci</strong> pour votre rendez-vous. Nous vous contacterons pour confirmer les détails.';
                    }
                ?>
            </div>
            
            <p style="color: #666; font-size: 14px;">
                Si vous avez des questions ou besoin de modifier ce rendez-vous, n'hésitez pas à nous contacter.
            </p>
        </div>
        
        <div class="footer">
            <p><strong>EEC Centre Médical</strong></p>
            <p>Nous sommes à votre service pour vos besoins médicaux</p>
            <div class="contact-info">
                <p>📧 noreply@eecsite.com</p>
                <p>Ce message a été généré automatiquement. Merci de ne pas y répondre.</p>
            </div>
        </div>
    </div>
</body>
</html>
