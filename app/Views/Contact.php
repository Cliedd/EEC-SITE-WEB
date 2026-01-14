<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact - Centre Médical Protestant de Bafoussam</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .contact-hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=base_url('ASSETS/IMAGES/img_courvre.PNG');?>);
      background-size: cover;
      background-position: center;
      color: white;
      padding: clamp(60px, 15vw, 100px) 20px;
      text-align: center;
      margin-bottom: 60px;
    }

    .contact-hero h1 {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      margin-bottom: 20px;
    }

    .contact-hero p {
      font-size: clamp(1rem, 2vw, 1.1rem);
      color: rgba(255, 255, 255, 0.9);
      max-width: 600px;
      margin: 0 auto;
    }

    .contact-wrapper {
      display: grid;
      grid-template-columns: 1fr;
      gap: 40px;
      margin-bottom: 60px;
    }

    @media (min-width: 768px) {
      .contact-wrapper {
        grid-template-columns: 1fr 1fr;
      }
    }

    .contact-form-section h2 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      color: var(--text-dark);
      margin-bottom: 30px;
      font-weight: 700;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: var(--text-dark);
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(3, 138, 49, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 150px;
    }

    .error-message {
      color: var(--secondary-color);
      font-size: 0.85rem;
      margin-top: 5px;
      display: block;
    }

    .alert {
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }

    .alert-danger {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .submit-btn {
      width: 100%;
      padding: 14px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .submit-btn:hover {
      background: #026b25;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(3, 138, 49, 0.3);
    }

    .contact-info-section {
      background: #f9f9f9;
      border-radius: 12px;
      padding: 30px;
    }

    .contact-info-section h2 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      color: var(--text-dark);
      margin-bottom: 30px;
      font-weight: 700;
    }

    .info-item {
      display: flex;
      gap: 20px;
      margin-bottom: 25px;
      padding-bottom: 25px;
      border-bottom: 1px solid #e0e0e0;
    }

    .info-item:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .info-icon {
      flex-shrink: 0;
      width: 50px;
      height: 50px;
      background: var(--primary-color);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .info-content h3 {
      color: var(--text-dark);
      font-size: 1.1rem;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .info-content p {
      color: var(--text-gray);
      margin: 0;
      line-height: 1.6;
    }

    .map-section {
      margin-top: 60px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .map-section h2 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      color: var(--text-dark);
      margin-bottom: 30px;
      font-weight: 700;
    }

    .map-section iframe {
      width: 100%;
      height: 400px;
      border: none;
    }

    @media (max-width: 480px) {
      .contact-info-section {
        padding: 20px;
      }

      .info-item {
        gap: 15px;
      }

      .info-icon {
        width: 45px;
        height: 45px;
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="top-header">
    <div class="header-content">
      <div class="logo-area">
        <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png')?>" alt="Logo CMP Bafoussam">
        <div class="title">
          <span class="line1">Centre médical protestant</span>
          <span class="line2">de Bafoussam</span>
        </div>
      </div>

      <div class="contact-area">
        <div class="contact-item">
          <span class="icon">📧</span>
          <a href="mailto:cmpbafoussam2020@gmail.com">cmpbafoussam2020@gmail.com</a>
        </div>

        <div class="contact-item">
          <span class="icon">📞</span>
          <a href="tel:+237657281610">+237 657 28 16 10 / 654 23 26 92</a>
        </div>
      </div>
    </div>

    <nav class="main-menu">
      <ul>
        <li><a href="<?=site_url('acceuil');?>">Accueil</a></li>
        <li><a href="<?=site_url('a_propos');?>">À Propos</a></li>
        <li><a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
        <li><a href="<?=site_url('espace_peteint');?>">Espace patient</a></li>
        <li><a href="<?=site_url('Contact');?>">Contact</a></li>
      </ul>
    </nav>

    <div class="header-btns">
      <a class="btn btn-green" href="<?=site_url('sinscrire');?>">S'inscrire</a>
      <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendez-vous</a>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="contact-hero">
    <h1>Nous Contacter</h1>
    <p>Le Centre Médical Protestant de Bafoussam reste à votre entière disposition afin de vous offrir des soins de qualité. Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.</p>
  </div>

  <!-- Main Content -->
  <main class="container">
    <div class="contact-wrapper">
      <!-- Contact Form -->
      <div class="contact-form-section">
        <h2>Formulaire de Contact</h2>
        
        <?php
        $validation = $validation ?? \Config\Services::validation();
        ?>

        <?php if(isset($validation) && $validation->listErrors()): ?>
        <div class="alert alert-danger">
          <?= $validation->listErrors() ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          ✓ Votre message a été envoyé avec succès. Nous vous répondrons dès que possible.
        </div>
        <?php endif; ?>

        <form method="post" action="<?=base_url('ContactController');?>" novalidate>
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="name">Nom et Prénom *</label>
            <input type="text" id="name" name="name_surName" placeholder="Votre nom complet" value="<?= old('name_surName') ?>" required>
            <span class="error-message"><?= $validation->getError('name_surName') ?></span>
          </div>

          <div class="form-group">
            <label for="email">Adresse Email *</label>
            <input type="email" id="email" name="email" placeholder="exemple@email.com" value="<?= old('email') ?>" required>
            <span class="error-message"><?= $validation->getError('email') ?></span>
          </div>

          <div class="form-group">
            <label for="phone">Téléphone *</label>
            <input type="tel" id="phone" name="telephone" placeholder="+237 XXX XXX XXX" value="<?= old('telephone') ?>" required>
            <span class="error-message"><?= $validation->getError('telephone') ?></span>
          </div>

          <div class="form-group">
            <label for="subject">Objet *</label>
            <input type="text" id="subject" name="Objet" placeholder="Objet de votre message" value="<?= old('Objet') ?>" required>
            <span class="error-message"><?= $validation->getError('Objet') ?></span>
          </div>

          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="msg" placeholder="Votre message..." required><?= old('msg') ?></textarea>
            <span class="error-message"><?= $validation->getError('msg') ?></span>
          </div>

          <button type="submit" class="submit-btn">Envoyer le Message</button>
        </form>
      </div>

      <!-- Contact Info -->
      <div class="contact-info-section">
        <h2>Informations</h2>

        <div class="info-item">
          <div class="info-icon">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div class="info-content">
            <h3>Heures d'ouverture</h3>
            <p>24H/24, 7J/7 pour tous vos problèmes de santé</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div class="info-content">
            <h3>Adresse</h3>
            <p>Situé avant le stade omnisport Kouekong - Bafoussam</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="info-content">
            <h3>Email</h3>
            <p><a href="mailto:cmpbafoussam2020@gmail.com">cmpbafoussam2020@gmail.com</a></p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">
            <i class="fa-solid fa-phone"></i>
          </div>
          <div class="info-content">
            <h3>Téléphone</h3>
            <p><a href="tel:+237699573569">(+237) 699 573 569 / 654 395 887 / 676 326</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
      <h2>Notre Localisation</h2>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.8855825873397!2d10.416488374039936!3d5.4343445348630075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x105f903635e7245b%3A0x119da109408bedc0!2sEEC%20Mbouo!5e0!3m2!1sfr!2scm!4v1763802348350!5m2!1sfr!2scm" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="grid grid-4">
        <div class="footer-col">
          <div class="logo-wrap">
            <img src="<?=base_url()?>ASSETS/LOGO/LOGO_SITE.png" alt="LOGO" class="footer-logo"/>
          </div>
          <div class="stay-connected">
            <p class="small-title">Restez connectés</p>
            <div class="socials">
              <a href="#" aria-label="Facebook" class="social"><i class="fab fa-facebook"></i></a>
              <a href="#" aria-label="YouTube" class="social"><i class="fab fa-youtube"></i></a>
              <a href="#" aria-label="LinkedIn" class="social"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="footer-col">
          <h3 class="col-title">Nos Services</h3>
          <ul class="footer-list">
            <li><a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Consultations</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Hospitalisation</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Urgences</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3 class="col-title">Contact</h3>
          <p><i class="fa-solid fa-phone"></i> (+237) 699 573 569 / 654 395 887</p>
          <p><i class="fa-solid fa-envelope"></i> cmpbafoussam2020@gmail.com</p>
          <p><i class="fa-solid fa-clock"></i> 24H/24, 7J/7</p>
        </div>

        <div class="footer-col">
          <h3 class="col-title">Actions Rapides</h3>
          <div class="footer-actions">
            <a href="<?=site_url('PrendreRendez_vous');?>" class="btn btn-small btn-green">Rendez-vous</a>
            <a href="<?=site_url('sinscrire');?>" class="btn btn-small btn-green">S'inscrire</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 Centre Médical Protestant de Bafoussam. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

</body>
</html>
