<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un compte - Centre Médical Protestant de Bafoussam</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
  <style>
    body {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: var(--spacing-md);
    }

    .signup-container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      max-width: 450px;
      width: 100%;
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .signup-header {
      padding: var(--spacing-lg);
      text-align: center;
      border-bottom: 1px solid #f0f0f0;
    }

    .signup-header img {
      width: 80px;
      height: 80px;
      margin-bottom: var(--spacing-md);
      border-radius: 50%;
      background: var(--light-bg);
      padding: var(--spacing-sm);
    }

    .signup-header h2 {
      color: var(--text-dark);
      font-size: 1.5rem;
      margin-bottom: var(--spacing-sm);
      font-weight: 700;
    }

    .signup-header p {
      color: var(--text-gray);
      font-size: 0.9rem;
      margin: 0;
    }

    .signup-body {
      padding: var(--spacing-lg);
    }

    .form-group {
      margin-bottom: var(--spacing-md);
    }

    .form-group label {
      display: block;
      margin-bottom: var(--spacing-sm);
      color: var(--text-dark);
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(3, 138, 49, 0.1);
    }

    .form-group input::placeholder {
      color: var(--text-light);
    }

    .error-message {
      color: var(--secondary-color);
      font-size: 0.85rem;
      margin-top: 5px;
      display: block;
    }

    .alert {
      padding: var(--spacing-md);
      border-radius: 8px;
      margin-bottom: var(--spacing-md);
      text-align: center;
      font-size: 0.9rem;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .alert-danger {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: var(--spacing-md) 0;
      gap: var(--spacing-md);
    }

    .checkbox-group input[type="checkbox"] {
      width: auto;
      margin: 0;
    }

    .checkbox-group label {
      display: flex;
      align-items: center;
      gap: var(--spacing-sm);
      margin: 0;
      font-weight: 400;
      cursor: pointer;
    }

    .forgot-password {
      color: var(--primary-color);
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
    }

    .forgot-password:hover {
      color: #026b25;
    }

    .signup-button {
      width: 100%;
      padding: 12px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: var(--spacing-md);
    }

    .signup-button:hover {
      background: #026b25;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(3, 138, 49, 0.3);
    }

    .signup-footer {
      text-align: center;
      padding-top: var(--spacing-md);
      border-top: 1px solid #f0f0f0;
    }

    .signup-footer p {
      color: var(--text-gray);
      font-size: 0.9rem;
      margin: 0;
    }

    .signup-footer a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .signup-footer a:hover {
      color: #026b25;
    }

    @media (max-width: 480px) {
      .signup-container {
        margin: var(--spacing-md);
      }

      .signup-header,
      .signup-body {
        padding: var(--spacing-md);
      }

      .checkbox-group {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <!-- Header -->
    <div class="signup-header">
      <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png')?>" alt="Logo CMPB">
      <h2>Créer un compte</h2>
      <p>Centre Médical Protestant de Bafoussam</p>
    </div>

    <!-- Body -->
    <div class="signup-body">
      <?php
      $validation = $validation ?? \Config\Services::validation();
      ?>

      <?php if (session()->getFlashdata('success')) : ?>
      <div class="alert alert-success">
        <strong>✓</strong> <?= session()->getFlashdata('success') ?>
      </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert alert-danger">
        <strong>✕</strong> <?= session()->getFlashdata('error') ?>
      </div>
      <?php endif; ?>

      <form method="post" action="<?=base_url('Creer_compte/store');?>" novalidate>
        <?= csrf_field() ?>

        <!-- Nom et Prénom -->
        <div class="form-group">
          <label for="name_surName">Nom et prénom *</label>
          <input 
            type="text" 
            id="name_surName" 
            name="name_surName" 
            placeholder="Votre nom complet"
            value="<?= old('name_surName') ?>"
            required>
          <span class="error-message"><?= $validation->getError('name_surName') ?></span>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email">Adresse email *</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="exemple@email.com"
            value="<?= old('email') ?>"
            required>
          <span class="error-message"><?= $validation->getError('email') ?></span>
        </div>

        <!-- Téléphone -->
        <div class="form-group">
          <label for="telephone">Téléphone *</label>
          <input 
            type="tel" 
            id="telephone" 
            name="telephone" 
            placeholder="+237 XXX XXX XXX"
            value="<?= old('telephone') ?>"
            required>
          <span class="error-message"><?= $validation->getError('telephone') ?></span>
        </div>

        <!-- Mot de passe -->
        <div class="form-group">
          <label for="mot_de_passe">Mot de passe *</label>
          <input 
            type="password" 
            id="mot_de_passe" 
            name="mot_de_passe" 
            placeholder="••••••••"
            required>
          <span class="error-message"><?= $validation->getError('mot_de_passe') ?></span>
        </div>

        <!-- Checkbox et lien -->
        <div class="checkbox-group">
          <label>
            <input type="checkbox" name="remember_me" value="1" checked>
            <span>Se souvenir de moi</span>
          </label>
          <a href="<?=site_url('sinscrire');?>" class="forgot-password">Mot de passe oublié ?</a>
        </div>

        <!-- Bouton -->
        <button type="submit" class="signup-button">Créer mon compte</button>
      </form>
    </div>

    <!-- Footer -->
    <div class="signup-footer">
      <p>Vous avez déjà un compte ? <a href="<?=site_url('sinscrire');?>">Se connecter</a></p>
    </div>
  </div>

</body>
</html>