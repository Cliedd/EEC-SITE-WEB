<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>SITE WEB CMPB</title>
      <meta name="description" content="The small framework with powerful features">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/png" href="/favicon.ico">
      <link rel="stylesheet" href="<?=base_url('ASSETS/css/CSS-EEC/Contact.css');?>">
      <script src="<?=base_url('ASSETS/EEC_JS/acceuil.js');?>"></script>
      <link rel="stylesheet" href="https://font.googleapis.com/css2?family=material+symbols+rounded:opsz,
      wght,FILL,GRAD@48,400,0,0" />
      
    
      <link rel="stylesheet" href="assets/css/shared/iconly.css">
      <link rel="stylesheet" href="ASSETS/extensions/@icon/dripicons/dripicons.css">

    </head>
    <body>

      <header>
         <style>
          header{
    background: url(../ASSETS/IMAGES/img_courvre.PNG);
    height: 300PX;
    width: 100%;
    background-repeat: no-repeat;
    background-size: 100%;
     border-bottom-left-radius:200px;
    border-bottom-right-radius:200px;
}
       
        </style>
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

        <div class="header_button1">
            <a class="main-title1" >CONTACT</a>
        </div>


       
      </header>

      <!--------------------------contact section--------------------------------------------------------->

      <section class="contact-section">

    <h5 class="sub-title">VOTRE AVIS COMPTE</h5>
    <h1 class="main-title">Restez connectés</h1>

    <p class="description">
        Le Centre Medical Protestant de Bafoussam reste à votre entière disposition afin de vous 
        offrir des soins de qualité. Veuillez remplir le formulaire suivant pour toutes autres informations 
        complémentaires ou en savoir plus sur les dispositions à prendre avant votre arrivée dans la structure.
    </p>

    <div class="contact-container">
      <?php
        $validation = $validation ?? \Config\Services::validation();
      ?>
         
         <?php if(isset($validation)):?>
         <div class='alert alert-danger'><?= $validation->listErrors();?></div>
         <?php endif; ?> 
         
        <form class="contact-form" method="post" action="<?=base_url('ContactController');?>">
            <input type="text" placeholder="Noms">
            <span class='text-danger'><?= $validation->getError('name_surName')?></span>
            <div class="row">
                <input type="email" placeholder="Adresse email">
                <span class='text-danger'><?= $validation->getError('email')?></span>
                <input type="text" placeholder="Telephone">
                <span class='text-danger'><?= $validation->getError('telephone')?></span>
            </div>
            <input type="text" placeholder="Objet">
            <span class='text-danger'><?= $validation->getError('Objet')?></span>
            <textarea placeholder="Message"></textarea>
            <span class='text-danger'><?= $validation->getError('msg')?></span>

            <button type="submit" class="btn_form">
                Envoyer
            </button>
        </form>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.8855825873397!2d10.416488374039936!3d5.4343445348630075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x105f903635e7245b%3A0x119da109408bedc0!2sEEC%20Mbouo!5e0!3m2!1sfr!2scm!4v1763802348350!5m2!1sfr!2scm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        

    </div>

</section>
<!--------------------------- contact card--------------------------------------------------------->
  <section class="contact-sectionCard">
    <div class="contact-card">
      <div class="contact-grid">
        <!-- Bloc 1 -->
        <div class="contact-item">
          <div class="icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24" class="icon">
              <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm1 11.5V7h-2v6h5v-2h-3z" />
            </svg>
            
          </div>
          <h3>Heures d'ouverture:</h3>
          <p class="muted">Heures D'ouverture:24H/24,7J/7 pour tous vos problèmes de santé</p>
        </div>

        <!-- Bloc 2 -->
        <div class="contact-item">
          <div class="icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24" class="icon">
              <path d="M4 3h16v18H4V3zm2 2v4h4V5H6zm6 0v4h4V5h-4zM6 11v6h12v-6H6z" />
            </svg>
          </div>
          <h3>Adresse principale:</h3>
          <p class="muted">Situé avant le stade omnisport Kouekong - Bafoussam</p>
        </div>

        <!-- Bloc 3 -->
        <div class="contact-item">
          <div class="icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24" class="icon">
              <path d="M20 6H4l8 6 8-6zm0 2.5-8 6-8-6V18h16V8.5z" />
            </svg>
          </div>
          <h3>Email:</h3>
          <p class="muted">cmpbafoussam2020@gmail.com</p>
        </div>

        <!-- Bloc 4 -->
        <div class="contact-item">
          <div class="icon-wrap" aria-hidden="true">
            <svg viewBox="0 0 24 24" class="icon">
              <path d="M6.62 10.79a15.053 15.053 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.07 21 3 13.93 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.24.2 2.45.57 3.57a1 1 0 0 1-.24 1.01l-2.21 2.21z"/>
            </svg>
          </div>
          <h3>Téléphone:</h3>
          <p class="muted">(+237):699573569/
            654395887/676326</p>
        </div>
      </div>
    </div>
  </section>


      
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

  </body>
</html>
