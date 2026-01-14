<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services Médicaux - Centre Médical Protestant de Bafoussam</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .services-hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=base_url('ASSETS/IMAGES/sevices.jpg');?>);
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
      text-align: center;
      padding: clamp(40px, 10vw, 80px) 20px;
      margin-bottom: 60px;
    }
    
    .services-hero h2 {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      margin-bottom: 20px;
    }
    
    .services-hero .subtitle {
      font-size: clamp(1rem, 2vw, 1.2rem);
      color: rgba(255, 255, 255, 0.9);
      max-width: 700px;
      margin: 0 auto;
    }
    
    .service-card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border-left: 4px solid var(--primary-color);
    }
    
    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
    }
    
    .service-card .icon {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 15px;
      display: block;
    }
    
    .service-card h3 {
      color: var(--text-dark);
      margin-bottom: 15px;
      font-size: 1.3rem;
      font-weight: 600;
    }
    
    .service-card ul {
      list-style: none;
      padding: 0;
      margin: 0;
      columns: 1;
    }
    
    .service-card li {
      padding: 8px 0;
      color: var(--text-gray);
      border-bottom: 1px solid #f0f0f0;
      font-size: 0.95rem;
    }
    
    .service-card li:last-child {
      border-bottom: none;
    }
    
    @media (min-width: 768px) {
      .service-card ul {
        columns: 2;
        column-gap: 20px;
      }
    }
    
    .section-title {
      text-align: center;
      margin-bottom: 50px;
    }
    
    .section-title h2 {
      font-size: clamp(2rem, 5vw, 2.5rem);
      color: var(--text-dark);
      margin-bottom: 15px;
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

  <!-- Services Hero Section -->
  <div class="services-hero">
    <h2>Services Médicaux</h2>
    <p class="subtitle">Le Centre Médical Protestant de Bafoussam propose une large gamme de services médicaux et spécialisés</p>
  </div>

  <!-- Main Content -->
  <main class="container">
    <section class="content">
      <div class="grid grid-3" style="gap: 30px;">
        <!-- Consultations Card -->
        <div class="service-card">
          <i class="fa-solid fa-stethoscope icon"></i>
          <h3>Consultations</h3>
          <ul>
            <li>Pédiatrie / Néonatologie</li>
            <li>Obstétrique / Gynécologie</li>
            <li>Médecine interne</li>
            <li>Neurologie</li>
            <li>Kinésithérapie</li>
            <li>Nutrition</li>
            <li>Échographie</li>
            <li>Vaccination</li>
          </ul>
        </div>

        <!-- Hospitalisation Card -->
        <div class="service-card">
          <i class="fa-solid fa-hospital icon"></i>
          <h3>Hospitalisation</h3>
          <ul>
            <li>Chirurgie générale</li>
            <li>Laboratoire</li>
            <li>UPEC</li>
            <li>Néonatologie</li>
            <li>Réanimation</li>
            <li>Maternité</li>
          </ul>
        </div>

        <!-- Urgences Card -->
        <div class="service-card">
          <i class="fa-solid fa-heart-pulse icon"></i>
          <h3>Urgences</h3>
          <ul>
            <li>Service 24/7</li>
            <li>Équipe médicale qualifiée</li>
            <li>Équipements modernes</li>
            <li>Ambulance</li>
            <li>Premiers secours</li>
            <li>Stabilisation</li>
          </ul>
        </div>
      </div>
    </section>
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
            <li><a href="#consultations">Consultations</a></li>
            <li><a href="#hospitalisation">Hospitalisation</a></li>
            <li><a href="#urgences">Urgences</a></li>
            <li><a href="#echographie">Échographie</a></li>
            <li><a href="#laboratoire">Laboratoire</a></li>
            <li><a href="#vaccination">Vaccination</a></li>
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