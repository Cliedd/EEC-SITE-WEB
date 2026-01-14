<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Espace Patient - Centre Médical Protestant de Bafoussam</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .patient-hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=base_url('ASSETS/IMAGES/IMG-service1.jpg');?>);
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
      padding: clamp(60px, 15vw, 100px) 20px;
      text-align: center;
      margin-bottom: 60px;
    }

    .patient-hero h1 {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      margin-bottom: 20px;
    }

    .patient-hero .cta {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 30px;
      background: var(--primary-color);
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .patient-hero .cta:hover {
      background: #026b25;
      transform: translateY(-2px);
    }

    .patient-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      align-items: center;
      margin-bottom: 60px;
    }

    @media (max-width: 768px) {
      .patient-content {
        grid-template-columns: 1fr;
      }
    }

    .patient-text h2 {
      font-size: clamp(1.5rem, 4vw, 2.2rem);
      color: var(--text-dark);
      margin-bottom: 20px;
      font-weight: 700;
    }

    .patient-text .highlight {
      color: var(--primary-color);
      font-weight: 600;
    }

    .patient-text p {
      color: var(--text-gray);
      margin-bottom: 15px;
      line-height: 1.8;
    }

    .instructions-list {
      list-style: none;
      padding: 0;
      margin: 20px 0;
    }

    .instructions-list li {
      padding: 12px 0;
      padding-left: 35px;
      position: relative;
      color: var(--text-gray);
    }

    .instructions-list li:before {
      content: "✓";
      position: absolute;
      left: 0;
      color: var(--primary-color);
      font-weight: bold;
      font-size: 1.2rem;
    }

    .patient-image {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .patient-image img {
      width: 100%;
      height: auto;
      display: block;
    }

    .gallery-section {
      margin-top: 60px;
      padding-top: 60px;
      border-top: 2px solid #f0f0f0;
    }

    .gallery-section h2 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      color: var(--text-dark);
      text-align: center;
      margin-bottom: 40px;
      font-weight: 700;
    }

    .gallery-carousel {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      background: #f9f9f9;
    }

    .gallery-images {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      gap: 15px;
      padding: 15px;
    }

    .gallery-images::-webkit-scrollbar {
      height: 8px;
    }

    .gallery-images::-webkit-scrollbar-track {
      background: #f0f0f0;
      border-radius: 10px;
    }

    .gallery-images::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 10px;
    }

    .gallery-item {
      flex-shrink: 0;
      width: 250px;
      height: 200px;
      border-radius: 8px;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .gallery-item:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .gallery-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 50px;
      height: 50px;
      background: rgba(3, 138, 49, 0.8);
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.5rem;
      transition: all 0.3s ease;
      z-index: 10;
    }

    .gallery-nav:hover {
      background: var(--primary-color);
    }

    .gallery-nav.left {
      left: 10px;
    }

    .gallery-nav.right {
      right: 10px;
    }

    @media (max-width: 480px) {
      .gallery-item {
        width: 150px;
        height: 120px;
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
      <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Rendez-vous</a>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="patient-hero">
    <h1>Espace Patient</h1>
    <p style="font-size: 1.1rem; margin: 0;">Se présenter à une consultation</p>
    <a href="<?=site_url('PrendreRendez_vous');?>" class="cta"><i class="fa-solid fa-calendar"></i> Prendre rendez-vous</a>
  </div>

  <!-- Main Content -->
  <main class="container">
    <!-- Patient Information Section -->
    <div class="patient-content">
      <div class="patient-text">
        <h2>Avant votre <span class="highlight">Consultation</span></h2>
        <p>L'hôpital protestant de Bafoussam offre à ses patients ou usagers les consultations dans tous les services qu'il héberge, tant chez les spécialistes que chez les généralistes.</p>
        <p>De ce fait, il est important pour les patients de s'informer sur la conduite à tenir avant de se rendre à une consultation.</p>

        <h3 style="color: var(--text-dark); margin-top: 30px; margin-bottom: 15px;">Conseils Importants:</h3>
        <ul class="instructions-list">
          <li>Manger ou ne pas manger avant une consultation (selon le service)</li>
          <li>Ne pas faire sa toilette intime avant les examens de routine</li>
          <li>Conserver la première urine du matin pour les analyses</li>
          <li>Apporter vos documents médicaux antérieurs</li>
          <li>Arriver 15 minutes avant votre rendez-vous</li>
        </ul>

        <p style="margin-top: 20px; color: var(--secondary-color); font-weight: 600;">
          <i class="fa-solid fa-exclamation-circle"></i> Le respect de ces mesures est d'une importance capitale pour la réussite de la consultation et l'avancée du traitement.
        </p>

        <a href="<?=site_url('Contact');?>" class="btn btn-green" style="margin-top: 30px; display: inline-block;">
          <i class="fa-solid fa-phone"></i> Nous Contacter
        </a>
      </div>

      <div class="patient-image">
        <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>" alt="Consultation médicale">
      </div>
    </div>

    <!-- Hospitalisation Section -->
    <section class="patient-content" style="margin-top: 80px;">
      <div class="patient-image" style="order: -1;">
        <img src="<?=base_url('ASSETS/IMAGES/IMG-service4.jpg');?>" alt="Service d'hospitalisation">
      </div>

      <div class="patient-text">
        <h2>Service d'<span class="highlight">Hospitalisation</span></h2>
        <p><strong>Choisissez : Le Centre Médical Protestant de Bafoussam</strong></p>
        
        <p>Respectez les consignes de votre médecin spécialiste pour une hospitalisation réussie.</p>

        <h3 style="color: var(--text-dark); margin-top: 30px; margin-bottom: 15px;">Avant votre Hospitalisation:</h3>
        <ul class="instructions-list">
          <li>Consultez votre médecin pour tous les examens préopératoires</li>
          <li>Respectez les recommandations de l'anesthésiste</li>
          <li>Apportez tous vos documents médicaux</li>
          <li>Préparez vos affaires personnelles</li>
          <li>Suivez le régime alimentaire prescrit</li>
        </ul>

        <p style="margin-top: 20px;">Notre équipe médicale est à votre disposition pour vous offrir les meilleurs soins et vous assurer un séjour confortable.</p>

        <a href="<?=site_url('PrendreRendez_vous');?>" class="btn btn-green" style="margin-top: 30px; display: inline-block;">
          <i class="fa-solid fa-calendar-check"></i> Prendre Rendez-vous
        </a>
      </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
      <h2>Galerie du Centre</h2>
      
      <div class="gallery-carousel">
        <button class="gallery-nav left" onclick="scrollGallery(-300)">
          <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="gallery-images" id="galleryImages">
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>" alt="Galerie 1">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>" alt="Galerie 2">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/img_malade.PNG');?>" alt="Galerie 3">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/IMG-service1.jpg');?>" alt="Galerie 4">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/IMG-service2.jpg');?>" alt="Galerie 5">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url('ASSETS/IMAGES/img_courvre.PNG');?>" alt="Galerie 6">
          </div>
          <div class="gallery-item">
            <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="Galerie 7">
          </div>
        </div>

        <button class="gallery-nav right" onclick="scrollGallery(300)">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
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
            <li><a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Consultations</a></li>
            <li><a href="<?=site_url('service_medicaux');?>">Hospitalisation</a></li>
            <li><a href="<?=site_url('espace_peteint');?>">Espace Patient</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3 class="col-title">Contact</h3>
          <p><i class="fa-solid fa-phone"></i> (+237) 657 28 16 10</p>
          <p><i class="fa-solid fa-envelope"></i> cmpbafoussam2020@gmail.com</p>
          <p><i class="fa-solid fa-clock"></i> 24H/24, 7J/7</p>
        </div>

        <div class="footer-col">
          <h3 class="col-title">Actions Rapides</h3>
          <div class="footer-actions">
            <a href="<?=site_url('PrendreRendez_vous');?>" class="btn btn-small btn-green">Rendez-vous</a>
            <a href="<?=site_url('sinscrire');?>" class="btn btn-small btn-green">Se Connecter</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 Centre Médical Protestant de Bafoussam. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

  <script>
    function scrollGallery(distance) {
      const gallery = document.getElementById('galleryImages');
      gallery.scrollBy({
        left: distance,
        behavior: 'smooth'
      });
    }
  </script>

</body>
</html>
