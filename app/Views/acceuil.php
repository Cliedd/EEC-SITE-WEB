<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Centre Médical Protestant de Bafoussam</title>
      <meta name="description" content="Centre Médical Protestant de Bafoussam - Soins de qualité pour tous">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/png" href="/favicon.ico">

      <!-- Système Responsive Professionnel -->
      <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">

      <!-- Styles spécifiques à la page -->
      <link rel="stylesheet" href="<?=base_url('ASSETS/acceuil.css');?>">

      <!-- JavaScript -->
      <script src="<?=base_url('ASSETS/EEC_JS/acceuil.js');?>"></script>

      <!-- Google Fonts -->
      <link rel="stylesheet" href="https://font.googleapis.com/css2?family=material+symbols+rounded:opsz,wght,FILL,GRAD@48,400,0,0" />

      <!-- Icônes -->
      <link rel="stylesheet" href="assets/css/shared/iconly.css">
      <link rel="stylesheet" href="ASSETS/extensions/@icon/dripicons/dripicons.css">
    </head>
    <body>
      <!-- Loader -->
      <div class="laoder" id="laoder">
       <p>Chargement...</p>
      </div>

      <!-- Header Responsive -->
      <header class="top-header">
        <div class="header-content">
          <!-- Logo + Nom -->
          <div class="logo-area">
            <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png')?>" alt="Logo CMP Bafoussam">
            <div class="title">
              <span class="line1">Centre médical protestant</span>
              <span class="line2">de Bafoussam</span>
            </div>
          </div>

          <!-- Contact -->
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
      </header>      <!-- Navigation Responsive -->
      <nav class="main-menu">
        <ul>
          <li><a href="<?=site_url('acceuil');?>">Accueil</a></li>
          <li><a href="<?=site_url('a_propos');?>">À Propos</a></li>
          <li><a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
          <li><a href="<?=site_url('espace_peteint');?>">Espace Patient</a></li>
          <li><a href="<?=site_url('actualiter');?>">Actualités</a></li>
          <li><a href="<?=site_url('Contact');?>">Contact</a></li>
        </ul>
      </nav>

      <!-- Boutons d'action responsifs -->
      <div class="header-btns">
        <a class="btn btn-green" href="<?=site_url('creer_un_compte');?>">Créer un compte</a>
        <a class="btn btn-red" href="<?=site_url('sinscrire');?>">S'inscrire</a>
        <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendez-vous</a>
      </div>

      <!-- Carousel Responsive -->
      <section class="equipements-section">
        <div class="carousel-container">
          <button class="arrow left" onclick="prevSlide()">&#10094;</button>
          <div class="carousel" id="carousel">
            <div class="slide">
              <video autoplay muted loop>
                <source src="ASSETS/VIDEO/VID-20251008-WA0020(1).mp4" type="video/mp4">
              </video>
              <p>Visite</p>
            </div>
            <div class="slide">
              <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (125).JPG');?>" alt="Équipement au service néonatologie">
              <p>Visite</p>
            </div>
            <div class="slide">
              <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (187).JPG');?>" alt="Équipement au service bactériologie">
              <p>Visite</p>
            </div>
            <div class="slide">
              <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (70).JPG');?>" alt="Équipement au service de réanimation">
              <p>ÉQUIPEMENT AU SERVICE DE RÉANIMATION</p>
            </div>
          </div>
          <button class="arrow right" onclick="nextSlide()">&#10095;</button>
        </div>
      </section>

      
      <body0>


<!-- Section principale responsive -->
      <main class="container">
        <section class="content">
          <div class="grid grid-2">
            <div class="left-column">
              <figure class="photo photo-top">
                <img src="<?=base_url('ASSETS/IMAGES/img_hopital.PNG');?>" alt="Bâtiment du Centre médical" />
              </figure>
              <figure class="photo photo-bottom">
                <img src="<?=base_url('ASSETS/IMAGES/entree-principale.png');?>" alt="Entrée du Centre médical" />
              </figure>
            </div>

            <div class="right-column">
              <h2 class="section-title">À propos du CMPB</h2>
              <p>
                Le Centre Médical Protestant de Bafoussam est une œuvre de témoignage
                de l'Église Évangélique du Cameroun (EEC). Le CMPB est une formation
                sanitaire créée en <strong>1978</strong> par arrêté d'ouverture
                <em>N°135/A/MSP</em> du <strong>05/05/1978</strong>, situé en plein
                cœur de la ville de Bafoussam au lieu-dit plateau après le marché C.
              </p>

              <p>
                À son ouverture le CMPB était appelé « Centre de Santé Médicalisé de
                Bafoussam » et était un centre de santé intégré à « l'Hôpital
                Protestant de Mbouo-Bandjoun » d'où alias « Petit Mbo ».
              </p>

              <p>
                Dès sa création jusqu'en l'an 2000, ce centre était dirigé par des
                infirmiers qui portaient alors le titre d'« infirmier-chef » et
                placés sous la tutelle du Médecin Directeur de l'Hôpital Protestant
                de Mbo-Bandjoun. À partir de 2000, date de sa médicalisation, il
                s'est vu confié à la tête des médecins portant le titre de
                « Médecin-chef ».
              </p>
            </div>
          </div>
        </section>
      </main>

      <!-- Section services responsive -->
      <section class="content">
        <div class="container">
          <div class="grid grid-2">
            <div class="content-container">
              <h1>Centre médical Protestant de Bafoussam à l'écoute du patient</h1>
              <p>Le centre médical protestant de Bafoussam est une œuvre de témoignage de l'église évangélique du Cameroun (EEC). Créé en 1978, il offre des soins médicaux complets et de qualité dans un cadre humain et spirituel au service de toute la communauté.</p>

              <h2>Liste des services</h2>
              <ul>
                <li>Pédiatrie/Néonatologie</li>
                <li>Obstétrique/Gynécologie</li>
                <li>Chirurgie générale</li>
                <li>Médecine interne</li>
                <li>Neurologie</li>
                <li>Réanimation</li>
                <li>Kinésithérapie</li>
                <li>Nutrition</li>
                <li>Échographie</li>
                <li>Laboratoire</li>
                <li>UPEC</li>
                <li>Vaccination</li>
              </ul>
              <div class="mt-3">
                <a class="btn btn-green" href="<?=site_url('service_medicaux');?>">
                  En savoir plus <img src="<?=base_url('ASSETS/extensions/@icon/dripicons/icons/arrow-right.svg');?>" alt="arrow" width="10px">
                </a>
              </div>
            </div>

            <div class="photos-container">
              <div class="grid grid-3">
                <img src="<?=base_url('ASSETS/IMAGES/IMG-service1.jpg');?>" alt="Service 1">
                <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>" alt="Service 2">
                <img src="<?=base_url('ASSETS/IMAGES/IMG-service2.jpg');?>" alt="Service 3">
                <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>" alt="Service 4">
                <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (18).JPG');?>" alt="Service 5">
                <img src="<?=base_url('ASSETS/IMAGES/IMG-service4.jpg');?>" alt="Service 6">
              </div>
            </div>
          </div>
        </div>
      </section>



      <!-- Section contact responsive -->
      <section class="content">
        <div class="container">
          <div class="text-center mb-4">
            <h1 class="section-title">CONTACT</h1>
            <p class="section-subtitle">Contactez-nous pour tous vos questions ou prise de rendez-vous: nous sommes là pour vous accompagner.</p>
          </div>

          <div class="grid grid-2">
            <div class="contact-info">
              <h2>Localisation</h2>
              <p>CMPB, Ouest Cameroun.</p>

              <h2>Nous appeler</h2>
              <p>+237 654 28 16 10 / 654 23 26 92.</p>

              <h2>Nous joindre</h2>
              <p>cmpbafoussam2020@gmail.com.</p>
            </div>

            <div class="contact-form">
              <form method="POST" action="<?=site_url('creer_un_compte');?>">
                <h2>Inscription</h2>
                <div class="form-group">
                  <label for="nom">Nom:</label>
                  <input type="text" id="nom" name="nom" required>
                </div>

                <div class="form-group">
                  <label for="prenom">Prénom:</label>
                  <input type="text" id="prenom" name="prenom" required>
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                  <label for="motdepasse">Mot de passe:</label>
                  <input type="password" id="motdepasse" name="motdepasse" required>
                </div>

                <button type="submit" class="btn btn-green">S'inscrire</button>
              </form>
            </div>
          </div>
        </div>
      </section>




      <!-- Section ressources humaines responsive -->
      <section class="content">
        <div class="container">
          <div class="text-center mb-4">
            <h1 class="section-title">RESSOURCES HUMAINES</h1>
            <p class="section-subtitle">Notre établissement de santé est équipé pour offrir des soins de qualité avec une équipe dédiée et des ressources adéquates.</p>
          </div>

          <div class="team-slider">
            <div class="grid grid-4">
              <div class="card">
                <img src="<?=base_url('ASSETS/IMAGES/directeur-generale.jpg');?>" alt="Directeur général" class="card-image">
                <div class="card-content">
                  <h3>Directeur Général</h3>
                  <p>Responsable de la direction générale</p>
                </div>
              </div>

              <div class="card">
                <img src="<?=base_url('ASSETS/IMAGES/responsable-financier.jpg');?>" alt="Responsable financier" class="card-image">
                <div class="card-content">
                  <h3>Responsable Financier</h3>
                  <p>Gestion administrative et financière</p>
                </div>
              </div>

              <div class="card">
                <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (139).JPG');?>" alt="Équipe médicale" class="card-image">
                <div class="card-content">
                  <h3>Équipe Médicale</h3>
                  <p>Professionnels de santé qualifiés</p>
                </div>
              </div>

              <div class="card">
                <img src="<?=base_url('ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg');?>" alt="Personnel soignant" class="card-image">
                <div class="card-content">
                  <h3>Personnel Soignant</h3>
                  <p>Soins et accompagnement patients</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Section témoignages responsive -->
      <section class="content">
        <div class="container">
          <div class="text-center mb-4">
            <p class="section-subtitle">TÉMOIGNAGES</p>
            <h1 class="section-title">AVIS DES CLIENTS</h1>
          </div>

          <div class="testimonials-grid">
            <div class="grid grid-3">
              <div class="card testimonial-card">
                <div class="card-content">
                  <div class="rating mb-2">
                    ⭐⭐⭐⭐⭐
                  </div>
                  <p class="mb-3">"Service excellent et personnel très professionnel. Je recommande vivement ce centre médical."</p>
                  <div class="client-info">
                    <span class="client-name">Marie K.</span>
                    <span class="client-role">Patiente</span>
                  </div>
                </div>
              </div>

              <div class="card testimonial-card">
                <div class="card-content">
                  <div class="rating mb-2">
                    ⭐⭐⭐⭐⭐
                  </div>
                  <p class="mb-3">"Équipements modernes et soins de qualité. L'équipe est à l'écoute des patients."</p>
                  <div class="client-info">
                    <span class="client-name">Jean P.</span>
                    <span class="client-role">Patient</span>
                  </div>
                </div>
              </div>

              <div class="card testimonial-card">
                <div class="card-content">
                  <div class="rating mb-2">
                    ⭐⭐⭐⭐⭐
                  </div>
                  <p class="mb-3">"Un centre médical de référence dans la région. Service rapide et efficace."</p>
                  <div class="client-info">
                    <span class="client-name">Sophie M.</span>
                    <span class="client-role">Patiente</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


     




      

    </body0>
      <!-- Footer responsive -->
      <footer class="site-footer">
        <div class="container">
          <div class="footer-inner">
            <div class="grid grid-4">
              <!-- Logo et réseaux sociaux -->
              <div class="footer-col">
                <div class="logo-wrap mb-3">
                  <img src="<?=base_url('ASSETS/LOGO/LOGO_SITE.png');?>" alt="LOGO" class="footer-logo">
                </div>
                <div class="stay-connected">
                  <p class="small-title mb-2">Restez connectés</p>
                  <div class="socials">
                    <a href="#" aria-label="Facebook" class="social">📘</a>
                    <a href="#" aria-label="YouTube" class="social">📺</a>
                    <a href="#" aria-label="LinkedIn" class="social">💼</a>
                  </div>
                </div>
              </div>

              <!-- Services -->
              <div class="footer-col">
                <h3 class="col-title mb-3">HOSPITALISATION</h3>
                <ul class="services-list">
                  <li>Pédiatrie/Néonatologie</li>
                  <li>Obstétrique/Gynécologie</li>
                  <li>Chirurgie générale</li>
                  <li>Médecine interne</li>
                  <li>Neurologie</li>
                  <li>Réanimation</li>
                  <li>Kinésithérapie</li>
                  <li>Nutrition</li>
                  <li>Échographie</li>
                  <li>Laboratoire</li>
                  <li>UPEC</li>
                  <li>Vaccination</li>
                </ul>
              </div>

              <!-- Contact -->
              <div class="footer-col">
                <h3 class="col-title mb-3">CONTACT INFO</h3>
                <p class="mb-2">📞 (+237) : 699 573 569 / 654 395 887 / 676 326</p>
                <p class="mb-2">📧 cmpbafoussam2020@gmail.com</p>
                <p class="mb-2">🕐 24H/24, 7J/7</p>
              </div>

              <!-- Newsletter -->
              <div class="footer-col">
                <h3 class="col-title mb-3">NEWSLETTER</h3>
                <p class="mb-3">Restez au courant de nos dernières nouvelles et de nos derniers produits.</p>
                <div class="footer-btns">
                  <a href="<?=site_url('PrendreRendez_vous');?>" class="btn btn-green">PRENDRE RENDEZ-VOUS</a>
                  <a href="<?=site_url('sinscrire');?>" class="btn btn-light">S'INSCRIRE</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <!-- Footer copyright -->
      <footer class="site-footer2">
        <div class="container">
          <div class="copyright text-center">
            ©2025 CENTRE MÉDICAL PROTESTANT DE BAFOUSSAM. TOUS DROITS RÉSERVÉS.
          </div>
        </div>
      </footer>

    </html>
</body>
</html>