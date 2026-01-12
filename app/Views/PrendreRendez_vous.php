<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Prendre Rendez-vous - EEC Centre Médical</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/css/CSS-EEC/pendre_rrende-vous.css');?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="<?=base_url('ASSETS/EEC_JS/prendreRende-vous.js');?>"></script>
</head>
<body>

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

    

</header>




  <main class="hero">
    <div class="slider" id="slider">
      <div class="slide" >
        <img src="<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>" alt="prendre-rrendez-vous image1">
      </div>
      <div class="slide" >
        <img src="<?=base_url('ASSETS/IMAGES/IMG-service3.jpg');?>" alt="Équipement au service néonatologie">
      </div>

    </div>

    <button class="nav prev" id="prev">‹</button>
    <button class="nav next" id="next">›</button>
    

    <div class="form-box">
      <h1>OBTENEZ UN BILAN DE SANTÉ, UN TRAITEMENT ET UNE VIE SAINE</h1>
      <form class="appointment-form" id="appointmentForm">
        <div class="row">
          <input type="text" name="name_surName" placeholder="Votre nom complet" required>
          <input type="email" name="email" placeholder="Votre adresse e-mail" required>
        </div>
        <div class="row">
          <input type="tel" name="telephone" placeholder="Votre numéro de téléphone" required>
          <div class="col-md-6">
            <input type="date" name="date_appointment" required>
          </div>
          <div class="col-md-6">
            <input type="time" name="time_appointment" required>
          </div>
        </div>
        <div class="row">
          <select name="service" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;">
            <option value="">-- Sélectionner un service --</option>
            <option value="Consultation générale">Consultation générale</option>
            <option value="Pédiatrie/Néonatologie">Pédiatrie/Néonatologie</option>
            <option value="Obstétrique/Gynécologie">Obstétrique/Gynécologie</option>
            <option value="Chirurgie générale">Chirurgie générale</option>
            <option value="Médecine interne">Médecine interne</option>
            <option value="Neurologie">Neurologie</option>
            <option value="Réanimation">Réanimation</option>
            <option value="Kinésithérapie">Kinésithérapie</option>
            <option value="Nutrition">Nutrition</option>
            <option value="Échographie">Échographie</option>
            <option value="Laboratoire">Laboratoire</option>
            <option value="UPEC">UPEC</option>
            <option value="Vaccination">Vaccination</option>
          </select>
        </div>
        <div class="row">
          <textarea name="raison" placeholder="Raison de la visite (optionnel)" style="width: 100%;"></textarea>
        </div>
        <button class="cta" type="submit">PRENDRE UN RENDEZ-VOUS</button>
      </form>
    </div>
  </main>

  <!-- Modal de confirmation -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="confirmationModalLabel">✓ Rendez-vous Enregistré avec Succès!</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info">
            <h6>Important - Étape suivante pour confirmer votre rendez-vous:</h6>
            <p>Votre rendez-vous a été enregistré. <strong>Pour le confirmer définitivement, veuillez appeler le centre au numéro ci-dessous:</strong></p>
          </div>
          
          <div class="row mt-4 mb-4">
            <div class="col-md-6">
              <div class="card bg-light p-3 text-center">
                <h6>Numéro 1</h6>
                <p class="fs-5" style="color: #2c3e50; font-weight: bold;">+237 657 28 16 10</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card bg-light p-3 text-center">
                <h6>Numéro 2</h6>
                <p class="fs-5" style="color: #2c3e50; font-weight: bold;">+237 654 23 26 92</p>
              </div>
            </div>
          </div>

          <div class="alert alert-success">
            <p><strong>📧 Confirmation par Email:</strong> Un email de confirmation a été envoyé à votre adresse. Conservez votre <strong>numéro de dossier</strong>.</p>
            <p><strong>Numéro de dossier: <span id="appointmentId" style="color: #2c3e50; font-weight: bold;"></span></strong></p>
          </div>

          <div class="alert alert-warning">
            <p>⏱️ <strong>Important:</strong> Appelez le centre pour confirmer votre présence. Votre rendez-vous sera tenu réservé pendant 24 heures.</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fermer</button>
          <a href="<?=base_url('/');?>" class="btn btn-primary">Retour à l'accueil</a>
        </div>
      </div>
    </div>
  </div>
 
  
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Handle appointment form submission
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);
      
      fetch('<?=base_url('appointment/store');?>', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          // Show appointment ID in modal
          document.getElementById('appointmentId').textContent = data.appointment_id;
          
          // Show the modal
          const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'), {});
          confirmationModal.show();

          // Reset form
          document.getElementById('appointmentForm').reset();
        } else {
          alert('Erreur: ' + (data.message || 'Impossible de créer le rendez-vous'));
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de la soumission du formulaire');
      });
    });
  </script>

    </html>
</body>
</html>
