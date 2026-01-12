<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Centre médical - Maquette</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/css/CSS-EEC/service_medicaux.css');?>">
  <script src="<?=base_url('ASSETS/EEC_JS/sevices_Medicaux.js');?>"></script>
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"><!--FontAwesome(icônescommesurlesite)-->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- EN-TETE -->
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
            <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendez-vous</a>
        </div>



  </header>

 <body>  
  <style>
    .services{
  padding:60px 8%;
  text-align:center; 
  color:#fff;
  background: url(../ASSETS/IMAGES/sevices.jpg);
  background-size:cover;
  background-repeat: no-repeat;
}
  </style>
  <section class="services">
  <h2>Services</h2>
  <p class="subtitle">Le Centre Medical prostetant de Bafousssam propose une large gamme de services médicaux et spécialisés:</p>
  <div class="services-container">
    <!--CONSULTATIONS-->
    <div class="cardconsultation">
      <div class="icongreen">
        <i class="fa-solidfa-stethoscope"></i>
      </div>
      <h3>Consultations</h3>
      <div class="lists">
        <ul>
          <li>Pédiatrie/ Néonatologie</li>
          <li>Obdtétrique/ Gynécologie</li>
          <li>Medecine interne</li>
          <li>Neurologie</li>
        </ul>
        <ul>
          <li>Kinésithérapie</li>
          <li>Nutrition</li>
          <li>Echographie</li>
          <li>Vaccination</li>
        </ul>
      </div>
    </div>
    <!--HOSPITALISATION-->
    <div class="cardhospitalisation">
      <div class="iconwhite">
        <i class="fa-solidfa-hospital"></i>
      </div>
      <h3>Hospitalisation</h3>
      <ul>
        <li>Chirugie générale</li>
        <li>Laboratoire</li>
        <li>UPEC</li>
        <li>Néonatologie</li>
        <li>Réanimation</li>
        <li>Maternité</li>
      </ul>
    </div>
  </div> 
</section>  

<br>
<br>


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