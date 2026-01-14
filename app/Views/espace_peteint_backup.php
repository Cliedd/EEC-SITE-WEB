<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Centre médical - Maquette</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/css/CSS-EEC/espace-patein.css')?>">
  <script src="<?=base_url('ASSETS/EEC_JS/espace_patient.js');?>"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- EN-TETE -->
  <header>
   
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

    <!-- Menu -->
    <nav class="main-menu">
        <ul>
                 <li><a href="<?=site_url('acceuil');?>">Acceuil</a></li>
                  <li><a href="<?=site_url('a_propos');?>">A Propos</a></li>
                 <li> <a href="<?=site_url('service_medicaux');?>">Services Médicaux</a></li>
                  <li><a href="<?=site_url('espace_peteint');?>">Espace patient</a></li>
                  <li><a href="<?=site_url('actualiter');?>">Actualités</a></li>
                  <li><a href="<?=site_url('Contact');?>">Contact</a></li>
        </ul>
    </nav>

    <div class="header-btns">
          <a class="btn btn-green" href="<?=site_url('sinscrire');?>">S'inscrire</a>
        </div>


          <!-- BANNIERE PRINCIPALE -->
  <section class="hero">
    <div class="hero-shape">
      <h1>Se présenter à une consultation</h1>
      <a class="cta" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendezvous ▶</a>
    </div>
  </section>
  </header>



  <main>
    <!-- contenu supplémentaire -->

      <header class="top-hero">
    <div class="hero-left">
      <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>" alt="Consultation" class="main-photo">
    </div>
    <div class="hero-left0">
      <style>

    .top-header {
    background: url(../ASSETS/IMAGES/IMG-service1.jpg);
    width: 100%;
    padding: 10px 0;
    border-bottom: 2px solid #eee;
    font-family: Arial, sans-serif;
    margin-top: -20px;
    height: 500PX;
    width: 100%;
    background-repeat: no-repeat;
    background-size: 100%;
}
    </style>

    
    <div class="hero-right">
      <p class="intro">
        L'hôpitaL protestant de Bafoussam offre à ses patients ou usagers les consultations dans tous les services qu'il héberge, tant chez les spécialistes que chez les généralistes.
        De ce fait, il est important pour les patients de s'informer sur la conduite à tenir avant de se rendre à une consultation comme :
      </p>
      <ul class="bullets">
        <li>Manger ou ne pas manger avant une consultation ;</li>
        <li>Ne pas faire sa toilette intime ;</li>
        <li>Conserver la première urine du matin, pour ne citer que ceux-là...</li>
      </ul>
      <p class="notes">Le respect de ces mesures est d'une importance capitale pour la réussite de la consultation et l'avancée du traitement du patient.</p>
    </div>
  </header>

  <main class="container">
    <h1 class="page-title">Hospitalisation</h1>

    <section class="content-grid">
      <div class="left-column">
        <p class="red"><strong>Choisissez: <span class="choose">Le Centre médical protestant<br>de Bafoussam</span></strong></p>

        <p class="instructions">
          Respectez les consignes de votre médecin spécialiste. Au niveau médical, il vous est demandé de respecter scrupuleusement l'ensemble des consignes données par le spécialiste lors de la programmation de l'hospitalisation et/ou par l'anesthésiste lors d'une éventuelle visite préopératoire.
        </p>

        <a class="cta" href="<?=site_url('Contact');?>">Contactez nous</a>
      </div>

      <aside class="right-column">
        <img src="<?=base_url('ASSETS/IMAGES/IMG-service4.jpg');?>" alt="Soins infirmiers" class="side-photo">
      </aside>
    </section>

            <div class="container">
            <div class="slider-wrapper">
                <button id="slide-left"class="slide-left"><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/arrow-left.svg" class="slide-button" alt="left-arrow"></button>
                <div class="image-list">
                    <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>" alt="espace-2" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>" alt="img-3" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/img_malade.PNG');?>" alt="img-4" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/IMG-service1.jpg');?>" alt="img-4" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/IMG-service2.jpg');?>" alt="img-4" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/img_courvre.PNG');?>" alt="img-4" class="image-iterm">
                    <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="img-4" class="image-iterm">
                    
                </div>
                <button id="slide-right"class="slide-right"><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/arrow-right.svg"class="slide-button" alt="right-arrow"></button>
            </div>
            <div class="slider-scrollbar">
                <div class="scrollber-trak">
                    <div class="scrollbar-thumb">
                        
                    </div>
                </div>
            </div>
  </main>

  </main>

   





   <!--------------------------footer--------------------------------------------------------->

  <footer class="site-footer">
    <div class="footer-inner">
      <div class="col logo-col">
        <div class="logo-wrap">
          <img src="<?=base_url()?>ASSETS/LOGO/LOGO_SITE.png"ALT="LOGO"CLASS="LOGO"/>
        </div>

        <div class="stay-connected">
          <p class="small-title">Restez connectés</p>
          <div class="socials">
            <a href="#" aria-label="Facebook" class="social"></a>
            <a href="#" aria-label="YouTube" class="social"></a>
            <a href="#" aria-label="LinkedIn" class="social"></a>
          </div>
        </div>
      </div>

      <div class="col services-col">
        <h3 class="col-title">HOSPITALISATION</h3>
        <ul class="services-list">
          <li>Pédiatrie/ Néonatologie</li>
          <li>Obdtétrique/ Gynécologie</li>
          <li>Chirugie générale</li>
          <li>Medecine interne</li>
          <li>Neurologie</li>
          <li>Réanimation</li>
          <li>Kinésithérapie</li>
          <li>Nutrition</li>
          <li>Echographie</li>
          <li>Laboratoire</li>
          <li>UPEC</li>
          <li>Vaccination</li>
        </ul>
      </div>

      <div class="col contact-col">
        <h3 class="col-title">CONTACTE INFO</h3>
        <p><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/phone.svg" ALT="">(+237) : 699 573 569 / 654 395 887 / 676 326</p>
        <p><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/mail.svg" ALT="">cmpbafoussam2020@gmail.com</p>
        <p><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/clock.svg" ALT="">24H/24, 7J/7</p>
      </div>
        
      <div class="col newsletter-col">
        <h3 class="col-title">NEWSLETTER</h3>
        <p>Restez au courant de nos dernières nouvelles et de nos derniers produits.</p>
        <DIV CLASS="BTNS">
        <BUTTON CLASS="BTN-APPOINTMENT"><a href="<?=site_url('PrendreRendez_vous');?>">PRENDRE RENDEZ-VOUS</a> </BUTTON>
        <BUTTON CLASS="BTN-SUBSCRIBE"><a href="<?=site_url('sinscrire');?>">S'INSCRIRE</a> </BUTTON>
      </DIV>
      </div>
    </div>

  </footer>
  <!--------------------------footer2--------------------------------------------------------->

<FOOTER CLASS="SITE-FOOTER2">
  <DIV CLASS="footer-innercontainer">

  <DIV CLASS="COPYRIGHT">
    ©2025 CENTRE MÉDICAL PROTESTANT DE BAFOUSSAM.TOUS DROIT SRÉSERVÉS.


  </DIV>
  </DIV>

</FOOTER>

</body>
</html>
