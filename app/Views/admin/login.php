<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur - EEC Centre Médical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --light-bg: #ecf0f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 20px;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .login-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light-bg);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--secondary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(52, 152, 219, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fee;
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .alert-success {
            background-color: #efe;
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-warning {
            background-color: #fef3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background: var(--light-bg);
            color: var(--primary-color);
            font-size: 12px;
        }

        .error-message {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .form-group input.is-invalid {
            border-color: var(--danger-color) !important;
            background: #fee;
        }

        .secure-info {
            background: #f0f8ff;
            border-left: 4px solid var(--secondary-color);
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 12px;
            color: var(--primary-color);
        }

        .secure-info strong {
            display: block;
            margin-bottom: 5px;
        }

        @media (max-width: 480px) {
            .login-container {
                border-radius: 0;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .login-body {
                padding: 30px;
            }

            .logo {
                width: 70px;
                height: 70px;
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <div class="logo">🔐</div>
            <h1>Dashboard Admin</h1>
            <p>EEC Centre Médical</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            <!-- Messages d'erreur/succès -->
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <strong>❌ Erreur!</strong> <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <strong>✓ Succès!</strong> <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form method="POST" action="<?= base_url('auth/authenticate'); ?>" id="loginForm">
                <?= csrf_field(); ?>

                <!-- Info sécurité -->
                <div class="secure-info">
                    <strong>🔒 Accès Sécurisé</strong>
                    <span>Réservé aux administrateurs du site</span>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">
                        📧 Adresse Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Entrez votre email"
                        value="<?= old('email'); ?>"
                        required
                        autocomplete="email"
                    >
                    <?php if (isset($errors['email'])): ?>
                        <div class="error-message show"><?= $errors['email']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="mot_de_passe">
                        🔑 Mot de Passe
                    </label>
                    <input 
                        type="password" 
                        id="mot_de_passe" 
                        name="mot_de_passe" 
                        placeholder="Entrez votre mot de passe"
                        required
                        autocomplete="current-password"
                    >
                    <?php if (isset($errors['mot_de_passe'])): ?>
                        <div class="error-message show"><?= $errors['mot_de_passe']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Bouton Connexion -->
                <button type="submit" class="btn-login">
                    Se Connecter
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <p>© 2025 EEC Centre Médical Bafoussam. Tous droits réservés.</p>
            <p style="margin-top: 10px; opacity: 0.7;">
                Pour toute assistance, contactez le support administrateur
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validation côté client
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('mot_de_passe').value;

            if (!email) {
                e.preventDefault();
                showError('email', 'L\'email est requis');
                return false;
            }

            if (!password) {
                e.preventDefault();
                showError('mot_de_passe', 'Le mot de passe est requis');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                showError('mot_de_passe', 'Le mot de passe doit contenir au moins 8 caractères');
                return false;
            }
        });

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorMsg = field.nextElementSibling;
            
            if (errorMsg && errorMsg.classList.contains('error-message')) {
                errorMsg.textContent = message;
                errorMsg.classList.add('show');
                field.classList.add('is-invalid');
            }
        }

        // Nettoyer les erreurs au focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
                const errorMsg = this.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains('error-message')) {
                    errorMsg.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
