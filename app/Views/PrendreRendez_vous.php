<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prendre Rendez-vous - Centre Médical Protestant de Bafoussam</title>
  <link rel="stylesheet" href="<?=base_url('ASSETS/responsive-system.css');?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .appointment-hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?=base_url('ASSETS/IMAGES/SETPR0011 (27).JPG');?>);
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
      padding: clamp(60px, 15vw, 100px) 20px;
      text-align: center;
      margin-bottom: 60px;
    }

    .appointment-hero h1 {
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      margin-bottom: 20px;
    }

    .appointment-form-container {
      max-width: 700px;
      margin: 0 auto 60px;
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .appointment-form-container h2 {
      font-size: clamp(1.5rem, 4vw, 2rem);
      color: var(--text-dark);
      margin-bottom: 30px;
      text-align: center;
      font-weight: 700;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    @media (min-width: 768px) {
      .form-row {
        grid-template-columns: 1fr 1fr;
      }
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      margin-bottom: 8px;
      color: var(--text-dark);
      font-weight: 600;
      font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(3, 138, 49, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
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
      margin-top: 20px;
    }

    .submit-btn:hover {
      background: #026b25;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(3, 138, 49, 0.3);
    }

    .confirmation-modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      align-items: center;
      justify-content: center;
    }

    .confirmation-modal.show {
      display: flex;
    }

    .modal-content {
      background: white;
      border-radius: 12px;
      padding: 40px;
      max-width: 600px;
      width: 90%;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 2px solid #f0f0f0;
    }

    .modal-header h2 {
      color: var(--primary-color);
      font-size: 1.8rem;
      font-weight: 700;
      margin: 0;
    }

    .modal-header .checkmark {
      font-size: 3rem;
      margin-bottom: 10px;
    }

    .info-box {
      background: #f9f9f9;
      border-left: 4px solid var(--primary-color);
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 4px;
    }

    .info-box strong {
      color: var(--text-dark);
    }

    .phone-numbers {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    @media (max-width: 480px) {
      .phone-numbers {
        grid-template-columns: 1fr;
      }
    }

    .phone-box {
      background: var(--primary-color);
      color: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
    }

    .phone-box h3 {
      font-size: 0.9rem;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .phone-box p {
      font-size: 1.3rem;
      font-weight: 600;
      margin: 0;
    }

    .modal-footer {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .modal-footer a,
    .modal-footer button {
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      font-size: 0.95rem;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .modal-footer button {
      background: var(--primary-color);
      color: white;
    }

    .modal-footer button:hover {
      background: #026b25;
    }

    .modal-footer a {
      background: #f0f0f0;
      color: var(--text-dark);
    }

    .modal-footer a:hover {
      background: #e0e0e0;
    }

    @media (max-width: 600px) {
      .appointment-form-container {
        padding: 20px;
      }

      .modal-content {
        padding: 20px;
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
  <div class="appointment-hero">
    <h1>Prendre un Rendez-vous</h1>
    <p style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Obtenez un bilan de santé, un traitement et une vie saine</p>
  </div>

  <!-- Main Content -->
  <main class="container">
    <!-- Appointment Form -->
    <div class="appointment-form-container">
      <h2>Formulaire de Rendez-vous</h2>
      <form id="appointmentForm" method="post" action="<?=base_url('appointment/store');?>" novalidate>
        <?= csrf_field() ?>

        <!-- Row 1: Name and Email -->
        <div class="form-row">
          <div class="form-group">
            <label for="name">Nom et Prénom *</label>
            <input type="text" id="name" name="name_surName" placeholder="Votre nom complet" required>
          </div>
          <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" placeholder="example@email.com" required>
          </div>
        </div>

        <!-- Row 2: Phone, Date, Time -->
        <div class="form-row">
          <div class="form-group">
            <label for="phone">Téléphone *</label>
            <input type="tel" id="phone" name="telephone" placeholder="+237 XXX XXX XXX" required>
          </div>
          <div class="form-group">
            <label for="date">Date du rendez-vous *</label>
            <input type="date" id="date" name="date_appointment" required>
          </div>
        </div>

        <!-- Row 3: Time and Service -->
        <div class="form-row">
          <div class="form-group">
            <label for="time">Heure *</label>
            <input type="time" id="time" name="time_appointment" required>
          </div>
          <div class="form-group">
            <label for="service">Service Médical *</label>
            <select id="service" name="service" required>
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
        </div>

        <!-- Row 4: Message -->
        <div class="form-row" style="grid-template-columns: 1fr;">
          <div class="form-group">
            <label for="message">Message (optionnel)</label>
            <textarea id="message" name="raison" placeholder="Raison de la visite..."></textarea>
          </div>
        </div>

        <button type="submit" class="submit-btn">
          <i class="fa-solid fa-calendar-check"></i> Prendre un rendez-vous
        </button>
      </form>
    </div>
  </main>

  <!-- Confirmation Modal -->
  <div id="confirmationModal" class="confirmation-modal">
    <div class="modal-content">
      <div class="modal-header">
        <div class="checkmark">✓</div>
        <h2>Rendez-vous Enregistré!</h2>
      </div>

      <div class="info-box">
        <p><strong>Votre rendez-vous a été enregistré avec succès!</strong></p>
        <p style="margin: 10px 0 0 0; color: var(--text-gray);">Pour confirmer définitivement votre rendez-vous, veuillez appeler le centre au numéro ci-dessous.</p>
      </div>

      <div class="phone-numbers">
        <div class="phone-box">
          <h3>Numéro 1</h3>
          <p><a href="tel:+237657281610" style="color: white; text-decoration: none;">+237 657 28 16 10</a></p>
        </div>
        <div class="phone-box">
          <h3>Numéro 2</h3>
          <p><a href="tel:+237654232692" style="color: white; text-decoration: none;">+237 654 23 26 92</a></p>
        </div>
      </div>

      <div class="info-box" style="border-left-color: var(--accent-color);">
        <p><strong>📧 Email de Confirmation:</strong> Un email de confirmation a été envoyé à votre adresse. Conservez votre numéro de dossier.</p>
        <p style="margin-top: 10px; font-weight: 600;">Numéro de dossier: <span id="appointmentId" style="color: var(--primary-color);">-</span></p>
      </div>

      <div class="info-box" style="border-left-color: var(--secondary-color);">
        <p><i class="fa-solid fa-clock"></i> <strong>Important:</strong> Votre rendez-vous sera tenu réservé pendant 24 heures. Appelez le centre pour confirmer votre présence.</p>
      </div>

      <div class="modal-footer">
        <button onclick="document.getElementById('confirmationModal').classList.remove('show')">Fermer</button>
        <a href="<?=base_url('/');?>">Retour à l'accueil</a>
      </div>
    </div>
  </div>

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
          document.getElementById('appointmentId').textContent = data.appointment_id || 'N/A';
          
          // Show the modal
          document.getElementById('confirmationModal').classList.add('show');

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

    // Close modal when clicking outside
    document.getElementById('confirmationModal').addEventListener('click', function(e) {
      if (e.target === this) {
        this.classList.remove('show');
      }
    });
  </script>

</body>
</html>
