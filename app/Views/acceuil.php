<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>SITE WEB CMPB</title>
      <meta name="description" content="The small framework with powerful features">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/png" href="/favicon.ico">
      <link rel="stylesheet" href="<?=base_url('ASSETS/acceuil.css');?>">
      <script src="<?=base_url('ASSETS/EEC_JS/acceuil.js');?>"></script>
      <link rel="stylesheet" href="https://font.googleapis.com/css2?family=material+symbols+rounded:opsz,
      wght,FILL,GRAD@48,400,0,0" />
      
    
      <link rel="stylesheet" href="assets/css/shared/iconly.css">
      <link rel="stylesheet" href="ASSETS/extensions/@icon/dripicons/dripicons.css">

    </head>
    <body>
      <div class="laoder" id="laoder">
       <p>Chargement...</p>
      </div>


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


         <!---------------------------slider------------------------------------------->

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
          <p>visite</p>
        </div>
        <div class="slide">
          <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (70).JPG');?>" alt="Équipement au service de réanimation">
          <p>ÉQUIPEMENT AU SERVICE DE RÉANIMATION</p>
        </div>
      </div>
      <button class="arrow right" onclick="nextSlide()">&#10095;</button>
    </div>
  </section>


        </div>


</header>

      
      <body0>


        <main class="containerr">
          <div class="hero">
           <h1>Présentation du Centre médical<br>protestant de Bafoussam</h1>
          </div>

        <section class="content">
          <div class="left-column">
            <figure class="photo photo-top">
              <img src="<?=base_url('ASSETS/IMAGES/img_hopital.PNG');?>" alt="Bâtiment du Centre médical" />
            </figure>

            <figure class="photo photo-bottom">
              <img src="<?=base_url('ASSETS/IMAGES/entree-principale.png');?>" alt="Entrée du Centre médical" />
            </figure>
          </div>

          <div class="right-column">
            <p>
              Le Centre Médical Protestant de Bafoussam est une œuvre de témoignage
              de l’Église Évangélique du Cameroun (EEC). Le CMPB est une formation
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
        </section>
      </main>





      <section class="content">

      <DIV CLASS="CONTAINER3">

      <DIV CLASS="CONTENT-CONTAINER">
        <H1>Centre médicale Protestant
           de Bafoussam
          à lecoute du patient</H1>
         <P>Le centre médicale protestant de Bafoussam
           est une oeuvre de témoignage de l’église évangélique
           du Cameroun (EEC). Creér en 1978 offre des sion médicaux 
           complets et de qualité dans un cadre humain 
           et spirituel au services de toutes la communauté.
         </P>

        <H2>Liste des services</H2>
        <UL>
          <LI>Pédiatrie/ Néonatologie</LI>
          <LI>Obdtétrique/ Gynécologie</LI>
          <LI>Chirugie générale</LI>
          <LI>Medecine interne</LI>
          <LI>Neurologie</LI>
          <LI>Réanimation</LI>
          <LI>Kinésithérapie</LI>
          <LI>Nutrition</LI>
          <LI>Echographie</LI>
          <LI>Laboratoire</LI>
          <LI>UPEC</LI>
          <LI>Vaccination</LI>
        </UL>
        <div class="header-btns">
          <a class="btn btn-green" href="<?=site_url('service_medicaux');?>"> en savoir plus ar <img src="<?=base_url('ASSETS/extensions/@icon/dripicons/icons/arrow-right.svg');?>" alt="arrow" width="10px"></a>
        </div>
      </DIV>
        <DIV CLASS="PHOTOS-CONTAINER1">
         <img src="<?=base_url('ASSETS/IMAGES/IMG-service1.jpg');?>"ALT="PHOTO1">
         <img src="<?=base_url()?>ASSETS/IMAGES/SETPR0011 (27).JPG"ALT="PHOTO2">
         <img src="<?=base_url('ASSETS/IMAGES/IMG-service2.jpg');?>"ALT="PHOTO3">
       </DIV> 

       <DIV CLASS="PHOTOS-CONTAINER2">
         <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>"ALT="PHOTO1">
         <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (18).JPG');?>"ALT="PHOTO2">
         <img src="<?=base_url('ASSETS/IMAGES/IMG-service4.jpg');?>"ALT="PHOTO3">
     </DIV>
     </section>



<!---------------------------------CONTACT--------------------------------------------------------->

        <main class="container4">
          <div class="hero4">
           <h1>CONTACT</h1>
           <p>Contactez-nous pour tous vos questions ou prise de rendez-vous: nous somme la pour vous accompagner.</p>
          </div>
     <section class="content">    
    <div class="containe4">
       <div class="left-containe4">
         <h1>Localisation</h1>
          <p>CMPB, Ouest Cameroun.
          </p>
          <h1>Nous Appeller</h1>
          <p>+237 654 28 16 10/ 654 23 26 92.
          </p>
          <h1>Nous joindre</h1>
          <p>cmpbafoussam2020@gmail.com.
          </p>

        </div><div class="right-containe4">
           <form>
             <h2>Inscription</h2>
             <label for="nom">Nom:</label>
             <input type="text"id="nom"name="nom">
             <br>
             <br>
             <label for="prenom">Prénom:</label>
             <input type="text"id="prenom"name="prenom">
             <br>
             <br>
             <label for="email">Email:</label>
             <input type="email"id="email"name="email">
             <br>
             <br>
             <label for="motdepasse">Motdepasse:</label>
             <input type="password"id="motdepasse"name="motdepasse">
             <br>
             <br>
             <input type="submit"value="S'inscrire">
            </form>
          </div> 
        </div>
        </section>
        </main>




<!--------------------------resource humaine---------------------------------------->

        <main class="containerr5">
          <div class="hero5">
           <h1>RESSOURCES HUMAINES</h1>
           <p>Notre établissement de santé est équipé pour offrire des sions de qualité avec une équipe dédiée et des ressource adéquates.</p>
          </div>
     <section class="content">

             <div class="container5">
            <div class="slider-wrapper5">
                <button id="slide-left5"class="slide-left5"><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/arrow-left.svg" class="slide-button5" alt="left-arrow"></button>
                <div class="image-list5">
                    <img src="<?=base_url('ASSETS/IMAGES/directeur-generale.jpg');?>" alt="img-1" class="image-iterm">
                    <img src="<?=base_url('ASSETS/IMAGES/responsable-financier.jpg');?>" alt="img-2" class="image-iterm">
                    <img src="<?=base_url()?>ASSETS/IMAGES/SETPR0011 (139).JPG" alt="img-3" class="image-iterm">
                    <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="img-4" class="image-iterm">

                </div>
                <button id="slide-right5"class="slide-right5"><img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/arrow-right.svg"class="slide-button5" alt="right-arrow"></button>
            </div>
            <div class="slider-scrollbar5">
                <div class="scrollber-trak5">
                    <div class="scrollbar-thumb5">
                        
                    </div>
                </div>
            </div>
        </div>
     </section>
        </main>


       <main class="body">
        <section>
          <div class="contener6">
            <div class="hero5">
           
           <p>temoignage.</p>
             <h1>AVIS DES CLIENTS</h1>
          </div>
            <div class="content">
              <button class="slide-left6">arrow<img src="<?=base_url()?>./ASSETS/extensions/@icon/dripicons/icons/arrow-left.svg" class="slide-button6" alt="left-arrow"></button>
              <div class="card">
                <div class="card-content">
                  <div class="image">
                    <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="">
                  </div>


                  <div class="name-profesion">
                    <span class="name">nom du client</span>
                    <span class="profession">nom de profession</span>
                    

                  </div>
                  <div class="ratting">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">


                  </div>
                  <div class="button">
                    <button><div class="aboute-me">About me</div></button>
                    <button><div class="hire-me">hire me</div></button>
                  </div>

                </div>
              </div>

              <div class="card">
                <div class="card-content">
                  <div class="image">
                    <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="">
                  </div>


                  <div class="name-profesion">
                    <span class="name">nom du client</span>
                    <span class="profession">nom de profession</span>
                    

                  </div>
                  <div class="ratting">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">


                  </div>
                  <div class="button">
                    <button><div class="aboute-me">About me</div></button>
                    <button><div class="hire-me">hire me</div></button>
                  </div>

                </div>
              </div>

              <div class="card">
                <div class="card-content">
                  <div class="image">
                    <img src="<?=base_url()?>ASSETS/IMAGES/IMG-20251011-WA0004(1).jpg" alt="">
                  </div>


                  <div class="name-profesion">
                    <span class="name">nom du client</span>
                    <span class="profession">nom de profession</span>
                    

                  </div>
                  <div class="ratting">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">
                    <img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/star.svg" alt="star" width="20px">


                  </div>
                  <div class="button">
                    <button><div class="aboute-me">About me</div></button>
                    <button><div class="hire-me">hire me</div></button>
                  </div>

                </div>
              </div>
               <button class="slide-right6">arrow<img src="<?=base_url()?>ASSETS/extensions/@icon/dripicons/icons/arrow-right.svg"class="slide-button6" alt="right-arrow"></button>
            </div>
          </div>
        </section>
        </main>


     




      

    </body0>
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