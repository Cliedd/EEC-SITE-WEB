<!DOCTYPE html>
<html lang="en">
<head>
    <head>
      <meta charset="UTF-8">
      <title>Welcome to CodeIgniter 4!</title>
      <meta name="description" content="The small framework with powerful features">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/png" href="/favicon.ico">
      <link rel="stylesheet" href="<?=base_url('ASSETS/css/CSS-EEC/a-propos.css')?>">
      <link rel="stylesheet" href="https://font.googleapis.com/css2?family=material+symbols+rounded:opsz,
      wght,FILL,GRAD@48,400,0,0" />
      <script src="<?=base_url('ASSETS/EEC_JS/a_propoas.js');?>"></script>
    
      <link rel="stylesheet" href="assets/css/shared/iconly.css">
      <link rel="stylesheet" href="ASSETS/extensions/@icon/dripicons/dripicons.css">

    </head>
    <body>

      <header>
        <style>
          header{
    background: url(../ASSETS/IMAGES/entree-principale.png);
    height: 600PX;
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
          <a class="btn btn-green" href="<?=site_url('creer_un_compte');?>">Creer un compte</a>
        </div>
        <div class="header-btns">
          <a class="btn btn-red" href="<?=site_url('sinscrire');?>">S'inscrire</a>
        </div>

        <div class="header_button1">
            <a class="btn btn-light" href="<?=site_url('PrendreRendez_vous');?>">Prendre rendez-vous</a>
        </div>



      <div class="hero-image-oval">
        <img src="<?=base_url('ASSETS/IMAGES/imgEnter.JPG')?>" alt="Entrée centre médical">
        <style>
          .hero-image-oval{
            height: 50%;
  width:100%;
  max-width:600px;
  margin-top:80px;
  margin-left:30%;
  display:block;
  border-radius:120px;
  overflow:hidden;
  box-shadow:0 8px 30px rgba(0,0,0,0.15);
  background:white;
}
.hero-image-oval img{
  width:100%;
  height:auto;
  display:block;
  object-fit:cover;
}
        </style>
      </div>


  </header>

    <div class="body2">
    <section class="presentation">
        <h1>Présentation SOLIDAIR du Centre
            <span class="highlight">MEDICAL PROTESTANT/BAFOUSSAM AELGISCARAVANE</span>
        </h1>
        <p>Le Centre Médical Protestant de Bafoussam est  une œuvre de témoignage de l'Église Évangélique du Cameroun(EEC),
          c’est un centre de  formation sanitaire créé en 1978 par arrêté d’ouverture N°135/A/MSPdu05/05/1978 situé en  plein 
          cœur de la ville de Bafoussam au lieu-dit plateau après le marché C.
            
           
        </p>
           <p>À son  ouver ture le CMPB était appelé «Centre de Santé Médical de Bafoussam»
              et était un centre de santé intégréà «l’Hôpital Protestant de Mbouo-Bandjoun»
              d’où alias«PetitMbo».
            </p>
            <p>Dès sa création jusqu’en l’an 2000,ce centre était dirigé par des infirmiers qui portaient
                alors le titre d’«infirmier-chef» et placés sous latutelle du Médecin Directeur de l’Hôpital
                Protestant de Mbo-Bandjoun et àpartir de l’an2000, date de sa médicalisation, il s’est vu 
                porté à la tête des médecins qui portaient alors le titre de «Médecin-chef» et cette 
                fois sous tutelle de l’Hôpital Protestant de Mbo-Bandjoun; en bref le CMPB a  vu passer les 
                responsables suivants:
            </p>
            <ul>
                <li class="li">De1978au31/08/1994:MNJEUNGOUOPaul,Infirmier-Chef</li>
                <li class="li">Du1er/09/1994au31/08/1997:M.NJEUTANGBenjamin,Infirmier-Chef</li>
                <li class="li">Du1er/09/1997au31/08/2000:M.KAMDEMSamuel,Infirmier-Chef</li>
                <li class="li">Du1er/09/2000au31/08/2010:DrNANAMartial,Médecin-Chef</li>
                <li class="li">Du1er/09/2010au31/08/2013:DrNDENSIJeanPaul,Médecin-Chef</li>
                <li class="li">Du1er/09/2013au31/08/2014:DrTCHAMOUMichel,Médecin-Chef</li>
                <li class="li">Du1er/09/2014au31/08/2020:DrCHEMGNENadine,Médecin-Chef</li>
                <li class="li">Du1er/09/2020ànosjours:DrBONNYDALLECyrile,Médecin-Directeur</li>
                
            </ul>
        </section>
        <section class="missions">
            <h2>MISSIONS ET VALEURS</h2>
            <p><strong>INTEGRITÉ:</strong>exercer notre profession avec honnêtetée téthique chrétienne;</p>
            <p><strong>COMPASSION:</strong>Agir avec empathie et bienveillance envers chaque patient;</p>
            <p><strong>SERVICE:</strong>Être au service des plus vulnérables avec humilité;</p>
            <p><strong>ESPERANCE:</strong>Offrir un soutien spirituel et un message d’espoir.</p>
        </section>
        <section class="equipements">
            <h2>Équipements et moyens logistiques</h2>
            <p>L’Hôpital Régional Annexe de Foumban est doté d’équipements modernes pour assurer une prise en charge de qualité:</p>
        </section>
        <style>
                

</style>



      </div>



      <!---------------------------------slider------------------------------------------>

          <section class="equipements-section">
    <div class="carousel-container">
      <button class="arrow left" onclick="prevSlide()">&#10094;</button>
      <div class="carousel" id="carousel">
        <div class="slide">
          <img src="<?=base_url('ASSETS/photos/Appariels electrostimulation.jpg');?>" alt="Équipement du service d'imagerie">
          <p>ÉQUIPEMENT DU SERVICE D’IMAGERIE</p>
        </div>
        <div class="slide">
          <img src="<?=base_url('ASSETS/photos/Appariel endodontique.jpg');?>" alt="Équipement au service néonatologie">
          <p>ÉQUIPEMENT AU SERVICE NÉONATOLOGIE</p>
        </div>
        <div class="slide">
          <img src="<?=base_url('ASSETS/photos/Contracteur oxygene.jpg');?>" alt="Équipement au service bactériologie">
          <p>ÉQUIPEMENT AU SERVICE BACTÉRIOLOGIE</p>
        </div>
        <div class="slide">
          <img src="<?=base_url('ASSETS/photos/Dialyseur.jpg');?>" alt="Équipement au service de réanimation">
          <p>ÉQUIPEMENT AU SERVICE DE RÉANIMATION</p>
        </div>
      </div>
      <button class="arrow right" onclick="nextSlide()">&#10095;</button>
    </div>
  </section>

    </body>


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

    </html>
</body>
</html>